<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Miembros');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Miembros::index');
$routes->get('nuevo', 'Miembros::nuevo');
$routes->post('insert', 'Miembros::insert');
$routes->post('actualizar', 'Miembros::update');
$routes->get('pdf', 'Miembros::pdf');
$routes->get('edita_datos_miembro/(:num)', 'Miembros::editar/$1');
$routes->get('membresias', 'Membresia::index');
$routes->get('edit/(:num)', 'Membresia::edit/$1', ['as' => 'editar-membresia']);
$routes->post('update_date', 'Membresia::update_date');
$routes->post('miembros_select', 'Membresia::miembros_select');
$routes->get('transfer', 'Membresia::frm_select_transfer');
$routes->get('select-transfer-membership/(:num)', 'Membresia::fr_select_member_transfer_membership/$1', ['as' => 'select-transfer_membership']);
$routes->get('membership/(:num)/newmember(:num)', 'Membresia::transfer_membership/$1/$2',['as' => 'transfer_membership']);
$routes->post('asistencia', 'Asistencia::insert', ['as' => 'asistencia']);

$routes->group('reportes', static function ($routes) {
    $routes->get('index', 'Reportes::index');
    $routes->get('lista-miembros', 'Reportes::listaMiembrosPDF');
    $routes->get('lista-membresias', 'Reportes::listaMembresiasPDF');
});
// $routes->get('reportes', 'Reportes::index');
// $routes->get('lista-miembros', 'Reportes::listaMiembrosPDF');
// $routes->get('lista-membresias', 'Reportes::listaMembresiasPDF');



/*
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
