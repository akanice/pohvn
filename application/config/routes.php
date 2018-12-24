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
$route['default_controller']							= "home";
$route['404_override']									= 'override_404';
$route['seo/sitemap\.xml']								= "seo/sitemap";
//$route['translate_uri_dashes']						= FALSE;

// Admin Control Panel
$route['admin/login']										=	'admin/main/loginAdmin';
$route['admin/logout']									=	'admin/main/logoutAdmin';
$route['admin']												=	'admin/admin/index';
$route['admin/admins/(:num)']						= 	'admin/admins/index/$1';
$route['admin/users/(:num)']							=	'admin/users/index/$1';
$route['admin/news/(:num)']             				=	'admin/news/index/$1';
$route['admin/newscategory/(:num)']			=	'admin/newscategory/index/$1';
$route['admin/pages/(:num)']							=	'admin/pages/index/$1';
$route['admin/options/(:num)']          				=	'admin/options/index/$1';
$route['admin/sliders/(:num)']          				=	'admin/sliders/index/$1';
$route['admin/faqs/(:num)']							=	'admin/faqs/index/$1';
$route['admin/tag/(:num)']								=	'admin/tag/index/$1';
$route['admin/widget/(:num)']						=	'admin/widget/$1';

$route['tim-kiem']											=	"home/tourSearch";
$route['logout']												=	"home/logout";

// Front-end routes
$route['category'] 											= 	"news/index";
$route['category/(:any)/(:any)/(:num)']			=	"news/category/$1/$2/$3";

$route['page/(:any)'] 										= 	"home/page";

$route['(:any)'] 												= 	"home/news";