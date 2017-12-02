<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Misc extends FrontEnd_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/misc_model', 'Misc_Model');
        $this->load->model('admin/members_model', 'Members_Model');
    }

//    function DeleteRecord() {
//        $this->isAjax();
//        $unique_id = $this->input->post('unique_id');
//        $table = $this->input->post('table');
//        $column = $this->input->post('column');
//        // if image table delete file from folder as well.
//        if ($table == 'tb_member_images') {
//            $where_clause = array('image_id'=>$unique_id);
//            $img_info = $this->Misc_Model->SelectByWhere($where_clause);
//            delete_image_from_directory($img_info);
//        }
//        $result = $this->Misc_Model->DeleteRecord($unique_id, $table, $column);
//
//
//        if ($result) {
//            $this->_response(false, "Record deleted successfully!");
//        }
//        $this->_response(true, "Problem while deleting record.");
//    }
//    function MarkAsProfileImage() {
//        $this->isAjax();
//        $unique_id = $this->input->post('image_id');
//        $member_id = $this->input->post('member_id');
//        $this->Misc_Model->UpdateRecord('member_id', $member_id, array('is_profile_image' => 0));
//        $this->Misc_Model->UpdateRecord('image_id', $unique_id, array('is_profile_image' => 1));
//        $this->_response(false, "Profile pic updated successfully!");
//    }

    function delete_dropzone_temp_file() {
        $unique_id = $this->input->get_post('unique_id');
        $file_name = $unique_id . $this->input->get_post('file_name');
        $where_clause = array('unique_id' => $unique_id, 'image' => $file_name);
        $result = $this->Misc_Model->DeleteRecordDropZoneJs('tb_temp_images_upload', $where_clause);
        if ($result) {
            // delete file from directory
            $file_path = 'uploads/temp_images/' . $file_name;
            delete_file_from_directory($file_path);
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
        $plan_info = $this->Misc_Model->getMemberPlanByPrice(array('plan_price' => $payment_details['payment_amount'], 'plan_type' => 1, 'is_active' => 1));
        if ($plan_info) {
            //update member info. add days to subscription days.
            $update_data = array(
                'email_verification_code' => md5(time()),
                'current_plan_id' => $plan_info[0]['plan_id'],
                'subscription_date' => date("Y-m-d H:i:s"),
                'end_subscription_date' => date('Y-m-d H:i:s', strtotime("+" . $plan_info[0]['plan_duration']))//date("Y-m-d H:i:s", strtotime("+" . $plan_info[0]['plan_duration'], strtotime('2014-05-22 10:35:10'))),
            );
            $this->Members_Model->update_member($member_id, $update_data);
            // get member info
            $member_info = $this->Members_Model->get_member_by_id($member_id);
            $member_email = $member_info['email'];
            $member_email_v_code = $update_data['email_verification_code'];
            sendEmail($member_email, "Signup Successfull", "Registration completed. Please verify email by <a href='" . base_url('misc/verify_email/' . $member_email_v_code) . "'>Clicking here.</a>");
        }
        $this->_response(false, "Payment processed successfully! Email sent to your account please verify email address to login to konsorts.com");
    }

//    Misc pages start here
    function about() {
        $this->selected_tab = 'about';
        $this->load->view('frontend/misc/about');
    }

    function contact() {
        $this->selected_tab = 'contact';
        $this->load->view('frontend/misc/contact_us');
    }

    function faq() {
        $this->load->view('frontend/misc/faq');
    }

    function terms() {
        $this->load->view('frontend/misc/terms');
    }

//    Misc pages ends here
}
