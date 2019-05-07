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
//
// Route::get('/', function () {
//   echo "投稿一覧ページです";
// });

Route::get('/', 'PostController@index')->middleware('auth');
Route::get('/posts/new', 'PostController@create')->middleware('auth');;
Route::post('/posts', 'PostController@store')->middleware('auth');;
Route::delete('/posts/{id}', 'PostController@destroy')->middleware('auth');;
Route::get('/posts/{id}', 'PostController@show')->middleware('auth');;
Route::get('ajax/favorites/{id}', 'FavoriteController')->middleware('auth');;
Route::post('/comments/{id}', 'CommentController@index')->middleware('auth');;




// Route::resource('posts', 'PostController');
//
// Route::get('/posts/new', function () {
//   echo "投稿ページです";
// });

// Route::get('/posts/19', function () {
//   echo "投稿詳細ページです";
// });

// Route::get('/', 'IndeController@index')

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
