<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
    return View::make('hello');
});

Route::get('login', 'SessionsController@create');
Route::get('logout', 'SessionsController@destroy');

Route::get('register', 'CharactersController@create');
Route::post('register', array('as' => 'characters.register', 'uses' => 'CharactersController@register'));
Route::resource('characters', 'CharactersController');

Route::resource('deposits', 'DepositsController');

Route::resource('sessions', 'SessionsController');