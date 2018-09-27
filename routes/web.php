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
Route::get('/admin/users/show', 'UserController@index');

Route::get('/admin/users', function () {
    return view('./admin/users');
});

// Reception routes
Route::get('/recept', function() {
    return view('./recept/dashboard');
});

// Doctor routes
Route::get('/doctor', function() {
    return view('./doctor/dashboard');
});

// Nurse routes
Route::get('/nurse', function() {
    return view('./nurse/dashboard');
});

// Lab assistant routes
Route::get('/lab', function() {
    return view('./lab/dashboard');
});

Route::get('/la' , 'LabController@store');

// Pharmacy routes
Route::get('/pharmacy', function() {
    return view('./pharmacy/dashboard');
});

