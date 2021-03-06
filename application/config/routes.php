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
$route['sitemap\.xml']									= "seo/sitemap";
//$route['translate_uri_dashes']						= FALSE;

// Admin Control Panel
$route['admin/login']										=	'admin/main/loginAdmin';
$route['admin/logout']									=	'admin/main/logoutAdmin';
$route['admin']												=	'admin/admin/index';
$route['admin/admins/(:num)']						= 	'admin/admins/index/$1';
$route['admin/users/(:num)']							=	'admin/users/index/$1';
$route['admin/news/(:num)']             				=	'admin/news/index/$1';
$route['admin/newscategory/setorder/(:num)'] = 'admin/newscategory/setorder/$1';
$route['admin/newscategory/(:num)']			=	'admin/newscategory/index/$1';
$route['admin/landingpage/(:num)']				=	'admin/landingpage/index/$1';
$route['admin/pages/(:num)']							=	'admin/pages/index/$1';
$route['admin/ladi/(:num)']								=	'admin/ladi/index/$1';
$route['admin/orders/(:num)']							=	'admin/orders/index/$1';
$route['admin/customers/(:num)']					=	'admin/customers/index/$1';
$route['admin/options/(:num)']          				=	'admin/options/index/$1';
$route['admin/urlredirect/(:num)']          			=	'admin/urlredirect/index/$1';
$route['admin/sliders/(:num)']          				=	'admin/sliders/index/$1';
$route['admin/faqs/(:num)']							=	'admin/faqs/index/$1';
$route['admin/tags/(:num)']							=	'admin/tags/index/$1';
$route['admin/profiles/(:num)']						=	'admin/profiles/index/$1';
$route['admin/widget/(:num)']						=	'admin/widget/$1';
$route['admin/access_denied']               		=	'admin/main/access_denied';

$route['admin/affiliate/statistic']               		=	'admin/affiliate/statistic';
$route['admin/affiliate/users']               		    =	'admin/affiliate/users';

$route['search']												=	"news/news_search";
$route['search/page/(:num)']							=	"news/news_search/$1";

// Landing page

// Front-end routes
$route['category'] 											= 	"news/cat_index";
$route['category/(:any)']									=	"news/category/$1";
$route['category/(:any)/(:num)']						=	"news/category/$1/$2";
$route['chuyen-muc/(:any)/(:any)']					=	"news/extend_cat/$1/$2";
$route['tags/(:any)']										=	"news/tagsSearch/$1";

$route['page/(:any)'] 										= 	"home/page";
$route['thanh-vien-lien-ket']							=	"user/main/affiliateUserInfo";
$route['dang-nhap']										=	"user/main/loginUser";
$route['dang-ky']											=	"user/main/signUpUser";
$route['dang-ky-thanh-cong']							=	"user/main/regSuccessfully";
$route['dang-xuat']											=	"user/main/logoutUser";
$route['(:any)'] 												= 	"news/index/$1";
