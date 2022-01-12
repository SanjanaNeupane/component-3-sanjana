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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:sanctum')->get('/authenticated', function (Request $request) {
    return true;
});

Route::get('/users_all', 'App\Http\Controllers\UserController@fetchAll');
Route::put('/user/deactive/{id}', 'App\Http\Controllers\UserController@deactiveUser');
Route::put('/user/update/{id}', 'App\Http\Controllers\UserController@updateUser');
Route::get('/users_all_fetch', 'App\Http\Controllers\UserController@fetchAllUsers');

Route::post('/login', 'App\Http\Controllers\LoginController@login');
Route::post('/register', 'App\Http\Controllers\RegisterController@createUser');
Route::post('/logout', 'App\Http\Controllers\LoginController@logout');

Route::delete('/delete_product/{id}','App\Http\Controllers\ProductController@delete');
Route::get('/products', 'App\Http\Controllers\ProductController@index');
Route::get('/products_all', 'App\Http\Controllers\ProductController@fetchAll');
Route::get('/product/edit/{id}', 'App\Http\Controllers\ProductController@edit');
Route::put('/product/update/{id}', 'App\Http\Controllers\ProductController@update');
Route::post('/product/add', 'App\Http\Controllers\ProductController@add');

