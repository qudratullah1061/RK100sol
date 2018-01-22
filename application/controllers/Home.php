<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    var $selected_tab = 'home';

    function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/misc_model', 'Misc_Model');
    }

    function index() {
        $this->selected_tab = 'home';
        $categories_data = $this->Misc_Model->get_all_categories();
        $data['categories_data'] = $categories_data;
        $this->load->view('frontend/home', $data);
    }

    function searchmember() {
        if (isset($_GET['location']) && isset($_GET['radius']) && isset($_GET['category_available'])) {
            $this->load->view('frontend/member/search');
        } else {
            redirect(base_url());
        }
    }

    function not_found() {
        $this->load->view('frontend/page404');
    }

}
