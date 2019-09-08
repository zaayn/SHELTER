<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::group(['prefix' => 'officer_crm',  'middleware' => 'is_officer_crm'], function(){

    Route::get('/home', 'OfficerController@index')->name('dashboard_officer'); //Dashboard Officer

    //------- laporan call
    Route::get('/insertcall', 'callController@insert')->name('insert.call.officer'); //show form insert
    Route::get('/call', 'callController@index')->name('index.call.officer');
    Route::post('/store/call', 'callController@store')->name('store.call.officer');
    Route::get('/delete/call{call_id}','callController@destroy')->name('destroy.call.officer');
    Route::get('/edit/editcall{call_id}','callController@edit')->name('edit.call.officer');
    Route::post('/update/call{call_id}','callController@update')->name('update.call.officer');
    Route::get('/call/exportPDF', 'callController@exportPDF');
    Route::get('/call/exportExcel', 'CalladminController@exportExcel');
    Route::post('/filter/call', 'callController@filter')->name('call.filter');

    //------- laporan visit
    Route::get('/insertvisit', 'VisitController@insert')->name('insert.visit.officer'); //show form insert
    Route::get('/visit', 'VisitController@index')->name('index.visit.officer');
    Route::post('/store/visit', 'VisitController@store')->name('store.visit.officer');
    Route::get('/delete/visit{visit_id}','VisitController@destroy')->name('destroy.visit.officer');
    Route::get('/edit/editvisit{visit_id}','VisitController@edit')->name('edit.visit.officer');
    Route::post('/update/visit{visit_id}','VisitController@update')->name('update.visit.officer');
    Route::get('/visit/exportPDF', 'VisitController@exportPDF');
    Route::get('/visit/exportExcel', 'VisitadminController@exportExcel');
    Route::post('/filter/viist', 'VisitController@filter')->name('visit.filter');

    //------- laporan keluhan
    Route::get('/insertkeluhan', 'KeluhanController@insert')->name('insert.keluhan.officer'); //show form insert
    Route::get('/keluhan', 'KeluhanController@index')->name('index.keluhan.officer');
    Route::post('/store/keluhan', 'KeluhanController@store')->name('store.keluhan.officer');
    Route::get('/delete/keluhan{id_keluhan}','KeluhanController@destroy')->name('destroy.keluhan.officer');
    Route::get('/edit/editkeluhan{id_keluhan}','KeluhanController@edit')->name('edit.keluhan.officer');
    Route::post('/update/keluhan{id_keluhan}','KeluhanController@update')->name('update.keluhan.officer');
    Route::get('/keluhan/exportPDF', 'KeluhanController@exportPDF');
    Route::get('/keluhan/exportExcel', 'KeluhanadminController@exportExcel');
    Route::post('/filter/keluhan', 'KeluhanController@filter')->name('keluhan.filter');

    //------- laporan kontrak
    Route::get('/insertkontrak', 'KontrakController@insert')->name('insert.kontrak.officer'); //show form insert
    Route::get('/kontrak', 'KontrakController@index')->name('index.kontrak.officer');
    Route::post('/store/kontrak', 'KontrakController@store')->name('store.kontrak.officer');
    Route::get('/delete/kontrak{id_kontrak}','KontrakController@destroy')->name('destroy.kontrak.officer');
    Route::get('/edit/editkontrak{id_kontrak}','KontrakController@edit')->name('edit.kontrak.officer');
    Route::post('/update/kontrak{id_kontrak}','KontrakController@update')->name('update.kontrak.officer');
    Route::get('/mou', 'OfficerController@mou')->name('mou.officer');
    Route::get('/kontrak/exportPDF', 'KontrakController@exportPDF');
    Route::get('/kontrak/exportExcel', 'KontrakadminController@exportExcel');
    Route::post('/filter/kontrak', 'KontrakController@filter')->name('kontrak.filter');

    Route::get('/mou/exportPDF', 'OfficerController@exportPDF');

});

