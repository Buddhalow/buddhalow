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

Auth::routes();


Route::middleware('web')->group(function () {
Route::get('/dashboard/{q}', 'DashboardController@index')->where('q', '(.*)');
Route::get('/dashboard', 'DashboardController@index')->name('home');

});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
Auth::routes();
