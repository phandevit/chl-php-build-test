<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'ProductsController@index');
Route::get('/product/add', 'ProductsController@add')->middleware('auth');
Route::post('/product/add', 'ProductsController@store')->middleware('auth');
Route::get('/product/{id}', 'ProductsController@show');
Route::post('/product/{id}', 'ProductsController@approveReviews')->middleware('auth');

Route::get('/review/add/{id}', 'ReviewsController@add');
Route::post('/review/add/{id}', 'ReviewsController@store');
