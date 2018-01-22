<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_auth extends CI_Controller {

    private $errors = array(
        '1' => "Email address or password is invalid!",
        '2' => "Please enter data in all fields!",
    );

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/login';
        $this->load->model('admin/admin_model', 'admin');
    }

    private function getAdminInfo() {
        $loggedin_userInfo = $this->db->get_where('tb_admin_users', array('admin_id' => $this->session->userdata('admin_id')))->result_array();
        if ($loggedin_userInfo) {
            return (isset($loggedin_userInfo[0]) ? $loggedin_userInfo[0] : null);
        }
    }

    public function index() {
        if (!$this->session->userdata('admin_id')) {
            $this->load->view('admin/login/view_login');
        } elseif ($this->session->userdata('is_locked')) {
            $data['admin_info'] = $this->getAdminInfo();
            $data['return_url'] = isset($_GET['return_url']) ? $_GET['return_url'] : "";
            $this->load->view('admin/login/view_lock', $data);
        } else {
            redirect(base_url('admin/admin_dashboard'));
        }
    }

    public function verifyLogin() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|strip_tags|xss_clean');
            if ($this->form_validation->run() == FALSE) {
                $error_data['login_error'] = validation_errors();
                $this->load->view('admin/login/view_login', $error_data);
            } else {
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $result = $this->admin->admin_login($username, $password);
                if ($result['error'] == 1) {
                    $error_data['login_error'] = $this->errors[$result['error']];
                    $this->load->view('admin/login/view_login', $error_data);
                } else {
                    $admin_info = $result['admin_info'];
                    $this->session->set_userdata(array('admin_id' => $admin_info['admin_id'], 'username' => $admin_info['username'], 'email' => $admin_info['email'], 'is_locked' => false));
                    // super admin redirect to dashboard
                    if ($admin_info['admin_id'] == 1) {
                        redirect(base_url('admin/admin_dashboard'));
                    } else {
                        RedirectAdminToAppropriatePage($admin_info['admin_id']);
                    }
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

    public function verifyUnlock() {
        if ($this->input->post()) {
            $error_data['admin_info'] = $this->getAdminInfo();
            $this->form_validation->set_rules('password', 'Password', 'required|trim|strip_tags|xss_clean');
            $return_url = $this->input->get_post('return_url');
            $error_data['return_url'] = $return_url;
            if ($this->form_validation->run() == FALSE) {
                $error_data['login_error'] = validation_errors();
                $this->load->view('admin/login/view_lock', $error_data);
            } else {
                $username = $this->session->userdata('username');
                $password = $this->input->post('password');
                $result = $this->admin->admin_login($username, $password);
                if ($result['error'] == 1) {
                    $error_data['login_error'] = "Please enter valid password!";
                    $this->load->view('admin/login/view_lock', $error_data);
                } else {
                    $admin_info = $result['admin_info'];
                    $this->session->set_userdata(array('admin_id' => $admin_info['admin_id'], 'username' => $admin_info['username'], 'email' => $admin_info['email'], 'is_locked' => false));
                    redirect($return_url != "" ? base_url($return_url) : base_url('admin/admin_dashboard'));
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

//
    public function logout() {
//        $this->session->unset_userdata(array('admin_id'=> '', 'admin_name'=> '', 'admin_email'    => '', 'admin_username' => ''));
        $this->session->sess_destroy();
        redirect(base_url('admin/admin_auth'));
    }

    public function lock() {
        $current_url = isset($_GET['current_url']) ? $_GET['current_url'] : "";
        $this->session->set_userdata('is_locked', 1);
        // redirected to dashboard to set userinfo.
        redirect(base_url('admin/admin_auth?return_url=' . $current_url));
    }

    //Controller for Authenticating the login
}
