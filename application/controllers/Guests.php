<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guests extends FrontEnd_Controller {

    function __construct() {
        parent::__construct();
        if ($this->session->userdata('member_type') == 2) {
            redirect(base_url('companions/get_companion_profile'));
        }
        $this->layout = 'frontend/main';
        $this->load->model('admin/members_model', 'Members_Model');
    }

    public function get_guest_profile() {
//        if (!$user_id || ($user_id == 1 && $this->admin_info['admin_id'] != 1)) {
//            redirect(base_url('admin/dashboard'));
//        }
        $member_id = $this->session->userdata('member_id');
        $member_info = $this->Members_Model->get_member_by_id($member_id);
        $data['member_profile_pics'] = $this->Members_Model->get_member_images_by_type(array('image_type' => 'profile', 'member_id' => $member_id));
        $data['member_id_proofs'] = $this->Members_Model->get_member_images_by_type(array('image_type' => 'id_proof', 'member_id' => $member_id));
        if ($member_info) {
            $data['member_info'] = $member_info;
            $data['member_images'] = $member_info;
            $data['country_options'] = GetCountriesOption($member_info['country']);
            $data['state_options'] = GetStatesOption($member_info['country'], $member_info['state']);
            $data['city_options'] = GetCityOptions($member_info['state'], $member_info['city']);
            $data['language_data'] = $this->Members_Model->get_member_languages($member_id);
            $this->load->view('frontend/guests/view_guest_profile', $data);
        } else {
            redirect(base_url());
        }
    }

}
