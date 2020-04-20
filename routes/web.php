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

// Route::get('/', 'Auth\LoginController@home');
Route::get('/', 'LandingController@show');
Route::post('/', 'Auth\LoginController@login')->name('login');
// Route::post('/', 'LandingController@register')->name('register2');

// Homepage
Route::get('homepage', 'HomepageController@show')->name('homepage');
Route::put('api/posts', 'HomepageController@createPost');

Route::get('cards/{id}', 'CardController@show');

// Students
Route::get('/users/{id}', 'StudentController@show');
Route::get('/users/myCUs/{id}', 'StudentController@requestCUs');
Route::get('/users/myRatings/{id}', 'StudentController@requestRatings');


// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
