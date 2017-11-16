<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guests extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/members_model', 'Members_Model');
    }

    //Main dashboard index function
    public function index() {
        $this->selected_tab = 'guest';
        $this->selected_child_tab = 'view';
        $data = array();
        $this->load->view('admin/guests/view_guests', $data);
    }

    public function add_guest() {
        $this->selected_tab = 'guest';
        $this->selected_child_tab = 'add';
        $data['country_options'] = GetCountriesOption();
        $this->load->view('admin/guests/add_guest', $data);
    }

    public function upload_images() {
        $unique_id = $this->input->post('file_upload_unique_id');
        $result = $this->upload_temp_image($_FILES, $unique_id);
        if ($result == 'success') {
            $this->_response(true, 'File uploaded successfully!');
        }
    }

    public function get_guest_users() {
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
        $cond = ' `tb_members`.member_type = 1 ';
        if ($this->input->post('username')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " `tb_members`.username '%" . $this->input->post('username') . "%'";
        }
        if ($this->input->post('first_name')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " `tb_members`.first_name LIKE  '%" . $this->input->post('first_name') . "%'";
        }
        if ($this->input->post('last_name')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " `tb_members`.last_name LIKE  '%" . $this->input->post('last_name') . "%'";
        }
        if ($this->input->post('email')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " `tb_members`.email LIKE  '%" . $this->input->post('email') . "%'";
        }
        if ($this->input->post('updated_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " `tb_members`.updated_on LIKE  '%" . $this->input->post('updated_on') . "%'";
        }

        $colmnsArry = array('', '`tb_members`.`username`', '`tb_members`.`first_name`', '`tb_members`.`last_name`', '`tb_members`.`email`', '`tb_members`.`updated_on`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }
        $admins = $this->Members_Model->getMembers($cond, $offset, $this->page_limit, $sort_by);
        $count = $admins['total'];
        if ($count > 0) {
            foreach ($admins['records'] as $result) {
                $records["data"][] = array(
                    '<img alt="Profile Image" class="img-circle" src="' . base_url($result['image_path'] . $result['image']) . '">',
                    $result['username'],
                    $result['first_name'],
                    $result['last_name'],
                    $result['email'],
                    $result['updated_on'],
                    '<a class="btn btn-xs default btn-editable">Edit</a> <a class="btn btn-xs default btn-editable">Delete</a> '
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
