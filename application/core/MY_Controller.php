<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class FrontEnd_Controller extends CI_Controller {

    var $selected_tab = '';
    var $member_info = array();

    function __construct() {
        parent::__construct();
        $this->authenticate();
    }

    private function setMemberInfo() {
        $this->load->model('admin/members_model', 'Members_Model');
        //$loggedin_userInfo = $this->db->get_where('tb_members', array('member_id' => $this->session->userdata('member_id')))->result_array();
        $loggedin_userInfo = $this->Members_Model->get_member_by_id($this->session->userdata('member_id'));
        //echo '<pre>';print_r($loggedin_userInfo);exit;
        if ($loggedin_userInfo) {
            unset($loggedin_userInfo['password']);
            $this->member_info = isset($loggedin_userInfo) ? $loggedin_userInfo : null;
        }
    }

    //Authenticate function
    private function authenticate() {
        if (!$this->session->userdata('member_id')) {
            redirect(base_url('login'));
        }
        $this->setMemberInfo();
    }

    public function upload_temp_image($files, $unique_id, $image_type) {
        try {
            if ($files) {
                $uploaddir = $this->config->item('root_path') . 'uploads/temp_images/';
                foreach ($files as $file) {
                    $file_name = $unique_id . basename($file['name']);
                    $uploadfile = $uploaddir . $file_name;
                    move_uploaded_file($file['tmp_name'], $uploadfile);
                    // inset record in db
                    $data = array('image' => $file_name, 'image_path' => str_replace($this->config->item('root_path'), "", $uploaddir), 'unique_id' => $unique_id, 'image_type' => $image_type, 'created_on' => date("Y-m-d h:i:s"));
                    $this->db->insert('tb_temp_images_upload', $data);
                }
            }
            return 'success';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    // general json error
    public function _response($is_error = true, $description = '', $status = '') {
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode(array(
            'error' => $is_error,
            'description' => $description,
            'code' => $status
        )))->_display();
        die();
    }

    public function isAjax() {
        header('Content-Type: application/json');
    }

}

#Admin Core Controller

class Admin_Controller extends CI_Controller {

    var $selected_tab = 'admin';
    var $selected_child_tab = 'dashboard';
    var $admin_info = array();

    function __construct() {
        parent::__construct();
        $this->authenticate();
    }

    private function setAdminInfo() {
        $loggedin_userInfo = $this->db->get_where('tb_admin_users', array('admin_id' => $this->session->userdata('admin_id')))->result_array();
        if ($loggedin_userInfo) {
            unset($loggedin_userInfo[0]['password']);
            $this->admin_info = isset($loggedin_userInfo[0]) ? $loggedin_userInfo[0] : null;
        }
    }

    //Authenticate function
    private function authenticate() {
        if (!$this->session->userdata('admin_id')) {
            redirect(base_url('admin/admin_auth'));
        } elseif ($this->session->userdata('is_locked')) {
            redirect(base_url('admin/admin_auth'));
        } elseif (!isAdminHasAccess($this->router->fetch_class(), $this->router->fetch_method())) {
            RedirectAdminToAppropriatePage();
        }

        $this->setAdminInfo();
    }

    // general json error
    public function _response($is_error = true, $description = '', $status = '') {
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode(array(
            'error' => $is_error,
            'description' => $description,
            'code' => $status
        )))->_display();
        die();
    }

    public function isAjax() {
        header('Content-Type: application/json');
    }

    protected function make_alias($string, $force_lowercase = true, $anal = false) {
        $strip = array("~", "`", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "=", "+", "[", "{", "]",
            "}", "\\", "|", ";", ":", "\"", "'", "&#8216;", "&#8217;", "&#8220;", "&#8221;", "&#8211;", "&#8212;",
            'â€"', 'â€"', ",", "<", ".", ">", "/", "?");
        $clean = trim(str_replace($strip, "", strip_tags($string)));
        $clean = preg_replace('/\s+/', "_", $clean);
        $clean = ($anal) ? preg_replace("/[^a-zA-Z0-9]/", "", $clean) : $clean;
        return ($force_lowercase) ?
                (function_exists('mb_strtolower')) ?
                        mb_strtolower($clean, 'UTF-8') :
                        strtolower($clean) :
                $clean;
    }

    public function upload_temp_image($files, $unique_id, $image_type) {
        try {
            if ($files) {
                $uploaddir = $this->config->item('root_path') . 'uploads/temp_images/';
                foreach ($files as $file) {
                    $file_name = basename($file['name']);
                    $uploadfile = $uploaddir . $file_name;
                    move_uploaded_file($file['tmp_name'], $uploadfile);
                    // inset record in db
                    $data = array('image' => $file_name, 'image_path' => str_replace($this->config->item('root_path'), "", $uploaddir), 'unique_id' => $unique_id, 'image_type' => $image_type, 'created_on' => date("Y-m-d h:i:s"));
                    $this->db->insert('tb_temp_images_upload', $data);
                }
            }
            return 'success';
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }

    public function echo_pre($data_array) {
        echo "<pre>";
        print_r($data_array);
        exit;
    }

    public function echo_vardump($data_array) {
        echo "<pre>";
        var_dump($data_array);
        exit;
    }

    public function is_ajax() {
        header('Content-Type: application/json');
    }

}
