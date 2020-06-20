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

Route::group([
    'namespace' => 'API',
    'middleware' => ['api_client']
], function () {

});

Route::middleware('api_token')->post('categories', 'API\CategoryAPIController@store')->name('api.category.store');
Route::put('categories/{category}/update', 'API\CategoryAPIController@update')->name('api.category.update');
Route::delete('categories/{category}/delete', 'API\CategoryAPIController@delete')->name('api.category.delete');

Route::post('/login', 'API\UserAPIController@login')->name('api.login');


Route::group([
    'namespace' => 'API',
    'middleware' => ['auth:api']
], function () {

    Route::group([
        'middleware' => ['admin_role']
    ], function () {
        Route::get('categories', 'CategoryAPIController@index')->name('api.category.index');
    });

    Route::post('/posts', 'PostAPIController@store')->name('api.post.store');
});