<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'sales'], function () {
    Route::get('/', 'API\SalesController@index');
});

Route::group(['prefix' => 'customers'], function () {
    Route::get('/{customer}/sales', 'API\CustomerSalesController@index');
});

Route::group(['prefix' => 'employees'], function () {
    Route::get('/{employee}/sales', 'API\EmployeeSalesController@index');
});
