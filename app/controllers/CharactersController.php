<?php

class CharactersController extends \BaseController {

    /**
     * Display a listing of characters
     *
     * @return Response
     */
    public function index()
    {
        $characters = Character::with('deposits')->get();

        return View::make('characters.index', compact('characters'));
    }

    /**
     * Show the form for creating a new character
     *
     * @return Response
     */
    public function create()
    {
        return View::make('characters.register');
    }

    /**
     * Decide whether to update an existing character, or create a new one.
     *
     * @return Response
     * TODO: Automatically create a new session for the new user so they don't have to enter their credentials again
     */
    public function register()
    {
        $validator = Validator::make($data = Input::only('name', 'password'), Character::$rules);
        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $pheal = new Pheal(Config::get('phealng.keyID'), Config::get('phealng.vCode'));
        $query = $pheal->eveScope->CharacterID(array(
            'names' => $data['name']
        ));

        foreach ($query->characters as $character) $data['characterID'] = $character->characterID;
        if ($data['characterID'])
        {
            $character = Character::firstOrNew(array('name' => Input::get('name')));
            if (!$character->active)
            {
                $character->id = $data['characterID'];
                $character->name = $data['name'];
                $character->password = Hash::make($data['password']);
                $character->active = 1;
                if ($character->save()) return Redirect::route('login');
            }
            else
            {
                return Redirect::back()->withErrors(array('name' => 'This character is already registered.'))->withInput();
            }
        }
        else
        {
            return Redirect::back()->withErrors(array('name' => 'No character with this name could be found.'))->withInput();
        }
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
        $character->load('deposits');

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
