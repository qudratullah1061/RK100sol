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
                $actions = '<a class="btn btn-xs default btn-editable" href="' . base_url('admin/admin_dashboard/admin_profile/' . $result['admin_id']) . '">Edit</a>';
                if ($result["admin_id"] != 1) {
                    $actions .='<a class="btn btn-xs default btn-editable" onclick="CommonFunctions.Delete(' . $result["admin_id"] . ',\'tb_admin_users\' , \'admin_id\' , \'User will be permanently deleted without further warning. Do you really want to delete this user?\')">Delete</a>';
                }
                $records["data"][] = array(
                    '<img alt="Profile Image" class="img-circle" src="' . base_url($result['image_path'] . '/small_' . $result['image']) . '">',
                    $result['username'],
                    $result['first_name'],
                    $result['last_name'],
                    $result['email'],
                    $result['updated_on'],
                    $actions
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

    // end here
    // Admin CRUD start here
    public function modal_add_admin() {
        $this->is_ajax();
        $this->selected_tab = 'admin';
        $this->selected_child_tab = 'admin_users';
        $data = array();
        $html = $this->load->view('admin/dashboard/modal_add_admin', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    public function is_admin_username_exist($username) {
        $result = $this->Admin_Model->is_admin_username_exist($username);
        if ($result) {
            $this->form_validation->set_message('is_admin_username_exist', 'The %s already exist. Please choose other username!');
            return false;
        }
        return true;
    }

    public function is_admin_email_exist($email) {
        $result = $this->Admin_Model->is_admin_email_exist($email);
        if ($result) {
            $this->form_validation->set_message('is_admin_email_exist', 'The %s already exist. Please choose other email!');
            return false;
        }
        return true;
    }

    public function add_admin_user() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|strip_tags|xss_clean|callback_is_admin_username_exist');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|strip_tags|xss_clean|callback_is_admin_email_exist');
            $this->form_validation->set_rules('about_me', 'About Me', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|strip_tags|xss_clean|matches[password]');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['first_name'] = $this->input->post('first_name');
                $data['last_name'] = $this->input->post('last_name');
                $data['username'] = $this->input->post('username');
                $data['email'] = $this->input->post('email');
                $data['password'] = $this->input->post('password');
                $data['about_me'] = $this->input->post('about_me');
                $data['facebook_link'] = $this->input->post('facebook_link');
                $data['twitter_link'] = $this->input->post('twitter_link');
                $data['linkedin_link'] = $this->input->post('linkedin_link');
                $data['instagram_link'] = $this->input->post('instagram_link');
                $data['updated_on'] = $data['created_on'] = date("Y-m-d H:m:i");
                $data['updated_by'] = $data['created_by'] = date("Y-m-d H:m:i");
                // upload image
                $thumb_options[0] = array('width' => 50, 'height' => 50, 'prefix' => 'small_');
                $thumb_options[1] = array('width' => 150, 'height' => 150, 'prefix' => 'medium_');
                $result = UploadImage('image', "uploads/admin/admin_profiles", TRUE, $thumb_options);
                if (isset($result['error'])) {
                    $this->_response(true, $result['error']);
                }
                $data['image'] = $result['upload_data']['file_name'];
                $data['image_path'] = $result['upload_data']['file_path'];
                $insert_id = $this->Admin_Model->add_admin_user($data);
                if ($insert_id) {
                    $this->_response(false, "New admin added successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

    // Admin CRUD ends here
}
