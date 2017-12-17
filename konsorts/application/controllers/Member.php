<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Member extends FrontEnd_Controller {

    function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/members_model', 'Members_Model');
    }

    function profile($member_id = '') {
        if($member_id != '')
        {
            $member_id = base64_decode($member_id);
        }else
        {
            $member_id = $this->session->userdata('member_id');
        }
        
        
        $this->load->view('frontend/member/profile');
    }

    

}
