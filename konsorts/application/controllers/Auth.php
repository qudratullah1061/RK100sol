<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends FrontEnd_Controller {

    private $errors = array(
        '1' => "Email address or password is invalid!",
        '2' => "Please enter data in all fields!",
    );

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
                    $data['login_error'] = $this->errors[$result['error']];
                    $this->load->view('frontend/auth/login', $data);
                } else {
                    $user_info = $result['member_info'];
                    if($user_info['is_email_verified'] != 1)
                    {
                        $data['login_error'] = 'Your account is not email verified.';
                        $data['alert'] = 'danger';
                        $this->load->view('frontend/auth/login', $data);
                        
                    }else{
                        if($user_info['status'] == 'pending')
                        {
                            $data['login_error'] = 'Your account is not verify by admin.Please wait for 24 hours.';
                            $data['alert'] = 'info';
                            $this->load->view('frontend/auth/login', $data);
                        }else if($user_info['status'] == 'suspended')
                        {
                            $data['login_error'] = 'Your account is suspended.';
                            $data['alert'] = 'danger';
                            $this->load->view('frontend/auth/login', $data);

                        } else {
                            $this->session->set_userdata(array('member_id' => $user_info['member_id'], 'username' => $user_info['username'], 'email' => $user_info['email'], 'member_type' => $user_info['member_type'], 'is_locked' => false));
                            redirect(base_url('member/profile'));

                        }
                    }
                    
                    
                    
                    
                }
           }
       } else {
           redirect(base_url('auth/login'));
       }
   }

//
//    public function logout() {
////        $this->session->unset_userdata(array('admin_id'=> '', 'admin_name'=> '', 'admin_email'    => '', 'admin_username' => ''));
//        $this->session->sess_destroy();
//        redirect(base_url('admin/admin_auth'));
//    }
    //Controller for Authenticating the login
}