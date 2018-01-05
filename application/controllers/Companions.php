<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Companions extends FrontEnd_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('member_type') == 1) {
            redirect(base_url('guests/get_guest_profile'));
        }
        $this->layout = 'frontend/main';
        $this->load->model('admin/members_model', 'Members_Model');
        $this->load->model('admin/misc_model', 'Misc_Model');
    }

    //Main dashboard index function
//    public function upload_images() {
//        $unique_id = $this->input->post('file_upload_unique_id');
//        $image_type = $this->input->post('image_type');
//        $result = $this->upload_temp_image($_FILES, $unique_id, $image_type);
//        if ($result == 'success') {
//            $this->_response(true, 'File uploaded successfully!');
//        }
//    }
//    function chk_member_username_exist($email, $exclude_id) {
//        $result = is_member_username_exist($email, $exclude_id);
//        if ($result) {
//            $this->form_validation->set_message('chk_member_username_exist', 'The %s already exist. Please choose other username!');
//            return false;
//        }
//        return true;
//    }
//    function chk_member_email_exist($email, $exclude_id) {
//        $result = is_member_email_exist($email, $exclude_id);
//        if ($result) {
//            $this->form_validation->set_message('chk_member_email_exist', 'The %s already exist. Please choose other email!');
//            return false;
//        }
//        return true;
//    }

    function update_member_categories() {
        $this->isAjax();
        $member_id = $this->input->post('member_id');
        $categories = $this->input->post('categories');
        $this->Members_Model->AddUpdateMemberCategories($categories, $member_id);
        $this->_response(false, "Changes saved successfully!");
    }

    public function get_companion_profile() {
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
            $data['categories'] = GetAllCategories();
            $data['selected_categories'] = $this->Members_Model->get_all_selected_categories($member_id);
            $data['portfolios'] = $this->Members_Model->get_member_portfolio($member_id);
            $data['language_data'] = $this->Members_Model->get_member_languages($member_id);
            $data['degrees'] = $this->Members_Model->get_member_degrees($member_id);
            $data['experiences'] = $this->Members_Model->get_member_experiences($member_id);
            $data['certifications'] = $this->Members_Model->get_member_certification($member_id);
            $this->load->view('frontend/companions/view_companion_profile', $data);
        } else {
            redirect(base_url());
        }
    }

    function modal_portfolio() {
        $this->isAjax();
        $portfolio_id = $this->input->post('portfolio_id');
        $portfolio_data = $this->Misc_Model->get_portfolio($portfolio_id);
        $data['portfolio_data'] = $portfolio_data;
        $data['country_options'] = GetCountriesOption((isset($data['portfolio_data']->country) ? $data['portfolio_data']->country : ''));
        $data['state_options'] = GetStatesOption((isset($data['portfolio_data']->country) ? $data['portfolio_data']->country : ''), (isset($data['portfolio_data']->state) ? $data['portfolio_data']->state : ''));
        $data['city_options'] = GetCityOptions((isset($data['portfolio_data']->state) ? $data['portfolio_data']->state : ''), (isset($data['portfolio_data']->city) ? $data['portfolio_data']->city : ''));
        $html = $this->load->view('frontend/companions/add_portfolio', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_portfolio() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('portfolio_id');
            $this->form_validation->set_rules('portfolio_title', 'Portfolio Title', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('state', 'State', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['portfolio_title'] = $this->input->post('portfolio_title');
                $data['country'] = $this->input->post('country');
                $data['state'] = $this->input->post('state');
                $data['city'] = $this->input->post('city');
                $data['is_active'] = $this->input->post('is_active') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $data['member_id'] = $this->session->userdata['member_info']['member_id'];
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }
                $result = false;
                if (isset($_FILES['portfolio_image']['name']) && $_FILES['portfolio_image']['name'] != "") {
                    //$id_proofs = reArrayFiles($_FILES['id_proofs']);
                    $portfolio_images = $_FILES['portfolio_image'];
                    $f_upload_dir = $this->config->item('root_path') . 'uploads/member_images/portfolio/';
                    $thumb_options[0] = array('width' => 50, 'height' => 50, 'prefix' => 'small_');
                    $thumb_options[1] = array('width' => 194, 'height' => 194, 'prefix' => 'medium_');
                    $thumb_options[2] = array('width' => 400, 'height' => 400, 'prefix' => 'large_');
                    $file_name = basename($portfolio_images['name']);
                    $u_file_name = time() . $file_name;
                    $f_file_path = $f_upload_dir . '/' . $u_file_name;
                    move_uploaded_file($portfolio_images['tmp_name'], $f_file_path);
                    CreateThumbnail($f_file_path, $f_upload_dir, $thumb_options);
                    // insert in database as well.
                    $data['portfolio_image_path'] = 'uploads/member_images/portfolio/';
                    $data['portfolio_image'] = $u_file_name;
                }

                if ($edit_id > 0) {
                    $this->Misc_Model->update_portfolio('portfolio_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Misc_Model->add_portfolio($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('companions/get_companion_profile'));
        }
    }
    
    
    
    
    function modal_degree() {
        $this->isAjax();
        $member_degree_id = $this->input->post('member_degree_id');
        $degree_data = $this->Members_Model->get_degree($member_degree_id);
        $data['degree_data'] = $degree_data;
        $html = $this->load->view('frontend/companions/add_degree', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_degree() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('member_degree_id');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('degree_name', 'Degree Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('start_date', 'Start Date', 'required|trim|strip_tags|xss_clean');
           

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['title'] = $this->input->post('title');
                $data['degree_name'] = $this->input->post('degree_name');
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date']   = $this->input->post('present') == null ? $this->input->post('end_date') : 'Present';
                $data['pub_status'] = $this->input->post('pub_status') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $data['member_id'] = $this->session->userdata['member_info']['member_id'];
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }
                $result = false;
                

                if ($edit_id > 0) {
                    $this->Members_Model->update_degree('member_degree_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Members_Model->add_degree($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('companions/get_companion_profile'));
        }
    }
    
    
    
    function modal_experience() {
        $this->isAjax();
        $member_experience_id = $this->input->post('member_experience_id');
        $experience_data = $this->Members_Model->get_experience($member_experience_id);
        $data['experience_data'] = $experience_data;
        $html = $this->load->view('frontend/companions/add_experience', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_experience() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('member_experience_id');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('position', 'Position', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('start_date', 'Start Date', 'required|trim|strip_tags|xss_clean');
           

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['title'] = $this->input->post('title');
                $data['position'] = $this->input->post('position');
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date']   = $this->input->post('present') == null ? $this->input->post('end_date') : 'Present';
                $data['pub_status'] = $this->input->post('pub_status') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $data['member_id'] = $this->session->userdata['member_info']['member_id'];
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }
                $result = false;
                

                if ($edit_id > 0) {
                    $this->Members_Model->update_experience('member_experience_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Members_Model->add_experience($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('companions/get_companion_profile'));
        }
    }
    
    
    function modal_certification() {
        $this->isAjax();
        $member_certification_id = $this->input->post('member_certification_id');
        $certification_data = $this->Members_Model->get_certification($member_certification_id);
        $data['certification_data'] = $certification_data;
        $html = $this->load->view('frontend/companions/add_certification', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_certification() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('member_certification_id');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('description', 'Position', 'required|trim|strip_tags|xss_clean');
            
           

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['title'] = $this->input->post('title');
                $data['description'] = $this->input->post('description');
                
                $data['pub_status'] = $this->input->post('pub_status') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $data['member_id'] = $this->session->userdata['member_info']['member_id'];
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }
                $result = false;
                

                if ($edit_id > 0) {
                    $this->Members_Model->update_certification('member_certification_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Members_Model->add_certification($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('companions/get_companion_profile'));
        }
    }

}
