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

Route::middleware('auth:api')->get('/cravings', function (Request $request) {
    return new CravingResourceCollection(Craving::all());
});

Route::resource('cravings', 'Api\\cravingsController', ['except' => ['create', 'edit']]);
Route::resource('savings', 'Api\\SavingsController', ['except' => ['create', 'edit']]);
Route::get('/sales/upload', 'Api\\BookSalesController@upload');
Route::resource('sales', 'Api\\BookSalesController', ['except' => ['create', 'edit']]);