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

Route::get('/admin', function () {
    return view('./admin/main');
});

Route::get('/recept', function() {
    return view('./recept/main');
});

Route::get('/doctor', function() {
    return view('./doctor/main');
});

Route::get('/nurse', function() {
    return view('./nurse/main');
});

Route::get('/lab', function() {
    return view('./lab/main');
});

Route::get('/pharmacy', function() {
    return view('./pharmacy/main');
});

