<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    public $selected_tab = 'login';

    public function __construct() {
        parent::__construct();

        $this->layout = 'frontend/main';
        $this->load->model('admin/members_model', 'Members_Model');
    }

    function login() {
        $this->selected_tab = 'login';
        $this->load->view('frontend/auth/login');
    }

    function register() {
        $this->selected_tab = 'register';
        $this->load->view('frontend/auth/membership_plans');
    }

    function verifyLogin() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|strip_tags|xss_clean');
            $data['alert'] = 'danger';
            $data['post_data'] = $this->input->post();
            if ($this->form_validation->run() == FALSE) {
                $data['login_error'] = validation_errors();
                $this->load->view('frontend/auth/login', $data);
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $result = $this->Members_Model->member_login($username, $password);
                if ($result['error'] == 1) {
                    $data['login_error'] = $result['error_message'];
                    $data['alert'] = 'danger';
                    $this->selected_tab = 'login';
                    $this->load->view('frontend/auth/login', $data);
                } else {
                    $user_info = $result['member_info'];
                    $user_info = $this->Members_Model->get_member_by_id($user_info['member_id']);
                    $this->session->set_userdata(array('member_id' => $user_info['member_id'], 'member_info' => $user_info, 'username' => $user_info['username'], 'email' => $user_info['email'], 'member_type' => $user_info['member_type']));
                    redirect(base_url('member/profile'));
                }
            }
        } else {
            redirect(base_url('auth/login'));
        }
    }

    public function logout() {
//        $this->session->unset_userdata(array('admin_id'=> '', 'admin_name'=> '', 'admin_email'    => '', 'admin_username' => ''));
        $this->session->sess_destroy();
        redirect(base_url('auth/login'));
    }

    function forgot_password() {
        $this->load->view('frontend/auth/forgot_password');
    }

    function sendForgotPasswordEmail() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'required|trim|strip_tags|valid_email');
            if ($this->form_validation->run() == FALSE) {
                $data['email_msg'] = validation_errors();
                $data['alert'] = 'danger';
                $this->load->view('frontend/auth/forgot_password', $data);
            } else {
                // check member exist with given email
                $email = $this->input->post('email');
                $this->table_name = 'tb_members';
                $member_info = $this->Members_Model->getBy('email', $email);
                if (!$member_info) {
                    $data['email_msg'] = "No account found with provided email address.";
                    $data['alert'] = 'danger';
                    $this->load->view('frontend/auth/forgot_password', $data);
                } else {
                    // update email verification code
                    $member_update['email_verification_code'] = md5(time());
                    $member_id = $member_info[0]->member_id;
                    $this->Members_Model->update_member($member_id, $member_update);
                    // send email to user with reset link.
                    $member_email = $member_info[0]->email;
                    $member_email_v_code = $member_update['email_verification_code'];
                    $macros_data['$$$FIRST_NAME$$$'] = $member_info[0]->first_name;
                    $macros_data['$$$EMAIL$$'] = $member_info[0]->email;
                    $macros_data['$$$CONFIRMATION_LINK$$$'] = (base_url('auth/reset_password/' . $member_id . '/' . $member_email_v_code));
                    $email_template_info = get_email_template('member_forgot_password', $macros_data);
                    if ($email_template_info) {
                        sendEmail($member_email, $email_template_info['template_subject'], $email_template_info['template_body']);
                    }
                    $data['email_msg'] = "Email sent to your email address with reset password link. Please follow instructions given in email to reset your password.";
                    $data['alert'] = 'success';
                    $this->load->view('frontend/auth/forgot_password', $data);
                }
            }
        }
    }

    function reset_password($member_id, $verification_code = '') {
        if ($verification_code != '' && $member_id > 0) {
            $result = $this->Members_Model->getBy('email_verification_code', $verification_code, 'member_id', $member_id);
            $data['verified'] = false;
            if (!empty($result)) {
                $data['member_id'] = $member_id;
                $data['email_verification_code'] = $verification_code;
                $this->load->view('frontend/auth/reset_password_form', $data);
            } else {
                redirect(base_url());
            }
        } else {
            redirect(base_url());
        }
    }

    function update_password() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('password', 'Password', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|strip_tags|xss_clean|matches[password]');
            if ($this->form_validation->run() == FALSE) {
                $data['email_msg'] = validation_errors();
                $data['alert'] = 'danger';
                $this->load->view('frontend/auth/reset_password_form', $data);
            } else {
                $member_id = $this->input->post('member_id');
                $email_verification_code = $this->input->post('email_verification_code');
                if ($member_id > 0 && $email_verification_code != "") {
                    $member_update['password'] = md5($this->input->post('password'));
                    $member_update['email_verification_code'] = "";
                    $this->Members_Model->update_member($member_id, $member_update);
                    $data['member_id'] = $member_id;
                    $data['email_verification_code'] = $email_verification_code;
                    $data['email_msg'] = "Password updted successfully. Please goto login page to access your account.";
                    $data['alert'] = 'success';
                    $this->load->view('frontend/auth/reset_password_form', $data);
                } else {
                    echo "y here";
                    echo "<pre>";
                    print_r($this->input->post());
                    exit;
                    redirect(base_url());
                }
            }
        }
    }

}
