<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Faqs extends CI_Controller {

    public $selected_tab = '';

    public function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/faqs_model', 'Blogs_Model');
    }

    function index() {
        $data['faqs'] = $faqs = $this->Blogs_Model->get_all_active_faqs();
        $this->selected_tab = 'faq';
        $this->load->view('frontend/faqs/faq', $data);
    }

}
