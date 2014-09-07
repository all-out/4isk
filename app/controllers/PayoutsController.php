<?php

/**
 * Class PayoutsController
 * TODO: Merge multiple games into one payout
 * TODO: Verify that a fulfiller has completed a payout via the Eve API
 */
class PayoutsController extends \BaseController {

	/**
	 * Display a listing of payouts
	 *
	 * @return Response
	 */
	public function index()
	{
        $payouts = Payout::with('winner', 'fulfiller', 'games')->get();

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
        $payout = Payout::with('winner', 'fulfiller', 'games')->find($id);

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

    /**
     * Mark the payout as fulfilled and record who did it.
     *
     * @param  int  $id
     * @return Response
     */
    public function fulfill($id)
    {
        $payout = Payout::findOrFail($id);

        $payout->fulfilled = true;
        $payout->fulfiller_id = Auth::id();

        if ($payout->save())
        {
            Session::flash('success', 'Payout #' . $payout->id . ' marked as fulfilled!');
            return Redirect::back();
        }

        Session::flash('danger', 'Could not mark Payout as fulfilled.');
        return Redirect::back();
    }

}
