<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Profile extends CI_Controller {

    public $selected_tab = '';
    private $error_msgs = array(
        '1' => "Please pay for your account before login.",
        '2' => "Your subscription has been ended. Please renew your subscription before login to your account.",
    );

    public function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/members_model', 'Members_Model');
    }

    #region guests

    function guest_signup() {
        $this->selected_tab = "guest_signup";
        $data['country_options'] = GetCountriesOption();
        $data['promo_code'] = GetPromoCodesByUserType(1);
        $this->load->view('frontend/guests/signup', $data);
    }

    public function add_guest_user() {
        isAjax();
        if ($this->input->post()) {
            $data = array();
            $is_update_call = $edit_id = $this->input->post('member_id') > 0 ? $this->input->post('member_id') : 0;
            // redirect user if someone directly calls this method without login.
            if ($edit_id > 0 && !$this->session->userdata('member_id')) {
                redirect(base_url('login'));
            }
//            $unique_id = $this->input->post('file_upload_unique_id');
            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|strip_tags|xss_clean|callback_chk_member_username_exist[' . $edit_id . ']');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|strip_tags|xss_clean|callback_chk_member_email_exist[' . $edit_id . ']');
            if (!$edit_id || ($this->input->post('password') != "" || $this->input->post('confirm_password') != "")) {
                $this->form_validation->set_rules('password', 'Password', 'required|trim|strip_tags|xss_clean');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|strip_tags|xss_clean|matches[password]');
            }
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('location', 'Location', 'required|trim|strip_tags|xss_clean');
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
                $year = $this->input->post('years');
                $month = $this->input->post('months');
                $day = $this->input->post('days');
                $data['date_of_birth'] = $year . '-' . $month . '-' . $day;
                $data['location'] = $this->input->post('location');
                $geoCodesData = getGeoCodes($this->input->post('location'));
                $data['country'] = $geoCodesData['country_long'];
                $data['state'] = $geoCodesData['state_long'];
                $data['city'] = $geoCodesData['city_long'];
                $data['latitude'] = $geoCodesData['latitude'];
                $data['longitude'] = $geoCodesData['longitude'];
                $data['address'] = $this->input->post('address');
                $data['zipcode'] = $this->input->post('zipcode');
                $data['about_me'] = $this->input->post('about_me');
                $data['membership_type'] = 'Guest';
                $data['other_interest'] = $this->input->post('other_interest');
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $edit_id;
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                    // receive social links
                    $data['facebook'] = $this->input->post('facebook');
                    $data['twitter'] = $this->input->post('twitter');
                    $data['linkedin'] = $this->input->post('linkedin');
                    $data['instagram'] = $this->input->post('instagram');
                    $data['youtube'] = $this->input->post('youtube');
                    $data['gmail'] = $this->input->post('gmail');
                    $data['pinterest'] = $this->input->post('pinterest');
                    $data['skype'] = $this->input->post('skype');
                }

                // check promo code is valid and entered.
                $promo_code = $this->input->post('promo_code');
                $promo_code_info = false;
                if ($promo_code != "") {
                    // validate promo code.
                    $promo_code_info = validatePromoCode($promo_code, 1);
                }
                // end here.

                $result = false;
                if ($edit_id > 0) {
                    $this->Members_Model->update_member($edit_id, $data);
                    $action = 'updated';
                    $result = true;
                } else {
                    $insert_promo_record = false;
                    $do_payment = true;
                    if ($promo_code_info && $promo_code_info['promo_type'] == "sub") {
                        $data['subscription_date'] = date("Y-m-d H:i:s");
                        $data['end_subscription_date'] = date('Y-m-d', strtotime(date("Y-m-d H:i:s") . ' +' . $promo_code_info['value'] . ' days'));
                        $insert_promo_record = true;
                        $do_payment = false;
                    } elseif ($promo_code_info && $promo_code_info['promo_type'] == 'discount') {
                        $insert_promo_record = true;
                    }
                    $data['member_type'] = 1;
                    $data['email_verification_code'] = md5(time());
                    $edit_id = $result = $this->Members_Model->add_member($data);
                    $action = 'added';
                    // insert record in database for used promo as well.
                    if ($insert_promo_record) {
                        $promo_used_record_data = array("promo_code" => $promo_code, "member_id" => $edit_id, "created_on" => date("Y-m-d H:i:s"), "created_by" => $edit_id);
                        $this->Members_Model->add_promo_used_record($promo_used_record_data);
                    }

                    // update unique id
                    $unique_id_update_data['member_unique_code'] = "G-" . date("Ymd") . $edit_id;
                    $this->Members_Model->update_member($edit_id, $unique_id_update_data);
                    $result = true;
                }
                // upload id proof images , add call
                // profile image and id proof upload
                $this->upload_images_member($edit_id, ($is_update_call ? true : false));
                if ($action == 'added' && $do_payment == false) {
                    $member_email = $data['email'];
                    $member_email_v_code = $data['email_verification_code'];
                    $macros_data['$$$FIRST_NAME$$$'] = $data['first_name'];
                    $macros_data['$$$LAST_NAME$$$'] = $data['last_name'];
                    $macros_data['$$$EMAIL$$'] = $data['email'];
                    $macros_data['$$$CONFIRM_REGISTRATION$$$'] = (base_url('misc/verify_email/' . $edit_id . '/' . $member_email_v_code));
                    $email_template_info = get_email_template('member_signup', $macros_data);
                    if ($email_template_info) {
                        sendEmail($member_email, $email_template_info['template_subject'], $email_template_info['template_body']);
                    }
                }
                if ($result) {
                    if ($is_update_call) {
                        $message = get_username($edit_id) . ' guest user has successfully created his account in our system.';
                    } else {
                        $message = get_username($edit_id) . ' has ' . $action . ' personal info from their profile settings.';
                    }
                    push_notification(array('member_id' => $edit_id, 'user_type' => 1, 'section_name' => 'personal info', 'message' => $message, 'created_at' => date("Y-m-d H:i:s")), $action);
                    if ($do_payment == false) {
                        $this->_response(false, "Changes saved successfully!", 'skip');
                    } else {
                        $this->_response(false, "Changes saved successfully!", $edit_id);
                    }
                }
            }
        } else {
            redirect(base_url('home'));
        }
    }

    #region guests ends.
    #region companions

    public function companion_signup($plan_type) {
        $this->selected_tab = $plan_type;
        if ($plan_type == 'silver' || $plan_type == 'gold') {
            $data['country_options'] = GetCountriesOption();
            $data['categories'] = GetAllCategories();
            $data['plan_type'] = $plan_type;
            $data['promo_code'] = GetPromoCodesByUserType(2);
            $this->load->view('frontend/companions/signup', $data);
        } else {
            redirect(base_url('register'));
        }
    }

    public function thankyou() {
        $data['registration_completed'] = true;
        $this->load->view('frontend/companions/thankyou', $data);
    }

    public function add_companion_user() {
        isAjax();
        if ($this->input->post()) {
            $data = array();
            $update_bit = $edit_id = $this->input->post('member_id') > 0 ? $this->input->post('member_id') : 0;
            // redirect user if someone directly calls this method without login.
            if ($edit_id > 0 && !$this->session->userdata('member_id')) {
                redirect(base_url('login'));
            }
            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|strip_tags|xss_clean|callback_chk_member_username_exist[' . $edit_id . ']');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|strip_tags|xss_clean|callback_chk_member_email_exist[' . $edit_id . ']');
            if (!$edit_id || ($this->input->post('password') != "" || $this->input->post('confirm_password') != "")) {
                $this->form_validation->set_rules('password', 'Password', 'required|trim|strip_tags|xss_clean');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|strip_tags|xss_clean|matches[password]');
            }
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('location', 'Location', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $geoCodesData = getGeoCodes($this->input->post('location'));
                $data['first_name'] = $this->input->post('first_name');
                $data['last_name'] = $this->input->post('last_name');
                $data['username'] = $this->input->post('username');
                $data['email'] = $this->input->post('email');
                if ($this->input->post('password') != "") {
                    $data['password'] = md5($this->input->post('password'));
                }
                $data['phone_number'] = $this->input->post('phone_number');
                $data['gender'] = $this->input->post('gender');
                $data['location'] = $this->input->post('location');
                $data['zipcode'] = $this->input->post('zipcode');
                $data['country'] = $geoCodesData['country_long'];
                $data['state'] = $geoCodesData['state_long'];
                $data['city'] = $geoCodesData['city_long'];
                $data['latitude'] = $geoCodesData['latitude'];
                $data['longitude'] = $geoCodesData['longitude'];
                $data['about_me'] = $this->input->post('about_me');
                $data['other_interest'] = $this->input->post('other_interest');
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $edit_id;
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                    $data['date_of_birth'] = $this->input->post('date_of_birth');
                    // receive social links
                    $data['facebook'] = $this->input->post('facebook');
                    $data['twitter'] = $this->input->post('twitter');
                    $data['linkedin'] = $this->input->post('linkedin');
                    $data['instagram'] = $this->input->post('instagram');
                    $data['youtube'] = $this->input->post('youtube');
                    $data['gmail'] = $this->input->post('gmail');
                    $data['pinterest'] = $this->input->post('pinterest');
                    $data['skype'] = $this->input->post('skype');
                }
                // check promo code is valid and entered.
                $promo_code = $this->input->post('promo_code');
                $promo_code_info = false;
                if ($promo_code != "") {
                    // validate promo code.
                    $promo_code_info = validatePromoCode($promo_code, 2);
                }
                // end here.
                $result = false;
                if ($edit_id > 0) {
                    $this->Members_Model->update_member($edit_id, $data); //use for future
                    $action = 'updated';
                    $result = true;
                } else {
                    $macros_data = array();
                    $data['member_type'] = 2;
                    $year = $this->input->post('years');
                    $month = $this->input->post('months');
                    $day = $this->input->post('days');
                    $data['date_of_birth'] = $year . '-' . $month . '-' . $day;
                    $data['plan_type'] = $this->input->post('plan_type');
                    $data['membership_type'] = 'Companion';
                    $data['subscription_date'] = date('Y-m-d H:i:s');
                    $data['end_subscription_date'] = date('Y-m-d H:i:s', strtotime("+1 month"));
                    $insert_promo_record = false;
                    $do_payment = false;
                    if ($promo_code_info && $promo_code_info['promo_type'] == "sub") {
                        $data['end_subscription_date'] = date('Y-m-d', strtotime($data['end_subscription_date'] . ' +' . $promo_code_info['value'] . ' days'));
                        $insert_promo_record = true;
                    } elseif ($promo_code_info && $promo_code_info['promo_type'] == 'discount') {
                        $insert_promo_record = true;
                        $do_payment = true;
                    }
                    $data['email_verification_code'] = md5(time());
                    $edit_id = $result = $this->Members_Model->add_member($data);
                    $action = 'added';
                    // insert record in database for used promo as well.
                    if ($insert_promo_record) {
                        $promo_used_record_data = array("promo_code" => $promo_code, "member_id" => $edit_id, "created_on" => date("Y-m-d H:i:s"), "created_by" => $edit_id);
                        $this->Members_Model->add_promo_used_record($promo_used_record_data);
                    }

                    // update unique id
                    $unique_id_update_data['member_unique_code'] = "C-" . date("Ymd") . $edit_id;
                    $this->Members_Model->update_member($edit_id, $unique_id_update_data);

                    if ($action == 'added' && $do_payment == false) {
                        $member_email = $data['email'];
                        $member_email_v_code = $data['email_verification_code'];
                        $macros_data['$$$FIRST_NAME$$$'] = $data['first_name'];
                        $macros_data['$$$LAST_NAME$$$'] = $data['last_name'];
                        $macros_data['$$$EMAIL$$'] = $data['email'];
                        $macros_data['$$$CONFIRM_REGISTRATION$$$'] = (base_url('misc/verify_email/' . $edit_id . '/' . $member_email_v_code));
                        $email_template_info = get_email_template('member_signup', $macros_data);
                        if ($email_template_info) {
                            sendEmail($member_email, $email_template_info['template_subject'], $email_template_info['template_body']);
                        }
                    }
                    $result = true;
                }
                // profile image upload
                $this->upload_images_member($edit_id, ($update_bit ? true : false));

                // add user categories.
                $categories = $this->input->post('categories');
                $call_type = $this->input->post('call_type');
                if ($categories && $call_type == 'add') {
                    $this->AddUpdateMemberCategories($categories, $edit_id);
                }
                if ($result) {
                    if ($update_bit) {
                        $message = get_username($edit_id) . ' service member has successfully created his account in our system.';
                    } else {
                        $message = get_username($edit_id) . ' has ' . $action . ' personal info from their profile settings.';
                    }
                    push_notification(array('member_id' => $edit_id, 'user_type' => 2, 'section_name' => 'personal info', 'message' => $message, 'created_at' => date("Y-m-d H:i:s")), $action);
                    if ($do_payment == false) {
                        $this->_response(false, "Changes saved successfully!", 'skip');
                    } else {
                        $this->_response(false, "Changes saved successfully!", $edit_id);
                    }
                }
            }
        } else {
            redirect(base_url('register'));
        }
    }

    function AddUpdateMemberCategories($member_categories, $member_id) {
        $this->Members_Model->AddUpdateMemberCategories($member_categories, $member_id);
    }

    #region companions
    #general functions for companions + guests start

    public function upload_images() {
        $unique_id = $this->input->post('file_upload_unique_id');
        $image_type = $this->input->post('image_type');
        $result = upload_temp_image($_FILES, $unique_id, $image_type);
        if ($result == 'success') {
            $this->_response(false, 'File uploaded successfully!');
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

    function watermarkImage() {
        watermarkImage($this->config->item('root_path') . 'assets/watermark_img/gallery2.jpg');
        exit;
    }

    public function upload_images_member($member_id_param = "", $push_notification = true) {
        // profile image upload
        $member_id = $this->input->post('member_id') ? $this->input->post('member_id') : $member_id_param;
        $member_type = $this->input->post('member_type');
        if ($member_id) {
            $image_info = isset($_POST['profile_images'][0]) ? json_decode($_POST['profile_images'][0]) : "";
            if ($image_info) {
                $f_upload_dir = $this->config->item('root_path') . 'uploads/member_images/profile/';
                $uploaded_file_info = upload_base_64_image($image_info, $f_upload_dir);
                if (isset($uploaded_file_info['image_full_path']) && $uploaded_file_info['image_full_path'] != "") {
                    $thumb_options[0] = array('width' => 50, 'height' => 50, 'prefix' => 'small_');
                    $thumb_options[1] = array('width' => 150, 'height' => 150, 'prefix' => 'medium_');
                    $thumb_options[2] = array('width' => 400, 'height' => 400, 'prefix' => 'large_');
//                        $thumb_options[3] = array('width' => 700, 'height' => 700, 'prefix' => 'Xlarge_');
                    CreateThumbnail($uploaded_file_info['image_full_path'], $f_upload_dir, $thumb_options);
                    // insert in database as well.
                    $image_data = array('member_id' => $member_id, 'image_type' => 'profile', 'is_profile_image' => 1, 'image' => $uploaded_file_info['image_name'], 'image_path' => str_replace($this->config->item('root_path'), "", $f_upload_dir));
                    $inserted = $this->db->insert('tb_member_images', $image_data);
                }
            }
            // id prof image upload
            $image_info = isset($_POST['id_proofs'][0]) ? json_decode($_POST['id_proofs'][0]) : "";
            if ($image_info) {
                $f_upload_dir = $this->config->item('root_path') . 'uploads/member_images/id_proofs/';
                $uploaded_file_info = upload_base_64_image($image_info, $f_upload_dir);
                if (isset($uploaded_file_info['image_full_path']) && $uploaded_file_info['image_full_path'] != "") {
                    $thumb_options[0] = array('width' => 50, 'height' => 50, 'prefix' => 'small_');
                    $thumb_options[1] = array('width' => 150, 'height' => 150, 'prefix' => 'medium_');
                    $thumb_options[2] = array('width' => 400, 'height' => 400, 'prefix' => 'large_');
//                        $thumb_options[3] = array('width' => 700, 'height' => 700, 'prefix' => 'Xlarge_');
                    CreateThumbnail($uploaded_file_info['image_full_path'], $f_upload_dir, $thumb_options);
                    // insert in database as well.
                    $image_data = array('member_id' => $member_id, 'image_type' => 'id_proof', 'image' => $uploaded_file_info['image_name'], 'image_path' => str_replace($this->config->item('root_path'), "", $f_upload_dir));
                    $inserted = $this->db->insert('tb_member_images', $image_data);
                }
            }
            if (isset($inserted) && $push_notification) {
                $message = get_username($member_id) . ' has uploaded new image.';
                $mType = $member_type == 'guest' ? 1 : 2;
                push_notification(array('member_id' => $member_id, 'user_type' => $mType, 'section_name' => 'images', 'message' => $message, 'created_at' => date("Y-m-d H:i:s")), 'added');
            }
        }
        if (!$member_id_param && $member_type == "guest") {
            redirect(base_url('guests/get_guest_profile/' . $member_id . "#tab_1_3"));
        }
        // front end user call.
        if (!$member_id_param && $member_type == "companion") {
            redirect(base_url('companions/get_companion_profile#tab_1_3'));
        }
    }

    public function _response($is_error = true, $description = '', $status = '') {
        $this->output->set_status_header(200);
        $this->output->set_content_type('application/json');
        $this->output->set_header('Content-type: application/json');
        $this->output->set_output(json_encode(array(
            'error' => $is_error,
            'description' => $description,
            'code' => $status
        )))->_display();
        die();
    }

    function payment($member_id, $msg_id = 0) {
        // check user exist in db
        if ($member_id) {
            $result = $this->Members_Model->get_member_by_id($member_id);
            if ($result) {
                // get guest member plans
                $data['type'] = get_user_type($member_id);
                $data['plans'] = $this->Members_Model->getPlans($data['type']);
                $code = IsPromoCodeApplied($member_id);
                if (isset($code)) {
                    $check = validatePromoCode($code['promo_code'], $data['type']);
                    if (isset($check) && $check['promo_type'] == 'discount') {
                        $data['discount_value'] = $check['value'];
                        $data['type'] = 3;
                    }
                }
                $data['member_id'] = $member_id;
                if ($msg_id > 0) {
                    $data['error_msg'] = isset($this->error_msgs[$msg_id]) ? $this->error_msgs[$msg_id] : "";
                }
                $data['type'] = $msg_id;
                $this->load->view('frontend/member/payment', $data);
            } else {
                redirect(base_url());
            }
        }
    }

    #general functions for companions + guests ends.
}
