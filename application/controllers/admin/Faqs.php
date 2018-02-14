<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faqs extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/faqs_model', 'Faqs_Model');
    }

    function modal_faq() {
        $this->is_ajax();
        $faq_id = $this->input->post('faq_id');
        $faq_data = $this->Faqs_Model->get_faq($faq_id);
        $data['faq_data'] = $faq_data;
        $html = $this->load->view('admin/faqs/add_faq', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_faq() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('faq_id');
            $this->form_validation->set_rules('faq_question', 'Faq Question', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('faq_answer', 'Faq Answer', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['faq_question'] = $this->input->post('faq_question');
                $data['faq_answer'] = $this->input->post('faq_answer');
                $data['is_active'] = $this->input->post('is_active') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $this->session->userdata('admin_id');
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }
                $result = false;
                if ($edit_id > 0) {
                    $this->Faqs_Model->update_faq('faq_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Faqs_Model->add_faq($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

    function view_faqs() {
        $this->selected_tab = 'faqs';
        $this->selected_child_tab = 'view_faqs';
        $this->load->view('admin/faqs/view_faqs');
    }

    function get_faqs() {
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
        if ($this->input->post('faq_question')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " faqs.faq_question LIKE '%" . $this->input->post('faq_question') . "%'";
        }
        if ($this->input->post('created_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " faqs.created_on LIKE  '%" . $this->input->post('created_on') . "%'";
        }
        if ($this->input->post('updated_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " faqs.updated_on LIKE  '%" . $this->input->post('updated_on') . "%'";
        }
        if ($this->input->post('created_by')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " admins.username LIKE  '%" . $this->input->post('created_by') . "%'";
        }
        if ($this->input->post('is_active') != "") {
            $cond .= ($cond != '' ? ' AND ' : '') . (" faqs.is_active = " . $this->input->post('is_active'));
        }

        $colmnsArry = array('`faqs`.`faq_question`', '`faqs`.`created_on`', '`faqs`.`updated_on`', '`faqs`.`created_by`', '`faqs`.`updated_by`', '`faqs`.`is_active`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }

        $admins = $this->Faqs_Model->getFaqs($cond, $offset, $this->page_limit, $sort_by);
        $count = $admins['total'];
        if ($count > 0) {
            foreach ($admins['records'] as $result) {
                $active_html = '<div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" disabled="disabled" id="checkbox' . $result['faq_id'] . '" ' . ($result['is_active'] ? "checked='checked'" : "") . ' class="md-check">
                                        <label for="checkbox' . $result['faq_id'] . '">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                        </label>
                                    </div>
                                </div>';
                $records["data"][] = array(
                    $result['faq_question'],
                    $result['created_on'],
                    $result['updated_on'],
                    $result['admin_name'],
                    $active_html,
                    '<a class="btn btn-xs default btn-editable" onclick="Faqs.modal_add_faq(' . $result['faq_id'] . ')">Edit</a> <a class="btn btn-xs default btn-editable" onclick="CommonFunctions.Delete(' . $result["faq_id"] . ' , \'tb_faqs\' , \'faq_id\' , \'Faq will be permanently deleted without further warning. Do you really want to delete this Faq?\');">Delete</i></a> '
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

}
