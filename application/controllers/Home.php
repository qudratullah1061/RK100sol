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
        $this->load->model('admin/members_model', 'Members_model');
    }

    function index() {
        $this->selected_tab = 'home';
        $categories_data = $this->Misc_Model->get_all_categories();
        $data['categories_data'] = $categories_data;
        $this->load->view('frontend/home', $data);
    }

    function searchmember() {
        if (isset($_GET['location']) && $_GET['location'] != '') {
            $categories_data = $this->Misc_Model->get_all_categories();
            $data['categories_data'] = $categories_data;
            $geo_codes = getGeoCodes($_GET['location']);
            if (count($geo_codes) > 0) {
                $loc = $_GET['location'];
                $radius = $_GET['radius'];
                $cat_available = $_GET['category_available'];
                $members_list = $this->Members_model->search_members($loc, $radius, $cat_available, $geo_codes);
            }
            $data['members_list'] = $members_list;
//            echo '<pre>';
//            print_r($members_list);
//            exit;
            $this->load->view('frontend/member/search', $data);
        } else {
            redirect(base_url());
        }
    }

    function not_found() {
        $this->load->view('frontend/page404');
    }

}
