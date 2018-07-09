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

Route::get('/', 'HomeController@index');
Route::get('/access_restricted', 'HomeController@access_restricted');
Route::get('/home_alerts', 'HomeController@getalerts');
Route::get('/alerts', 'AlertController@index');
Route::get('/facilities', 'FacilityController@index');
Route::get('/diseases', 'DiseaseController@index');
Route::get('/alerts', 'AlertController@index');
Route::get('/counties', 'CountyController@index');
Route::get('/subcounties', 'SubcountyController@index');
Route::get('/users', 'UserController@index');
Route::get('facility/create', [
  'as' => 'register',
  'uses' => 'FacilityController@create'
]);
Route::get('/responses', 'ResponseController@index');
Route::get('/responses/excel', 'ResponseController@excel');

Route::get('/facility_alerts/{facility_id}', 'AlertController@show_byFacility');

Route::get('/disease/create', 'DiseaseController@create');
Route::get('/alert/create', 'AlertController@create');
Route::get('/alert/excel', 'AlertController@excel');
Route::get('/alert/response/{alert}', 'ResponseController@response');
Route::get('/county/create', 'CountyController@create');
Route::get('/subcounty/create', 'SubcountyController@create');
Route::get('/kemri/create/{alert}', 'ResponseController@kemri_response');

Route::post('/facility/store','FacilityController@store');
Route::post('/disease/store','DiseaseController@store');
Route::post('/alert/store','AlertController@store');
Route::post('/county/store','CountyController@store');
Route::post('/subcounty/store','SubcountyController@store');
Route::post('/response/store/{response}','ResponseController@store');
Route::post('/kemri/store/{alert}','ResponseController@kemri_response_store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
