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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('blog/{slug}', ['as' => 'blog.single', 'uses' => 'BlogController@getSingle'])->where('slug', '[\w\d\-\_]+');

Route::get('blog', ['uses' => 'BlogController@getIndex', 'as' => 'blog.index']);

Route::get('contact', 'PagesController@getContact');

Route::post('contact', 'PagesController@postContact');

Route::get('about', 'PagesController@getAbout');

Route::get('/', 'PagesController@getIndex');

// PostController Routes
Route::resource('posts', 'PostController');

// CategoryController Routes
Route::resource('categories', 'CategoryController', ['except' => ['create']]);

// TagController Routes
Route::resource('tags', 'TagController');

// CommentController Routes
Route::post('comments/{post_id}', ['uses' => 'CommentController@store', 'as' => 'comments.store']);
Route::get('comments/{id}/edit', ['uses' => 'CommentController@edit', 'as' => 'comments.edit']);
Route::put('comments/{id}', ['uses' => 'CommentController@update', 'as' => 'comments.update']);
Route::delete('comments/{id}', ['uses' => 'CommentController@destroy', 'as' => 'comments.destroy']);
Route::get('comments/{id}/delete', ['uses' => 'CommentController@delete', 'as' => 'comments.delete']);

// Admin pages routing
Route::get('admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');

Route::post('admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');

Route::get('admin/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

Route::get('/phpinfo', function() {
    return phpinfo();
});
