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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::resource('tips', 'TipController');

Route::resource('posts', 'PostController');
Route::post('posts/{post}/comments', 'PostCommentController@store');

Route::resource('linux/commands', 'LinuxCommandController');
Route::post('linux/commands/{command}/comments', 'LinuxCommandController@storeComment');

Route::resource('comments', 'CommentController');

Route::resource('notes', 'NoteController');

Route::resource('news/feeds', 'News\FeedController');
Route::resource('news', 'News\PostController');

Route::resource('task_boards', 'TaskBoardController');
