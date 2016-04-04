<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::auth();
Route::get('/', ['uses' => 'MainController@home', 'as' => 'home']);

Route::get('/addLike/{post_id}', 'MainController@addLike');
Route::get('/user/{user_id}', 'MainController@showUser');
Route::post('/addPost', 'MainController@addPost');
Route::post('/deletePost/{post_id}', 'MainController@deletePost');
Route::post('/makeRepost/{post_id}', 'RepostController@makeRepost');


Route::get('/home', 'HomeController@index');
