<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->resource('stats');
$routes->resource('rpm');
$routes->resource('temperature');
$routes->get('/', 'Auth::login', ['filter' => 'auth']);

$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);

//Auth
$routes->match(['get','post'],'/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

//Sites
$routes->match(['get','post'],'/sites/create', 'Sites::create', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/sites/edit', 'Sites::manage', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/sites/edit/(:any)', 'Sites::edit/$1', ['filter' => 'admin_exec_surveyor']);
$routes->get('/sites/manage', 'Sites::manage', ['filter' => 'admin_exec_surveyor']);
$routes->get('/sites/delete', 'Sites::manage', ['filter' => 'admin']);
$routes->match(['get','post'],'/sites/delete/(:any)', 'Sites::delete/$1', ['filter' => 'admin']);

//Users
$routes->match(['get','post'],'/users/create', 'Users::create', ['filter' => 'admin']);
$routes->match(['get','post'],'/users/edit', 'Users::manage', ['filter' => 'admin']);
$routes->match(['get','post'],'/users/edit/(:any)', 'Users::edit/$1', ['filter' => 'admin']);
$routes->get('/users/manage', 'Users::manage', ['filter' => 'admin']);
$routes->get('/users/delete', 'Users::manage', ['filter' => 'admin']);
$routes->match(['get','post'],'/users/delete/(:any)', 'Users::delete/$1', ['filter' => 'admin']);


//Motor Testing
$routes->match(['get','post'],'/motor_test/create', 'Motor_Test::create', ['filter' => 'admin']);
// $routes->match(['get','post'],'/motor_test/edit', 'Motor_Test::manage', ['filter' => 'admin']);
// $routes->match(['get','post'],'/motor_test/edit/(:any)', 'Motor_Test::edit/$1', ['filter' => 'admin']);
// $routes->get('/motor_test/manage', 'Motor_Test::manage', ['filter' => 'admin']);
// $routes->get('/motor_test/delete', 'Motor_Test::manage', ['filter' => 'admin']);
// $routes->match(['get','post'],'/motor_test/delete/(:any)', 'Motor_Test::delete/$1', ['filter' => 'admin']);

//Serveys
$routes->match(['get','post'],'/serveys/create', 'Serveys::manage', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/serveys/create/(:any)', 'Serveys::create/$1', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/serveys/survey_images', 'Serveys::manage', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/serveys/survey_images/(:any)', 'Serveys::survey_images/$1', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/serveys/edit', 'Serveys::manage', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/serveys/edit/(:any)', 'Serveys::edit/$1', ['filter' => 'admin_exec_surveyor']);
$routes->get('/serveys/manage', 'Serveys::manage', ['filter' => 'admin_exec_surveyor']);
$routes->get('/serveys/show', 'Serveys::show', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->get('/serveys/approval', 'Serveys::approval', ['filter' => 'admin_exec']);
$routes->match(['get','post'],'/serveys/approve/(:any)', 'Serveys::approve/$1', ['filter' => 'admin_exec']);
$routes->match(['get','post'],'/serveys/reject/(:any)', 'Serveys::reject/$1', ['filter' => 'admin_exec']);
$routes->match(['get','post'],'/serveys/view_servey', 'Serveys::show', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/serveys/view_servey/(:any)', 'Serveys::view_servey/$1', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/serveys/status_and_feasibility', 'Serveys::status_and_feasibility', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/serveys/print_status_and_feasibility/(:any)', 'Serveys::print_status_and_feasibility/$1', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/serveys/print_surveyed', 'Serveys::print_surveyed', ['filter' => 'admin_exec_surveyor_usr']);


//Reports
$routes->get('/reports/survey_reports', 'Reports::survey_reports', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->get('/reports/non_feasible_reports', 'Reports::non_feasible_reports', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->get('/reports/supplied_sites_reports', 'Reports::supplied_sites_reports', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->get('/reports/installed_sites_reports', 'Reports::installed_sites_reports', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->get('/reports/final_tested_sites_reports', 'Reports::final_tested_sites_reports', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->get('/reports/completed_sites_reports', 'Reports::completed_sites_reports', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/reports/print_survey_report/(:any)', 'Reports::print_survey_report/$1', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/reports/print_non_feasible_report', 'Reports::print_non_feasible_report', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/reports/print_supplied_sites_report', 'Reports::print_supplied_sites_report', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/reports/print_installation_report/(:any)', 'Reports::print_installation_report/$1', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/reports/print_final_testing_report/(:any)', 'Reports::print_final_testing_report/$1', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/reports/print_completion_report/(:any)', 'Reports::print_completion_report/$1', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/reports/print_report', 'Reports::print_report', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/reports/print_installed_report', 'Reports::print_installed_report', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/reports/print_final_tested_report', 'Reports::print_final_tested_report', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/reports/print_completed_report', 'Reports::print_completed_report', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);

//Stocks
$routes->match(['get','post'],'/stocks/add', 'Stocks::add', ['filter' => 'admin_stock_usr']);
$routes->match(['get','post'],'/stocks/get_stocks', 'Stocks::get_stocks', ['filter' => 'admin_stock_usr']);
$routes->match(['get','post'],'/stocks/update', 'Stocks::update', ['filter' => 'admin_stock_usr']);
$routes->match(['get','post'],'/stocks/show', 'Stocks::show', ['filter' => 'admin_exec_surveyor_stock_usr']);

//Supply Order
$routes->match(['get','post'],'/supply_order/create', 'Supply_Order::create', ['filter' => 'admin_exec_stock_usr']);
$routes->match(['get','post'],'/supply_order/create/(:any)', 'Supply_Order::create/$1', ['filter' => 'admin_exec_stock_usr']);
$routes->match(['get','post'],'/supply_order/delete/(:any)', 'Supply_Order::delete/$1', ['filter' => 'admin']);
$routes->get('/supply_order/manage', 'Supply_Order::manage', ['filter' => 'admin_exec_stock_usr']);
$routes->match(['get','post'],'/supply_order/print', 'Supply_Order::print', ['filter' => 'admin_exec_stock_usr']);
$routes->match(['get','post'],'/supply_order/print/(:any)', 'Supply_Order::print/$1', ['filter' => 'admin_exec_stock_usr']);
$routes->match(['get','post'],'/supply_order/print_packing_list/(:any)', 'Supply_Order::print_packing_list/$1', ['filter' => 'admin_exec_stock_usr']);
$routes->get('/supply_order/show', 'Supply_Order::show', ['filter' => 'admin_exec_surveyor_stock_usr']);
$routes->match(['get','post'],'/supply_order/view_supply_order', 'Supply_Order::show', ['filter' => 'admin_exec_surveyor_stock_usr']);
$routes->get('/supply_order/print_supplied', 'Supply_Order::print_supplied', ['filter' => 'admin_exec_surveyor_stock_usr']);
$routes->match(['get','post'],'/supply_order/view_supply_order/(:any)', 'Supply_Order::view_supply_order/$1', ['filter' => 'admin_exec_surveyor_stock_usr']);

//Site Installations
$routes->match(['get','post'],'/site_installations/create', 'Site_Installations::manage', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/site_installations/create/(:any)', 'Site_Installations::create/$1', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/site_installations/site_installation_images', 'Site_Installations::manage', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/site_installations/site_installation_images/(:any)', 'Site_Installations::site_installation_images/$1', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/site_installations/edit', 'Site_Installations::manage', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/site_installations/edit/(:any)', 'Site_Installations::edit/$1', ['filter' => 'admin_exec_surveyor']);
$routes->get('/site_installations/manage', 'Site_Installations::manage', ['filter' => 'admin_exec_surveyor']);
$routes->get('/site_installations/show', 'Site_Installations::show', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->get('/site_installations/print_installed', 'Site_Installations::print_installed', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/site_installations/view_site_installation', 'Site_Installations::show', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/site_installations/view_site_installation/(:any)', 'Site_Installations::view_site_installation/$1', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);

//Site FAT
$routes->match(['get','post'],'/fat/create', 'Fat::manage', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/fat/create/(:any)', 'Fat::create/$1', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/fat/fat_images', 'Fat::manage', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/fat/fat_images/(:any)', 'Fat::fat_images/$1', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/fat/edit', 'Fat::manage', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/fat/edit/(:any)', 'Fat::edit/$1', ['filter' => 'admin_exec_surveyor']);
$routes->get('/fat/manage', 'Fat::manage', ['filter' => 'admin_exec_surveyor']);
$routes->get('/fat/show', 'Fat::show', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/fat/view_fat', 'Fat::show', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/fat/view_fat/(:any)', 'Fat::view_fat/$1', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/fat/fat_passed_failed', 'Fat::fat_passed_failed', ['filter' => 'admin_exec_surveyor_usr']);
$routes->match(['get','post'],'/fat/print_fat_passed_failed/(:any)', 'Fat::print_fat_passed_failed/$1', ['filter' => 'admin_exec_surveyor_usr']);

//Site Handing/Taking
$routes->match(['get','post'],'/handing_taking/create', 'Handing_Taking::manage', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/handing_taking/create/(:any)', 'Handing_Taking::create/$1', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/handing_taking/edit', 'Handing_Taking::manage', ['filter' => 'admin_exec_surveyor']);
$routes->match(['get','post'],'/handing_taking/edit/(:any)', 'Handing_Taking::edit/$1', ['filter' => 'admin_exec_surveyor']);
$routes->get('/handing_taking/manage', 'Handing_Taking::manage', ['filter' => 'admin_exec_surveyor']);
$routes->get('/handing_taking/show', 'Handing_Taking::show', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/handing_taking/view_handing_taking', 'Handing_Taking::show', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/handing_taking/view_handing_taking/(:any)', 'Handing_Taking::view_handing_taking/$1', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);

//Problematic Sites
$routes->get('/problematic/show', 'Problematic::show', ['filter' => 'admin_exec_surveyor_stock_usr']);
$routes->match(['get','post'],'/problematic/view_survey', 'Problematic::show', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);
$routes->match(['get','post'],'/problematic/view_survey/(:any)', 'Problematic::view_survey/$1', ['filter' => 'admin_exec_surveyor_usr_stock_usr']);

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
