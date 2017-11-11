<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
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
            $this->admin_info = isset($loggedin_userInfo[0]) ? $loggedin_userInfo[0] : null;
        }
    }

    //Authenticate function
    private function authenticate() {
        if (!$this->session->userdata('admin_id')) {
            redirect(base_url('admin/admin_auth'));
        } elseif ($this->session->userdata('is_locked')) {
            redirect(base_url('admin/admin_auth'));
        }
        $this->setAdminInfo();
    }

    // general json error
    public function _fail($description = '', $status = '') {
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode(array(
            'error' => 1,
            'error_description' => $description,
            'error_code' => $status
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

}
