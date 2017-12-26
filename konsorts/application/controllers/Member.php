<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends FrontEnd_Controller {

    function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/members_model', 'Members_Model');
    }

    function profile($member_id = '') {
        if ($member_id != '') {
            $member_id = base64_decode($member_id);
        } else {
            $member_id = $this->session->userdata('member_id');
        }

        $member_info = $this->Members_Model->get_member_by_id($member_id);
        // not in used yet.
        //$data['member_profile_pics'] = $this->Members_Model->get_member_images_by_type(array('image_type' => 'profile', 'member_id' => $member_id));
        //$data['member_id_proofs'] = $this->Members_Model->get_member_images_by_type(array('image_type' => 'id_proof', 'member_id' => $member_id));
        if ($member_info) {
            $data['member_info'] = $member_info;
            // not in used yet.
            //$data['member_images'] = $member_info;
            $data['selected_categories'] = $this->Members_Model->get_selected_categories($member_id);
            $data['selected_sub_categories'] = $this->Members_Model->get_selected_sub_categories($member_id);
            $data['portfolios'] = $this->Members_Model->get_member_portfolio($member_id, "AND `tb_member_portfolios`.is_active = 1");
            //$data['country_options'] = GetCountriesOption($member_info['country']);
            //$data['state_options'] = GetStatesOption($member_info['country'], $member_info['state']);
            //$data['city_options'] = GetCityOptions($member_info['state'], $member_info['city']);
            // echo '<pre>';
            // print_r($data['portfolios']);exit;

            if ($member_info['member_type'] == 2 || $member_info['member_type'] == 1) {
                $this->load->view('frontend/member/companion_profile', $data);
            }
        } else {
            redirect(base_url());
        }
    }

}
