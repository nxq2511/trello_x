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

Route::group(['prefix' => 'post', 'middleware' => ['api']], function () {
    Route::get('getall', ['uses' => 'PostController@index']);

    Route::get('create', ['uses' => 'PostController@create']);
});

Route::group(['prefix' => 'user'], function () {
    Route::get('getall', ['uses' => 'UserController@index'])->middleware('api');

    Route::get('create', ['uses' => 'UserController@create'])->middleware('api');

    Route::post('login', ['uses' => 'UserController@login']);

    Route::get('logout', ['uses' => 'UserController@logout']);

});

Route::group(['prefix' => 'board', 'middleware' => ['api']], function () {
    Route::post('store', ['uses' => 'BoardController@store']);

    Route::get('all', ['uses' => 'BoardController@index']);
});

Route::group(['prefix' => 'column', 'middleware' => ['api']], function () {
    Route::post('store', ['uses' => 'ColumnController@store']);

    Route::post('getColumn', ['uses' => 'ColumnController@getColumnFromBoard']);
});


