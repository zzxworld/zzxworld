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
Route::get('user/sessions/check', 'User\SessionController@check');

Route::resource('users', 'User\UserController');

Route::resource('posts', 'PostController');
Route::post('posts/{post}/comments', 'PostCommentController@store');

Route::resource('linux/commands', 'LinuxCommandController');
Route::post('linux/commands/{command}/comments', 'LinuxCommandController@storeComment');

Route::resource('comments', 'CommentController');

Route::resource('news/feeds', 'News\FeedController');
Route::resource('news', 'News\PostController');

Route::resource('task_boards', 'TaskBoardController');

Route::resource('notes', 'NoteController');
Route::get('notebooks', 'NoteController@notebook');

Route::resource('tool/segmentwords', 'Tool\SegmentWordController', ['only' => ['index', 'store']]);

Route::resource('sites', 'SiteController');
Route::get('sites/{site}/go', 'SiteController@go');
Route::get('sites/tags/{id}', 'SiteController@tagSiteIndex');

// 管理功能
Route::namespace('Admin')->middleware('admin')->prefix('admin')->group(function () {
    Route::delete('sites/bulk_destroy', 'SiteController@bulkDestroy');
    Route::put('sites/bulk_update_detail', 'SiteController@bulkUpdateDetail');
    Route::resource('sites', 'SiteController');
});
