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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/profile', 'UserController@edit')->middleware('auth')->name('user.edit');
Route::put('/profile', 'UserController@update')->middleware('auth')->name('user.update');
Route::get('/profile/image/{filename}', 'UserController@getImage')->name('user.image');
Route::get('/channel/{user_id}', 'UserController@channel')->middleware('auth')->name('user.channel');

// Video Route
Route::get('/videos/crear', 'VideoController@create')->middleware('auth')->name('video.create');
Route::post('/videos/crear', 'VideoController@store')->middleware('auth')->name('video.store');

Route::post('/videos/{video_id}/dislike', 'VideoLikeController@dislike')->middleware('auth')->name('video.dislike');
Route::post('/videos/{video_id}/like', 'VideoLikeController@like')->middleware('auth')->name('video.like');

Route::get('/buscar/{search?}/{order?}', 'VideoController@search')->name('video.search');

Route::get('/videos/{video_id}', 'VideoController@detail')->name('video.detail');
Route::get('/videos/editar/{video_id}', 'VideoController@edit')->middleware('auth') ->name('video.edit');
Route::put('/videos/editar/{video_id}', 'VideoController@update')->middleware('auth') ->name('video.update');
Route::get('/videos/delete/{video_id}', 'VideoController@delete')->middleware('auth')->name('video.delete');

Route::get('/miniatura/{filename}', 'VideoController@getImage')->name('miniatura.image');
Route::get('/video-file/{filename}', 'VideoController@getVideo')->name('video-file');

Route::post('/comment', 'CommentController@store')->middleware('auth')->name('comment');
Route::get('/comment/{comment_id}', 'CommentController@delete')->middleware('auth')->name('comment.delete');
