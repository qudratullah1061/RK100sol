<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newsletters extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/newsletters_model', 'Newsletters_Model');
    }

    function add_update_newsletter() {
        isAjax();
        if ($this->input->post()) {
        $is_unique = '|is_unique[tb_newsletters.newsletter_email]';
            $data = array();
            $edit_id = $this->input->post('newsletter_id');
            $this->form_validation->set_rules('newsletter_email', 'Email', 'required|trim|strip_tags|xss_clean'.$is_unique);

            if ($this->form_validation->run() == FALSE) {
                $records["error"] = true;
                $records["description"] = "This email has already been subscribed for newsletter. Please change email address!";
                echo json_encode($records);
                die();
            } else {
                $data = array();
                $data['newsletter_email'] = $this->input->post('newsletter_email');
                $data['created_on'] = date("Y-m-d h:i:s");
                $result = $this->Newsletters_Model->add_newsletter($data);
                if ($result) {
                    $records["error"] = false;
                    $records["description"] = "Email has been added successfully for newsletter!";
                    echo json_encode($records);
                    die();
                }
            }
        } else {
            redirect(base_url());
        }
    }

}
