<?php

/**
 * Class SessionsController
 */
class SessionsController extends BaseController {

    /**
     * Show the form for creating a new session
     *
     * @return Response
     */
    public function create()
    {
        return View::make('sessions.login');
    }

    /**
     * Store a newly created session to log the user in.
     *
     * @return Response
     * TODO: If a user tries to login with a character that exists in the Eve DB, but they don't exist in ours (or are marked as inactive), then prompt them to register
     */
    public function store()
    {
        $validator = Validator::make($data = Input::all(), Character::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }
        if (Auth::attempt(array('name' => Input::get('name'), 'password'=>Input::get('password'), 'active' => 1)))
        {
            Session::flash('success', 'Logged in successfully!');
            return Redirect::intended('characters/'.Auth::id());
        }
        else
        {
            Session::flash('danger', 'Login failed!');
            return Redirect::back()->withInput();
        }
    }

    /**
     * Remove the session to log the user out.
     *
     * @return Response
     */
    public function destroy()
    {
        Auth::logout();
        Session::flash('info', 'You have been logged out!');
        return Redirect::route('login');
    }

}
