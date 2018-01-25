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
//        delete_cookie('anonymous_user_id');
        $cookie = get_cookie('anonymous_user_id', FALSE);
        $data['blog'] = $this->Blogs_Model->get_blog($blog_id);
        $data['blog_descriptions'] = $this->db->get_where('tb_blog_descriptions', array('blog_id' => $blog_id))->result_array();
        $data['selected_categories'] = $this->Blogs_Model->get_all_selected_categories($blog_id);
        $data['selected_tags'] = $this->Blogs_Model->get_all_selected_tags($blog_id);
        $data['blog_comments'] = $this->Blogs_Model->get_selected_comments($blog_id);
        $data['categories'] = GetAllCategories();
        $data['member_id'] = $this->session->userdata('member_id');
        $data['anonymous_user_id'] = $cookie;
        $this->selected_tab = 'blog';
        $this->load->view('frontend/blogs/blog_detail', $data);
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
        $category_id = $this->input->post('search_by_category');
        $keyword = $this->input->post('keyword');
        $data['blogs'] = $this->Blogs_Model->search_by_keyword($keyword, $category_id);
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
            if(!empty($this->session->userdata('member_id'))){
                $comment_data['user_type'] = '1';
                $comment_data['user_id'] = $this->session->userdata('member_id');
            }elseif(!empty(get_cookie('anonymous_user_id', FALSE))){
                $comment_data['user_type'] = '2';
                $comment_data['user_id'] = get_cookie('anonymous_user_id', FALSE);
            }else {
                $anonymous_user_id = $this->Blogs_Model->add_anonymous_user_data($data);
                $comment_data['user_type'] = '2';
                $comment_data['user_id'] = $anonymous_user_id;
            }
            
            $this->Blogs_Model->add_comment($comment_data);
            
            if($anonymous_user_id > 0){
                $cookie= array(
                    'name' => 'anonymous_user_id',
                    'value' => $anonymous_user_id,
                    'expire' => '3600',
                    'secure' => FALSE
                );
                $this->input->set_cookie($cookie);
            }
            
            //Render Back to Blog Details Page
            redirect(base_url('blogs/blog_detail/'.$blog_id));
            
//        }
    }

}
