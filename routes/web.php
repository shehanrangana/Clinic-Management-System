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
    return view('welcome');
});

Route::get('/la', function () {
    return view('Labassistant_Dashboard.main');
});


// Auth::routes();




Route::post('/la/addlabreport', 'LabController@store');

Route::get('/viewDownloadFile' , 'DownloadController@download');

Route::get('/la' , 'LabController@store');