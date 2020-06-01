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
Route::get('api/posts', 'PostController@preventError');
Route::delete('api/posts/{id}', 'PostController@deletePost');
Route::get('api/posts/{id}', 'PostController@preventError');

// About
Route::get('about', 'LandingController@showAbout');

// Rating
Route::post('/users/{id}/rate', 'StudentController@rateStudent')->name('rateStudent');
Route::get('/users/{id}/rate', 'StudentController@preventError');
Route::post('/professors/{id}/rate', 'ProfessorController@rateProf')->name('rateProf');
Route::get('/professors/{id}/rate', 'ProfessorController@preventError');

// Post page
Route::get('post/{id}', 'PostPageController@show');
Route::put('api/comments', 'PostPageController@createComment');
Route::get('api/comments', 'PostPageController@preventError');
Route::put('api/comment/{commentId}/subcomments', 'PostPageController@createSubcomment');
Route::get('api/comment/{commentId}/subcomments', 'PostPageController@preventError');

// Students
Route::get('/users/{id}', 'StudentController@show');
Route::post('/users/{id}/editPassword', 'StudentController@editPassword')->middleware('UserAuth')->name('editPassword');
Route::get('/users/{id}/editPassword', 'StudentController@preventError');
Route::post('/users/{id}/editProfilePicture', 'StudentController@editProfilePicture')->middleware('UserAuth')->name('editProfilePicture');
Route::get('/users/{id}/editProfilePicture', 'StudentController@preventError');
Route::post('/users/{id}/editBio', 'StudentController@editBio')->middleware('UserAuth')->name('editBio');
Route::get('/users/{id}/editBio', 'StudentController@preventError');
Route::get('/users/myCUs/{id}', 'StudentController@requestCUs');
Route::get('/users/myCUsAdmin/{id}', 'StudentController@requestCUsAdmin');
Route::get('/users/myRatings/{id}', 'StudentController@requestRatings');
Route::post('/users/deleteAccount', 'StudentController@deleteAccount')->name('deleteAccount');
Route::get('/users/deleteAccount', 'StudentController@preventError');

// Professors
Route::get('/professors/{id}', 'ProfessorController@show');
Route::post('/professors/{id}/editName', 'ProfessorController@editName')->middleware('AdminAuth')->name('editProfName');
Route::get('/professors/{id}/editName', 'ProfessorController@preventError');
Route::post('/professors/{id}/editAbbrev', 'ProfessorController@editAbbrev')->middleware('AdminAuth')->name('editProfAbbrev');
Route::get('/professors/{id}/editAbbrev', 'ProfessorController@preventError');
Route::post('/professors/{id}/editEmail', 'ProfessorController@editEmail')->middleware('AdminAuth')->name('editProfEmail');
Route::get('/professors/{id}/editEmail', 'ProfessorController@preventError');
Route::post('/professors/{id}/editPicture', 'ProfessorController@editProfilePicture')->middleware('AdminAuth')->name('editProfPicture');
Route::get('/professors/{id}/editPicture', 'ProfessorController@preventError');
Route::get('professors/{id}/cus', 'ProfessorController@listCUs')->name('listProfCUs');
Route::get('professors/{id}/ratings', 'ProfessorController@requestRatings');

//CUs
Route::get('/cu', 'CUController@showAll');
Route::get('/cu/{id}', 'CUController@show');
Route::put('api/posts/{cu_id}/{feed}', 'PostController@createPostInCUInFeed');
Route::get('api/posts/{cu_id}/{feed}', 'PostController@preventError');
Route::get('/cu/{id}/feed/', 'CUController@feed');
Route::get('/cu/{id}/doubts/', 'CUController@doubts');
Route::get('/cu/{id}/tutoring/', 'CUController@tutoring');
Route::get('/cu/{id}/about/', 'CUController@about');
Route::get('/cu/{id}/classes/', 'CUController@classes');
Route::delete('/cu', 'CUController@destroy')->middleware('AdminAuth');
Route::post('/cu/{id}/editName', 'CUController@editName')->middleware('AdminAuth');
Route::get('/cu/{id}/editName', 'CUController@preventError');
Route::post('/cu/{id}/editAbbrev', 'CUController@editAbbrev')->middleware('AdminAuth');
Route::get('/cu/{id}/editAbbrev', 'CUController@preventError');
Route::post('/cu/{id}/editDescription', 'CUController@editDescription')->middleware('AdminAuth');
Route::get('/cu/{id}/editDescription', 'CUController@preventError');
Route::post('/cu/{id}/rate', 'CUController@rateCU')->name('rateCU');
Route::get('/cu/{id}/rate', 'CUController@preventError');

//Requests
Route::get('/request/cu', 'CURequestController@requestCU');
Route::post('/request/newcu', 'CURequestController@submitRequest');
Route::get('/request/newcu', 'CURequestController@preventError');
Route::get('/manageCreateRequests', 'CURequestController@manageCreateRequests')->middleware('AdminAuth')->name('manageCreateRequests');
Route::get('/manageJoinRequests', 'CURequestController@manageJoinRequests')->middleware('AdminAuth')->name('manageJoinRequests');
Route::post('/acceptCreateRequest/{id}', 'CURequestController@acceptCreateRequest')->name('acceptCreateRequest');
Route::get('/acceptCreateRequest/{id}', 'CURequestController@preventError');
Route::post('/denyCreateRequest/{id}', 'CURequestController@denyCreateRequest')->name('denyCreateRequest');
Route::get('/denyCreateRequest/{id}', 'CURequestController@preventError');
Route::post('/acceptJoinRequest/{id}', 'CURequestController@acceptJoinRequest')->name('acceptJoinRequest');
Route::get('/acceptJoinRequest/{id}', 'CURequestController@preventError');
Route::post('/denyJoinRequest/{id}', 'CURequestController@denyJoinRequest')->name('denyJoinRequest');
Route::get('/denyJoinRequest/{id}', 'CURequestController@preventError');
Route::post('/askJoinCU/{id}', 'CURequestController@askJoinCU')->name('askJoinCU');
Route::get('/askJoinCU/{id}', 'CURequestController@preventError');

// Authentication
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('login', 'Auth\LoginController@preventError');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::post('register', 'Auth\RegisterController@register')->name('register');
Route::get('register', 'Auth\RegisterController@preventError');

//Notifications
Route::get('/users/myNotifications/{id}', 'StudentController@notifications');
Route::get('/users/myNotifications/poll/{id}', 'StudentController@pollNotifications');