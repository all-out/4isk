<?php

class GamesController extends \BaseController {

	/**
	 * Display a listing of games
	 *
	 * @return Response
	 */
	public function index()
	{
        $games['inProgress'] = Game::get();
        $games['completed'] = Game::onlyTrashed()->get();

		return View::make('games.index', compact('games'));
	}

	/**
	 * Show the form for creating a new game
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('games.create');
	}

	/**
	 * Store a newly created game in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Game::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Game::create($data);

		return Redirect::route('games.index');
	}

	/**
	 * Display the specified game.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $game = Game::withTrashed()->findOrfail($id);
        dd($game->payout);
        $seats = new \Illuminate\Database\Eloquent\Collection;
        foreach (range(1, $game->seats) as $index)
        {
            $player = $game->players()->where('seat', $index)->first();
            $seats->add($player);
        }

        return View::make('games.show', compact('game', 'seats'));
	}

	/**
	 * Show the form for editing the specified game.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$game = Game::find($id);

		return View::make('games.edit', compact('game'));
	}

	/**
	 * Update the specified game in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$game = Game::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Game::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$game->update($data);

		return Redirect::route('games.index');
	}

	/**
	 * Remove the specified game from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Game::destroy($id);

		return Redirect::route('games.index');
	}

}
