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
Route::get('/admin/chart', 'HomeController@chart')->name('chart');
Route::get('/admin/table', 'HomeController@table')->name('table');

Route::get('/admins/categories', 'CategoryController@index')->name('admin.category.index');
Route::get('/admins/categories/create', 'CategoryController@create')->name('admin.category.create');
Route::post('/admins/categories', 'CategoryController@store')->name('admin.category.store');
Route::get('/admins/categories/{id}/edit', 'CategoryController@edit')->name('admin.category.edit');
Route::put('/admins/categories/{id/update', 'CategoryController@update')->name('admin.category.update');
Route::delete('/admins/categories/{id}/delete', 'CategoryController@delete')->name('admin.category.delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');