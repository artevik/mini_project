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

Route::get('/', 'PostController@index')->name('welcome');
Route::get('posts/{id}', 'PostController@show')->name('showPost');
Route::get('posts', 'PostController@create')->name('addPost');
Route::post('posts', 'PostController@store')->name('storePost');
Route::get('posts/{id}/edit', 'PostController@edit')->name('editPost');

//Comments
Route::post('comment/{post_id}', ['as' => 'comments.store', 'uses' => 'CommentController@store']);
Route::post('comment/reply', 'CommentController@replyStore')->name('reply.add');

Route::post('posts/{id}/sort', 'PostController@show')->name('comments.sort');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile/update', 'ProfileController@updateProfile')->name('profile.update');
