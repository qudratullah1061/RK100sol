<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chat extends FrontEnd_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/chat_model', 'Chat_Model');
    }

    function view_chat_list() {
        $this->load->view('frontend/chat/chat_list');
    }

}
