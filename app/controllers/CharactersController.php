<?php

class CharactersController extends \BaseController {

    /**
     * Display a listing of characters
     *
     * @return Response
     */
    public function index()
    {
        $characters = Character::all();

        return View::make('characters.index', compact('characters'));
    }

    /**
     * Show the form for creating a new character
     *
     * @return Response
     */
    public function create()
    {
        return View::make('characters.create');
    }

    /**
     * Store a newly created character in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make($data = Input::all(), Character::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        Character::create($data);

        return Redirect::route('characters.index');
    }

    /**
     * Display the specified character.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $character = Character::findOrFail($id);

        return View::make('characters.show', compact('character'));
    }

    /**
     * Show the form for editing the specified character.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $character = Character::find($id);

        return View::make('characters.edit', compact('character'));
    }

    /**
     * Update the specified character in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $character = Character::findOrFail($id);

        $validator = Validator::make($data = Input::all(), Character::$rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $character->update($data);

        return Redirect::route('characters.index');
    }

    /**
     * Remove the specified character from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Character::destroy($id);

        return Redirect::route('characters.index');
    }

}
