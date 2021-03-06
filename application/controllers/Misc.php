<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Misc extends CI_Controller {

    public $selected_tab = '';

    public function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/misc_model', 'Misc_Model');
        $this->load->model('admin/members_model', 'Members_Model');
        $this->load->model('admin/blogs_model', 'Blogs_Model');
    }

    // general json error
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

    public function isAjax() {
        header('Content-Type: application/json');
    }

    function DeleteRecord() {
        $this->isAjax();
        $unique_id = $this->input->post('unique_id');
        $table = $this->input->post('table');
        $column = $this->input->post('column');
        // if image table delete file from folder as well.
        if ($table == 'tb_member_images') {
            $where_clause = array('image_id' => $unique_id);
            $img_info = $this->Misc_Model->SelectByWhere($where_clause);
            delete_image_from_directory($img_info);
        }
        $result = $this->Misc_Model->DeleteRecord($unique_id, $table, $column);


        if ($result) {
            $this->_response(false, "Record deleted successfully!");
        }
        $this->_response(true, "Problem while deleting record.");
    }

    function AcceptRequest() {
        $this->isAjax();
        $unique_id = $this->input->post('unique_id');
        $table = $this->input->post('table');
        $column = $this->input->post('column');
        $result = $this->db->where($column, $unique_id)->update($table, array('status' => 1, 'updated_at' => 'Y-m-d h:i:s'));
        if ($result) {
            $this->_response(false, "Connection accepted successfully!");
        }
        $this->_response(true, "Problem while accepting connection request.");
    }

    function RejectRequest() {
        $this->isAjax();
        $unique_id = $this->input->post('unique_id');
        $table = $this->input->post('table');
        $column = $this->input->post('column');
        $result = $this->db->where($column, $unique_id)->update($table, array('status' => 2, 'updated_at' => 'Y-m-d h:i:s'));
        if ($result) {
            $this->_response(false, "Connection rejected successfully!");
        }
        $this->_response(true, "Problem while rejecting connection request.");
    }

    function DeleteChilds() {
        $this->isAjax();
        $unique_id = $this->input->post('unique_id');
        $table = $this->input->post('table');
        $column = $this->input->post('column');
        $result = $this->Misc_Model->DeleteRecord($unique_id, $table, $column);
        $result = $this->Misc_Model->DeleteRecord($unique_id, $table, 'parent_id');

        if ($result) {
            $this->_response(false, "Record deleted successfully!");
        }
        $this->_response(true, "Problem while deleting record.");
    }

    function MarkAsProfileImage() {
        $this->isAjax();
        $unique_id = $this->input->post('image_id');
        $member_id = $this->input->post('member_id');
        $this->Misc_Model->UpdateRecord('member_id', $member_id, array('is_profile_image' => 0));
        $this->Misc_Model->UpdateRecord('image_id', $unique_id, array('is_profile_image' => 1));
        // update session info as well.
        $user_info = $this->Members_Model->get_member_by_id($this->session->userdata('member_id'));
        $this->session->set_userdata('member_info', $user_info);
        $this->_response(false, "Profile pic updated successfully!");
    }

    function update_member_privacy() {
        $this->isAjax();
        if ($this->input->post()) {
            $data[0]['privacy_status'] = $this->input->post('first_name_privacy');
            $data[0]['privacy_name'] = 'first_name_privacy';

            $data[1]['privacy_status'] = $this->input->post('last_name_privacy');
            $data[1]['privacy_name'] = 'last_name_privacy';

            $data[2]['privacy_status'] = $this->input->post('email_privacy');
            $data[2]['privacy_name'] = 'email_privacy';

            $data[3]['privacy_status'] = $this->input->post('phone_number_privacy');
            $data[3]['privacy_name'] = 'phone_number_privacy';

            $data[4]['privacy_status'] = $this->input->post('facebook_privacy');
            $data[4]['privacy_name'] = 'facebook_privacy';

            $data[5]['privacy_status'] = $this->input->post('twitter_privacy');
            $data[5]['privacy_name'] = 'twitter_privacy';

            $data[6]['privacy_status'] = $this->input->post('linkedin_privacy');
            $data[6]['privacy_name'] = 'linkedin_privacy';

            $data[7]['privacy_status'] = $this->input->post('instagram_privacy');
            $data[7]['privacy_name'] = 'instagram_privacy';

            $data[8]['privacy_status'] = $this->input->post('skype_privacy');
            $data[8]['privacy_name'] = 'skype_privacy';

            $data[9]['privacy_status'] = $this->input->post('youtube_privacy');
            $data[9]['privacy_name'] = 'youtube_privacy';

            $data[10]['privacy_status'] = $this->input->post('pinterest_privacy');
            $data[10]['privacy_name'] = 'pinterest_privacy';

            $data[11]['privacy_status'] = $this->input->post('gmail_privacy');
            $data[11]['privacy_name'] = 'gmail_privacy';

            $this->Misc_Model->update_privacy($data, $this->session->userdata('member_id'));
            $message = get_username($this->input->post('member_id')) . ' has updated privacy policy from their profile settings.';
            push_notification(array('member_id' => $this->input->post('member_id'), 'user_type' => get_user_type($this->input->post('member_id')), 'section_name' => 'privacy policy', 'message' => $message, 'created_at' => date("Y-m-d H:i:s")), 'updated');
            $this->_response(false, "Privacy updated successfully!");
        }
    }

    function delete_dropzone_temp_file() {
        $unique_id = $this->input->get_post('unique_id');
        $file_name = $unique_id . $this->input->get_post('file_name');
        $where_clause = array('unique_id' => $unique_id, 'image' => $file_name);
        $result = $this->Misc_Model->DeleteRecordDropZoneJs('tb_temp_images_upload', $where_clause);
        $where_clause = array('image' => $file_name);
        $result_member = $this->Misc_Model->DeleteRecordDropZoneJs('tb_member_images', $where_clause);
        if ($result || $result_member) {
            if ($result) {
                // delete file from directory
                $file_path = 'uploads/temp_images/' . $file_name;
                delete_file_from_directory($file_path);
            } else if ($result_member) {
                // delete file from directory
                $file_path = 'uploads/member_images/id_proofs/' . $file_name;
                delete_file_from_directory($file_path);
                $file_path = 'uploads/member_images/profile/' . $file_name;
                delete_file_from_directory($file_path);
            }
            $this->_response(false, "Record deleted successfully!");
        }
        $this->_response(true, "Problem while deleting record.");
    }

    function get_countries() {
        return GetCountriesOption($selected_country_id);
    }

    function get_states() {
        $country_id = $this->input->post('country_id');
        $selected_state_id = $this->input->post('state_id');
        $state_options = GetStatesOption($country_id, $selected_state_id);
        echo json_encode(array('error' => 0, 'options' => $state_options));
        die();
    }

    function get_cities() {
        $state_id = $this->input->post('state_id');
        $selected_city_id = $this->input->post('city_id');
        $city_options = GetCityOptions($state_id, $selected_city_id);
        echo json_encode(array('error' => 0, 'options' => $city_options));
        die();
    }

    function UpdatePaymentInfoInDB() {
        $this->isAjax();
        $data_received = $this->input->post('data');
        $member_id = $this->input->post('member_id');
        $promo_code = $this->input->post('promo_code');
        $plan_id = $this->input->post('plan_id');
        // get member info
        $member_info = $this->Members_Model->get_member_by_id($member_id);

        $subscription_date = $member_info['end_subscription_date'] != "0000-00-00 00:00:00" ? $member_info['end_subscription_date'] : date('Y-m-d H:i:s');

        $payment_details['member_id'] = $member_id;
        $payment_details['payment_raw_data'] = json_encode($data_received);
        $payment_details['transaction_id'] = isset($data_received['id']) ? $data_received['id'] : "";
        $payment_details['payment_country_code'] = isset($data_received['payer']['payer_info']['country_code']) ? $data_received['payer']['payer_info']['country_code'] : "";
        $payment_details['payer_id'] = isset($data_received['payer']['payer_info']['payer_id']) ? $data_received['payer']['payer_info']['payer_id'] : "";
        $payment_details['payment_method'] = isset($data_received['payer']['payment_method']) ? $data_received['payer']['payment_method'] : "";
        $payment_details['payment_status'] = isset($data_received['payer']['status']) ? $data_received['payer']['status'] : "";
        $payment_details['payment_email'] = isset($data_received['payer']['payer_info']['email']) ? $data_received['payer']['payer_info']['email'] : "";
        $payment_details['payment_first_name'] = isset($data_received['payer']['payer_info']['first_name']) ? $data_received['payer']['payer_info']['first_name'] : "";
        $payment_details['payment_middle_name'] = isset($data_received['payer']['payer_info']['middle_name']) ? $data_received['payer']['payer_info']['middle_name'] : "";
        $payment_details['payment_last_name'] = isset($data_received['payer']['payer_info']['last_name']) ? $data_received['payer']['payer_info']['last_name'] : "";
        $payment_details['payment_amount'] = isset($data_received['transactions'][0]['amount']['total']) ? $data_received['transactions'][0]['amount']['total'] : 0;
        $payment_details['payment_currency'] = isset($data_received['transactions'][0]['amount']['currency']) ? $data_received['transactions'][0]['amount']['currency'] : "";
        $payment_details['payment_date'] = date("Y-m-d H:i:s");
        // save record in payment details.
        $record_id = $this->Misc_Model->saveRecord('tb_member_payment_details', $payment_details);
        // update member subscription dates
        // get plan number of days.
        $discount_value = 0;
        if ($promo_code != "" && $promo_code) {
            $code = IsPromoCodeApplied($member_id, $promo_code);
            if (isset($code) && $code) {
                $check = validatePromoCode($promo_code, get_user_type($member_id));
                if (isset($check) && $check['promo_type'] == 'discount') {
                    $discount_value = $check['value'];
                }
            }
        }
//        $plan_info = $this->Misc_Model->getMemberPlanByPrice(array('plan_price' => ($payment_details['payment_amount'] + $discount_value), 'plan_type' => get_user_type($member_id), 'is_active' => 1));
        $plan_info = $this->Misc_Model->getPlanById($plan_id);

        if ($plan_info) {
            //update member info. add days to subscription days.
            $macros_data['$$$FIRST_NAME$$$'] = $member_info['first_name'];
            if ($member_info['is_email_verified'] == 1) {
                $update_data = array(
                    'current_plan_id' => $plan_info[0]['plan_id'],
                    'end_subscription_date' => date('Y-m-d H:i:s', strtotime($subscription_date . " +" . $plan_info[0]['plan_duration'])),
                );
            } else {
                $update_data = array(
                    'email_verification_code' => md5(time()),
                    'current_plan_id' => $plan_info[0]['plan_id'],
                    'subscription_date' => date("Y-m-d H:i:s"),
                    'end_subscription_date' => date('Y-m-d H:i:s', strtotime($subscription_date . " +" . $plan_info[0]['plan_duration'])),
                );
            }

            if ($member_info['is_email_verified'] == 1) {
                $description = "Payment processed successfully! You've successfully renewed your subscription, also the confirmation email is sent!";
                $email_template_info = get_email_template('subscription_renew', $macros_data);
                sendEmail($member_info['email'], $email_template_info['template_subject'], $email_template_info['template_body']);
            } elseif ($member_info['is_email_verified'] == 0) {
                $description = "Payment processed successfully! Email sent to your account please verify email address to login to konsorts.com";
                $macros_data['$$$CONFIRM_REGISTRATION$$$'] = base_url('misc/verify_email/' . $member_id . '/' . $update_data['email_verification_code']);
                $email_template_info = get_email_template('member_signup', $macros_data);
                sendEmail($member_info['email'], $email_template_info['template_subject'], $email_template_info['template_body']);
            }

            $this->Members_Model->update_member($member_id, $update_data);
        }
        echo json_encode(array(
            'error' => false,
            'description' => $description,
            'code' => ''
        ));
        exit;
    }

    // check this function. Doing nothing.
    function verify($member_id, $member_code = "") {
        if ($member_code) {
            $this->Misc_Model->check_member_code_exist();
        }
        redirect(base_url());
    }

