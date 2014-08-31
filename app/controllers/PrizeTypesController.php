<?php

class PrizeTypesController extends \BaseController {

	/**
	 * Display a listing of prizetypes
	 *
	 * @return Response
	 */
	public function index()
	{
		$prizetypes = Prizetype::all();

		return View::make('prizetypes.index', compact('prizetypes'));
	}

	/**
	 * Show the form for creating a new prizetype
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('prizetypes.create');
	}

	/**
	 * Store a newly created prizetype in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Prizetype::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Prizetype::create($data);

		return Redirect::route('prizetypes.index');
	}

	/**
	 * Display the specified prizetype.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$prizetype = Prizetype::findOrFail($id);

		return View::make('prizetypes.show', compact('prizetype'));
	}

	/**
	 * Show the form for editing the specified prizetype.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$prizetype = Prizetype::find($id);

		return View::make('prizetypes.edit', compact('prizetype'));
	}

	/**
	 * Update the specified prizetype in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$prizetype = Prizetype::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Prizetype::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$prizetype->update($data);

		return Redirect::route('prizetypes.index');
	}

	/**
	 * Remove the specified prizetype from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Prizetype::destroy($id);

		return Redirect::route('prizetypes.index');
	}

}