// email superadmin :superadmin@gmail.com
// pass             :12345678
Route::group(['prefix' => 'superadmin',  'middleware' => 'is_superadmin'], function(){
    Route::get('/home', 'AdminController@superadmin')->name('home'); //Dashboard super admin

    //--------- bisnis unit
    Route::get('/insert_bisnis_unit', 'BisnisController@insert')->name('insert.bisnis_unit'); //show form insert
    Route::get('/bisnis_unit', 'BisnisController@index')->name('index.bisnis_unit');
    Route::post('/store/bisnis_unit', 'BisnisController@store')->name('store.bisnis_unit');
    Route::get('/delete/bisnis_unit{id}','BisnisController@delete')->name('delete.bisnis_unit');
    Route::get('/edit/bisnis_unit{id}','BisnisController@edit')->name('edit.bisnis_unit');
    Route::put('/update/bisnis_unit{id}','BisnisController@update')->name('update.bisnis_unit');

    //--------- area
    Route::get('/insert_area', 'AreaController@insert')->name('insert.area'); //show form insert
    Route::get('/area', 'AreaController@index')->name('index.area');
    Route::post('/store/area', 'AreaController@store')->name('store.area');
    Route::get('/delete/area{id}','AreaController@delete')->name('delete.area');
    Route::get('/edit/area{id}','AreaController@edit')->name('edit.area');
    Route::put('/update/area{id}','AreaController@update')->name('update.area');

    // --------- wilayah
    Route::get('/insert_wilayah', 'WilayahController@insert')->name('insert.wilayah'); //show form insert
    Route::get('/wilayah', 'WilayahController@index')->name('index.wilayah');
    Route::post('/store/wilayah', 'WilayahController@store')->name('store.wilayah');
    Route::get('/delete/wilayah{id}','WilayahController@delete')->name('delete.wilayah');
    Route::get('/edit/wilayah{id}','WilayahController@edit')->name('edit.wilayah');
    Route::put('/update/wilayah{id}','WilayahController@update')->name('update.wilayah');
    Route::post('/filter/wilayah', 'WilayahController@filter')->name('filter.wilayah');

    // user
    Route::get('/insert_user', 'UserController@insert')->name('insert.user'); //show form insert
    Route::get('/user', 'UserController@index')->name('index.user');
    Route::post('/store/user', 'UserController@store')->name('store.user');
    Route::get('/delete/user{id}','UserController@delete')->name('delete.user');
    Route::get('/edit/user{id}','UserController@edit')->name('edit.user');
    Route::put('/update/user{id}','UserController@update')->name('update.user');
    Route::post('/filter/user', 'UserController@filter')->name('filter.user');

});

