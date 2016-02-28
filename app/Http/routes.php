<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/





/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
   // Route::get('home', array('middleware' => 'auth', 'uses' => 'DoctorController@index'));
    Route::any('registerDoctor', array('uses' => 'UserController@doctor'));
    Route::any('registerPatient', array('uses' => 'UserController@patient'));
    Route::any('login', array('uses' => 'UserController@login'));

    Route::any('/', function(){
        return Redirect::intended('home');
    });
    Route::any('home', array('uses' => 'MainPageController@index'));

    Route::any('patients', 'PatientController@patientsList');
    Route::any('patients/{id}', 'PatientController@patientVisits');

    Route::any('doctors', 'DoctorController@doctorsList');
    Route::any('doctors/{id}', 'DoctorController@doctorVisits');
    Route::get('permissions', 'PermissionController@index');
    Route::post('permissions', 'PermissionController@create');

    Route::any('visit/{id}/edit', 'VisitController@edit');
    Route::any('visit/{id}/cancel', 'VisitController@cancel');
    Route::any('visit/create', 'VisitController@create');

    Route::get('logout', function(){
        Auth::logout();
        return Redirect::intended('home');
    });

});

Menu::make('userNav', function($menu){
    $menu->add('Home', 'home');
    $menu->add('Logout', 'logout');
});
Menu::make('mainNav', function($menu){
    $menu->add('Home', 'home');
    $menu->add('Sign up', 'login');
    $menu->add('Patient register',    'registerPatient');
    $menu->add('Doctor register', 'registerDoctor');
});










//Route::get('doctor', array('uses' => 'DoctorController@index'));
//Route::get('visits', array('uses' => 'DoctorController@visits'));

