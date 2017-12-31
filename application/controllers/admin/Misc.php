<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Misc extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/misc_model', 'Misc_Model');
        $this->load->model('admin/members_model', 'Members_Model');
    }

//    public function add_guest() {
//        $this->selected_tab = 'guest';
//        $this->selected_child_tab = 'add';
//        $data = array();
//        $this->load->view('admin/guests/add_guest', $data);
//    }

    function modal_category() {
        $this->is_ajax();
        $this->selected_tab = 'misc';
        $this->selected_child_tab = 'view_categories';
        $category_id = $this->input->post('category_id');
        $category_data = $this->Misc_Model->get_category($category_id);
        $data['category_data'] = $category_data;
        $html = $this->load->view('admin/misc/add_category', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_category() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('category_id');
            $this->form_validation->set_rules('category_name', 'Category Name', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['category_name'] = $this->input->post('category_name');
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
                    $this->Misc_Model->update_category('category_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Misc_Model->add_category($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

    function view_categories() {
        $this->selected_tab = 'misc';
        $this->selected_child_tab = 'view_categories';
        $this->load->view('admin/misc/view_categories');
    }

    function get_categories() {
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
        if ($this->input->post('category_name')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " categories.category_name LIKE '%" . $this->input->post('category_name') . "%'";
        }
        if ($this->input->post('created_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " categories.created_on LIKE  '%" . $this->input->post('created_on') . "%'";
        }
        if ($this->input->post('updated_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " categories.updated_on LIKE  '%" . $this->input->post('updated_on') . "%'";
        }
        if ($this->input->post('created_by')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " admins.username LIKE  '%" . $this->input->post('created_by') . "%'";
        }
        if ($this->input->post('is_active') != "") {
            $cond .= ($cond != '' ? ' AND ' : '') . (" categories.is_active = " . $this->input->post('is_active'));
        }

        $colmnsArry = array('`categories`.`category_name`', '`categories`.`created_on`', '`categories`.`created_by`', '`categories`.`updated_on`', '`categories`.`is_active`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }

        $admins = $this->Misc_Model->getCategories($cond, $offset, $this->page_limit, $sort_by);
        $count = $admins['total'];
        if ($count > 0) {
            foreach ($admins['records'] as $result) {
                $active_html = '<div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" disabled="disabled" id="checkbox' . $result['category_id'] . '" ' . ($result['is_active'] ? "checked='checked'" : "") . ' class="md-check">
                                        <label for="checkbox' . $result['category_id'] . '">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                        </label>
                                    </div>
                                </div>';
                $records["data"][] = array(
                    $result['category_name'],
                    $result['created_on'],
                    $result['admin_name'],
                    $result['updated_on'],
                    $active_html,
                    '<a class="btn btn-xs default btn-editable" title="View Sub Categories" href="' . (base_url("admin/misc/view_sub_categories/" . $result['category_id'])) . '"><i class="fa fa-eye"></i></a><a class="btn btn-xs default btn-editable" onclick="Categories.modal_add_category(' . $result['category_id'] . ')">Edit</a> <a class="btn btn-xs default btn-editable" onclick="CommonFunctions.Delete(' . $result["category_id"] . ' , \'tb_categories\' , \'category_id\' , \'Category will be permanently deleted without further warning. Do you really want to delete this category?\');">Delete</i></a> '
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

    function view_sub_categories($category_id = 0) {
        $this->selected_tab = 'misc';
        $this->selected_child_tab = 'view_categories';
        $data['category_id'] = $category_id;
        $this->load->view('admin/misc/view_sub_categories', $data);
    }

    function get_sub_categories($category_id = 0) {
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
        $cond = ' sub_categories.category_id = ' . $category_id;
        if ($this->input->post('sub_category_name')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " sub_categories.sub_category_name LIKE '%" . $this->input->post('sub_category_name') . "%'";
        }
        if ($this->input->post('created_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " sub_categories.created_on LIKE  '%" . $this->input->post('created_on') . "%'";
        }
        if ($this->input->post('updated_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " sub_categories.updated_on LIKE  '%" . $this->input->post('updated_on') . "%'";
        }
        if ($this->input->post('created_by')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " admins.username LIKE  '%" . $this->input->post('created_by') . "%'";
        }
        if ($this->input->post('is_active') != "") {
            $cond .= ($cond != '' ? ' AND ' : '') . (" sub_categories.is_active = " . $this->input->post('is_active'));
        }

        $colmnsArry = array('`sub_categories`.`sub_category_name`', '`sub_categories`.`created_on`', '`sub_categories`.`created_by`', '`sub_categories`.`updated_on`', '`sub_categories`.`is_active`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }

        $admins = $this->Misc_Model->getSubCategories($cond, $offset, $this->page_limit, $sort_by);
        $count = $admins['total'];
        if ($count > 0) {
            foreach ($admins['records'] as $result) {
                $active_html = '<div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" disabled="disabled" id="checkbox' . $result['sub_category_id'] . '" ' . ($result['is_active'] ? "checked='checked'" : "") . ' class="md-check">
                                        <label for="checkbox' . $result['sub_category_id'] . '">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                        </label>
                                    </div>
                                </div>';
                $records["data"][] = array(
                    $result['sub_category_name'],
                    $result['created_on'],
                    $result['admin_name'],
                    $result['updated_on'],
                    $active_html,
                    '<a class="btn btn-xs default btn-editable" onclick="SubCategories.modal_add_sub_category(' . $result['sub_category_id'] . ' , ' . $result['category_id'] . ')">Edit</a> <a class="btn btn-xs default btn-editable" onclick="CommonFunctions.Delete(' . $result["sub_category_id"] . ' , \'tb_sub_categories\' , \'sub_category_id\' , \'Sub Category option will be permanently deleted without further warning. Do you really want to delete this sub category option?\');">Delete</a> '
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

    function modal_sub_category() {
        $this->is_ajax();
        $this->selected_tab = 'misc';
        $this->selected_child_tab = 'view_categories';
        $sub_category_id = $this->input->post('sub_category_id');
        $category_id = $this->input->post('category_id');
        $sub_category_data = $this->Misc_Model->get_sub_category($sub_category_id);
        $data['sub_category_data'] = $sub_category_data;
        $data['category_id'] = $category_id;
        $html = $this->load->view('admin/misc/add_sub_category', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_sub_category() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('sub_category_id');
            $category_id = $this->input->post('category_id');
            $this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['sub_category_name'] = $this->input->post('sub_category_name');
                $data['category_id'] = $category_id;
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
                    $this->Misc_Model->update_sub_category('sub_category_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Misc_Model->add_sub_category($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
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

    public function upload_images_member() {
        $member_id = $this->input->post('member_id');
        $file_upload_unique_id = $this->input->post('file_upload_unique_id');
        $image_type = $this->input->post('image_type');
        $image_dir = $this->input->post('image_dir');
        $watermark = $image_type == 'profile' ? TRUE : FALSE;
        $thumb_options[0] = array('width' => 50, 'height' => 50, 'prefix' => 'small_');
        $thumb_options[1] = array('width' => 150, 'height' => 150, 'prefix' => 'medium_');
        $thumb_options[2] = array('width' => 400, 'height' => 400, 'prefix' => 'large_');
        $thumb_options[3] = array('width' => 700, 'height' => 700, 'prefix' => 'Xlarge_');
        $result = UploadImage('file', $image_dir, TRUE, $thumb_options, $watermark, $file_upload_unique_id);
        if (isset($result['error'])) {
            $this->_response(true, $result['error']);
        }
        // new image paths
        $image = $result['upload_data']['file_name'];
        $image_path = $result['upload_data']['file_path'];

        $image_data = array('member_id' => $member_id, 'image_type' => $image_type, 'is_profile_image' => 0, 'image' => $image, 'image_path' => $image_dir);
        $this->db->insert('tb_member_images', $image_data);
        $this->_response(true, 'File uploaded successfully!');
    }

    function MarkAsProfileImage() {
        $this->isAjax();
        $unique_id = $this->input->post('image_id');
        $member_id = $this->input->post('member_id');
        $this->Misc_Model->UpdateRecord('member_id', $member_id, array('is_profile_image' => 0));
        $this->Misc_Model->UpdateRecord('image_id', $unique_id, array('is_profile_image' => 1));
        $this->_response(false, "Profile pic updated successfully!");
    }

    function delete_dropzone_temp_file() {
        $unique_id = $this->input->get_post('unique_id');
        $file_name = $unique_id . $this->input->get_post('file_name');
        $where_clause = array('unique_id' => $unique_id, 'image' => $file_name);
        $result = $this->Misc_Model->DeleteRecordDropZoneJs('tb_temp_images_upload', $where_clause);
        $where_clause = array('image' => $file_name);
        $result_member = $this->Misc_Model->DeleteRecordDropZoneJs('tb_member_images', $where_clause);
        if ($result || $result_member) {
            // delete file from directory
            $file_path = 'uploads/temp_images/' . $file_name;
            delete_file_from_directory($file_path);
            $this->_response(false, "Record deleted successfully!");
        } else if ($result_member) {
            // delete file from directory
            $file_path = 'uploads/member_images/id_proofs/' . $file_name;
            delete_file_from_directory($file_path);
            $file_path = 'uploads/member_images/profile/' . $file_name;
            delete_file_from_directory($file_path);
            $this->_response(false, "Record deleted successfully!");
        }
        $this->_response(true, "Problem while deleting record.");
    }

    function get_countries() {
        return GetCountriesOption($selected_country_id);
    }

    function get_states() {
        $country_id = $this->input->post('country_id');
        $selected_state_id = $this->input->post('state_id');
        $state_options = GetStatesOption($country_id, $selected_state_id);
        echo json_encode(array('error' => 0, 'options' => $state_options));
        die();
    }

    function get_cities() {
        $state_id = $this->input->post('state_id');
        $selected_city_id = $this->input->post('city_id');
        $city_options = GetCityOptions($state_id, $selected_city_id);
        echo json_encode(array('error' => 0, 'options' => $city_options));
        die();
    }

    function modal_language() {
        $this->isAjax();
        $language_id = $this->input->post('language_id');
        $member_id = $this->input->post('member_id');
        $language_data = $this->Members_Model->get_language($language_id);
        $data['language_data'] = $language_data;
        $data['member_id'] = $member_id;
        $html = $this->load->view('admin/misc/add_language', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_language() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('language_id');
            $member_id = $this->input->post('member_id');
            $this->form_validation->set_rules('language_name', 'Language name', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['language_name'] = $this->input->post('language_name');
                $data['language_level'] = $this->input->post('language_level');
                $data['member_id'] = $member_id;
                $data['is_active'] = $this->input->post('is_active') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                }
                if ($edit_id > 0) {
                    $this->Members_Model->update_language('language_id', $edit_id, $data);
                    $this->_response(false, "Changes saved successfully!");
                } else {
                    $result = $this->Members_Model->add_language($data);
                    $this->_response(false, "Language added successfully!");
                }
                $this->_response(true, "Error while updating data!");
            }
        } else {
            redirect(base_url('admin/admin_dashboard'));
        }
    }

}
