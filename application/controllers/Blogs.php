<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blogs extends CI_Controller {

    public $selected_tab = '';
    public $seo_title = '';
    public $seo_description = '';

    public function __construct() {
//        echo "asdf"; exit;
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/blogs_model', 'Blogs_Model');
    }

    function index() {
        $data['categories'] = GetAllCategories();
        $data['blogs'] = $blogs = $this->Blogs_Model->get_all_active_blogs();
        $this->selected_tab = 'blog';
        $this->load->view('frontend/blogs/blog', $data);
    }

    function blog_detail($blog_slug) {
        $blog_slug = strtolower($blog_slug);
        $this->selected_tab = 'blog';
        $blog_data = $this->Blogs_Model->get_blog_by_slug($blog_slug);
        if ($blog_data && isset($blog_data->blog_id) && $blog_data->is_active == 1) {
            $blog_id = $blog_data->blog_id;
//        delete_cookie('anonymous_user_id');
            $cookie = get_cookie('anonymous_user_id', FALSE);
            $data['blog'] = $blog_data; //$this->Blogs_Model->get_blog($blog_id);
            $data['blog_descriptions'] = $this->db->get_where('tb_blog_descriptions', array('blog_id' => $blog_id))->result_array();
            $data['selected_categories'] = $this->Blogs_Model->get_all_selected_categories($blog_id);
            $data['selected_tags'] = $this->Blogs_Model->get_all_selected_tags($blog_id);
            $data['blog_comments'] = $this->Blogs_Model->get_selected_comments($blog_id);
            $data['categories'] = GetAllCategories();
            $data['member_id'] = $member_id = $this->session->userdata('member_id');
            $data['anonymous_user_id'] = $anonymous_user_id = $cookie;
            $data['admin_id'] = $this->session->userdata('admin_id');
            $this->selected_tab = 'blog_detail';
            $this->seo_title = isset($data['blog']->seo_title) ? $data['blog']->seo_title : "";
            $this->seo_description = isset($data['blog']->seo_description) ? $data['blog']->seo_description : "";
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

    function update_comment() {
        isAjax();
        $blog_comment_id = $this->input->post('blog_comment_id');
        $comment = $this->input->post('comment');
        $this->Blogs_Model->update_comment($blog_comment_id, $comment);
        echo json_encode(array("error" => FALSE, "message" => "Comment Updated Successfully"));
        die();
    }

    function search_keyword() {
        $data['categories'] = GetAllCategories();
        $data['category_id'] = $category_id = $this->input->post('search_by_category');
        $data['keyword'] = $keyword = $this->input->post('keyword');
        if ($category_id || $keyword) {
            $data['blogs'] = $this->Blogs_Model->search_by_keyword($category_id, $keyword);
        } else {
            $data['blogs'] = $this->Blogs_Model->get_all_active_blogs();
        }
        $this->selected_tab = 'blog';
        $this->load->view('frontend/blogs/blog', $data);
    }

    function blog_comment($blog_id) {
//        $this->form_validation->set_rules('anonymous_user_name', 'Name', 'required|trim|strip_tags|xss_clean');
//        $this->form_validation->set_rules('anonymous_user_email', 'Email', 'required|email|trim|strip_tags|xss_clean');
//        $this->form_validation->set_rules('comment', 'Comment', 'required|trim');
//        if ($this->form_validation->run() == FALSE) {
//            $this->_response(true, validation_errors());
//        } else {
        $data['anonymous_user_name'] = $anonymous_user_name = $this->input->post('anonymous_user_name');
        $data['anonymous_user_email'] = $anonymous_user_email = $this->input->post('anonymous_user_email');
        $comment_data['comment'] = $this->input->post('comment');
        $comment_data['parent_id'] = $this->input->post('parent_id');
        $comment_data['blog_id'] = $blog_id;
        $comment_data['created_on'] = $data['created_on'] = date("Y-m-d h:i:s");
        if (!empty($this->session->userdata('member_id'))) {
            $comment_data['user_type'] = '1';
            $comment_data['user_id'] = $this->session->userdata('member_id');
        } elseif (!empty(get_cookie('anonymous_user_id', FALSE))) {
            $comment_data['user_type'] = '2';
            $comment_data['user_id'] = get_cookie('anonymous_user_id', FALSE);
        } elseif (!empty($this->session->userdata('admin_id'))) {
            $comment_data['user_type'] = '3';
            $comment_data['user_id'] = $this->session->userdata('admin_id');
        } else {
            $anonymous_user_id = $this->Blogs_Model->add_anonymous_user_data($data);
            $comment_data['user_type'] = '2';
            $comment_data['user_id'] = $anonymous_user_id;
        }

        $this->Blogs_Model->add_comment($comment_data);

        if ($anonymous_user_id > 0) {
            $cookie = array(
                'name' => 'anonymous_user_id',
                'value' => $anonymous_user_id,
                'expire' => '3600',
                'secure' => FALSE
            );
            $this->input->set_cookie($cookie);
        }

        //Render Back to Blog Details Page
        $blog_info = $this->Blogs_Model->get_blog($blog_id);
        $blog_slug = isset($blog_info->blog_slug) ? $blog_info->blog_slug : "";
        redirect(base_url('blog/' . $blog_slug));

//        }
    }

}
