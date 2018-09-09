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
$route['default_controller'] = 'Front_article';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['assets/(:any)'] = 'assets/$1';

/* Admin Routes */
$route['admin'] = 'Admin_main/index'; // main admin route
// Admin user main functions
$route['admin/login'] = 'Admin_main/login';
$route['admin/register'] = 'Admin_main/register';
$route['admin/forgot'] = 'Admin_main/forgot';
$route['admin/reset_password/token/(:any)'] = 'Admin_main/reset_password/$1';
$route['admin/complete/token/(:any)'] = 'Admin_main/complete/$1';
$route['admin/approve-user'] = 'Admin_main/approve_request';
$route['admin/logout'] = 'Admin_main/logout';
$route['admin/profilul-meu'] = 'Admin_main/get_user_profile';
// Companies routes
$route['admin/companii'] = 'Admin_company/read';
$route['admin/companii/(:any)'] = 'Admin_company/read/$1';
$route['admin/adaugare-companie'] = 'Admin_company/create';
$route['admin/editare-companie/(:any)'] = 'Admin_company/update/$1';
$route['admin/stergere-companie'] = 'Admin_company/delete';
// Students routes
$route['admin/studenti'] = 'Admin_student/read';
$route['admin/studenti/(:any)'] = 'Admin_student/read/$1';
$route['admin/adaugare-student'] = 'Admin_student/create';
$route['admin/editare-student/(:any)'] = 'Admin_student/update/$1';
$route['admin/stergere-student'] = 'Admin_student/delete';
$route['admin/studenti-activi'] = 'Admin_student/get_students_activity';
// Articles routes
$route['admin/articole'] = 'Admin_article/read';
$route['admin/articole/(:any)'] = 'Admin_article/read/$1';
$route['admin/adaugare-articol'] = 'Admin_article/create';
$route['admin/editare-articol/(:any)'] = 'Admin_article/update/$1';
$route['admin/stergere-articol'] = 'Admin_article/delete';
$route['admin/top-articole'] = 'Admin_article/get_top_articles'; // ?
$route['admin/upload-image'] = 'Admin_article/upload_image';
$route['admin/delete-image'] = 'Admin_article/delete_image';
$route['admin/upload-file'] = 'Admin_article/upload_file';
$route['admin/delete-file'] = 'Admin_article/delete_file';
$route['admin/categorii-articole'] = 'Admin_article/read_categories';
$route['admin/adaugare-categorie'] = 'Admin_article/create_category';
$route['admin/editare-categorie/(:any)'] = 'Admin_article/update_category/$1';
$route['admin/stergere-categorie'] = 'Admin_article/delete_category';
$route['admin/taguri-articole'] = 'Admin_article/read_tags';
$route['admin/adaugare-tag'] = 'Admin_article/create_tag';
$route['admin/editare-tag/(:any)'] = 'Admin_article/update_tag/$1';
$route['admin/stergere-tag'] = 'Admin_article/delete_tag';
// Admin search
$route['admin/cautare/(:any)'] = 'Admin_search/read/$1';

/* Front Routes */
$route['home'] = 'Front_article/index';
$route['login'] = 'Front_main/login';
$route['register'] = 'Front_main/register';
$route['forgot'] = 'Front_main/forgot';
$route['reset_password/token/(:any)'] = 'Front_main/reset_password/$1';
$route['complete/token/(:any)'] = 'Front_main/complete/$1';
$route['logout'] = 'Front_main/logout';
$route['my-profile'] = 'Front_main/get_user_profile';
$route['articol/(:any)'] = 'Front_article/get_article/$1';
$route['trending'] = 'Front_article/get_trending_articles';
$route['companii'] = 'Front_company/get_companies';
$route['companii/(:any)'] = 'Front_article/get_articles_by_company/$1';
$route['studenti-activi'] = 'Front_student/get_active_students';
$route['adaugare-comentariu'] = 'Front_article/add_comment';
$route['editare-comentariu'] = 'Front_article/edit_comment';
$route['stergere-comentariu'] = 'Front_article/delete_comment';
$route['adaugare-review-comentariu'] = 'Front_article/review_comment';
$route['stergere-review-comentariu'] = 'Front_article/delete_review_comment';