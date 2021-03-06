<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Promos extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->layout = 'admin/main';
        $this->load->model('admin/promos_model', 'Promos_Model');
        $this->load->model('admin/members_model', 'Members_Model');
    }

    function modal_promo()
    {
        $this->is_ajax();
        $promo_id = $this->input->post('promo_id');
        $promo_data = $this->Promos_Model->get_promo($promo_id);
        $data['promo_data'] = $promo_data;
        $html = $this->load->view('admin/promos/add_promo', $data, TRUE);
        echo json_encode(array('key' => true, 'value' => $html));
        die();
    }

    function add_update_promo()
    {
        $this->isAjax();
        if ($this->input->post()) {
            $cur_promo_code = $this->input->post('current_promo_code');
            if ($this->input->post('promo_code') != $cur_promo_code) {
                $is_unique = '|is_unique[tb_promos.promo_code]';
            } else {
                $is_unique = '';
            }
            $data = array();
            $edit_id = $this->input->post('promo_id');
            $this->form_validation->set_rules('promo_title', 'Promo Title', 'required|trim|strip_tags|xss_clean');
            $this->form_validation->set_rules('promo_code', 'Promo Code', 'required|trim|strip_tags|xss_clean' . $is_unique);

            if ($this->form_validation->run() == FALSE) {
                $this->_response(true, validation_errors());
            } else {
                $data = array();
                $data['promo_title'] = $this->input->post('promo_title');
                $data['promo_code'] = $this->input->post('promo_code');
                $data['promo_subscription_discount'] = $this->input->post('promo_subscription_discount');
                $data['promo_valid_for'] = $this->input->post('promo_valid_for');
                $data['promo_sub_dis_value'] = $this->input->post('promo_sub_dis_value');
                $data['start_date'] = $this->input->post('start_date');
                $data['end_date'] = $this->input->post('end_date');
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
                    $this->Promos_Model->update_promo('promo_id', $edit_id, $data);
                    $result = true;
                } else {
                    $result = $this->Promos_Model->add_promo($data);
                }
                if ($result) {
                    $this->_response(false, "Changes saved successfully!");
                }
            }
        } else {
            redirect(base_url('admin/admin_auth'));
        }
    }

    function view_promos()
    {
        $this->selected_tab = 'promos';
        $this->selected_child_tab = 'view_promos';
        $this->load->view('admin/promos/view_promos');
    }

    function get_promos()
    {
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
        if ($this->input->post('promo_title')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " promos.promo_title LIKE '%" . $this->input->post('promo_title') . "%'";
        }
        if ($this->input->post('promo_subscription_discount') != '') {
            $cond .= ($cond != '' ? ' AND ' : '') . (" promos.promo_subscription_discount = " . $this->input->post('promo_subscription_discount'));
        }
        if ($this->input->post('promo_valid_for') != '') {
            $cond .= ($cond != '' ? ' AND ' : '') . (" promos.promo_valid_for = " . $this->input->post('promo_valid_for'));
        }
        if ($this->input->post('start_date')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " promos.start_date LIKE  '%" . $this->input->post('start_date') . "%'";
        }
        if ($this->input->post('end_date')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " promos.end_date LIKE  '%" . $this->input->post('end_date') . "%'";
        }
        if ($this->input->post('promo_code')) {
            $cond .= ($cond != '' ? ' AND ' : '') . " promos.promo_code LIKE  '%" . $this->input->post('promo_code') . "%'";
        }
        if ($this->input->post('is_active') != "") {
            $cond .= ($cond != '' ? ' AND ' : '') . (" promos.is_active = " . $this->input->post('is_active'));
        }

        $colmnsArry = array('`promos`.`promo_title`', '`promos`.`start_date`', '`promos`.`end_date`', '`promos`.`promo_code`', '`promos`.`is_active`');
        if ($this->input->post('order')) {
            $order = $this->input->post('order');
            if (isset($order[0]['column'])) {
                $sort_by = " ORDER BY " . $colmnsArry[$order[0]['column']] . " " . $order[0]['dir'];
            }
        }

        $admins = $this->Promos_Model->getPromos($cond, $offset, $this->page_limit, $sort_by);
        $count = $admins['total'];
        if ($count > 0) {
            foreach ($admins['records'] as $result) {
                $used_promo_code = CountPromoCode($result['promo_code']);
                if ($result['promo_subscription_discount'] == '0') {
                    $result['promo_subscription_discount'] = 'Subscription';
                } else {
                    $result['promo_subscription_discount'] = 'Discount';
                }

                if ($result['promo_valid_for'] == '1') {
                    $result['promo_valid_for'] = 'Guest';
                } else {
                    $result['promo_valid_for'] = 'Companion';
                }
                $active_html = '<div class="md-checkbox-inline">
                                    <div class="md-checkbox">
                                        <input type="checkbox" disabled="disabled" id="checkbox' . $result['promo_id'] . '" ' . ($result['is_active'] ? "checked='checked'" : "") . ' class="md-check">
                                        <label for="checkbox' . $result['promo_id'] . '">
                                            <span></span>
                                            <span class="check"></span>
                                            <span class="box"></span>
                                        </label>
                                    </div>
                                </div>';
                $records["data"][] = array(
                    $result['promo_title'],
                    $result['promo_subscription_discount'],
                    $result['promo_valid_for'],
                    $result['start_date'],
                    $result['end_date'],
                    $result['promo_code'],
                    $used_promo_code,
                    $active_html,
                    '<a class="btn btn-xs default btn-editable" onclick="Promos.modal_add_promo(' . $result['promo_id'] . ')">Edit</a> <a class="btn btn-xs default btn-editable" onclick="CommonFunctions.Delete(' . $result["promo_id"] . ' , \'tb_promos\' , \'promo_id\' , \'Promo will be permanently deleted without further warning. Do you really want to delete this Promo?\');">Delete</i></a> '
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

    function submit_promo()
    {
        $promo_code = $this->input->post('promo_code');
        $member_id = $this->input->post('member_id');
        $promo_code_info = false;
        if ($promo_code != "") {
            // validate promo code.
            $promo_code_info = validatePromoCode($promo_code,2);
            if ($promo_code_info) {
                // check whether user already used that promo code or not.
                $is_used = IsPromoCodeAlreadyUsed($promo_code, $member_id);
                if ($is_used) {
                    $this->_response(true, "You have already used this promo code.");
                } else {
                    // update promo according to type.
                    if ($promo_code_info['promo_type'] == "sub" && $promo_code_info['value'] > 0) {
                        // add days
                        $member_info = $this->Members_Model->get_member_by_id($member_id);
                        $subscription_date = $member_info['subscription_date'];
                        $data['end_subscription_date'] = date('Y-m-d', strtotime($member_info['end_subscription_date'] . ' +' . $promo_code_info['value'] . ' days'));
                        $this->Members_Model->update_member($member_id, $data);
                        // insert record in database for used promo as well.
                        $promo_used_record_data = array("promo_code" => $promo_code, "member_id" => $member_id, "created_on" => date("Y-m-d H:i:s"), "created_by" => $member_id);
                        $this->Members_Model->add_promo_used_record($promo_used_record_data);
                        $this->_response(false, "Promo code applied successfully.");
                    }
                    $this->_response(true, "Promo code is not valid.");
                }
            }
            $this->_response(true, "Promo code is not valid.");
        }
        $this->_response(true, "Please enter promo code.");
    }

}