//    Misc pages start here
    function about() {
        if ($this->uri->segment(1) == "about") {
            $this->selected_tab = 'about';
            $this->load->view('frontend/misc/about');
        } else {
            redirect(base_url('about'));
        }
    }

    function contact() {
        if ($this->uri->segment(1) == "contact") {
            $this->selected_tab = 'contact';
            $this->load->view('frontend/misc/contact_us');
        } else {
            redirect(base_url('contact'));
        }
    }

    function faq() {
        if ($this->uri->segment(1) == "faq") {
            $this->load->view('frontend/misc/faq');
        } else {
            redirect(base_url('faq'));
        }
    }

    function terms() {
        if ($this->uri->segment(1) == "terms") {
            $this->selected_tab = "terms";
            $this->load->view('frontend/misc/terms');
        } else {
            redirect(base_url('terms'));
        }
    }

    function how_it_works() {
        if ($this->uri->segment(1) == "how-it-works") {
            $this->selected_tab = "how_it_works";
            $this->load->view('frontend/misc/how_it_works');
        } else {
            redirect(base_url('how-it-works'));
        }
    }

    function earn_extra_cash() {
        if ($this->uri->segment(1) == "earn-extra-cash") {
            $this->selected_tab = "earn_extra_cash";
            $this->load->view('frontend/misc/earn_extra_cash');
        } else {
            redirect(base_url('earn-extra-cash'));
        }
    }

    function secure_community() {
        if ($this->uri->segment(1) == "secure-community") {
            $this->selected_tab = "secure_community";
            $this->load->view('frontend/misc/secure_community');
        } else {
            redirect(base_url('secure-community'));
        }
    }

    function find_perfect_buddy() {
        if ($this->uri->segment(1) == "find-perfect-buddy") {
            $this->load->view('frontend/misc/find_perfect_buddy');
        } else {
            $this->load->view('frontend/page404');
        }
    }

    function rewards_hosting_traveling() {
        if ($this->uri->segment(1) == "rewards-hosting-traveling") {
            $this->load->view('frontend/misc/rewards_hosting_traveling');
        } else {
            redirect(base_url('find-perfect-buddy'));
        }
    }

    function homestay() {
        $this->load->view('frontend/misc/homestay');
    }

    function event_planning($cat_id = NULL) {
        if ($this->uri->segment(1) == "event-planning") {
            $this->selected_tab = "event";
            $data = array();
            $data['cat_id'] = 5;
            $this->load->view('frontend/misc/EP1', $data);
        } else {
            redirect(base_url('event-planning'));
        }
    }

    function fitness() {
        if ($this->uri->segment(1) == "fitness") {
            $this->selected_tab = "fitness";
            $data = array();
            $data['cat_id'] = 1;
            $this->load->view('frontend/misc/F1', $data);
        } else {
            redirect(base_url('fitness'));
        }
    }

    function tourism($cat_id = NULL) {
        if ($this->uri->segment(1) == "tourism") {
            $this->selected_tab = "tourism";
            $data = array();
            $data['cat_id'] = 2;
            $this->load->view('frontend/misc/FA3', $data);
        } else {
            redirect(base_url('tourism'));
        }
    }

    function social_occasion($cat_id = NULL) {
        if ($this->uri->segment(1) == "social-occasion") {
            $this->selected_tab = "social";
            $data = array();
            $data['cat_id'] = 3;
            $this->load->view('frontend/misc/SO2', $data);
        } else {
            redirect(base_url('social-occasion'));
        }
    }

    function fashion($cat_id = 0) {
        if ($this->uri->segment(1) == "fashion") {
            $this->selected_tab = "fashion";
            $data = array();
            $data['cat_id'] = 6;
            $this->load->view('frontend/misc/T2', $data);
        } else {
            redirect(base_url('fashion'));
        }
    }

    function hosting($cat_id = NULL) {
        if ($this->uri->segment(1) == "hosting") {
            $this->selected_tab = "hosting";
            $data = array();
            $data['cat_id'] = 7;
            $this->load->view('frontend/misc/T6', $data);
        } else {
            redirect(base_url('hosting'));
        }
    }

    //    Misc pages ends here

    function verify_email($member_id, $verification_code = '') {
        if ($verification_code != '' && $member_id > 0) {
            $result = $this->Members_Model->getBy('email_verification_code', $verification_code, 'member_id', $member_id);
            $data['verified'] = false;
            if (!empty($result)) {
                if ($result[0]->email_verification_code == $verification_code) {
                    $update_data = array(
                        'email_verification_code' => '',
                        'is_email_verified' => 1
                    );
                    $this->Members_Model->update_member($result[0]->member_id, $update_data);
                    $data['verified'] = true;
                }
            }
            $this->load->view('frontend/misc/verified_status', $data);
        } else {
            redirect(base_url());
        }
    }

    function save_contactus_form() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $this->form_validation->set_rules('name', 'Full Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('phone', 'Phone', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('subject', 'Subject', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('comment', 'Comment', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {

                $data['name'] = $this->input->post('name');
                $data['email'] = $this->input->post('email');
                $data['phone'] = $this->input->post('phone');
                $data['subject'] = $this->input->post('subject');
                $data['comment'] = $this->input->post('comment');
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $result = $this->Misc_Model->add_contact($data);
                if ($result) {
                    $macros_data['$$$TITLE$$$'] = $data['subject'];
                    $macros_data['$$$MESSAGE$$$'] = $data['comment'];
                    $macros_data['$$$EMAIL$$$'] = $data['email'];
                    $macros_data['$$$PHONE$$$'] = $data['phone'];
                    $email_template_info = get_email_template('contact_us_email_to_admin', $macros_data);
                    if ($email_template_info) {
                        sendEmail($this->config->item('admin_email'), $email_template_info['template_subject'], $email_template_info['template_body'], $data['email']);
                    }
                    $this->_response(false, "Message sent successfully to admin!");
                } else {
                    $this->_response(true, "Error while sending requrst!");
                }
            }
        } else {
            redirect(base_url('contact'));
        }
    }

    function validate_promo_code() {
        $this->isAjax();
        $code = $this->input->post('code');
        $user_type = $this->input->post('userType');
        // if image table delete file from folder as well.
        $check = validatePromoCode($code, $user_type);
        if (!$check) {
            $this->_response(true, "Invalid promo code.");
        }
        $this->_response(false, "");
    }

    function updateOnlineStatus() {
        $this->isAjax();
        $userId = $this->input->post('userId');
        $is_online = $this->input->post('is_online');
        $result = $this->Misc_Model->update_is_online('member_id', $userId, array('is_online' => $is_online));
        // if image table delete file from folder as well.
        if (!$result) {
            $this->_response(true, "Unable to update status.");
        }
        $this->_response(false, "Status updated!");
    }

    function sendRequest() {
        $this->isAjax();
        $userId = $this->input->post('userID');
        $memberID = $this->input->post('memberID');
        $check_if_sent = $this->Misc_Model->check_if_request_sent($userId, $memberID);
        if (isset($check_if_sent) && count($check_if_sent) > 0) {
            if ($check_if_sent->status == 0) {
                $this->_response(false, "Connection request already sent!");
            } elseif ($check_if_sent->status == 1) {
                $this->_response(false, "You are already connected with this user!");
            } elseif ($check_if_sent->status == 2) {
                $this->_response(false, "Sorry, this user has rejected your request!");
            }
        } else {
            $data['user_id'] = $userId;
            $data['connection_id'] = $memberID;
            $data['status'] = 0;
            $data['created_at'] = date('Y-m-d h:i:s');
            $result = $this->Misc_Model->saveRecord('tb_member_connections', $data);
        }

        if (!$result) {
            $this->_response(true, "Unable to send connection request!");
        }
        $this->_response(false, "Connection request sent successfully!");
    }

    // remove it later.
    function sendTestMail() {
        echo sendEmail("qudratullah1061@gmail.com", "Signup Successfull", "Registration completed. Please verify email by");
        exit;
    }

}
