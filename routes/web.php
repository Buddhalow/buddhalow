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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/cravings', 'CravingsController@index');
Route::get('/treatments/fungal', 'FungalTreatmentsController@index');

Route::post('/cravings/upload', 'CravingsController@upload')->name('upload_craving');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::resource('fungal-treatments', 'FungalTreatmentsController');
Route::resource('fungal-treatments', 'FungalTreatmentsController');
Route::resource('fungal-treatments', 'FungalTreatmentsController');
Route::resource('fungal-treatments', 'FungalTreatmentsController');
Route::resource('dashboard/fungal-treatments', 'dashboard\\FungalTreatmentsController');
Route::resource('dashboard/fungal-treatments', 'dashboard\\FungalTreatmentsController');
Route::resource('dashboard/fungal-treatments', 'dashboard\\FungalTreatmentsController');
Route::resource('dashboard/fungal-treatments', 'dashboard\\FungalTreatmentsController');
Route::resource('dashboard/fungal-treatments', 'dashboard\\FungalTreatmentsController');
Route::resource('dashboard/savings', 'dashboard\\SavingsController');
Route::resource('dashboard/savings', 'dashboard\\SavingsController');
Route::resource('dashboard/savings', 'dashboard\\SavingsController');