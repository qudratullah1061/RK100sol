<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_dashboard extends Admin_Controller {

    public function __construct() {
        parent::__construct();
//        $this->load->model('admin/admin_message_mod', 'ADMIN_MESSAGES');
        $this->layout = 'admin/main';
    }

    //Main dashboard index function
    public function index() {
        $this->selected_tab = 'admin';
        $this->selected_child_tab = 'dashboard';
        $data = array();
        $this->load->view('admin/dashboard/view_dashboard', $data);
    }

}
