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

use App\Craving;
use App\Http\Resources\CravingResourceCollection;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard/cravings', 'Dashboard\CravingsController@index')->name('cravings');
Route::get('/dashboard/aqtivity', 'Dashboard\RoamingsController@index')->name('roamings');
Route::get('/dashboard/stats/cravings', 'Dashboard\RoamingsController@index')->name('roamings');
Route::get('/dashboard/savings', 'Dashboard\SavingsController@index')->name('savings');
Route::get('/dashboard/sales/books', 'Dashboard\BookSalesController@index')->name('booksales');
Route::get('/dashboard/music/streams', 'Dashboard\BookSalesController@index')->name('music_streams');
Route::get('/dashboard/cleaning', 'Dashboard\BookSalesController@index')->name('booksales');
Route::get('/dashboard/threats', 'Dashboard\BookSalesController@index')->name('booksales');
Route::get('/dashboard/opportunities', 'Dashboard\BookSalesController@index')->name('booksales');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});