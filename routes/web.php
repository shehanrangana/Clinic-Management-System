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

// Admin routes
Route::get('/admin', function () {
    return view('./admin/dashboard');
});

Route::get('/admin/user_register', function () {
    return view('./admin/user_register');
});

Route::post('/admin/user_register/store', 'UserController@store');

Route::get('/admin/users', function () {
    return view('./admin/users');
});

Route::get('/admin/users/show', 'UserController@index');
Route::post('/admin/users/remove/{user_id}', 'UserController@destroy');

Route::get('/admin/patients', function () {
    return view('./admin/patients');
});

Route::get('/admin/patients/show', 'PatientController@index');
Route::post('/admin/patients/remove/{nic}', 'PatientController@destroy');

Route::get('/admin/patients/filter', 'PatientController@filter');

Route::get('/admin/appointments', function () {
    return view('./admin/appointments');
});


// Receptionist routes
Route::get('/recept', function() {
    return view('./recept/dashboard');
});

Route::get('/recept/queue', function() {
    return view('./recept/queue');
});

Route::get('/recept/queue/today-list', 'AppointmentController@getTodayList'); 

Route::get('/recept/patient_register', function () {
    return view('./recept/patient_register');
});

Route::post('/recept/patient_register/store', 'PatientController@store');

Route::get('/recept/patients', function () {
    return view('./admin/patients');
});


// Doctor routes
Route::get('/doctor', function() {
    return view('./doctor/dashboard');
});


// Nurse routes
Route::get('/nurse', function() {
    return view('./nurse/dashboard');
});


// // Lab assistant routes
Route::get('/lab', function() {
    return view('./lab/dashboard');
});

Route::get('/lab/upload' , function(){
    return view('./lab/reportupload');
});

Route::post('/lab/upload/store' , 'LabReportController@store')->name("hhh");
// Pharmacy routes
Route::get('/pharmacy', function() {
    return view('./pharmacy/dashboard');
});

Route::get('/test', function () {
    return asset('uploads/1MztetsHpGOO6AgB1mvxaQNxKZBTmGz3EthpuU3K.pdf');
});

