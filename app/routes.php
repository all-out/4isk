<?php

Route::get('/', ['as' => 'home', function()
{
    return View::make('hello');
}]);

Route::get('login', [
    'as' => 'login',
    'uses' => 'SessionsController@create',
    'before' => 'guest'
]);

Route::get('logout', [
    'as' => 'logout',
    'uses' => 'SessionsController@destroy',
    'before' => 'auth'
]);

Route::get('register', [
    'as' => 'register',
    'uses' => 'CharactersController@create',
    'before' => 'guest'
]);

Route::post('register', [
    'as' => 'characters.register',
    'uses' => 'CharactersController@register',
    'before' => 'guest'
]);

Route::resource('sessions', 'SessionsController', [
    'only' => ['create', 'store', 'destroy']
]);


Route::group([], function()
{
    Route::resource('games', 'GamesController');
});


Route::group(['before' => 'role:fulfiller'], function()
{
    Route::resource('characters', 'CharactersController');
});


Route::group(['before' => 'role:fulfiller'], function()
{
    Route::resource('payouts', 'PayoutsController');

    Route::patch('payouts/{id}/fulfill', [
        'as' => 'payouts.fulfill',
        'uses' => 'PayoutsController@fulfill'
    ]);
});


Route::group(['before' => 'role:administrator'], function()
{
    Route::resource('deposits', 'DepositsController');
});