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
    
        Route::get('/user_register', function () {
            return view('./admin/user_register');
        });

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

        Route::get('/dashboard/get_queue', 'QueueController@getCurrentQueue');

        Route::get('/dashboard/patient_history', 'PatientController@getPatientHistory');

        Route::get('/profile/{id}', 'UserController@loadProfile');
        Route::post('/profile/{id}/update', 'UserController@updateProfile'); // update profile
        Route::get('/logout', 'Auth\LoginController@logout');
    });
});
//Nurse routes
Route::get('/nurse/make_appointment', function () {
    return view('./nurse/make_appointment');
});

Route::get('/nurse/appointment_list', function () {
    return view('./nurse/appointment_list');
});

Route::get('/nurse/appointment_list/show', 'AppointmentController@show');
Route::get('/nurse/appointment_list/cancel', 'AppointmentController@destroy');
Route::post('/nurse/make_appointment/add', 'AppointmentController@add');

Route::get('/nurse/make_appointment/count/{date}', 'AppointmentController@getCountStatus');
Route::get('/nurse/make_appointment/checkid', 'AppointmentController@checkID');
Route::get('/nurse/make_appointment/checkappointment', 'AppointmentController@checkAppointment');
Route::get('/nurse/make_appointment/getcount', 'AppointmentController@getCount');

//
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

        Route::get('/profile/{id}', 'UserController@loadProfile');
        Route::post('/profile/{id}/update', 'UserController@updateProfile'); // update profile
        Route::get('/logout', 'Auth\LoginController@logout');
    });
});

// Pharmacist routes
Route::group(['middleware' => 'App\Http\Middleware\PharmacistMiddleware'], function() {
    Route::prefix('pharmacy')->group(function(){
        Route::get('/', 'UserController@pharmacist');

        Route::get('/profile/{id}', 'UserController@loadProfile');
        Route::post('/profile/{id}/update', 'UserController@updateProfile'); // update profile
        Route::get('/logout', 'Auth\LoginController@logout');
    });
});