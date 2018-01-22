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
        $this->selected_tab = 'blog';
        $this->load->view('frontend/blogs/blog', $data);
    }

    function blog_detail($blog_id) {
        $this->selected_tab = 'blog';
        $blog_data = $this->Blogs_Model->get_blog($blog_id);
        if ($blog_data && isset($blog_data->blog_id) && $blog_data->is_active == 1) {
            $data['blog'] = $blog_data;
            $data['blog_descriptions'] = $this->db->get_where('tb_blog_descriptions', array('blog_id' => $blog_id))->result_array();
            $data['selected_categories'] = $this->Blogs_Model->get_all_selected_categories($blog_id);
            $data['selected_tags'] = $this->Blogs_Model->get_all_selected_tags($blog_id);
            $this->selected_tab = 'blog';
            $this->load->view('frontend/blogs/blog_detail', $data);
        } else {
            redirect(base_url());
        }
    }

    function blogs_as_per_categories($category_id) {
        $data['blogs'] = $this->Blogs_Model->get_all_blogs_as_per_category($category_id);
        $this->selected_tab = 'blog';
        $this->load->view('frontend/blogs/blog', $data);
    }

    function blogs_as_per_tags($tag_id) {
        $data['blogs'] = $this->Blogs_Model->get_all_blogs_as_per_tag($tag_id);
        $this->selected_tab = 'blog';
        $this->load->view('frontend/blogs/blog', $data);
    }

    function search_keyword() {
        $keyword = $this->input->post('keyword');
        $data['blogs'] = $this->Blogs_Model->search_by_keyword($keyword);
        $this->selected_tab = 'blog';
        $this->load->view('frontend/blogs/blog', $data);
    }

}
