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
Route::delete('api/posts/{id}', 'PostController@deletePost');

Route::get('about', 'LandingController@showAbout');

Route::post('/users/{id}/rate', 'StudentController@rateStudent')->name('rateStudent');
Route::post('/professors/{id}/rate', 'ProfessorController@rateProf')->name('rateProf');

// Post page
Route::get('post/{id}', 'PostPageController@show');
Route::put('api/comments', 'PostPageController@createComment');
// Route::delete('api/comments/{id}', 'PostPageController@deleteComment');
Route::put('api/comment/{commentId}/subcomments', 'PostPageController@createSubcomment');
// Route::delete('api/comments/{id}/subcomments/{id}', 'PostPageController@deleteSubComment');

// Students
Route::get('/users/{id}', 'StudentController@show');
Route::post('/users/{id}/editPassword', 'StudentController@editPassword')->name('editPassword');
Route::post('/users/{id}/editProfilePicture', 'StudentController@editProfilePicture')->name('editProfilePicture');
Route::post('/users/{id}/editBio', 'StudentController@editBio')->name('editBio');
Route::get('/users/myCUs/{id}', 'StudentController@requestCUs');
Route::get('/users/myCUsAdmin/{id}', 'StudentController@requestCUsAdmin');
Route::get('/users/myRatings/{id}', 'StudentController@requestRatings');
Route::post('/users/deleteAccount', 'StudentController@deleteAccount')->name('deleteAccount');

// Professors
Route::get('/professors/{id}', 'ProfessorController@show');
Route::post('/professors/{id}/editName', 'ProfessorController@editName')->name('editProfName');
Route::post('/professors/{id}/editAbbrev', 'ProfessorController@editAbbrev')->name('editProfAbbrev');
Route::post('/professors/{id}/editEmail', 'ProfessorController@editEmail')->name('editProfEmail');
Route::post('/professors/{id}/editPicture', 'ProfessorController@editProfilePicture')->name('editProfPicture');
Route::get('professors/{id}/cus', 'ProfessorController@listCUs')->name('listProfCUs');
Route::get('professors/{id}/ratings', 'ProfessorController@requestRatings');


//CUs
Route::get('/cu', 'CUController@showAll');
Route::get('/cu/{id}', 'CUController@show');
Route::put('api/posts/{cu_id}/{feed}', 'PostController@createPostInCUInFeed');
Route::get('/cu/{id}/feed/', 'CUController@feed');
Route::get('/cu/{id}/doubts/', 'CUController@doubts');
Route::get('/cu/{id}/tutoring/', 'CUController@tutoring');
Route::get('/cu/{id}/about/', 'CUController@about');
Route::get('/cu/{id}/classes/', 'CUController@classes');
Route::delete('/cu', 'CUController@destroy');
Route::post('/cu/{id}/editName', 'CUController@editName');
Route::post('/cu/{id}/editAbbrev', 'CUController@editAbbrev');
Route::post('/cu/{id}/editDescription', 'CUController@editDescription');
Route::get('/manageRequests', 'CURequestController@manageRequests')->name('manageRequests');
Route::post('/cu/{id}/rate', 'CUController@rateCU')->name('rateCU');


//Requests
Route::get('/request/cu', 'CURequestController@requestCU');
Route::post('/request/newcu', 'CURequestController@submitRequest');
Route::get('/testRequest', 'CURequestController@testPoll');
Route::get('/manageCreateRequests', 'CURequestController@manageCreateRequests')->name('manageCreateRequests');
Route::get('/manageJoinRequests', 'CURequestController@manageJoinRequests')->name('manageJoinRequests')->middleware('AuthResource');
Route::post('/acceptCreateRequest/{id}', 'CURequestController@acceptCreateRequest')->name('acceptCreateRequest');
Route::post('/denyCreateRequest/{id}', 'CURequestController@denyCreateRequest')->name('denyCreateRequest');
Route::post('/acceptJoinRequest/{id}', 'CURequestController@acceptJoinRequest')->name('acceptJoinRequest');
Route::post('/denyJoinRequest/{id}', 'CURequestController@denyJoinRequest')->name('denyJoinRequest');
Route::post('/askJoinCU/{id}', 'CURequestController@askJoinCU')->name('askJoinCU');

// Authentication
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm');
Route::post('register', 'Auth\RegisterController@register')->name('register');

//Notifications
Route::get('/users/myNotifications/{id}', 'StudentController@notifications');
Route::get('/users/myNotifications/poll/{id}', 'StudentController@pollNotifications');
