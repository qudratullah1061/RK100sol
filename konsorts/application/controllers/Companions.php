<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Companions extends FrontEnd_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/members_model', 'Members_Model');
    }
    
    

    //Main dashboard index function
    public function signup($plan_type) {
        if($plan_type == 'silver' || $plan_type == 'gold' )
        {
            $data['country_options'] = GetCountriesOption();
            $data['categories'] = GetAllCategories();
            $this->load->view('frontend/companions/signup', $data);
        
        } else 
        {
            redirect(base_url('auth/register'));
            
        }
        
    }

   

    public function upload_images() {
        $unique_id = $this->input->post('file_upload_unique_id');
        $image_type = $this->input->post('image_type');
        $result = $this->upload_temp_image($_FILES, $unique_id, $image_type);
        if ($result == 'success') {
            $this->_response(true, 'File uploaded successfully!');
        }
    }

    function chk_member_username_exist($email, $exclude_id) {
        $result = is_member_username_exist($email, $exclude_id);
        if ($result) {
            $this->form_validation->set_message('chk_member_username_exist', 'The %s already exist. Please choose other username!');
            return false;
        }
        return true;
    }

    function chk_member_email_exist($email, $exclude_id) {
        $result = is_member_email_exist($email, $exclude_id);
        if ($result) {
            $this->form_validation->set_message('chk_member_email_exist', 'The %s already exist. Please choose other email!');
            return false;
        }
        return true;
    }

    

    public function add_companion_user() {
        $this->isAjax();

        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('member_id') > 0 ? $this->input->post('member_id') : 0;
            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|strip_tags|xss_clean|callback_chk_member_username_exist[' . $edit_id . ']');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|strip_tags|xss_clean|callback_chk_member_email_exist[' . $edit_id . ']');
            if (!$edit_id || ($this->input->post('password') != "" || $this->input->post('confirm_password') != "")) {
                $this->form_validation->set_rules('password', 'Password', 'required|trim|strip_tags|xss_clean');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|strip_tags|xss_clean|matches[password]');
            }
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('gender', 'Gender', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('state', 'State', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('address', 'Address', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['first_name'] = $this->input->post('first_name');
                $data['last_name'] = $this->input->post('last_name');
                $data['username'] = $this->input->post('username');
                $data['email'] = $this->input->post('email');
                if ($this->input->post('password') != "") {
                    $data['password'] = md5($this->input->post('password'));
                }
                $data['phone_number'] = $this->input->post('phone_number');
                $data['gender'] = $this->input->post('gender');
                $data['date_of_birth'] = $this->input->post('date_of_birth');
                $data['country'] = $this->input->post('country');
                $data['state'] = $this->input->post('state');
                $data['city'] = $this->input->post('city');
                $data['address'] = $this->input->post('address');
                $data['about_me'] = $this->input->post('about_me');
                
                
                $data['subscription_date']       = date('Y-m-d H:i:s');
                $data['end_subscription_date']   = date('Y-m-d H:i:s',strtotime("1 month"));
                
                $data['other_interest'] = $this->input->post('other_interest');
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = 0;
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }

                $result = false;
                if ($edit_id > 0) {
                    $this->Members_Model->update_member($edit_id, $data);//use for future
                    $result = true;
                } else {
                    $data['member_type'] = 2;
                    $data['membership_type'] = 'Companion';
                    $data['email_verification_code'] = md5(time());
                    $edit_id = $result = $this->Members_Model->add_member($data);
                    // update unique id
                    $unique_id_update_data['member_unique_code'] = "C-" . date("Ymd") . $edit_id;
                    $this->Members_Model->update_member($edit_id, $unique_id_update_data);
                    
                    $member_info = $this->Members_Model->get_member_by_id($edit_id);
                    $member_email = $member_info['email'];
                    $member_email_v_code = $data['email_verification_code'];
                    sendEmail($member_email, "Signup Successfull", "Registration completed. Please verify email by <a href='" . base_url('misc/verify_email/' . $member_email_v_code) . "'>Clicking here.</a>");
                    
                    
                    
                    $result = true;
                }
                // upload id proof images , add call
                if (isset($_FILES['id_proofs']['name']) && $_FILES['id_proofs']['name'] != "" && $edit_id > 0) {
                    $id_proofs = reArrayFiles($_FILES['id_proofs']);
                    $f_upload_dir = $this->config->item('root_path') . 'uploads/member_images/id_proofs/';
                    foreach ($id_proofs as $id_proof) {
                        $thumb_options[0] = array('width' => 50, 'height' => 50, 'prefix' => 'small_');
                        $thumb_options[1] = array('width' => 150, 'height' => 150, 'prefix' => 'medium_');
                        $thumb_options[2] = array('width' => 400, 'height' => 400, 'prefix' => 'large_');
                        $file_name = basename($id_proof['name']);
                        $u_file_name = time() . $file_name;
                        $f_file_path = $f_upload_dir . '/' . $u_file_name;
                        move_uploaded_file($id_proof['tmp_name'], $f_file_path);
                        CreateThumbnail($f_file_path, $f_upload_dir, $thumb_options);
                        // insert in database as well.
                        $image_data = array('member_id' => $edit_id, 'image_type' => 'id_proof', 'image' => $u_file_name, 'image_path' => str_replace($this->config->item('root_path'), "", $f_upload_dir));
                        $this->db->insert('tb_member_images', $image_data);
                    }
                }
                // upload profile images , add call
                if (isset($_FILES['profile_images']['name']) && $_FILES['profile_images']['name'] != "" && $edit_id > 0) {
                    $images = reArrayFiles($_FILES['profile_images']);
                    $f_upload_dir = $this->config->item('root_path') . 'uploads/member_images/profile/';
                    $is_profile_image = 1;
                    foreach ($images as $img) {
                        $thumb_options[0] = array('width' => 50, 'height' => 50, 'prefix' => 'small_');
                        $thumb_options[1] = array('width' => 150, 'height' => 150, 'prefix' => 'medium_');
                        $thumb_options[2] = array('width' => 400, 'height' => 400, 'prefix' => 'large_');
                        $thumb_options[3] = array('width' => 700, 'height' => 700, 'prefix' => 'Xlarge_');
                        $file_name = basename($img['name']);
                        $u_file_name = time() . $file_name;
                        $f_file_path = $f_upload_dir . '/' . $u_file_name;
                        move_uploaded_file($img['tmp_name'], $f_file_path);
                        CreateThumbnail($f_file_path, $f_upload_dir, $thumb_options, TRUE);
                        // insert in database as well.
                        $image_data = array('member_id' => $edit_id, 'image_type' => 'profile', 'is_profile_image' => $is_profile_image, 'image' => $u_file_name, 'image_path' => str_replace($this->config->item('root_path'), "", $f_upload_dir));
                        $this->db->insert('tb_member_images', $image_data);
                        $is_profile_image = 0;
                    }
                }

                // add user categories.
                $categories = $this->input->post('categories');
                $call_type = $this->input->post('call_type');
                if ($categories && $call_type == 'add') {
                    
                    $this->AddUpdateMemberCategories($categories, $edit_id);
                }
                if ($result) {
                    
                    
                    $this->_response(false, "Register Successfully.Please verify your email first!");
                }
            }
        } else {
            redirect(base_url('auth/register'));
        }
    }

   
   
    function AddUpdateMemberCategories($member_categories, $member_id) {
        $this->Members_Model->AddUpdateMemberCategories($member_categories, $member_id);
    }
    

}