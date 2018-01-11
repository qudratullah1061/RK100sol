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
        $this->load->model('admin/notification_model', 'Notification_Model');
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
            //$data['country_options'] = GetCountriesOption($member_info['country']);
            //$data['state_options'] = GetStatesOption($member_info['country'], $member_info['state']);
            //$data['city_options'] = GetCityOptions($member_info['state'], $member_info['city']);
            // echo '<pre>';
            // print_r($data['portfolios']);exit;
            
            //$data['notifications']  = $this->Notification_Model->get_all_notifications(1,'AND tb_notification_users.receiver_id = '.$member_id.'');
           
            $data['data_languages'] = $this->Members_Model->get_member_languages($member_id, "AND `tb_member_languages`.is_active = 1");
            if ($member_info['member_type'] == 2) {
                $data['selected_categories'] = $this->Members_Model->get_selected_categories($member_id);
                $data['selected_sub_categories'] = $this->Members_Model->get_selected_sub_categories($member_id);
                $data['portfolios'] = $this->Members_Model->get_member_portfolio($member_id, "AND `tb_member_portfolios`.is_active = 1");
                $data['degrees'] = $this->Members_Model->get_member_degrees($member_id, "AND `tb_member_degrees`.pub_status = 1 AND `tb_member_degrees`.approval_status = 'Approved'");
                $data['experiences'] = $this->Members_Model->get_member_experiences($member_id, "AND `tb_member_experience`.pub_status = 1 AND `tb_member_experience`.approval_status = 'Approved'");
                $data['certifications'] = $this->Members_Model->get_member_certification($member_id, "AND `tb_member_certifications`.pub_status = 1 AND `tb_member_certifications`.approval_status = 'Approved'");
                $this->load->view('frontend/member/companion_profile', $data);
            } elseif ($member_info['member_type'] == 1) {
                $this->load->view('frontend/member/guest_profile', $data);
            }
        } else {
            redirect(base_url());
        }
    }
    
    function modal_language() {
        $this->isAjax();
        $language_id = $this->input->post('language_id');
        $language_data = $this->Members_Model->get_language($language_id);
        $data['language_data'] = $language_data;
        $html = $this->load->view('frontend/member/add_language', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_language() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('language_id');
            $member_id = $this->session->userdata('member_id');
            $this->form_validation->set_rules('language_name', 'Language name', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['language_name'] = $this->input->post('language_name');
                $data['language_level'] = $this->input->post('language_level');
                $data['member_id'] = $member_id;
                $data['is_active'] = $this->input->post('is_active') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                }
                if ($edit_id > 0) {
                    $this->Members_Model->update_language('language_id', $edit_id, $data);
                    $this->_response(false, "Changes saved successfully!");
                } else {
                    $result = $this->Members_Model->add_language($data);
                    $this->_response(false, "Language added successfully!");
                }
                $this->_response(true, "Error while updating data!");
            }
        } else {
            redirect(base_url('companions/get_companion_profile'));
        }
    }

}
