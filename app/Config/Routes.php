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
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::login');

$routes->get('/admin', 'Home::index');
$routes->get('/admin', 'Jaminan::index');
$routes->get('/detail/(:segment)', 'Jaminan::detail/$1');

// api
$routes->get('karyawan_api', 'Karyawan::karyawan_api');
// 

//route data master karyawan
$routes->get('/karyawan', 'Karyawan::index');
$routes->delete('karyawan/(:num)', 'Karyawan::delete/$1');
$routes->get('/detail/(:any)', 'Karyawan::detail/$1');

//route data master position
$routes->get('/position', 'Position::index');
$routes->delete('position/(:num)', 'Position::delete/$1');
$routes->get('/detail/(:any)', 'Position::detail/$1');

//route data master contact emplooyee
$routes->get('/contact_employee', 'Contact_employee::index');
$routes->delete('/contact_employee/(:num)', 'Contact_employee::delete_contact/$1');
$routes->get('/detail/(:any)', 'Contact_employee::detail_contact/$1');

//route data master education employee
$routes->get('/employee_education', 'Employee_education::index');
$routes->delete('/employee_education/(:num)', 'Employee_education::delete/$1');
$routes->get('/detail_education/(:any)', 'Employee_education::detail_education/$1');

//route data master fasilitas karyawan
$routes->get('/fasilitas_karyawan', 'Fasilitas_karyawan::index');
$routes->delete('/fasilitas_karyawan/(:num)', 'Fasilitas_karyawan::delete_fasilitas/$1');
$routes->get('/detail_fasilitas/(:any)', 'Fasilitas_karyawan::detail_fasilitas/$1');

//route data master family
$routes->get('/family', 'Family::index');
$routes->delete('/family/(:num)', 'Family::delete/$1');
$routes->get('/detail_family/(:any)', 'Family::detail_family/$1');

//route data master jaminan
$routes->get('/mst_jaminan', 'Mst_jaminan::index');
$routes->delete('/mst_jaminan/(:num)', 'Mst_jaminan::delete_jaminan/$1');
$routes->get('/detail_jaminan/(:any)', 'Mst_jaminan::detail_jaminan/$1');

//route data master join karyawan
$routes->get('/mst_join', 'Mst_join::index');
$routes->delete('/mst_join/(:num)', 'Mst_join::delete_join/$1');
$routes->get('/detail_join/(:any)', 'Mst_join::detail_join/$1');

//route data master jabatan karyawan
$routes->get('/mst_position', 'Mst_position::index');
$routes->delete('/mst_position/(:num)', 'Mst_position::delete_position/$1');

//route data master training karyawan
$routes->get('/mst_training', 'Mst_training::index');
$routes->delete('/mst_training/(:num)', 'Mst_training::delete_training/$1');
$routes->get('/detail_training/(:any)', 'Mst_training::detail_training/$1');

//route data transaksi education
$routes->get('/education', 'Education::index');
$routes->delete('/education/(:num)', 'Education::delete_education/$1');
$routes->get('/detail_education/(:any)', 'Education::detail_education/$1');

//route data transaksi position
$routes->get('/trn_position', 'Trn_position::index');
$routes->delete('/trn_position/(:num)', 'Trn_position::delete_position/$1');
$routes->get('/detail_position/(:any)', 'Trn_position::detail_position/$1');

//route data transaksi fasilitas
$routes->get('/fasilitas', 'Fasilitas::index');
$routes->delete('/fasilitas/(:num)', 'Fasilitas::delete_fasilitas/$1');
$routes->get('/detail_fasilitas/(:any)', 'Fasilitas::detail_fasilitas/$1');

//route data transaksi fasilitas in
$routes->get('/fasilitas_in', 'Fasilitas_in::index');
$routes->delete('/fasilitas_in/(:num)', 'Fasilitas_in::delete_fasilitas_in/$1');
$routes->get('/detail_fasilitas_in/(:any)', 'Fasilitas_in::detail_fasilitas_in/$1');

//route jaminan
$routes->get('/jaminan', 'Jaminan::index');
$routes->delete('/jaminan/(:num)', 'Jaminan::delete_jaminan/$1');
$routes->get('/detail_jaminan/(:any)', 'Jaminan::detail/$1');

//route training
$routes->get('/training', 'Training::index');
$routes->delete('/training/(:num)', 'Training::delete_training/$1');
$routes->get('/detail_training/(:any)', 'Training::detail_training/$1');

//route data transaksi peringatan
$routes->get('/peringatan', 'Peringatan::index');
$routes->delete('/peringatan/(:num)', 'Peringatan::delete_peringatan/$1');
$routes->get('/detail/(:any)', 'Peringatan::detail/$1');

//route data transaksi PHK
$routes->get('/phk', 'Phk::index');
$routes->delete('/phk/(:num)', 'Phk::delete_phk/$1');
$routes->get('/detail/(:any)', 'Phk::detail/$1');

//route data transaksi izin
$routes->get('/izin', 'Trn_izin::index');
$routes->delete('/trn_izin/(:num)', 'Trn_izin::delete_izin/$1');
$routes->get('/detail_izin/(:any)', 'Trn_izin::detail_izin/$1');

//route data transaksi join
$routes->get('/join', 'Join::index');
$routes->delete('/join/(:num)', 'Join::delete_join/$1');
$routes->get('/detail/(:any)', 'Join::detail/$1');

//route data transaksi join
$routes->get('/cuti', 'Trn_cuti::index');
$routes->delete('/trn_cuti/(:num)', 'Trn_cuti::delete_cuti/$1');
$routes->get('/detail/(:any)', 'Trn_cuti::detail_cuti/$1');

//route data master cuti
$routes->get('/mst_cuti', 'Mst_cuti::index');
$routes->delete('/mst_cuti/(:num)', 'Mst_cuti::delete_cuti/$1');
$routes->get('/detail_cuti/(:any)', 'Mst_cuti::detail_cuti/$1');

//route data transaksi cuti period
$routes->get('/period', 'TrnCuti_period::index');
$routes->delete('/TrnCuti_period/(:num)', 'TrnCuti_period::delete_period/$1');
$routes->get('/detail_period/(:any)', 'TrnCuti_period::detail/$1');

//route libur

$routes->get('/libur', 'Libur::index');
$routes->delete('/libur/(:num)', 'Libur::delete_libur/$1');

//route dokumen
$routes->get('/dokumen', 'Dokumen::index');
$routes->delete('/dokumen/(:num)', 'Dokumen::delete_dokumen/$1');

//route branch
$routes->get('/branch', 'Branch::index');
$routes->delete('/branch/(:num)', 'Branch::delete_branch/$1');

//route mst_facility
$routes->get('/mst_facility', 'Mst_facility::index');
$routes->delete('/mst_facility/(:num)', 'Mst_facility::delete_facility/$1');

//route mst_achive
$routes->get('/mst_achivement', 'Mst_achivement::index');
$routes->delete('/mst_achivement/(:num)', 'Mst_achivement::delete_achivement/$1');

//route trn_achive
$routes->get('/trn_achivement', 'Trn_achivement::index');
$routes->delete('/trn_achivement/(:num)', 'trn_achivement::delete_achivement/$1');

// route master training
$routes->delete('/mst_training_type/(:num)', 'training_master::delete_training_type/$1');
// route master user
$routes->delete('/auth/(:num)', 'auth::delete_user/$1');





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
