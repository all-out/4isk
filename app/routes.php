<?php

Route::get('/', ['as' => 'home', function()
{
    return View::make('hello');
}]);

Route::resource('sessions', 'SessionsController', ['only' => ['create', 'store', 'destroy']]);
Route::resource('games', 'GamesController');
Route::get('characters/{id}', ['as' => 'characters.show', 'uses' => 'CharactersController@show', 'before' => 'self-or-role:fulfiller']);


/*
 * Guest only
 */
Route::group(['before' => 'guest'], function()
{
    Route::get('login', ['as' => 'login', 'uses' => 'SessionsController@create']);
    Route::get('register', ['as' => 'register', 'uses' => 'CharactersController@create']);
    Route::post('register', ['as' => 'characters.register', 'uses' => 'CharactersController@register']);
});


/*
 * Logged in only
 */
Route::group(['before' => 'auth'], function()
{
    Route::get('logout', ['as' => 'logout', 'uses' => 'SessionsController@destroy']);
});


/*
 * Fulfiller only
 */
Route::group(['before' => 'role:fulfiller'], function()
{
    Route::resource('payouts', 'PayoutsController');
    Route::resource('characters', 'CharactersController');
    Route::patch('payouts/{id}/fulfill', ['as' => 'payouts.fulfill', 'uses' => 'PayoutsController@fulfill']);
});

/**
 * Admin only
 */
Route::group(['before' => 'role:administrator'], function()
{
    Route::resource('deposits', 'DepositsController');
});