Route::group(['prefix' => 'admin',  'middleware' => 'is_admin'], function(){

    Route::get('/home', 'AdminController@index')->name('home'); //Dashboard Admin
    Route::get('/data_customer', 'AdminController@data_customer')->name('index.data_customer');
    
    // customer
    Route::get('/insert_customer', 'CustomerController@insert')->name('insert.user'); //show form insert
    Route::get('/customer', 'CustomerController@index')->name('index.customer');
    Route::post('/store/customer', 'CustomerController@store')->name('store.customer');
    Route::get('/delete/customer{id}','CustomerController@delete')->name('delete.customer');
    Route::get('/edit/customer{id}','CustomerController@edit')->name('edit.customer');
    Route::post('/update/customer{id}','CustomerController@update')->name('update.customer');
    Route::get('/customer/exportPDF', 'CustomerController@exportPDF');
    Route::get('/datacustomer/exportPDF', 'AdminController@exportPDF');
    Route::get('/customer/exportExcel', 'CustomerController@exportExcel');
    Route::post('/filter/customer', 'CustomerController@filter')->name('filter.customer');
    Route::get('/reset/customer{id}', 'CustomerController@aktivasi')->name('reset.customer');
    Route::get('/cust_type', 'CustomerController@cust_type')->name('cust.type');
    Route::get('/profile', 'CustomerController@profile')->name('cust.profile');
    Route::post('/filter/profile', 'CustomerController@filter_profile')->name('filter.profile');

    //------- laporan call
    Route::get('/insertcall', 'CalladminController@insert')->name('insert.call'); //show form insert
    Route::get('/call', 'CalladminController@index')->name('index.call');
    Route::post('/store/call', 'CalladminController@store')->name('store.call');
    Route::get('/delete/call{call_id}','CalladminController@destroy')->name('destroy.call');
    Route::get('/edit/editcall{call_id}','CalladminController@edit')->name('edit.call');
    Route::post('/update/call{call_id}','CalladminController@update')->name('update.call');
    Route::get('/call/exportPDF', 'CalladminController@exportPDF');
    Route::get('/call/exportExcel', 'CalladminController@exportExcel');
    Route::post('/filter/call', 'CalladminController@filter')->name('filter.call');

        //------- laporan visit
        Route::get('/insertvisit', 'Visitadmincontroller@insert')->name('insert.visit'); //show form insert
        Route::get('/visit', 'Visitadmincontroller@index')->name('index.visit');
        Route::post('/store/visit', 'Visitadmincontroller@store')->name('store.visit');
        Route::get('/delete/visit{visit_id}','Visitadmincontroller@destroy')->name('destroy.visit');
        Route::get('/edit/editvisit{visit_id}','Visitadmincontroller@edit')->name('edit.visit');
        Route::post('/update/visit{visit_id}','Visitadmincontroller@update')->name('update.visit');
        Route::get('/visit/exportPDF', 'VisitadminController@exportPDF');
        Route::get('/visit/exportExcel', 'VisitadminController@exportExcel');
        Route::post('/filter/visit', 'VisitadminController@filter')->name('filter.visit');
    
        //------- laporan keluhan
        Route::get('/insertkeluhan', 'KeluhanadminController@insert')->name('insert.keluhan'); //show form insert
        Route::get('/keluhan', 'KeluhanadminController@index')->name('index.keluhan');
        Route::post('/store/keluhan', 'KeluhanadminController@store')->name('store.keluhan');
        Route::get('/delete/keluhan{id_keluhan}','KeluhanadminController@destroy')->name('destroy.keluhan');
        Route::get('/edit/editkeluhan{id_keluhan}','KeluhanadminController@edit')->name('edit.keluhan');
        Route::post('/update/keluhan{id_keluhan}','KeluhanadminController@update')->name('update.keluhan');
        Route::get('/keluhan/exportPDF', 'KeluhanadminController@exportPDF');
        Route::get('/keluhan/exportExcel', 'KeluhanadminController@exportExcel');
        Route::get('/reset/keluhan{id}', 'KeluhanadminController@aktivasi')->name('reset.keluhan');
        Route::post('/filter/keluhan', 'KeluhanadminController@filter')->name('filter.keluhan');
    
        //------- laporan kontrak
        Route::get('/insertkontrak', 'KontrakadminController@insert')->name('insert.kontrak'); //show form insert
        Route::get('/kontrak', 'KontrakadminController@index')->name('index.kontrak');
        Route::post('/store/kontrak', 'KontrakadminController@store')->name('store.kontrak');
        Route::get('/delete/kontrak{id_kontrak}','KontrakadminController@destroy')->name('destroy.kontrak');
        Route::get('/edit/editkontrak{id_kontrak}','KontrakadminController@edit')->name('edit.kontrak');
        Route::post('/update/kontrak{id_kontrak}','KontrakadminController@update')->name('update.kontrak');
        Route::post('/filter/kontrak', 'KontrakadminController@filter')->name('filter.kontrak');
        Route::get('/kontrak/exportPDF', 'KontrakadminController@exportPDF');
        Route::get('/kontrak/exportExcel', 'KontrakadminController@exportExcel');
        Route::get('/reminder', 'KontrakadminController@reminder')->name('index.reminder.kontrak');
        Route::get('/closed/kontrak{id_kontrak}', 'KontrakadminController@closed')->name('closed.kontrak');
        Route::get('/insert/mou{id_kontrak}','KontrakadminController@insertmou')->name('insertmou.kontrak');


        //------- laporan mou
        Route::get('/insertmou', 'MouController@insert')->name('insert.datamou'); //show form insert
        Route::get('/mou', 'MouController@index')->name('index.datamou');
        Route::post('/store/datamou/{id_kontrak}', 'MouController@store')->name('store.datamou');
        Route::get('/delete/datamou{no_mou}','MouController@destroy')->name('destroy.datamou');
        Route::get('/edit/datamou{no_mou}','MouController@edit')->name('edit.datamou');
        Route::post('/update/datamou{no_mou}','MouController@update')->name('update.datamou');
        Route::get('/mou/exportPDF', 'MouController@exportPDF');
        Route::get('/mou/exportExcel', 'MouController@exportExcel');
});
 
