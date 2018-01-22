<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blogs extends CI_Controller {

    public $selected_tab = '';

    public function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/blogs_model', 'Blogs_Model');
    }

    function index() {
        $data['blogs'] = $blogs = $this->Blogs_Model->get_all_active_blogs();
//        foreach ($blogs as $blog) {
//            $blog_id = $blog->blog_id;
//            $data['blog_descriptions'][] = $this->db->get_where('tb_blog_descriptions', array('blog_id' => $blog_id))->result_array();
//            $data['selected_tags'][] = $this->db->get_where('tb_blog_tags', array('blog_id' => $blog_id))->result_array();
//            $data['selected_categories'][] = $this->db->get_where('tb_blog_categories', array('blog_id' => $blog_id))->result_array();
//        }
        $this->selected_tab = 'blog';
        $this->load->view('frontend/blogs/blog', $data);
    }

    function blog_detail($blog_id) {
        $data['blog'] = $this->Blogs_Model->get_blog($blog_id);
        if ($data['blog'] && isset($data['blog']->blog_id) && $data['blog']->is_active == 1) {
            $data['blog_descriptions'] = $this->db->get_where('tb_blog_descriptions', array('blog_id' => $blog_id))->result_array();
            $this->selected_tab = 'blog';
            $this->load->view('frontend/blogs/blog_detail', $data);
        } else {
            redirect(base_url());
        }
    }

}
