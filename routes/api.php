<?php

use Illuminate\Http\Request;

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



Route::post('login', 'API\UserController@login');

Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');

    Route::post('family/store','FamilyController@store');

    Route::post('family/addMember','FamilyController@addMember')->middleware('sameFamily');

    Route::post('family/search','FamilyController@search');

    Route::post('user/update','API\UserController@update');

    Route::post('post/store','PostController@store');

    Route::get('post/show','PostController@show');

    Route::post('event/store','EventController@store');

    Route::get('user/index','API\UserController@index');

    Route::get('post/index','PostController@index');

    Route::get('event/index','EventController@index');
});

