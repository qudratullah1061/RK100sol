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

    public function view_activities() {
        $this->selected_tab = 'misc';
        $this->selected_child_tab = 'view_activities';
        $data = array();
        $this->load->view('admin/misc/view_activities', $data);
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
//        if ($this->input->post('username')) {
//            $cond .= ($cond != '' ? ' AND ' : '') . " tb_activities.activity_name '%" . $this->input->post('username') . "%'";
//        }
//        if ($this->input->post('first_name')) {
//            $cond .= ($cond != '' ? ' AND ' : '') . " tb_admin_users.first_name LIKE  '%" . $this->input->post('first_name') . "%'";
//        }
//        if ($this->input->post('last_name')) {
//            $cond .= ($cond != '' ? ' AND ' : '') . " tb_admin_users.last_name LIKE  '%" . $this->input->post('last_name') . "%'";
//        }
//        if ($this->input->post('email')) {
//            $cond .= ($cond != '' ? ' AND ' : '') . " tb_admin_users.email LIKE  '%" . $this->input->post('email') . "%'";
//        }
//        if ($this->input->post('updated_on')) {
//            $cond .= ($cond != '' ? ' AND ' : '') . " tb_admin_users.updated_on LIKE  '%" . $this->input->post('updated_on') . "%'";
//        }

        $colmnsArry = array('', '`tb_activities`.`activity_name`', '`tb_activities`.`created_on`', '`tb_activities`.`created_by`', '`tb_activities`.`updated_on`', '`tb_activities`.`updated_by`');
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
                $records["data"][] = array(
                    $result['activity_name'],
                    $result['created_on'],
                    $result['created_by'],
                    $result['updated_on'],
                    $result['updated_by'],
//                    '<a class="btn btn-xs default btn-editable" onclick="upload_file(' . $result["type_id"] . ');">File Upload</a>',
                    '<a class="btn btn-xs default btn-editable" onclick="show_edit(' . $result['activity_id'] . ')">Edit</a> <a class="btn btn-xs default btn-editable" onclick="delete_type(' . $result["activity_id"] . ');">Delete</a> '
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
