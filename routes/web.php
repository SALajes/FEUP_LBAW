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

Route::get('/', 'LandingController@show');

// Homepage
Route::get('homepage', 'PostController@show')->name('homepage');
Route::put('api/posts', 'PostController@createPost');
Route::put('api/posts/{cu_id}/{feed}', 'PostController@createPostInCUInFeed');
Route::delete('api/posts/{id}', 'PostController@deletePost');

// Students
Route::get('/users/{id}', 'StudentController@show');
Route::post('/users/{id}/editPassword', 'StudentController@editPassword')->name('editPassword');
Route::post('/users/{id}/editProfilePicture', 'StudentController@editProfilePicture')->name('editProfilePicture');
Route::post('/users/{id}/editBio', 'StudentController@editBio')->name('editBio');
Route::get('/users/myCUs/{id}', 'StudentController@requestCUs');
Route::get('/users/myCUsAdmin/{id}', 'StudentController@requestCUsAdmin');
Route::get('/users/myRatings/{id}', 'StudentController@requestRatings');

//CUs
Route::get('/cu', 'CUController@showAll');
Route::get('/cu/{id}', 'CUController@show');
Route::get('/cu/{id}/feed/', 'CUController@feed');
Route::get('/cu/{id}/doubts/', 'CUController@doubts');
Route::get('/cu/{id}/tutoring/', 'CUController@tutoring');
Route::get('/cu/{id}/about/', 'CUController@about');
Route::get('/cu/{id}/classes/', 'CUController@classes');
Route::delete('/cu', 'CUController@delete');

// Authentication
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register')->name('register');
