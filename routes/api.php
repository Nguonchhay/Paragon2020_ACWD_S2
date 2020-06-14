<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('categories', 'API\CategoryAPIController@index')->name('api.category.index');
Route::middleware('api_token')->post('categories', 'API\CategoryAPIController@store')->name('api.category.store');
Route::put('categories/{category}/update', 'API\CategoryAPIController@update')->name('api.category.update');
Route::delete('categories/{category}/delete', 'API\CategoryAPIController@delete')->name('api.category.delete');