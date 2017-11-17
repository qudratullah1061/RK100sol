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

    // view to add guest
    public function add_guest() {
        $this->selected_tab = 'guest';
        $this->selected_child_tab = 'add';
        $data['country_options'] = GetCountriesOption();
        $this->load->view('admin/guests/add_guest', $data);
    }

    function chk_member_username_exist($email, $exclude_id) {
        $result = is_member_username_exist($email, $exclude_id);
        if ($result) {
            $this->form_validation->set_message('chk_member_username_exist', 'The %s already exist. Please choose other email!');
            return false;
        }
        return true;
    }

    function chk_member_email_exist($email, $exclude_id) {
        $result = is_member_email_exist($email, $exclude_id);
        if ($result) {
            $this->form_validation->set_message('chk_member_email_exist', 'The %s already exist. Please choose other email!');
            return false;
        }
        return true;
    }

    public function add_guest_user() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('member_id') > 0 ? $this->input->post('member_id') : 0;
            $unique_id = $this->input->post('file_upload_unique_id');
            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|strip_tags|xss_clean|callback_chk_member_username_exist[' . $edit_id . ']');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|strip_tags|xss_clean|callback_chk_member_email_exist[' . $edit_id . ']');
            if (!$edit_id || ($this->input->post('password') != "" || $this->input->post('confirm_password') != "")) {
                $this->form_validation->set_rules('password', 'Password', 'required|trim|strip_tags|xss_clean');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|strip_tags|xss_clean|matches[password]');
            }
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('gender', 'Gender', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('state', 'State', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('address', 'Address', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['first_name'] = $this->input->post('first_name');
                $data['last_name'] = $this->input->post('last_name');
                $data['username'] = $this->input->post('username');
                $data['email'] = $this->input->post('email');
                if ($this->input->post('password') != "") {
                    $data['password'] = md5($this->input->post('password'));
                }
                $data['phone_number'] = $this->input->post('phone_number');
                $data['gender'] = $this->input->post('gender');
                $data['date_of_birth'] = $this->input->post('date_of_birth');
                $data['country'] = $this->input->post('country');
                $data['state'] = $this->input->post('state');
                $data['city'] = $this->input->post('city');
                $data['address'] = $this->input->post('address');
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $this->session->userdata('admin_id');
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }

                $result = false;
                if ($edit_id > 0) {
                    $this->Members_Model->update_member($edit_id, $data);
                    $result = true;
                } else {
                    $data['member_type'] = 1;
                    $edit_id = $result = $this->Members_Model->add_member($data);
                }
                // upload id proof images
                if (isset($_FILES['id_proofs']['name']) && $_FILES['id_proofs']['name'] != "" && $edit_id > 0) {
                    $id_proofs = reArrayFiles($_FILES['id_proofs']);
                    $upload_dir = $this->config->item('root_path') . 'uploads/member_images/id_proofs/';
                    foreach ($id_proofs as $id_proof) {
                        $thumb_options[0] = array('width' => 50, 'height' => 50, 'prefix' => 'small_');
                        $thumb_options[1] = array('width' => 150, 'height' => 150, 'prefix' => 'medium_');
                        $thumb_options[2] = array('width' => 400, 'height' => 400, 'prefix' => 'large_');
                        $file_name = basename($id_proof['name']);
                        $file_name = time() . $file_name;
                        $file_path = $upload_dir . '/' . $file_name;
                        move_uploaded_file($id_proof['tmp_name'], $file_path);
                        CreateThumbnail($file_path, $upload_dir, $thumb_options);
                        // insert in database as well.
                        $image_data = array('member_id' => $edit_id, 'image_type' => 'id_proof', 'image_name' => $file_name, 'image_path' => str_replace($this->config->item('root_path'), "", $upload_dir));
                        $this->db->insert('tb_member_images', $image_data);
                    }
                }
                // move temp images to tb_member_images after creating thumbnails
                $profile_images = $this->Members_Model->getTempImages($unique_id, 'profile');
                if ($profile_images) {
                    $current_time = time();
                    foreach ($profile_images as $image) {
                        $fname = $current_time . $image['image'];
                        $image_old_path = $this->config->item('root_path') . $image['image_path'] . $image['image'];
                        $image_new_path = $this->config->item('root_path') . "uploads/member_images/profile/" . $fname;
                        if (file_exists($image_old_path)) {
                            rename($image_old_path, $image_new_path);
                            unlink($image_old_path);
                        }
                    }
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

    public function upload_images() {
        $unique_id = $this->input->post('file_upload_unique_id');
        $image_type = $this->input->post('image_type');
        $result = $this->upload_temp_image($_FILES, $unique_id, $image_type);
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
