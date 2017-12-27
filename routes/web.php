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

Route::resource('/cravings', 'CravingsController');
Route::resource('/treatments/fungal', 'FungalTreatmentsController');

Route::resource('/cravings/upload', 'CravingsController@upload')->name('upload_craving');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::resource('/treatments/fungal', 'dashboard\\FungalTreatmentsController');
Route::resource('/savings', 'dashboard\\SavingsController');