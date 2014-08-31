<?php

Route::get('/', ['as' => 'home', function()
{
    return View::make('hello');
}]);

Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@create', 'before' => 'guest']);
Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy', 'before' => 'auth']);
Route::get('register', ['as' => 'register', 'uses' => 'CharactersController@create', 'before' => 'guest']);
Route::post('register', ['as' => 'characters.register', 'uses' => 'CharactersController@register', 'before' => 'guest']);

Route::resource('sessions', 'SessionsController', array('only' => array('create', 'store', 'destroy')));

Route::resource('characters', 'CharactersController');

Route::resource('deposits', 'DepositsController');

Route::resource('games', 'GamesController');