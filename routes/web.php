<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*
 * чому не працює такий роут у папку
 *
 * Route::get('reg', 'User\RegController@index');
 */

//route registration

Route::get('reg/user', 'RegController@create');
Route::post('reg', 'RegController@store');
Route::get('reg/show', 'RegController@show');

//route auth

Route::get('auth/user', 'AutheController@auth');
Route::post('auth', 'AutheController@store');
Route::post('auth/logout', 'AutheController@logout');


//rout news

Route::get('news', 'NewsController@index');
