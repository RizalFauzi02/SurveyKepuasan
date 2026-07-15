<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'survey/landingpage';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Auth routes
$route['auth/login'] = 'auth/login';
$route['auth/logout'] = 'auth/logout';

// Admin routes (protected by Auth + Role filter in controller constructor)
$route['admin'] = 'admin/index';
$route['admin/rooms'] = 'admin/rooms';
$route['admin/questions'] = 'admin/questions';
$route['admin/reports'] = 'admin/reports';

// Superadmin routes (protected by Auth + Superadmin filter)
$route['superadmin/users'] = 'superadmin/users';

// Survey routes (public)
$route['survey/submit'] = 'survey/submit';
