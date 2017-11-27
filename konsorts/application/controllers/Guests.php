<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Guests extends FrontEnd_Controller {

    function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
    }

    function signup() {
        $this->load->view('frontend/guests/signup');
    }

    function login() {
        $this->load->view('frontend/guest/login');
    }

}
