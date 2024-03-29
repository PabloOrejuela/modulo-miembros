<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Usuarios::index');
$routes->post('validate', 'Usuarios::validate_credentials');
$routes->get('nuevo-usuario', 'Usuarios::nuevo');
$routes->post('usuario-insert', 'Usuarios::insert');
$routes->get('usuarios', 'Usuarios::showUsuarios');
$routes->get('edita_datos_usuario/(:num)', 'Usuarios::editar/$1');
$routes->get('delete-user/(:num)', 'Usuarios::delete/$1');
$routes->post('actualizar-user', 'Usuarios::update');
$routes->post('getNameCedula', 'Usuarios::usuarios_select');

$routes->get('inicio', 'Usuarios::inicio');
$routes->get('salir', 'Usuarios::salir');

$routes->get('miembros', 'Miembros::index');
$routes->get('frm_asigna_membresia_miembro', 'Membresia::frm_asigna_membresia_miembro');
$routes->get('asigna_membresia_miembro/(:num)', 'Membresia::asigna_membresia_miembro/$1');
$routes->post('asign_membresia', 'Membresia::asign_membresia');
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
$routes->post('transfer_membership', 'Membresia::transfer_membership',['as' => 'transfer_membership']);
$routes->post('asistencia', 'Asistencia::insert', ['as' => 'asistencia']);

$routes->group('reportes', static function ($routes) {
    $routes->get('index', 'Reportes::index');
    $routes->get('lista-miembros', 'Reportes::listaMiembrosPDF');
    $routes->get('lista-membresias', 'Reportes::listaMembresiasPDF');

    $routes->get('reporte-movimientos', 'Reportes::lista_movimientos');
    $routes->get('selecciona-instructor', 'Reportes::frm_selecciona_instructor');
    $routes->post('genera_reporte_asistencia_instructor', 'Reportes::genera_reporte_asistencia_instructor');
});
// $routes->get('reportes', 'Reportes::index');
// $routes->get('lista-miembros', 'Reportes::listaMiembrosPDF');
// $routes->get('lista-membresias', 'Reportes::listaMembresiasPDF');
$routes->post('genera_reporte_asistencia_instructor', 'Reportes::genera_reporte_asistencia_instructor');

$routes->get('registra-asistencia-instructor', 'Asistencia::FrmRegistraAsistenciaInstructor');
$routes->post('registra_aistencia_instructor', 'Asistencia::registraAsistenciaInstructor');


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
