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

Route::get('/login', 'LoginController@getLogin')->name('login');
Route::post('/login', 'LoginController@postLogin')->name('login');

//routes for admin
Route::prefix('admin')->group(function () {
    Route::get('/', 'AdminController@getAdmin')->name('admin');
    Route::resource('/users', 'UserController');
    Route::post('/profile', 'ProfileController@postProfile')->name('profile.post');
    Route::get('/profile', 'ProfileController@getProfile')->name('profile');
    Route::resource('posts','PostController');
    Route::resource('categories','CategoryController');
    Route::get('/profile/editpassword', 'ProfileController@getEditPassword')->name('editpassword');
    Route::post('/profile/editpassword', 'ProfileController@postEditPassword')->name('editpassword.post');
});

Route::get('/', 'HomeController@index')->name('home');
Route::get('/{cat}/{slug}_pid-{postid}.html', 'SiteController@postDetail');
Route::get('/search', 'SiteController@search');
Route::get('/author_{author}', 'SiteController@author');
Route::get('/{cat}', 'SiteController@category');

