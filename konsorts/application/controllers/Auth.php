<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

//    private $errors = array(
//        '1' => "Email address or password is invalid!",
//        '2' => "Please enter data in all fields!",
//    );

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

}
