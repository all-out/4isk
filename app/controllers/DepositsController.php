<?php

class DepositsController extends \BaseController {

	/**
	 * Display a listing of deposits
	 *
	 * @return Response
	 */
	public function index()
	{
		$deposits = Deposit::all();

		return View::make('deposits.index', compact('deposits'));
	}

	/**
	 * Show the form for creating a new deposit
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('deposits.create');
	}

	/**
	 * Store a newly created deposit in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Deposit::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Deposit::create($data);

		return Redirect::route('deposits.index');
	}

	/**
	 * Display the specified deposit.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$deposit = Deposit::findOrFail($id);

		return View::make('deposits.show', compact('deposit'));
	}

	/**
	 * Show the form for editing the specified deposit.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$deposit = Deposit::find($id);

		return View::make('deposits.edit', compact('deposit'));
	}

	/**
	 * Update the specified deposit in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$deposit = Deposit::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Deposit::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$deposit->update($data);

		return Redirect::route('deposits.index');
	}

	/**
	 * Remove the specified deposit from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Deposit::destroy($id);

		return Redirect::route('deposits.index');
	}

}
