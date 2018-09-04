<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Chat extends FrontEnd_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/chat_model', 'Chat_Model');
    }

    function view_chat_list()
    {
        $data['connections'] = $this->Chat_Model->getConnections($this->session->userdata('member_type'),$this->session->userdata('member_id'));
        $data['admin'] = $this->Chat_Model->getAdminMembers();
        $this->load->view('frontend/chat/chat_list', $data);
    }

}
