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
Auth::routes();
Route::get('/', function() { 
    return view('welcome2');  // this is default welcome page
});
Route::get('/home', 'HomeController@index')->name('home');
// Admin routes
Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function() {
    Route::prefix('admin')->group(function(){
        Route::get('/', 'UserController@admin');

        Route::get('/dashboard/get_status', 'QueueController@getStatus');

        Route::get('/user_register', function () {
            return view('./admin/user_register');
        });
        Route::get('/user_register/checkEmail', 'UserController@checkEmail'); // check already exits
        Route::post('/user_register/store', 'UserController@store');
        Route::get('/users', function () {
            return view('./admin/users');
        });
        Route::get('/users/show', 'UserController@index');
        Route::post('/users/remove/{user_id}', 'UserController@destroy');
        Route::get('/patients', function () {
            return view('./admin/patients');
        });
        Route::get('/patients/show', 'PatientController@index');
        Route::post('/patients/remove/{nic}', 'PatientController@destroy');
        Route::get('/patients/filter', 'PatientController@filter');
        Route::get('/appointments', function () {
            return view('./admin/appointments');
        });

        Route::get('/profile/{id}', 'UserController@loadProfile');
        Route::post('/profile/{id}/update', 'UserController@updateProfile'); // update profile
        Route::get('/logout', 'Auth\LoginController@logout');
    });
});
// Receptionist routes
Route::group(['middleware' => 'App\Http\Middleware\ReceptionistMiddleware'], function() {
    Route::prefix('recept')->group(function(){
        Route::get('/', 'UserController@receptionist');

        Route::get('/dashboard/get_status', 'QueueController@getStatus');
    
        Route::get('/queue', function() {
            return view('./recept/queue');
        });
        Route::get('/queue/today-list', 'AppointmentController@getTodayList'); 
        Route::post('/queue/add', 'QueueController@store'); 

        Route::get('/queue/active-queue', 'QueueController@getActiveQueue');

        Route::post('/queue/start', 'QueueController@startQueue');

        Route::post('/queue/stop', 'QueueController@stopQueue');

        Route::get('/queue/get_recent', 'QueueController@getRecentNumber');

        Route::get('/queue/numbers', 'QueueController@index');

        Route::get('/patient_register', function () {
            return view('./recept/patient_register');
        });
        Route::post('/patient_register/store', 'PatientController@store');
        Route::get('/patient_register/get_last', 'PatientController@getLastId');
        Route::get('/patients', function () {
            return view('./admin/patients');
        }); 
        Route::get('/appointments', function () {
            return view('./recept/appointments');
        });

        Route::get('/profile/{id}', 'UserController@loadProfile');
        Route::post('/profile/{id}/update', 'UserController@updateProfile'); // update profile
        Route::get('/logout', 'Auth\LoginController@logout');
    });
});
// Doctor routes
Route::group(['middleware' => 'App\Http\Middleware\DoctorMiddleware'], function() {
    Route::prefix('doctor')->group(function(){
        Route::get('/', 'UserController@doctor');
        
        Route::get('/dashboard/is_active_panel', 'QueueController@isActivePanel');
        Route::post('/dashboard/active_panel', 'QueueController@activePanel');

        Route::get('/dashboard/get_queue', 'QueueController@getCurrentQueue');

        Route::get('/dashboard/patient_history', 'PatientController@getPatientHistory');

        Route::get('/dashboard/get_drug_list', 'DrugController@index');

        Route::post('/dashboard/prescription_store', 'PrescriptionController@store');

        Route::get('/patients', function () {
            return view('./doctor/patients');
        });

        Route::get('/patients/show', 'PatientController@index');

        Route::get('/profile/{id}', 'UserController@loadProfile');
        Route::post('/profile/{id}/update', 'UserController@updateProfile'); // update profile
        Route::get('/logout', 'Auth\LoginController@logout');
        
        Route::get('/labreports', function () {
            return view('./doctor/reportview');
        });
        Route::get('/get_reports', 'LabReportController@index');
        Route::get('/report/getReport', 'LabReportController@getReport');
    });
});
// Nurse routes
Route::group(['middleware' => 'App\Http\Middleware\NurseMiddleware'], function() {
    Route::prefix('nurse')->group(function(){
        Route::get('/', 'UserController@nurse');

        Route::get('/profile/{id}', 'UserController@loadProfile');
        Route::post('/profile/{id}/update', 'UserController@updateProfile'); // update profile
        Route::get('/logout', 'Auth\LoginController@logout');
    });
});

// Lab assistant routes

Route::group(['middleware' => 'App\Http\Middleware\LabAssistantMiddleware'], function() {
    Route::prefix('lab')->group(function(){
        Route::get('/', 'UserController@lab_assistant');
        
        Route::get('/upload' , function(){
             return view('./lab/reportupload');
        });

        Route::get('/upload/view', function () {
            return view('./lab/reportview');
        });
        Route::get('/upload/show', 'LabReportController@index');

        Route::get('/upload/getReport', 'LabReportController@getReport');

        Route::post('/upload/remove/{report_id}', 'LabReportController@destroy');
        Route::post('/upload/store' , 'LabReportController@store')->name("hhh");
        
        Route::get('/profile/{id}', 'UserController@loadProfile');

        Route::post('/profile/{id}/update', 'UserController@updateProfile'); 

        Route::post('/upload/checkid','LabReportController@checkID');
        // update profile
        Route::get('/logout', 'Auth\LoginController@logout');
    });
});

 //Pharmacist routes
Route::group(['middleware' => 'App\Http\Middleware\PharmacistMiddleware'], function() {
    Route::prefix('pharmacy')->group(function(){
        Route::get('/', 'UserController@pharmacist');
        
        Route::get('/addDrugs', function() {
            return view('./pharmacy/addingdrugs');
        });
        Route::post('/addDrugs/store', 'PharmacyController@store');
        Route::get('/viewdrugs', function () {
            return view('./pharmacy/viewprescription');
        });
        Route::get('/emailSend', function () {
            return view('./pharmacy/emailsend');
        });
        
        Route::get('/addDrugs/show', 'PharmacyController@index');

        Route::get('/overDrug/show', 'PharmacyController@overDrug');

        Route::get('/expireDrug/show', 'PharmacyController@expireDrug');

        Route::get('/dashboard/getPrescription' ,'PharmacyController@prescription');

        Route::get('/dashboard/patient_history', 'PatientController@getPatientHistory');

        Route::post('/dashboard/updateQuantity' ,'PharmacyController@updatequantity');

        Route::post('/addDrugs/remove/{drug_id}', 'PharmacyController@destroy');

        Route::post('/testmail' ,'HomeController@testMail');

        Route::post('/testmail/checksupplier_email' ,'HomeController@checkEmail' );

        Route::get('/profile/{id}', 'UserController@loadProfile');

        Route::post('/profile/{id}/update', 'UserController@updateProfile'); 
        // update profile
        Route::get('/logout', 'Auth\LoginController@logout');
    });
});