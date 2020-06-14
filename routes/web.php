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

Route::get('/', 'HomeController@index')->name('dashboard');

Route::group([
    'prefix' => 'admins',
    'middleware' => 'html_minifier'
], function () {
    Route::get('chart', 'HomeController@chart')->name('chart');
    Route::get('table', 'HomeController@table')->name('table');

    Route::group([
        'prefix' => 'categories',
        'middleware' => 'admin_role'
    ], function () {
        Route::get('', 'CategoryController@index')->name('admin.category.index');
        Route::get('create', 'CategoryController@create')->name('admin.category.create');
        Route::post('', 'CategoryController@store')->name('admin.category.store');
        Route::get('{id}/edit', 'CategoryController@edit')->name('admin.category.edit');
        Route::put('{id}/update', 'CategoryController@update')->name('admin.category.update');
        Route::delete('{id}/delete', 'CategoryController@delete')->name('admin.category.delete');
        Route::delete('{id}/delete-ajax', 'CategoryController@deleteAjax')->name('admin.category.deleteAjax');
    });

    Route::group([
        'prefix' => 'posts'
    ], function () {
        Route::get('', 'PostController@index')->name('admin.post.index');
        Route::get('create', 'PostController@create')->name('admin.post.create');
        Route::post('', 'PostController@store')->name('admin.post.store');
        Route::get('{id}/show', 'PostController@show')->name('admin.post.show');
        Route::get('{post}/edit', 'PostController@edit')->name('admin.post.edit')
            ->middleware('can:editPost,post');
        Route::put('{id}/update', 'PostController@update')->name('admin.post.update');
        Route::delete('{id}/delete', 'PostController@delete')->name('admin.post.delete');
        Route::delete('{id}/delete-ajax', 'PostController@deleteAjax')->name('admin.post.deleteAjax');
    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');