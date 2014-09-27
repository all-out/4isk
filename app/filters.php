<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" Filters easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('role', function ($route, $request, $role)
{
    if (!Auth::check())
    {
        Session::flash('warning', 'You must be logged in.');
        return Redirect::route('login');
    }
    if (!Auth::user()->hasRole($role))
    {
        Session::flash('warning', 'You do not have the required permissions.');
        return Redirect::home();
    }
});

Route::filter('self', function ($route, $request)
{
    if (Auth::user()->id != $route->parameters()['id'])
    {
        Session::flash('warning', 'This record does not belong to you.');
        return Redirect::home();
    }
});

Route::filter('self-or-role', function ($route, $request, $role)
{
    if (!Auth::check())
    {
        Session::flash('warning', 'You must be logged in.');
        return Redirect::route('login');
    }
    if (Auth::user()->id != $route->parameters()['id'])
    {
        if (!Auth::user()->hasRole($role))
        {
            Session::flash('warning', 'You can only view your own records.');
            return Redirect::home();
        }
    }
});

Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filters
|--------------------------------------------------------------------------
|
| The "guest" Filters is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filters
|--------------------------------------------------------------------------
|
| The CSRF Filters is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});
