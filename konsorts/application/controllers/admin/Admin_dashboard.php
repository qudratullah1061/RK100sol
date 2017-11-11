<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/Admin_model', 'Admin_Model');
    }

    //Main dashboard index function
    public function index() {
        $this->selected_tab = 'admin';
        $this->selected_child_tab = 'dashboard';
        $data = array();
        $this->load->view('admin/dashboard/view_dashboard', $data);
    }

    public function admin_users() {
        $this->selected_tab = 'admin';
        $this->selected_child_tab = 'admin_users';
        $data = array();
        $this->load->view('admin/admin_users/view_users', $data);
    }

    public function admin_profile($user_id) {
        if (!$user_id) {
            redirect(base_url('admin/dashboard'));
        }
        $this->selected_tab = 'admin';
        $this->selected_child_tab = 'AdminUsers';
        $admin_info = GetAdminInfoWithId($user_id);
        $data['admin_info'] = $admin_info;
        $this->load->view('admin/dashboard/view_admin_profile', $data);
    }

    public function get_admin_users() {
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
        if ($this->input->post('username')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " tb_admin_users.username '%" . $this->input->post('username') . "%'";
        }
        if ($this->input->post('first_name')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " tb_admin_users.first_name LIKE  '%" . $this->input->post('first_name') . "%'";
        }
        if ($this->input->post('last_name')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " tb_admin_users.last_name LIKE  '%" . $this->input->post('last_name') . "%'";
        }
        if ($this->input->post('email')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " tb_admin_users.email LIKE  '%" . $this->input->post('email') . "%'";
        }
        if ($this->input->post('updated_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " tb_admin_users.updated_on LIKE  '%" . $this->input->post('updated_on') . "%'";
        }

        $colmnsArry = array('', '`tb_admin_users`.`username`', '`tb_admin_users`.`first_name`', '`tb_admin_users`.`last_name`', '`tb_admin_users`.`email`', '`tb_admin_users`.`updated_on`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }
        $admins = $this->Admin_Model->getAdminUsers($cond, $offset, $this->page_limit, $sort_by);
        $count = $admins['total'];
        if ($count > 0) {
            foreach ($admins['admin_users'] as $result) {
                $records["data"][] = array(
                    '<img alt="Profile Image" class="img-circle" src="' . base_url($result['image_path'] . $result['image']) . '">',
                    $result['username'],
                    $result['first_name'],
                    $result['last_name'],
                    $result['email'],
                    $result['updated_on'],
//                    '<a class="btn btn-xs default btn-editable" onclick="upload_file(' . $result["type_id"] . ');">File Upload</a>',
                    '<a class="btn btn-xs default btn-editable" onclick="show_edit(' . $result['admin_id'] . ')">Edit</a> <a class="btn btn-xs default btn-editable" onclick="delete_type(' . $result["admin_id"] . ');">Delete</a> '
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
