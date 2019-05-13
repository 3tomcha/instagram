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

Route::get('/', 'PostController@index');
Route::get('ajax/favorites/{id}', 'FavoriteController')->middleware('auth');
Route::post('ajax/comments/{id}', 'CommentController')->middleware('auth');

Route::resource('posts','PostController')->only([
    'create','store','destroy',
])->middleware('auth');
Auth::routes();
