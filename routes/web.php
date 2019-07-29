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

Auth::routes();
Route::get('code',function(){
 return view('auth.code');
});
Route::post('verify-code','Auth\LoginController@verifyCode');
Route::middleware(['auth'])->group(function () {

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/appointments', 'PagesController@appointment');
Route::get('/registers', 'PagesController@register');
Route::get('/schedule', 'PagesController@schedule');
Route::get('/patients', 'PagesController@patients');
Route::post('/patient/appointment','PagesController@create_appointment')->name('create_appointments');

Route::resource('post','PostController');

Route::resource('patient', 'PatientsController');
Route::delete('/patients/{delete}','PatientsController@delete')->name('patients.delete');
Route::resource('appointment','AppointmentController');

});
