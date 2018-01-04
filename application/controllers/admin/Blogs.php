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

}
