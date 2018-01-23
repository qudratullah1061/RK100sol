<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Companions extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/members_model', 'Members_Model');
        $this->load->model('admin/misc_model', 'Misc_Model');
    }

    //Main dashboard index function
    public function index() {
        $this->selected_tab = 'companion';
        $this->selected_child_tab = 'view';
        $this->load->view('admin/companions/view_companions');
    }

    public function add_companion() {
        $this->selected_tab = 'companion';
        $this->selected_child_tab = 'add';
        $data['country_options'] = GetCountriesOption();
        $data['categories'] = GetAllCategories();
        $this->load->view('admin/companions/add_companion', $data);
    }

    public function upload_images() {
        $unique_id = $this->input->post('file_upload_unique_id');
        $image_type = $this->input->post('image_type');
        $result = $this->upload_temp_image($_FILES, $unique_id, $image_type);
        if ($result == 'success') {
            $this->_response(true, 'File uploaded successfully!');
        }
    }

    function chk_member_username_exist($email, $exclude_id) {
        $result = is_member_username_exist($email, $exclude_id);
        if ($result) {
            $this->form_validation->set_message('chk_member_username_exist', 'The %s already exist. Please choose other username!');
            return false;
        }
        return true;
    }

    function chk_member_email_exist($email, $exclude_id) {
        $result = is_member_email_exist($email, $exclude_id);
        if ($result) {
            $this->form_validation->set_message('chk_member_email_exist', 'The %s already exist. Please choose other email!');
            return false;
        }
        return true;
    }

    function AddUpdateMemberCategories($member_categories, $member_id) {
        $this->Members_Model->AddUpdateMemberCategories($member_categories, $member_id);
    }

    public function add_companion_user() {
        $this->isAjax();

        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('member_id') > 0 ? $this->input->post('member_id') : 0;
            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('username', 'Username', 'required|trim|strip_tags|xss_clean|callback_chk_member_username_exist[' . $edit_id . ']');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|strip_tags|xss_clean|callback_chk_member_email_exist[' . $edit_id . ']');
            if (!$edit_id || ($this->input->post('password') != "" || $this->input->post('confirm_password') != "")) {
                $this->form_validation->set_rules('password', 'Password', 'required|trim|strip_tags|xss_clean');
                $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|strip_tags|xss_clean|matches[password]');
            }
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'required|trim|strip_tags|xss_clean');
//            $this->form_validation->set_rules('gender', 'Gender', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('date_of_birth', 'Date Of Birth', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('location', 'Location', 'required|trim|strip_tags|xss_clean');
//            $this->form_validation->set_rules('zipcode', 'Zip Code', 'required|trim|strip_tags|xss_clean');
//            $this->form_validation->set_rules('country', 'Country', 'required|trim|strip_tags|xss_clean');
//            $this->form_validation->set_rules('state', 'State', 'required|trim|strip_tags|xss_clean');
//            $this->form_validation->set_rules('city', 'City', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $geoCodesData = getGeoCodes($this->input->post('location'));
                $data['first_name'] = $this->input->post('first_name');
                $data['last_name'] = $this->input->post('last_name');
                $data['username'] = $this->input->post('username');
                $data['email'] = $this->input->post('email');
                if ($this->input->post('password') != "") {
                    $data['password'] = md5($this->input->post('password'));
                }
                $data['phone_number'] = $this->input->post('phone_number');
                $data['gender'] = $this->input->post('gender');
                $data['date_of_birth'] = $this->input->post('date_of_birth');
                $data['location'] = $this->input->post('location');
                $data['zipcode'] = $this->input->post('zipcode');
                $data['country'] = $geoCodesData['country_long'];
                $data['state'] = $geoCodesData['state_long'];
                $data['city'] = $geoCodesData['city_long'];
                $data['latitude'] = $geoCodesData['latitude'];
                $data['longitude'] = $geoCodesData['longitude'];
                $data['about_me'] = $this->input->post('about_me');
                $data['other_interest'] = $this->input->post('other_interest');
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $this->session->userdata('admin_id');
                if ($edit_id > 0) {
                    // unset created on
                    $data['status'] = $this->input->post('status');
                    unset($data['created_on']);
                    unset($data['created_by']);
                    // receive social links
                    $data['facebook'] = $this->input->post('facebook');
                    $data['twitter'] = $this->input->post('twitter');
                    $data['linkedin'] = $this->input->post('linkedin');
                    $data['instagram'] = $this->input->post('instagram');
                    $data['youtube'] = $this->input->post('youtube');
                    $data['gmail'] = $this->input->post('gmail');
                    $data['pinterest'] = $this->input->post('pinterest');
                    $data['skype'] = $this->input->post('skype');
                }

                $result = false;
                if ($edit_id > 0) {
                    $member_info = $this->Members_Model->get_member_by_id($edit_id);
                    if ($member_info['status'] != $data['status']) {
                        //status changed of user.
                        $member_email = $member_info['email'];
                        $member_email_v_code = $data['email_verification_code'];
                        $macros_data['$$$FIRST_NAME$$$'] = $data['first_name'];
                        if ($data['status'] == "active") {
                            // account activated
                            $email_template_info = get_email_template('member_activated', $macros_data);
                            if ($email_template_info) {
                                sendEmail($member_email, $email_template_info['template_subject'], $email_template_info['template_body']);
                            }
                        } elseif ($data['status'] == "pending") {
                            // account pending
                            $email_template_info = get_email_template('member_pending', $macros_data);
                            if ($email_template_info) {
                                sendEmail($member_email, $email_template_info['template_subject'], $email_template_info['template_body']);
                            }
                        } elseif ($data['status'] == "suspended") {
                            // account suspended
                            $email_template_info = get_email_template('member_suspended', $macros_data);
                            if ($email_template_info) {
                                sendEmail($member_email, $email_template_info['template_subject'], $email_template_info['template_body']);
                            }
                        }
                    }
                    $this->Members_Model->update_member($edit_id, $data);
                    $result = true;
                } else {
                    $data['member_type'] = 2;
                    // for admin only.
                    $data['is_email_verified'] = 1;
                    $data['subscription_date'] = date('Y-m-d H:i:s');
                    $data['end_subscription_date'] = date('Y-m-d H:i:s', strtotime("+1 month"));
                    // for admin only ends here.
                    $edit_id = $result = $this->Members_Model->add_member($data);
                    // update unique id
                    $unique_id_update_data['member_unique_code'] = "C-" . date("Ymd") . $edit_id;
                    $this->Members_Model->update_member($edit_id, $unique_id_update_data);
                    $result = true;
                }
                // upload id proof images , add call
                if (isset($_FILES['id_proofs']['name']) && $_FILES['id_proofs']['name'] != "" && $edit_id > 0) {
                    $id_proofs = reArrayFiles($_FILES['id_proofs']);
                    $f_upload_dir = $this->config->item('root_path') . 'uploads/member_images/id_proofs/';
                    foreach ($id_proofs as $id_proof) {
                        $thumb_options[0] = array('width' => 50, 'height' => 50, 'prefix' => 'small_');
                        $thumb_options[1] = array('width' => 150, 'height' => 150, 'prefix' => 'medium_');
                        $thumb_options[2] = array('width' => 400, 'height' => 400, 'prefix' => 'large_');
                        $file_name = basename($id_proof['name']);
                        $u_file_name = time() . $file_name;
                        $f_file_path = $f_upload_dir . '/' . $u_file_name;
                        move_uploaded_file($id_proof['tmp_name'], $f_file_path);
                        CreateThumbnail($f_file_path, $f_upload_dir, $thumb_options);
                        // insert in database as well.
                        $image_data = array('member_id' => $edit_id, 'image_type' => 'id_proof', 'image' => $u_file_name, 'image_path' => str_replace($this->config->item('root_path'), "", $f_upload_dir));
                        $this->db->insert('tb_member_images', $image_data);
                    }
                }
                // upload profile images , add call
                if (isset($_FILES['profile_images']['name']) && $_FILES['profile_images']['name'] != "" && $edit_id > 0) {
                    $images = reArrayFiles($_FILES['profile_images']);
                    $f_upload_dir = $this->config->item('root_path') . 'uploads/member_images/profile/';
                    $is_profile_image = 1;
                    foreach ($images as $img) {
                        $thumb_options[0] = array('width' => 50, 'height' => 50, 'prefix' => 'small_');
                        $thumb_options[1] = array('width' => 150, 'height' => 150, 'prefix' => 'medium_');
                        $thumb_options[2] = array('width' => 400, 'height' => 400, 'prefix' => 'large_');
                        $thumb_options[3] = array('width' => 700, 'height' => 700, 'prefix' => 'Xlarge_');
                        $file_name = basename($img['name']);
                        $u_file_name = time() . $file_name;
                        $f_file_path = $f_upload_dir . '/' . $u_file_name;
                        move_uploaded_file($img['tmp_name'], $f_file_path);
                        CreateThumbnail($f_file_path, $f_upload_dir, $thumb_options, TRUE);
                        // insert in database as well.
                        $image_data = array('member_id' => $edit_id, 'image_type' => 'profile', 'is_profile_image' => $is_profile_image, 'image' => $u_file_name, 'image_path' => str_replace($this->config->item('root_path'), "", $f_upload_dir));
                        $this->db->insert('tb_member_images', $image_data);
                        $is_profile_image = 0;
                    }
                }

                // add user categories.
                $categories = $this->input->post('categories');
                $call_type = $this->input->post('call_type');
                if ($categories && $call_type == 'add') {
                    $this->AddUpdateMemberCategories($categories, $edit_id);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

    function update_member_categories() {
        $this->isAjax();
        $member_id = $this->input->post('member_id');
        $categories = $this->input->post('categories');
        $this->AddUpdateMemberCategories($categories, $member_id);
        $this->_response(false, "Changes saved successfully!");
    }

    public function get_companion_users() {
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
        $cond = ' `tb_members`.member_type = 2 ';
        if ($this->input->post('username')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " `tb_members`.username '%" . $this->input->post('username') . "%'";
        }
        if ($this->input->post('first_name')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " `tb_members`.first_name LIKE  '%" . $this->input->post('first_name') . "%'";
        }
        if ($this->input->post('last_name')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " `tb_members`.last_name LIKE  '%" . $this->input->post('last_name') . "%'";
        }
        if ($this->input->post('email')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " `tb_members`.email LIKE  '%" . $this->input->post('email') . "%'";
        }
        if ($this->input->post('updated_on')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " `tb_members`.updated_on LIKE  '%" . $this->input->post('updated_on') . "%'";
        }

        $colmnsArry = array('', '`tb_members`.`username`', '`tb_members`.`first_name`', '`tb_members`.`last_name`', '`tb_members`.`email`', '`tb_members`.`updated_on`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }
        $companion_members = $this->Members_Model->getMembers($cond, $offset, $this->page_limit, $sort_by);
        $count = $companion_members['total'];
        if ($count > 0) {
            foreach ($companion_members['records'] as $result) {
                $records["data"][] = array(
                    '<img alt="Profile Image" class="img-circle" src="' . base_url($result['image_path'] . 'small_' . $result['image']) . '">',
                    $result['username'],
                    $result['first_name'],
                    $result['last_name'],
                    $result['email'],
                    $result['updated_on'],
                    '<a class="btn btn-xs default btn-editable" href="' . (base_url('admin/companions/get_companion_profile/' . $result['member_id'])) . '">Edit</a> <a href="javascript:CommonFunctions.Delete(' . $result['member_id'] . ', \'tb_members\' , \'member_id\' , \'Companion Member and all data associated with this member will be permanently deleted without further warning. Do you really want to delete this member?\')" class="btn btn-xs default btn-editable">Delete</a> '
                );
            }
        }
        $records["draw"] = $sEcho;
        $records["recordsTotal"] = $count;
        $records["recordsFiltered"] = $count;
        $records["query"] = $companion_members['query'];
        echo json_encode($records);
        exit();
    }

    public function get_companion_profile($member_id) {
//        if (!$user_id || ($user_id == 1 && $this->admin_info['admin_id'] != 1)) {
//            redirect(base_url('admin/dashboard'));
//        }
        $this->selected_tab = 'companion';
        $this->selected_child_tab = 'view';
        $member_info = $this->Members_Model->get_member_by_id($member_id);
        $data['member_profile_pics'] = $this->Members_Model->get_member_images_by_type(array('image_type' => 'profile', 'member_id' => $member_id));
        $data['member_id_proofs'] = $this->Members_Model->get_member_images_by_type(array('image_type' => 'id_proof', 'member_id' => $member_id));
        if ($member_info) {
            $data['member_info'] = $member_info;
            $data['member_images'] = $member_info;
            $data['country_options'] = GetCountriesOption($member_info['country']);
            $data['state_options'] = GetStatesOption($member_info['country'], $member_info['state']);
            $data['city_options'] = GetCityOptions($member_info['state'], $member_info['city']);
            $data['categories'] = GetAllCategories();
            $data['selected_categories'] = $this->Members_Model->get_all_selected_categories($member_id);
            $data['portfolios'] = $this->Members_Model->get_member_portfolio($member_id);
            $data['language_data'] = $this->Members_Model->get_member_languages($member_id);
            $data['degrees']       = $this->Members_Model->get_member_degrees($member_id);
            $data['experiences']   = $this->Members_Model->get_member_experiences($member_id);
            $data['certifications'] = $this->Members_Model->get_member_certification($member_id);
            $this->load->view('admin/companions/view_companion_profile', $data);
        } else {
            redirect(base_url('admin/companions'));
        }
    }

    function modal_portfolio() {
        $this->isAjax();
        $portfolio_id = $this->input->post('portfolio_id');
        $member_id = $this->input->post('member_id');
        $portfolio_data = $this->Misc_Model->get_portfolio($portfolio_id);
        $data['portfolio_data'] = $portfolio_data;
        $data['member_id'] = $member_id;
        $data['country_options'] = GetCountriesOption((isset($data['portfolio_data']->country) ? $data['portfolio_data']->country : ''));
        $data['state_options'] = GetStatesOption((isset($data['portfolio_data']->country) ? $data['portfolio_data']->country : ''), (isset($data['portfolio_data']->state) ? $data['portfolio_data']->state : ''));
        $data['city_options'] = GetCityOptions((isset($data['portfolio_data']->state) ? $data['portfolio_data']->state : ''), (isset($data['portfolio_data']->city) ? $data['portfolio_data']->city : ''));
        $html = $this->load->view('admin/companions/add_portfolio', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_portfolio() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('portfolio_id');
            $member_id = $this->input->post('member_id');
            $this->form_validation->set_rules('portfolio_title', 'Portfolio Title', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('portfolio_type', 'Portfolio Type', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('state', 'State', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'required|trim|strip_tags|xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['portfolio_title'] = $this->input->post('portfolio_title');
                $data['portfolio_type'] = $this->input->post('portfolio_type');
                $data['country'] = $this->input->post('country');
                $data['state'] = $this->input->post('state');
                $data['city'] = $this->input->post('city');
                $data['is_active'] = $this->input->post('is_active') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $this->session->userdata('admin_id');
                $data['member_id'] = $member_id;
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }
                $result = false;
                if (isset($_FILES['portfolio_image']['name']) && $_FILES['portfolio_image']['name'] != "") {
                    //$id_proofs = reArrayFiles($_FILES['id_proofs']);
                    $portfolio_images = $_FILES['portfolio_image'];
                    $f_upload_dir = $this->config->item('root_path') . 'uploads/member_images/portfolio/';
                    $thumb_options[0] = array('width' => 50, 'height' => 50, 'prefix' => 'small_');
                    $thumb_options[1] = array('width' => 194, 'height' => 194, 'prefix' => 'medium_');
                    $thumb_options[2] = array('width' => 400, 'height' => 400, 'prefix' => 'large_');
                    $file_name = basename($portfolio_images['name']);
                    $u_file_name = time() . $file_name;
                    $f_file_path = $f_upload_dir . '/' . $u_file_name;
                    move_uploaded_file($portfolio_images['tmp_name'], $f_file_path);
                    CreateThumbnail($f_file_path, $f_upload_dir, $thumb_options);
                    // insert in database as well.
                    $data['portfolio_image_path'] = 'uploads/member_images/portfolio/';
                    $data['portfolio_image'] = $u_file_name;
                }

                if ($edit_id > 0) {
                    $this->Misc_Model->update_portfolio('portfolio_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Misc_Model->add_portfolio($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/companions/get_companion_profile'));
        }
    }
    
    
    function modal_degree() {
        $this->isAjax();
        $member_degree_id = $this->input->post('member_degree_id');
        $member_id = $this->input->post('member_id');
        $data['member_id'] = $member_id;
        $degree_data = $this->Members_Model->get_degree($member_degree_id);
        $data['degree_data'] = $degree_data;
        $html = $this->load->view('admin/companions/add_degree', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_degree() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('member_degree_id');
            $member_id = $this->input->post('member_id');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('degree_name', 'Degree Name', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('start_date', 'Start Date', 'required|trim|strip_tags|xss_clean');
           

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['title'] = $this->input->post('title');
                $data['degree_name'] = $this->input->post('degree_name');
                
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date']   = $this->input->post('present') == null ? $this->input->post('end_date') : 'Present';
                $data['pub_status'] = $this->input->post('pub_status') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $data['member_id'] = $this->session->userdata('admin_id');
                $data['member_id'] = $member_id;
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }
                $result = false;
                

                if ($edit_id > 0) {
                    $this->Members_Model->update_degree('member_degree_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Members_Model->add_degree($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/companions/get_companion_profile'));
        }
    }
    
    
    
     function modal_experience() {
        $this->isAjax();
        $member_experience_id = $this->input->post('member_experience_id');
        $member_id = $this->input->post('member_id');
        $data['member_id'] = $member_id;
        $experience_data = $this->Members_Model->get_experience($member_experience_id);
        $data['experience_data'] = $experience_data;
        $html = $this->load->view('admin/companions/add_experience', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_experience() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('member_experience_id');
            $member_id = $this->input->post('member_id');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('position', 'Position', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('start_date', 'Start Date', 'required|trim|strip_tags|xss_clean');
           

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['title'] = $this->input->post('title');
                $data['position'] = $this->input->post('position');
                $data['start_date'] = $this->input->post('start_date');
                
                $data['end_date']   = $this->input->post('present') == null ? $this->input->post('end_date') : 'Present';
                $data['pub_status'] = $this->input->post('pub_status') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by']  = $this->session->userdata('admin_id');
                $data['member_id'] = $member_id;
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }
                $result = false;
                

                if ($edit_id > 0) {
                    $this->Members_Model->update_experience('member_experience_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Members_Model->add_experience($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/companions/get_companion_profile'));
        }
    }
    
    
    
    function modal_certification() {
        $this->isAjax();
        $member_certification_id = $this->input->post('member_certification_id');
        $member_id = $this->input->post('member_id');
        $data['member_id'] = $member_id;
        $certification_data = $this->Members_Model->get_certification($member_certification_id);
        $data['certification_data'] = $certification_data;
        $html = $this->load->view('admin/companions/add_certification', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_certification() {
        $this->isAjax();
        if ($this->input->post()) {
            $data = array();
            $edit_id = $this->input->post('member_certification_id');
            $member_id = $this->input->post('member_id');
            $this->form_validation->set_rules('title', 'Title', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('description', 'Position', 'required|trim|strip_tags|xss_clean');
            
           

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['title'] = $this->input->post('title');
                $data['description'] = $this->input->post('description');
                
                $data['type_of_certification'] = $this->input->post('type_of_certification');
                $data['year_issued'] = $this->input->post('year_issued');
                $data['issued_by'] = $this->input->post('issued_by');
                
                $data['pub_status'] = $this->input->post('pub_status') == null ? 0 : 1;
                $data['updated_on'] = $data['created_on'] = date("Y-m-d h:i:s");
                $data['updated_by'] = $data['created_by'] = $this->session->userdata('admin_id');
                $data['member_id'] = $member_id;
                if (isset($_FILES['certification_image']['name']) && $_FILES['certification_image']['name'] != "") {
                    //$id_proofs = reArrayFiles($_FILES['id_proofs']);
                    $certification_images = $_FILES['certification_image'];
                    $f_upload_dir = $this->config->item('root_path') . 'uploads/member_images/certification/';
                    $thumb_options[0] = array('width' => 50, 'height' => 50, 'prefix' => 'small_');
                    $thumb_options[1] = array('width' => 194, 'height' => 194, 'prefix' => 'medium_');
                    $thumb_options[2] = array('width' => 400, 'height' => 400, 'prefix' => 'large_');
                    $file_name = basename($certification_images['name']);
                    $u_file_name = time() . $file_name;
                    $f_file_path = $f_upload_dir . '/' . $u_file_name;
                    move_uploaded_file($certification_images['tmp_name'], $f_file_path);
                    CreateThumbnail($f_file_path, $f_upload_dir, $thumb_options);
                    // insert in database as well.
                    $data['certification_image_path'] = 'uploads/member_images/certification/';
                    $data['certification_image'] = $u_file_name;
                }
                if ($edit_id > 0) {
                    // unset created on
                    unset($data['created_on']);
                    unset($data['created_by']);
                }
                $result = false;
                

                if ($edit_id > 0) {
                    $this->Members_Model->update_certification('member_certification_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Members_Model->add_certification($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/companions/get_companion_profile'));
        }
    }

}
