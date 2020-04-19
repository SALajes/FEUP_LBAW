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

Route::get('/homepage', 'HomepageController@show')->name('homepage');

Route::get('cards/{id}', 'CardController@show');

// Students
Route::get('users', 'StudentController@show');
Route::get('users/{id}', 'StudentController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');

// Authentication
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register')->name('register');
