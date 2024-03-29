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
Route::get('/book', 'GoogleAPIController@book');
Route::get('/map', 'GoogleAPIController@map');
Route::get('/bookshow', 'GoogleAPIController@bookshow');

Route::get('/test', 'ReviewpostController@index');
Route::get('/test/{post}', 'ReviewpostController@show');


Route::get('/', 'PostController@index');
Route::post('/posts', 'PostController@store');
Route::get('/posts/create', 'PostController@create');
Route::get('/posts/{post}', 'PostController@show');
Route::get('/posts/{post}/edit', 'PostController@edit');
Route::get('/posts/{post}/role', 'PostController@role');
Route::put('/posts/{post}', 'PostController@update');
Route::delete('/posts/{post}', 'PostController@delete');
Route::get('/categories/{category}', 'CategoryController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::post('/charge', 'ChargeController@charge');
