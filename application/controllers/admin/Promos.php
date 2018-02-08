<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promos extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/promos_model', 'Promos_Model');
    }

    function modal_promo() {
        $this->is_ajax();
//        $this->selected_tab = 'blogs';
//        $this->selected_child_tab = 'view_tags';
        $promo_id = $this->input->post('promo_id');
        $promo_data = $this->Promos_Model->get_promo($promo_id);
        $data['promo_data'] = $promo_data;
        $html = $this->load->view('admin/promos/add_promo', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_promo() {
        $this->isAjax();
        if ($this->input->post()) {
            $cur_promo_code = $this->input->post('current_promo_code');
            if ($this->input->post('promo_code') != $cur_promo_code) {
                $is_unique = '|is_unique[tb_promos.promo_code]';
            } else {
                $is_unique = '';
            }
            $data = array();
            $edit_id = $this->input->post('promo_id');
            $this->form_validation->set_rules('promo_title', 'Promo Title', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('promo_code', 'Promo Code', 'required|trim|strip_tags|xss_clean'.$is_unique);

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['promo_title'] = $this->input->post('promo_title');
                $data['promo_code'] = $this->input->post('promo_code');
                $data['promo_subscription_discount'] = $this->input->post('promo_subscription_discount');
                $data['promo_sub_dis_value'] = $this->input->post('promo_sub_dis_value');
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
                    $this->Promos_Model->update_promo('promo_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Promos_Model->add_promo($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

    function view_promos() {
//        $this->selected_tab = 'blogs';
//        $this->selected_child_tab = 'view_tags';
        $this->load->view('admin/promos/view_promos');
    }

    function get_promos() {
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
        if ($this->input->post('promo_title')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " promos.promo_title LIKE '%" . $this->input->post('promo_title') . "%'";
        }
        if ($this->input->post('created_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " promos.created_on LIKE  '%" . $this->input->post('created_on') . "%'";
        }
        if ($this->input->post('updated_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " promos.updated_on LIKE  '%" . $this->input->post('updated_on') . "%'";
        }
        if ($this->input->post('created_by')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " admins.username LIKE  '%" . $this->input->post('created_by') . "%'";
        }
        if ($this->input->post('is_active') != "") {
            $cond .= ($cond != '' ? ' AND ' : '') . (" promos.is_active = " . $this->input->post('is_active'));
        }

        $colmnsArry = array('`promos`.`promo_title`', '`promos`.`created_on`', '`promos`.`updated_on`', '`promos`.`created_by`', '`promos`.`updated_by`', '`promos`.`is_active`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }

        $admins = $this->Promos_Model->getPromos($cond, $offset, $this->page_limit, $sort_by);
        $count = $admins['total'];
        if ($count > 0) {
            foreach ($admins['records'] as $result) {
                $active_html = '<div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" disabled="disabled" id="checkbox' . $result['promo_id'] . '" ' . ($result['is_active'] ? "checked='checked'" : "") . ' class="md-check">
                                        <label for="checkbox' . $result['promo_id'] . '">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                        </label>
                                    </div>
                                </div>';
                $records["data"][] = array(
                    $result['promo_title'],
                    $result['created_on'],
                    $result['updated_on'],
                    $result['admin_name'],
                    $active_html,
                    '<a class="btn btn-xs default btn-editable" onclick="Promos.modal_add_promo(' . $result['promo_id'] . ')">Edit</a> <a class="btn btn-xs default btn-editable" onclick="CommonFunctions.Delete(' . $result["promo_id"] . ' , \'tb_promos\' , \'promo_id\' , \'Promo will be permanently deleted without further warning. Do you really want to delete this Promo?\');">Delete</i></a> '
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