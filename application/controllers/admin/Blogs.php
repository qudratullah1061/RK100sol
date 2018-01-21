<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Blogs extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/blogs_model', 'Blogs_Model');
    }

    function modal_tag() {
        $this->is_ajax();
        $this->selected_tab = 'blogs';
        $this->selected_child_tab = 'view_tags';
        $tag_id = $this->input->post('tag_id');
        $tag_data = $this->Blogs_Model->get_tag($tag_id);
        $data['tag_data'] = $tag_data;
        $html = $this->load->view('admin/blogs/add_tag', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }
    function modal_categories() {
        $this->is_ajax();
        $data['blog_id'] = $blog_id = $this->input->post('blog_id');
        $data['tags_data'] = $this->Blogs_Model->get_all_tags();
        $data['selected_tags'] = $this->db->get_where('tb_blog_tags', array('blog_id' => $blog_id))->result_array();
        $data['categories'] = GetAllCategories();
        $data['selected_categories'] = $this->db->get_where('tb_blog_categories', array('blog_id' => $blog_id))->result_array();
        $html = $this->load->view('admin/blogs/view_categories', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_tag() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('tag_id');
            $this->form_validation->set_rules('tag_name', 'Tag Name', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['tag_name'] = $this->input->post('tag_name');
                $data['is_active'] = $this->input->post('is_active') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $this->session->userdata('admin_id');
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }
                $result = false;
                if ($edit_id > 0) {
                    $this->Blogs_Model->update_tag('tag_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Blogs_Model->add_tag($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

    function view_tags() {
        $this->selected_tab = 'blogs';
        $this->selected_child_tab = 'view_tags';
        $this->load->view('admin/blogs/view_tags');
    }

    function get_tags() {
        $records = array();
        $records["data"] = array();
        $sEcho = intval($this->input->post('draw'));
        $offset = $this->input->post('start');
        if (trim($offset) == "") {
            $offset = 1;
        }
        $this->page_limit = $this->input->post('length');
        $columns = $this->input->post('columns');
        $sort_by = '';
        $cond = '';
        if ($this->input->post('tag_name')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " tags.tag_name LIKE '%" . $this->input->post('tag_name') . "%'";
        }
        if ($this->input->post('created_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " tags.created_on LIKE  '%" . $this->input->post('created_on') . "%'";
        }
        if ($this->input->post('updated_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " tags.updated_on LIKE  '%" . $this->input->post('updated_on') . "%'";
        }
        if ($this->input->post('created_by')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " admins.username LIKE  '%" . $this->input->post('created_by') . "%'";
        }
        if ($this->input->post('is_active') != "") {
            $cond .= ($cond != '' ? ' AND ' : '') . (" tags.is_active = " . $this->input->post('is_active'));
        }

        $colmnsArry = array('`tags`.`tag_name`', '`tags`.`created_on`', '`tags`.`updated_on`', '`tags`.`created_by`', '`tags`.`updated_by`', '`tags`.`is_active`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }

        $admins = $this->Blogs_Model->getBlogs($cond, $offset, $this->page_limit, $sort_by);
        $count = $admins['total'];
        if ($count > 0) {
            foreach ($admins['records'] as $result) {
                $active_html = '<div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" disabled="disabled" id="checkbox' . $result['tag_id'] . '" ' . ($result['is_active'] ? "checked='checked'" : "") . ' class="md-check">
                                        <label for="checkbox' . $result['tag_id'] . '">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                        </label>
                                    </div>
                                </div>';
                $records["data"][] = array(
                    $result['tag_name'],
                    $result['created_on'],
                    $result['updated_on'],
                    $result['admin_name'],
                    $active_html,
                    '<a class="btn btn-xs default btn-editable" onclick="Blogs.modal_add_tag(' . $result['tag_id'] . ')">Edit</a> <a class="btn btn-xs default btn-editable" onclick="CommonFunctions.Delete(' . $result["tag_id"] . ' , \'tb_tags\' , \'tag_id\' , \'Tag will be permanently deleted without further warning. Do you really want to delete this tag?\');">Delete</i></a> '
                );
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records["query"] = $admins['query'];
        echo json_encode($records);
        exit();
    }
    function get_blogs() {
        $records = array();
        $records["data"] = array();
        $sEcho = intval($this->input->post('draw'));
        $offset = $this->input->post('start');
        if (trim($offset) == "") {
            $offset = 1;
        }
        $this->page_limit = $this->input->post('length');
        $columns = $this->input->post('columns');
        $sort_by = '';
        $cond = '';
        if ($this->input->post('blog_title')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " blogs.blog_title LIKE '%" . $this->input->post('blog_title') . "%'";
        }
        if ($this->input->post('blog_author')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " blogs.blog_author LIKE '%" . $this->input->post('blog_author') . "%'";
        }
//        if ($this->input->post('blog_date')) {
//            $cond .= ($cond != '' ? ' AND ' : '') . " blogs.blog_date LIKE '%" . $this->input->post('blog_date') . "%'";
//        }
        if ($this->input->post('created_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " blogs.created_on LIKE  '%" . $this->input->post('created_on') . "%'";
        }
//        if ($this->input->post('updated_on')) {
//            $cond .= ($cond != '' ? ' AND ' : '') . " blogs.updated_on LIKE  '%" . $this->input->post('updated_on') . "%'";
//        }
        if ($this->input->post('created_by')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " admins.username LIKE  '%" . $this->input->post('created_by') . "%'";
        }
        if ($this->input->post('is_active') != "") {
            $cond .= ($cond != '' ? ' AND ' : '') . (" blogs.is_active = " . $this->input->post('is_active'));
        }

        $colmnsArry = array('`blogs`.`blog_title`', '`blogs`.`blog_author`', '`blogs`.`created_on`', '`blogs`.`created_by`', '`blogs`.`updated_by`', '`blogs`.`is_active`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }

        $admins = $this->Blogs_Model->getBlogsLists($cond, $offset, $this->page_limit, $sort_by);
        $count = $admins['total'];
        if ($count > 0) {
            foreach ($admins['records'] as $result) {
                $active_html = '<div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" disabled="disabled" id="checkbox' . $result['blog_id'] . '" ' . ($result['is_active'] ? "checked='checked'" : "") . ' class="md-check">
                                        <label for="checkbox' . $result['blog_id'] . '">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                        </label>
                                    </div>
                                </div>';
                $records["data"][] = array(
                    $result['blog_title'],
                    $result['blog_author'],
//                    $result['blog_date'],
                    '<img src="'.base_url($result['blog_image_path'].$result['blog_image']).'" style="width: 50px; height: 50px; border-radius: 10px !important;">',
                    '<img src="'.base_url($result['author_image_path'].$result['author_image']).'" style="width: 50px; height: 50px; border-radius: 10px !important;">',
                    date('Y-m-d', strtotime($result['created_on'])),
//                    $result['updated_on'],
                    $result['admin_name'],
                    $active_html,
                    '<a class="btn btn-xs default btn-editable" onclick="Blogs.modal_view_categories(' . $result['blog_id'] . ')">Tags & Categories</a> <a class="btn btn-xs default btn-editable" href="'.base_url('admin/blogs/edit_blog/').$result['blog_id'].'">Edit</a> <a class="btn btn-xs default btn-editable" onclick="CommonFunctions.Delete(' . $result["blog_id"] . ' , \'tb_blogs\' , \'blog_id\' , \'Blog will be permanently deleted without further warning. Do you really want to delete this blog?\');">Delete</i></a> '
                );
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records["query"] = $admins['query'];
        echo json_encode($records);
        exit();
    }

    function DeleteRecord() {
        $this->isAjax();
        $unique_id = $this->input->post('unique_id');
        $table = $this->input->post('table');
        $column = $this->input->post('column');
        // if image table delete file from folder as well.
        if ($table == 'tb_member_images') {
            $where_clause = array('image_id' => $unique_id);
            $img_info = $this->Misc_Model->SelectByWhere($where_clause);
            delete_image_from_directory($img_info);
        }
        $result = $this->Misc_Model->DeleteRecord($unique_id, $table, $column);


        if ($result) {
            $this->_response(false, "Record deleted successfully!");
        }
        $this->_response(true, "Problem while deleting record.");
    }
    
    //Work by Sufyan
    function view_blogs() {
        $this->selected_tab = 'blogs';
        $this->selected_child_tab = 'view_blogs';
        $this->load->view('admin/blogs/view_blogs');
    }
    
    function add_blog() {
        $this->selected_tab = 'blogs';
        $this->selected_child_tab = 'add_blog';
        $data['tags_data'] = $this->Blogs_Model->get_all_tags();
        $data['categories'] = GetAllCategories();
        $this->load->view('admin/blogs/add_blog', $data);
    }
    
    function edit_blog($blog_id) {
        $this->selected_tab = 'blogs';
        $this->selected_child_tab = 'add_blog';
        $data['blog_data'] = $this->Blogs_Model->get_blog($blog_id);
        $data['blog_descriptions'] = $this->db->get_where('tb_blog_descriptions', array('blog_id' => $blog_id))->result_array();
        $data['tags_data'] = $this->Blogs_Model->get_all_tags();
        $data['selected_tags'] = $this->db->get_where('tb_blog_tags', array('blog_id' => $blog_id))->result_array();
        $data['categories'] = GetAllCategories();
        $data['selected_categories'] = $this->db->get_where('tb_blog_categories', array('blog_id' => $blog_id))->result_array();
        $this->load->view('admin/blogs/add_blog', $data);
    }
    
    function add_update_blog() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('blog_id');
            $this->form_validation->set_rules('blog_title', 'Blog Title', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('blog_author', 'Author Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('blog_author_about', 'About Author', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('blog_date', 'Blog Date', 'required|trim|strip_tags|xss_clean');
            if (empty($_FILES['author_image']['name'])){
                $this->form_validation->set_rules('author_image', 'Author Image', 'required');
            }
            if (empty($_FILES['blog_image']['name'])){
                $this->form_validation->set_rules('blog_image', 'Blog Image', 'required');
            }

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['blog_title'] = $this->input->post('blog_title');
                $data['blog_author'] = $this->input->post('blog_author');
                $data['blog_author_about'] = $this->input->post('blog_author_about');
                $data['blog_date'] = $this->input->post('blog_date');
                $data['is_active'] = $this->input->post('is_active') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $this->session->userdata('admin_id');
                
                //Upload Author Image
                if (isset($_FILES['author_image']['name']) && $_FILES['author_image']['name'] != "") {
                    $thumb_options = array();
                    $author_images = $_FILES['author_image'];
                    $f_upload_dir = $this->config->item('root_path') . 'uploads/blogs/authors/';
                    $thumb_options[0] = array('width' => 30, 'height' => 30, 'prefix' => 'small_');
                    $thumb_options[1] = array('width' => 100, 'height' => 100, 'prefix' => 'medium_');
                    $thumb_options[2] = array('width' => 270, 'height' => 180, 'prefix' => 'large_');
                    $file_name = basename($author_images['name']);
                    $author_image_name = time() . $file_name;
                    $f_file_path = $f_upload_dir . '/' . $author_image_name;
                    move_uploaded_file($author_images['tmp_name'], $f_file_path);
                    CreateThumbnail($f_file_path, $f_upload_dir, $thumb_options);
                    $data['author_image_path'] = 'uploads/blogs/authors/';
                    $data['author_image'] = $author_image_name;
                }
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }
                
                //Upload Blog Image
                if (isset($_FILES['blog_image']['name']) && $_FILES['blog_image']['name'] != "") {
                    $thumb_options = array();
                    $blog_images = $_FILES['blog_image'];
                    $f_upload_dir = $this->config->item('root_path') . 'uploads/blogs/blog_images/';
                    $thumb_options[0] = array('width' => 270, 'height' => 180, 'prefix' => 'medium_');
                    $file_name = basename($blog_images['name']);
                    $blog_image_name = time() . $file_name;
                    $f_file_path = $f_upload_dir . '/' . $blog_image_name;
                    move_uploaded_file($blog_images['tmp_name'], $f_file_path);
                    CreateThumbnail($f_file_path, $f_upload_dir, $thumb_options);
                    $data['blog_image_path'] = 'uploads/blogs/blog_images/';
                    $data['blog_image'] = $blog_image_name;
                }
//                echo '<pre>';print_r($data);exit();
                $result = false;
                if ($edit_id > 0) {
                    $this->Blogs_Model->update_blog('blog_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $insert_id = $this->Blogs_Model->add_blog($data);
                }
                
                // Start Repeated Data of Blog
                $blog_data = $this->input->post('blog_data');
                if(count($blog_data) >= 1){
                    $counter = 0;
                    foreach ($blog_data as $bl_data) {
                        if($edit_id > 0){
                            $blog_des['blog_id'] = $edit_id;
                        }else{
                            $blog_des['blog_id'] = $insert_id;
                        }
                        $blog_description_id = $this->input->post($bl_data['blog_description_id']);
                        $blog_des['blog_description'] = $bl_data['blog_description'];
                        // upload Blog Description images , add call
                        if (isset($_FILES['blog_data']['name'][$counter]['blog_description_image']) && $_FILES['blog_data']['name'][$counter]['blog_description_image'] != "") {
                            $thumb_options = array();
                            $blog_description_images = $_FILES['blog_data']['name'][$counter]['blog_description_image'];
                            $f_upload_dir = $this->config->item('root_path') . 'uploads/blogs/blog_description/';
                            $thumb_options[0] = array('width' => 150, 'height' => 150, 'prefix' => 'small_');
                            $thumb_options[1] = array('width' => 400, 'height' => 400, 'prefix' => 'medium_');
                            $thumb_options[2] = array('width' => 825, 'height' => 578, 'prefix' => 'large_');
                            $file_name = basename($blog_description_images);
                            $blog_description_image_name = time() . $file_name;
                            $f_file_path = $f_upload_dir . '/' . $blog_description_image_name;
                            move_uploaded_file($_FILES['blog_data']['tmp_name'][$counter]['blog_description_image'], $f_file_path);
                            CreateThumbnail($f_file_path, $f_upload_dir, $thumb_options);
                            $blog_des['blog_description_image_path'] = 'uploads/blogs/blog_description/';
                            $blog_des['blog_description_image'] = $blog_description_image_name;
                        }
                        
                        $blog_des['blog_feature_description'] = $bl_data['blog_feature_description'];
                        // upload Feature Description images , add call
                        if (isset($_FILES['blog_data']['name'][$counter]['blog_feature_image']) && $_FILES['blog_data']['name'][$counter]['blog_feature_image'] != "") {
                            $thumb_options = array();
                            $blog_feature_images = $_FILES['blog_data']['name'][$counter]['blog_feature_image'];
                            $f_upload_dir = $this->config->item('root_path') . 'uploads/blogs/feature_description/';
                            $thumb_options[0] = array('width' => 75, 'height' => 26, 'prefix' => 'small_');
                            $thumb_options[1] = array('width' => 353, 'height' => 257, 'prefix' => 'medium_');
//                            $thumb_options[2] = array('width' => 400, 'height' => 400, 'prefix' => 'large_');
                            $file_name = basename($blog_feature_images);
                            $blog_feature_image_name = time() . $file_name;
                            $f_file_path = $f_upload_dir . '/' . $blog_feature_image_name;
                            move_uploaded_file($_FILES['blog_data']['tmp_name'][$counter]['blog_feature_image'], $f_file_path);
                            CreateThumbnail($f_file_path, $f_upload_dir, $thumb_options);
                            $blog_des['blog_feature_image_path'] = 'uploads/blogs/feature_description/';
                            $blog_des['blog_feature_image'] = $blog_feature_image_name;
                        }
                        $blog_des['updated_on'] = $blog_des['created_on'] = date("Y-m-d h:i:s");
                        $blog_des['updated_by'] = $blog_des['created_by'] = $this->session->userdata('admin_id');
                        
                        if ($blog_description_id > 0) {
                            // unset created on
                            unset($blog_des['created_on']);
                            unset($blog_des['created_by']);
                        }
                        
                        $result_desc = false;
                        if ($blog_description_id > 0) {
                            $this->Blogs_Model->update_blog_des('blog_description_id', $blog_description_id, $blog_des);
                            $result_desc = true;
                        } else {
                            $result_desc = $this->Blogs_Model->add_blog_des($blog_des);
                        }
                        $counter++;
                    }
                }
                // Adding Categories
                $categories = $this->input->post('categories');
                $this->Blogs_Model->AddUpdateBlogCategories($categories, $insert_id);
                
                //Adding Tags
                $tags = $this->input->post('tag_id');
                $this->Blogs_Model->add_tags($tags, $insert_id);
                // End Repeated Data of Blog
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }
    
    function update_blog_categories() {
        $this->isAjax();
        $blog_id = $this->input->post('blog_id');
        $categories = $this->input->post('categories');
        $this->Blogs_Model->AddUpdateBlogCategories($categories, $blog_id);
        $tags = $this->input->post('tag_id');
        $this->Blogs_Model->add_tags($tags, $blog_id);
        $this->_response(false, "Changes saved successfully!");
    }

}
