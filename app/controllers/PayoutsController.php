<?php

class PayoutsController extends \BaseController {

	/**
	 * Display a listing of payouts
	 *
	 * @return Response
	 */
	public function index()
	{
        $payouts = Payout::with('winner', 'fulfiller', 'games')->get();
        dd($payouts);

		return View::make('payouts.index', compact('payouts'));
	}

	/**
	 * Show the form for creating a new payout
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('payouts.create');
	}

	/**
	 * Store a newly created payout in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Payout::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Payout::create($data);

		return Redirect::route('payouts.index');
	}

	/**
	 * Display the specified payout.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $payout = Payout::with('winner', 'fulfiller')->find($id);

        return View::make('payouts.show', compact('payout'));
	}

	/**
	 * Show the form for editing the specified payout.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$payout = Payout::find($id);

		return View::make('payouts.edit', compact('payout'));
	}

	/**
	 * Update the specified payout in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$payout = Payout::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Payout::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$payout->update($data);

		return Redirect::route('payouts.index');
	}

	/**
	 * Remove the specified payout from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Payout::destroy($id);

		return Redirect::route('payouts.index');
	}

}
