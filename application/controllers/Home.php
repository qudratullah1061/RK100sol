<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

    var $selected_tab = 'home';

    function __construct() {
        parent::__construct();
        $this->layout = 'frontend/main';
        $this->load->model('admin/misc_model', 'Misc_Model');
        $this->load->model('admin/members_model', 'Members_model');
    }
    
    function test(){
        header('Access-Control-Allow-Origin: *');
        $json = '{
	"@context": "http://iiif.io/api/presentation/2/context.json",
	"@id": "http://cf22c384-f1c9-4430-9a61-788c996b5d59",
	"@type": "sc:Manifest",
	"label": "[Click to edit label]",
	"metadata": [],
	"description": [
		{
			"@value": "[Click to edit description]",
			"@language": "en"
		}
	],
	"license": "https://creativecommons.org/licenses/by/3.0/",
	"attribution": "[Click to edit attribution]",
	"sequences": [
		{
			"@id": "http://4e1301a3-34c3-424b-a8be-a2ca5afdd7d7",
			"@type": "sc:Sequence",
			"label": [
				{
					"@value": "Normal Sequence",
					"@language": "en"
				}
			],
			"canvases": [
				{
					"@id": "http://2fe872bf-b7b4-48b2-8c62-ede4e5d822c8",
					"@type": "sc:Canvas",
					"label": "Empty canvas",
					"height": 5064,
					"width": 4008,
					"images": [
						{
							"@context": "http://iiif.io/api/presentation/2/context.json",
							"@id": "http://924618b1-3292-4ec4-808d-9be6348ee75e",
							"@type": "oa:Annotation",
							"motivation": "sc:painting",
							"resource": {
								"@id": "https://bafdigital.iiifhosting.com//iiif/9a5e296eb64ee969e47c1df514d28c3aaabd6013c6b815547d595128dfc5476e/full/full/0/default.jpg",
								"@type": "dctypes:Image",
								"format": "image/jpeg",
								"service": {
									"@context": "http://iiif.io/api/image/2/context.json",
									"@id": "https://bafdigital.iiifhosting.com//iiif/9a5e296eb64ee969e47c1df514d28c3aaabd6013c6b815547d595128dfc5476e",
									"profile": [
										"http://iiif.io/api/image/2/level1.json",
										{
											"formats": [
												"jpg"
											],
											"qualities": [
												"native",
												"color",
												"gray"
											],
											"supports": [
												"regionByPct",
												"regionSquare",
												"sizeByForcedWh",
												"sizeByWh",
												"sizeAboveFull",
												"rotationBy90s",
												"mirroring"
											]
										}
									]
								},
								"height": 5064,
								"width": 4008
							},
							"on": "http://2fe872bf-b7b4-48b2-8c62-ede4e5d822c8"
						}
					],
					"related": ""
				}
			]
		}
	],
	"structures": []
}';
        $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output($json)
        ->_display();
        
        exit;
        
    }

    function index() {
        if($this->uri->segment(1)){
            redirect(base_url());
        }
        $this->selected_tab = 'home';
        $categories_data = $this->Misc_Model->get_all_categories();
        $gold_members = $this->Members_model->get_gold_members_for_homepage();
        $data['categories_data'] = $categories_data;
        $data['gold_members'] = $gold_members;
//        echo "<pre>";
//        print_r($gold_members);
//        exit;
        $this->load->view('frontend/home', $data);
    }

    function searchmember() {
        $cat_id = '';
        $sub_cat_id = '';
        $sub_cat_id_str = '';
        $category_ids = array();
        $sub_category_ids = array();
        if (isset($_GET['location']) && $_GET['location'] != '') {
            $categories_data = $this->Misc_Model->get_all_categories();
            $data['categories_data'] = $categories_data;
            $geo_codes = getGeoCodes($_GET['location']);
            if (count($geo_codes) > 0) {
                $loc = $_GET['location'];
                $radius = $_GET['radius'];
                if(isset($_GET['category_available'])){
                    $cat_available = $_GET['category_available'];
                }
                //Start Categories and Sub Categories
                if (isset($cat_available)) {
                    foreach ($cat_available as $sel_cat) {
                        $selected_cat = explode(':', $sel_cat);
                        $category_ids[] = $selected_cat[0];
                        $sub_category_ids[] = $selected_cat[1];
                        $sub_cat_id_str .= $selected_cat[1] . ',';
                    }
                    $unique_cat_ids = array_unique($category_ids);
                    $unique_sub_cat_ids = array_unique($sub_category_ids);
                    $cat_id = implode(',', $unique_cat_ids);
                    $sub_cat_id = rtrim($sub_cat_id_str, ',');
                }
                //End
                $lat = isset($geo_codes['latitude']) ? $geo_codes['latitude'] : "";
                $lon = isset($geo_codes['longitude']) ? $geo_codes['longitude'] : "";
                $nearby_members_id = '';
                $members_list = array();
                if ($radius > 0 && $lat != "" && $lon != "") {
                    $distance_miles = $radius / 1.609344; //M
                    $nearby_members = $this->Members_model->SearchNearByMembers($lat, $lon, $distance_miles);
                    if (count($nearby_members) > 0) {
                        $nearby_members_id = '';
                        foreach ($nearby_members as $nearby_ids) {
                            if ($nearby_members_id != '') {
                                $nearby_members_id .= ',';
                            }
                            $nearby_members_id .= $nearby_ids['member_id'];
                        }
                        $members_list = $this->Members_model->search_members($cat_id, $sub_cat_id, $geo_codes, $nearby_members_id);
                    }
                } else {
                    $members_list = $this->Members_model->search_members($cat_id, $sub_cat_id, $geo_codes, $nearby_members_id);
//                    $members_list = $this->Members_model->search_members($cat_available, $geo_codes, $nearby_members_id);
                }
            }
            $data['members_list'] = $members_list;
            $data['selected_cat_ids'] = isset($unique_cat_ids) ? $unique_cat_ids : array();
            $data['selected_sub_cat_ids'] = isset($unique_sub_cat_ids) ? $unique_sub_cat_ids : array();
            $this->load->view('frontend/member/search', $data);
        } else {
            redirect(base_url());
        }
    }

    function not_found() {
        $this->load->view('frontend/page404');
    }

}
