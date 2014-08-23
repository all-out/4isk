<?php

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
     * Store a newly created session in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (Auth::attempt(Input::only('name', 'password')))
        {
            return Redirect::intended('/');
        }
    }

}
