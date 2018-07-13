<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends FrontEnd_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/members_model', 'Members_Model');
        $this->load->model('admin/notification_model', 'Notification_Model');
        $this->load->library('pagination');
    }

    function profile($member_id = '')
    {
        if ($member_id != '') {
            $member_id = base64_decode($member_id);
        } else {
            $member_id = $this->session->userdata('member_id');
        }
        $data['member_id'] = $this->session->userdata('member_id');
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
                $data['selected_sub_categories'] = $this->Members_Model->get_selected_sub_categories($member_id, array("tb_member_categories.is_active" => "active"));
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

//    function ajaxData() {
//        $member_id = $this->session->userdata('member_id');
//        $selected_sub_categories = $this->Members_Model->get_selected_sub_categories($member_id);
//        $totalRec = count($selected_sub_categories);
//        $config = array();
//        $config['base_url']    = '#';
//        $config['total_rows']  = $totalRec;
//        $config['per_page']    = 2;
//        $config['uri_segment'] = 3;
//        $config['uri_page_numbers'] = TRUE;
//        $config['full_tag_open'] = '<ul class="pagination">';
//        $config['full_tag_close'] = '</ul>';
//        $config['first_tag_open'] = '<li>';
//        $config['first_tag_close'] = '</li>';
//        $config['last_tag_open'] = '<li>';
//        $config['last_tag_close'] = '</li>';
//        $config['next_link'] = '&gt;';
//        $config['next_tag_open'] = '<li>';
//        $config['next_tag_close'] = '</li>';
//        $config['prev_link'] = '&lt;';
//        $config['prev_tag_open'] = '<li>';
//        $config['prev_tag_close'] = '</li>';
//        $config['cur_tag_open'] = '<li class="active"><a href="#">';
//        $config['cur_tag_close'] = '</a></li>';
//        $config['num_tag_open'] = '<li>';
//        $config['num_tag_close'] = '</li>';
//        $config['num_links'] = 1;
//        $this->pagination->initialize($config);
//        $page = $this->uri->segment(3);
//        $start = ($page - 1) * $config['per_page'];
//        $output = array(
//            'pagination_link' => $this->pagination->create_links(),
//            'skills_data'   => $this->Members_Model->ajaxSubCategories($member_id, $config['per_page'], $start)
//        );
//        echo json_encode($output);
//        die();
//    }

    function modal_language()
    {
        $this->isAjax();
        $language_id = $this->input->post('language_id');
        $language_data = $this->Members_Model->get_language($language_id);
        $data['language_data'] = $language_data;
        $html = $this->load->view('frontend/member/add_language', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function show_skill_detail()
    {
        $this->isAjax();
        $member_id = $this->input->post('member_id');
        $data['selected_categories'] = $this->Members_Model->get_all_selected_categories($member_id);
        $sub_cat_rates = array();
        if ($data['selected_categories']) {
            foreach ($data['selected_categories'] as $val) {
                $sub_cat_rates[] = $val['sub_category_id'];
            }
        }
        $data['sub_category_rates'] = $this->Members_Model->get_sub_cat_rates($member_id, $sub_cat_rates, array("is_active" => "active"));
        $html = $this->load->view('frontend/companions/skill_detail', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_language()
    {
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
                    $result = $this->Members_Model->update_language('language_id', $edit_id, $data);
                    $message = get_username($data['member_id']) . ' has modified language from their profile settings.';
                    push_notification(array('member_id' => $data['member_id'], 'user_type' => get_user_type($data['member_id']), 'section_name' => 'language', 'message' => $message, 'created_at' => date("Y-m-d H:i:s")));
                    $this->_response(false, "Changes saved successfully!");
                } else {
                    $result = $this->Members_Model->add_language($data);
                    $message = get_username($data['member_id']) . ' has modified language from their profile settings.';
                    push_notification(array('member_id' => $data['member_id'], 'user_type' => get_user_type($data['member_id']), 'section_name' => 'language', 'message' => $message, 'created_at' => date("Y-m-d H:i:s")));
                    $this->_response(false, "Language added successfully!");
                }
                $this->_response(true, "Error while updating data!");
            }
        } else {
            redirect(base_url('companions/get_companion_profile'));
        }
    }

    function submit_promo()
    {
        $promo_code = $this->input->post('promo_code');
        $member_id = $this->input->post('member_id');
        $promo_code_info = false;
        if ($promo_code != "") {
            // validate promo code.
            $promo_code_info = validatePromoCode($promo_code);
            if ($promo_code_info) {
                // check whether user already used that promo code or not.
                $is_used = IsPromoCodeAlreadyUsed($promo_code, $member_id);
                if ($is_used) {
                    $this->_response(true, "You have already used this promo code.");
                } else {
                    // update promo according to type.
                    if ($promo_code_info['promo_type'] == "sub" && $promo_code_info['value'] > 0) {
                        // add days
                        $member_info = $this->Members_Model->get_member_by_id($member_id);
                        $subscription_date = $member_info['subscription_date'];
                        $data['end_subscription_date'] = date('Y-m-d', strtotime($member_info['end_subscription_date'] . ' +' . $promo_code_info['value'] . ' days'));
                        $this->Members_Model->update_member($member_id, $data);
                        // insert record in database for used promo as well.
                        $promo_used_record_data = array("promo_code" => $promo_code, "member_id" => $member_id, "created_on" => date("Y-m-d H:i:s"), "created_by" => $member_id);
                        $this->Members_Model->add_promo_used_record($promo_used_record_data);
                        $this->_response(false, "Promo code applied successfully.");
                    }
                    $this->_response(true, "Promo code is not valid.");
                }
            }
            $this->_response(true, "Promo code is not valid.");
        }
        $this->_response(true, "Please enter promo code.");
    }

}
