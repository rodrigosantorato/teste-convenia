<?php

use Illuminate\Http\Request;

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

Route::resource('companies', 'CompaniesController', ['only' => ['store', 'show']]);
Route::resource('companies.suppliers', 'SuppliersController')->middleware('auth:api');
//Route::middleware('auth:api')->get('/suppliers/{supplier}', function (Request $request) {
//    return $request->user();
//});