Route::group(['prefix' => 'manager_crm',  'middleware' => 'is_manager_crm'], function(){
    //manager crm
    Route::get('/home', 'ManagerController@index')->name('dashboard_officer'); //Dashboard Admin
    Route::get('/call', 'ManagerController@call')->name('manager_call');
    Route::get('/keluhan', 'ManagerController@keluhan')->name('manager_keluhan');
    Route::get('/visit', 'ManagerController@visit')->name('manager_visit');
    Route::get('/kontrak', 'ManagerController@kontrak')->name('manager_kontrak');
    Route::get('/mou', 'ManagerController@mou')->name('manager_mou');
    Route::get('/customer', 'ManagerController@customer')->name('manager_customer');

    Route::get('/call/exportPDF', 'callController@exportPDF');
    Route::get('/call/exportExcel', 'CalladminController@exportExcel');
    Route::get('/kontrak/exportPDF', 'KontrakController@exportPDF');
    Route::get('/kontrak/exportExcel', 'KontrakadminController@exportExcel');
    Route::get('/visit/exportPDF', 'VisitController@exportPDF');
    Route::get('/visit/exportExcel', 'VisitadminController@exportExcel');
    Route::get('/keluhan/exportPDF', 'KeluhanController@exportPDF');
    Route::get('/keluhan/exportExcel', 'KeluhanadminController@exportExcel');
    Route::get('/mou/exportPDF', 'MouController@exportPDF');
    Route::get('/mou/exportExcel', 'MouController@exportExcel');
    Route::get('/customer/exportPDF', 'CustomerController@exportPDF');
    Route::get('/customer/exportExcel', 'CustomerController@exportExcel');


});

Route::group(['prefix' => 'direktur',  'middleware' => 'is_direktur'], function(){
    //manager crm
    Route::get('/home', 'DirekturController@index')->name('dashboard_officer'); //Dashboard Admin
    Route::get('/call', 'DirekturController@call')->name('direktur_call');
    Route::get('/keluhan', 'DirekturController@keluhan')->name('direktur_keluhan');
    Route::get('/visit', 'DirekturController@visit')->name('direktur_visit');
    Route::get('/kontrak', 'DirekturController@kontrak')->name('direktur_kontrak');
    Route::get('/mou', 'DirekturController@mou')->name('direktur_mou');
    Route::get('/customer', 'DirekturController@customer')->name('direktur_customer');

    Route::get('/call/exportPDF', 'callController@exportPDF');
    Route::get('/call/exportExcel', 'CalladminController@exportExcel');
    Route::get('/kontrak/exportPDF', 'KontrakController@exportPDF');
    Route::get('/kontrak/exportExcel', 'KontrakadminController@exportExcel');
    Route::get('/visit/exportPDF', 'VisitController@exportPDF');
    Route::get('/visit/exportExcel', 'VisitadminController@exportExcel');
    Route::get('/keluhan/exportPDF', 'KeluhanController@exportPDF');
    Route::get('/keluhan/exportExcel', 'KeluhanadminController@exportExcel');
    Route::get('/mou/exportPDF', 'MouController@exportPDF');
    Route::get('/mou/exportExcel', 'MouController@exportExcel');
    Route::get('/customer/exportPDF', 'CustomerController@exportPDF');
    Route::get('/customer/exportExcel', 'CustomerController@exportExcel');
});

Route::group(['prefix' => 'manager_non_crm',  'middleware' => 'is_manager_non_crm'], function(){
    //manager crm
    Route::get('/home', 'ManagerNonCrmController@index')->name('dashboard_officer'); //Dashboard Admin
    Route::get('/kontrak', 'ManagerNonCrmController@kontrak')->name('manager_non_crm_kontrak');
    Route::get('/mou', 'ManagerNonCrmController@mou')->name('manager_non_crm_mou');
    Route::get('/customer', 'ManagerNonCrmController@customer')->name('manager_non_crm_customer');

    Route::get('/mou/exportPDF', 'MouController@exportPDF');
    Route::get('/mou/exportExcel', 'MouController@exportExcel');
    Route::get('/customer/exportPDF', 'CustomerController@exportPDF');
    Route::get('/customer/exportExcel', 'CustomerController@exportExcel');
    Route::get('/kontrak/exportPDF', 'KontrakController@exportPDF');
    Route::get('/kontrak/exportExcel', 'KontrakadminController@exportExcel');

});