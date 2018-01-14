<?php

use Illuminate\Http\Request;

use App\Craving;
use App\Http\Resources\CravingsResourceCollection;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('cravings', 'Api\\CravingsController');
Route::resource('savings', 'Api\\SavingsController');
Route::resource('/sales/books', 'Api\\BookSalesController');
Route::resource('/roamings', 'Api\\RoamingsController');
Route::resource('/stats/cravings', 'Api\\CravingStatsController');
Route::resource('/stats', 'Api\\StatsController');
Route::resource('/rooms', 'Api\\RoomsController');
Route::resource('/rooms/{id}/snapshots', 'Api\\RoomSnapshotsController');