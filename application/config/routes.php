<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = "dashboards/index";
$route['signin'] = "dashboards/signin";
$route['signin_user'] = "dashboards/signin_user";
$route['logout'] = "dashboards/logout";
$route['register'] = "dashboards/register";
$route['register_user'] = "dashboards/register_user";
$route['dashboard'] = "dashboards/dashboard";
$route['dashboard/admin'] = "dashboards/admin";
$route['profile/(:num)'] = "dashboards/profile/$1";
$route['edit/(:num)'] = "dashboards/edit/$1";
$route['edit_user'] = "dashboards/edit_user";
$route['edit_password'] = "dashboards/edit_password";
$route['delete/(:num)'] = "dashboards/delete_user/$1";
$route['add_new'] = "dashboards/add_new";
$route['post_message/(:num)'] = "dashboards/message/$1";
$route['post_comment/(:num)'] = "dashboards/comment/$1";
$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */