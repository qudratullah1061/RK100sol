<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
$route['default_controller'] = 'Home';
$route['404_override'] = 'Home/not_found';
$route['admin'] = 'admin/admin_auth';
$route['fitness'] = 'misc/fitness';
$route['tourism'] = 'misc/tourism';
$route['social-occasion'] = 'misc/social_occasion';
$route['fashion'] = 'misc/fashion';
$route['hosting'] = 'misc/hosting';
$route['event-planning'] = 'misc/event_planning';
$route['blogs/(:any)'] = 'blogs/blog_detail/$1';
$route['about'] = 'misc/about';
$route['contact'] = 'misc/contact';
$route['login'] = 'auth/login';
$route['register'] = 'auth/register';
$route['how-it-works'] = 'misc/how_it_works';
$route['earn-extra-cash'] = 'misc/earn_extra_cash';
$route['secure-community'] = 'misc/secure_community';
$route['find-perfect-buddy'] = 'misc/find_perfect_buddy';
$route['rewards-hosting-traveling'] = 'misc/rewards_hosting_traveling';
$route['terms'] = 'misc/terms';
$route['translate_uri_dashes'] = FALSE;
