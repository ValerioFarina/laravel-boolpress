<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeController@index')->name('index');

Route::get('/contacts', 'HomeController@contacts')->name('contacts');

Route::get('/posts', 'PostController@index')->name('posts.index');

Route::get('/posts/{slug}', 'PostController@show')->name('posts.show');

Route::get('/categories', 'CategoryController@index')->name('categories.index');

Route::get('/categories/{slug}', 'CategoryController@show')->name('categories.show');

Auth::routes(['register' => false]);

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function() {
    Route::get('/', 'HomeController@index')->name('index');

    Route::get('/profile', 'HomeController@profile')->name('profile');

    Route::post('profile/generate-token', 'HomeController@generateToken')->name('profile.generate-token');

    Route::resource('/posts', 'PostController');

    Route::resource('/categories', 'CategoryController');
});
