<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Misc extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/misc_model', 'Misc_Model');
    }

//    public function add_guest() {
//        $this->selected_tab = 'guest';
//        $this->selected_child_tab = 'add';
//        $data = array();
//        $this->load->view('admin/guests/add_guest', $data);
//    }

    public function modal_activity() {
        $this->is_ajax();
        $this->selected_tab = 'misc';
        $this->selected_child_tab = 'view_activity';
        $activity_id = $this->input->post('activity_id');
        $activity_data = $this->Misc_Model->get_activity($activity_id);
        $data['activity_data'] = $activity_data;
        $html = $this->load->view('admin/misc/add_activity', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    public function add_update_activity() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('activity_id');
            $this->form_validation->set_rules('activity_name', 'Activity Name', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['activity_name'] = $this->input->post('activity_name');
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
                    $this->Misc_Model->update_activity('activity_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Misc_Model->add_activity($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

    public function view_activities() {
        $this->selected_tab = 'misc';
        $this->selected_child_tab = 'view_activities';
        $this->load->view('admin/misc/view_activities');
    }

    public function get_activities() {
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
        if ($this->input->post('activity_name')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " activities.activity_name LIKE '%" . $this->input->post('activity_name') . "%'";
        }
        if ($this->input->post('created_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " activities.created_on LIKE  '%" . $this->input->post('created_on') . "%'";
        }
        if ($this->input->post('updated_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " activities.updated_on LIKE  '%" . $this->input->post('updated_on') . "%'";
        }
        if ($this->input->post('created_by')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " admins.username LIKE  '%" . $this->input->post('created_by') . "%'";
        }
        if ($this->input->post('is_active') != "") {
            $cond .= ($cond != '' ? ' AND ' : '') . (" activities.is_active = " . $this->input->post('is_active'));
        }

        $colmnsArry = array('`activities`.`activity_name`', '`activities`.`created_on`', '`activities`.`created_by`', '`activities`.`updated_on`', '`activities`.`is_active`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }

        $admins = $this->Misc_Model->getActivities($cond, $offset, $this->page_limit, $sort_by);
        $count = $admins['total'];
        if ($count > 0) {
            foreach ($admins['records'] as $result) {
                $active_html = '<div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="checkbox' . $result['activity_id'] . '" ' . ($result['is_active'] ? "checked='checked'" : "") . ' class="md-check">
                                        <label for="checkbox' . $result['activity_id'] . '">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                        </label>
                                    </div>
                                </div>';
                $records["data"][] = array(
                    $result['activity_name'],
                    $result['created_on'],
                    $result['admin_name'],
                    $result['updated_on'],
                    $active_html,
                    '<a class="btn btn-xs default btn-editable" onclick="Activities.modal_add_activity(' . $result['activity_id'] . ')">Edit</a> <a class="btn btn-xs default btn-editable" onclick="CommonFunctions.Delete(' . $result["activity_id"] . ' , \'tb_activities\' , \'activity_id\' , \'Activity will be permanently deleted without further warning. Do you really want to delete this activity?\');">Delete</a> '
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

    public function view_availabilities() {
        $this->selected_tab = 'misc';
        $this->selected_child_tab = 'view_availabilities';
        $this->load->view('admin/misc/view_availabilities');
    }

    public function get_availabilities() {
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
        if ($this->input->post('activity_name')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " availabilities.availability_name LIKE '%" . $this->input->post('availability_name') . "%'";
        }
        if ($this->input->post('created_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " availabilities.created_on LIKE  '%" . $this->input->post('created_on') . "%'";
        }
        if ($this->input->post('updated_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " availabilities.updated_on LIKE  '%" . $this->input->post('updated_on') . "%'";
        }
        if ($this->input->post('created_by')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " admins.username LIKE  '%" . $this->input->post('created_by') . "%'";
        }
        if ($this->input->post('is_active') != "") {
            $cond .= ($cond != '' ? ' AND ' : '') . (" availabilities.is_active = " . $this->input->post('is_active'));
        }

        $colmnsArry = array('`availabilities`.`availability_name`', '`availabilities`.`created_on`', '`availabilities`.`created_by`', '`availabilities`.`updated_on`', '`availabilities`.`is_active`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }

        $admins = $this->Misc_Model->getAvailabilities($cond, $offset, $this->page_limit, $sort_by);
        $count = $admins['total'];
        if ($count > 0) {
            foreach ($admins['records'] as $result) {
                $active_html = '<div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" id="checkbox' . $result['availability_id'] . '" ' . ($result['is_active'] ? "checked='checked'" : "") . ' class="md-check">
                                        <label for="checkbox' . $result['availability_id'] . '">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                        </label>
                                    </div>
                                </div>';
                $records["data"][] = array(
                    $result['availability_name'],
                    $result['created_on'],
                    $result['admin_name'],
                    $result['updated_on'],
                    $active_html,
                    '<a class="btn btn-xs default btn-editable" onclick="Availabilities.modal_add_availability(' . $result['availability_id'] . ')">Edit</a> <a class="btn btn-xs default btn-editable" onclick="CommonFunctions.Delete(' . $result["availability_id"] . ' , \'tb_availabilities\' , \'availability_id\' , \'Availability option will be permanently deleted without further warning. Do you really want to delete this availability option?\');">Delete</a> '
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

    public function modal_availability() {
        $this->is_ajax();
        $this->selected_tab = 'misc';
        $this->selected_child_tab = 'view_availability';
        $availability_id = $this->input->post('availability_id');
        $availability_data = $this->Misc_Model->get_availability($availability_id);
        $data['availability_data'] = $availability_data;
        $html = $this->load->view('admin/misc/add_availability', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    public function add_update_availability() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('availability_id');
            $this->form_validation->set_rules('availability_name', 'Availability Name', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['availability_name'] = $this->input->post('availability_name');
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
                    $this->Misc_Model->update_availability('availability_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Misc_Model->add_availability($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

    public function DeleteRecord() {
        $this->isAjax();
        $unique_id = $this->input->post('unique_id');
        $table = $this->input->post('table');
        $column = $this->input->post('column');
        $result = $this->Misc_Model->DeleteRecord($unique_id, $table, $column);
        if ($result) {
            $this->_response(false, "Record deleted successfully!");
        }
        $this->_response(true, "Problem while deleting record.");
    }

}
