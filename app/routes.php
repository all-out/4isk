<?php

/**
 * TODO: Restrict access to login and register routes when already authenticated
 * TODO:
 */

Route::get('/', ['as' => 'home', function()
{
    return View::make('hello');
}]);

Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@create']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
Route::get('register', ['as' => 'register', 'uses' => 'CharactersController@create']);
Route::post('register', ['as' => 'characters.register', 'uses' => 'CharactersController@register']);

Route::resource('characters', 'CharactersController');

Route::resource('deposits', 'DepositsController');

Route::resource('sessions', 'SessionsController', array('only' => array('create', 'store', 'destroy')));
