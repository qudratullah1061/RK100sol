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
  "@context" : "http://iiif.io/api/presentation/2/context.json",
  "@id" : "https://www.konsorts.com/home/test",
  "@type" : "sc:Manifest",
  "label" : "Test Label",
  "description" : "Description Here",
  "metadata" : [ {
    "label" : "Creator(s)",
    "value" : [ "Thomas Creswick, 1811â€“1869, British" ]
  }, {
    "label" : "Titles",
    "value" : [ "<span>View on the Hudson River</span>" ]
  }, {
    "label" : "Date",
    "value" : [ "ca. 1843" ]
  }, {
    "label" : "Medium",
    "value" : [ "<span>oil on mahogany</span>" ]
  }, {
    "label" : "Dimensions",
    "value" : [ "Support (PTG): 8 x 12 inches (20.3 x 30.5 cm)" ]
  }, {
    "label" : "Credit line",
    "value" : [ "Yale Center for British Art, Paul Mellon Fund" ]
  }, {
    "label" : "Institution",
    "value" : [ "Yale Center for British Art" ]
  }, {
    "label" : "Collection",
    "value" : [ "Paintings and Sculpture" ]
  }, {
    "label" : "Accession number",
    "value" : [ "B1986.7.2" ]
  } ],
  "logo" : "https://static.britishart.yale.edu/images/ycba_logo.jpg",
  "related" : [ {
    "@id" : "http://collections.britishart.yale.edu/vufind/Record/1665981",
    "label" : "catalog entry at the Yale Center for British Art",
    "format" : "text/html"
  } ],
  "seeAlso" : [ {
    "@id" : "https://manifests.britishart.yale.edu/lido/1273.xml",
    "format" : "text/xml",
    "profile" : "http://www.lido-schema.org/schema/v1.0/lido-v1.0.xsd"
  }, {
    "@id" : "http://collection.britishart.yale.edu/id/data/object/1273",
    "format" : "text/rdf+n3"
  } ],
  
  "sequences" : [
    {
      "@id" : "https://bafdigital.iiifhosting.com//iiif/b7fb2cec6a8fda26604e0c5f1440b7b6467c7b066237cf6e4e9a00383075143d/seq0.json",
      "@type" : "sc:Sequence",
      "label": "/iiif/b7fb2cec6a8fda26604e0c5f1440b7b6467c7b066237cf6e4e9a00383075143d - sequence 1 0",
      "canvases": [
        {
          "@id" : "https://bafdigital.iiifhosting.com//iiif/b7fb2cec6a8fda26604e0c5f1440b7b6467c7b066237cf6e4e9a00383075143d/can0.json",
          "@type" : "sc:Canvas",
          "label": "test Label1",
          "width" : 4080,
          "height" : 5064,
          "images": [
            {
              "@id" : "https://bafdigital.iiifhosting.com//iiif/b7fb2cec6a8fda26604e0c5f1440b7b6467c7b066237cf6e4e9a00383075143d/anot0.json",
              "@type": "oa:Annotation",
              "motivation": "sc:painting",
              "on": "https://bafdigital.iiifhosting.com//iiif/b7fb2cec6a8fda26604e0c5f1440b7b6467c7b066237cf6e4e9a00383075143d/can0.json",
              "resource": {
                "@id" : "https://bafdigital.iiifhosting.com//iiif/b7fb2cec6a8fda26604e0c5f1440b7b6467c7b066237cf6e4e9a00383075143d/full/full/0/native.jpg",
                "@type" : "dctypes:Image",
                "format" : "image/jpeg",
                "width" : 4080,
                "height" : 5064,
                "service" : {
                  "@context" : "http://iiif.io/api/image/2/context.json",
                  "@id" : "https://bafdigital.iiifhosting.com//iiif/b7fb2cec6a8fda26604e0c5f1440b7b6467c7b066237cf6e4e9a00383075143d",
                  "profile" : "http://iiif.io/api/image/2/level1.json"
                }
              }
            }
          ]
        },
        {
          "@id" : "https://bafdigital.iiifhosting.com//iiif/9a5e296eb64ee969e47c1df514d28c3aaabd6013c6b815547d595128dfc5476e/can0.json",
          "@type" : "sc:Canvas",
          "label": "Label 2",
          "width" : 4080,
          "height" : 5064,
          "images": [
            {
              "@id" : "https://bafdigital.iiifhosting.com//iiif/9a5e296eb64ee969e47c1df514d28c3aaabd6013c6b815547d595128dfc5476e/anot0.json",
              "@type": "oa:Annotation",
              "motivation": "sc:painting",
              "on": "https://bafdigital.iiifhosting.com//iiif/9a5e296eb64ee969e47c1df514d28c3aaabd6013c6b815547d595128dfc5476e/can0.json",
              "resource": {
                "@id" : "https://bafdigital.iiifhosting.com//iiif/9a5e296eb64ee969e47c1df514d28c3aaabd6013c6b815547d595128dfc5476e/full/full/0/native.jpg",
                "@type" : "dctypes:Image",
                "format" : "image/jpeg",
                "width" : 4080,
                "height" : 5064,
                "service" : {
                  "@context" : "http://iiif.io/api/image/2/context.json",
                  "@id" : "https://bafdigital.iiifhosting.com//iiif/9a5e296eb64ee969e47c1df514d28c3aaabd6013c6b815547d595128dfc5476e",
                  "profile" : "http://iiif.io/api/image/2/level1.json"
                }
              }
            }
          ]
        }
      ]
    }
  ]
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
