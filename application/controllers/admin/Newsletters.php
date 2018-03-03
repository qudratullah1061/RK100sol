<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newsletters extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/newsletters_model', 'Newsletters_Model');
    }

    function add_update_newsletter() {
        $this->isAjax();
        if ($this->input->post()) {
            $cur_newsletter_email = $this->input->post('current_newsletter_email');
            if ($this->input->post('newsletter_code') != $cur_newsletter_email) {
                $is_unique = '|is_unique[tb_newsletters.newsletter_email]';
            } else {
                $is_unique = '';
            }
            $data = array();
            $edit_id = $this->input->post('newsletter_id');
            $this->form_validation->set_rules('newsletter_email', 'Email', 'required|trim|strip_tags|xss_clean'.$is_unique);

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['newsletter_email'] = $this->input->post('newsletter_email');
                $data['created_on'] = date("Y-m-d h:i:s");
                $result = $this->Newsletters_Model->add_newsletter($data);
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

    function view_newsletters() {
        $this->selected_tab = 'newsletters';
        $this->selected_child_tab = 'view_newsletters';
        $this->load->view('admin/newsletters/view_newsletters');
    }

    function get_newsletters() {
        $records = array();
        $records["data"] = array();
        $sEcho = intval($this->input->post('draw'));
        $offset = $this->input->post('start');
        if (trim($offset) == "") {
            $offset = 1;
        }
        $this->page_limit = $this->input->post('length');
        $columns = $this->input->post('columns');
        $sort_by = '';
        $cond = '';
        if ($this->input->post('newsletter_email')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " newsletters.newsletter_email LIKE '%" . $this->input->post('newsletter_email') . "%'";
        }
        if ($this->input->post('created_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " newsletters.created_on LIKE  '%" . $this->input->post('created_on') . "%'";
        }

        $colmnsArry = array('`newsletters`.`newsletter_email`', '`newsletters`.`created_on`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }

        $admins = $this->Newsletters_Model->getNewsletters($cond, $offset, $this->page_limit, $sort_by);
        $count = $admins['total'];
        if ($count > 0) {
            foreach ($admins['records'] as $result) {
                $records["data"][] = array(
                    $result['newsletter_email'],
                    $result['created_on'],
                    '<a class="btn btn-xs default btn-editable" onclick="CommonFunctions.Delete(' . $result["newsletter_id"] . ' , \'tb_newsletters\' , \'newsletter_id\' , \'Newsletter Email will be permanently deleted without further warning. Do you really want to delete this Email?\');">Delete</i></a> '
                );
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records["query"] = $admins['query'];
        echo json_encode($records);
        exit();
    }
    
    function send_newsletters() {
        $this->selected_tab = 'newsletters';
        $this->selected_child_tab = 'view_newsletters';
        $data['newsletters'] = $this->Newsletters_Model->get_all_newsletters();
        $this->load->view('admin/newsletters/send_newsletters', $data);
    }
    function send_mail() {
        $this->isAjax();
        $this->selected_tab = 'newsletters';
        $this->selected_child_tab = 'view_newsletters';
        $this->form_validation->set_rules('newsletter_email[]', 'Email', 'required');
        if ($this->form_validation->run() == FALSE) {
            $records["error"] = true;
            $records["description"] = "Please select atleast one email!";
            echo json_encode($records);
            die();
        } else {
            $newsletter_email = $this->input->post('newsletter_email');
            $newsletter_email[] = 'sufyan.cs10@gmail.com';
            $newsletter_text = $this->input->post('write_newsletter');
            $subject = 'Newsletter';
            foreach($newsletter_email as $mail){
                $resultOfEmail = sendEmail($mail, $subject, $newsletter_text);
            }
            if(!$resultOfEmail){
                $records["error"] = true;
                $records["description"] = "Newsletter cannot be sent at the moment! Please check your internet connection";
                echo json_encode($records);
                die();
            }
            $records["error"] = false;
            $records["description"] = "Newsletter has been sent successfully!";
            echo json_encode($records);
            die();
        }
    }

}
