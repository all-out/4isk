<?php

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Support\Collection;

class VerifyPayouts extends ScheduledCommand {

    // Create an empty array to store Payouts.
    protected $transactions = array();

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'api:verify-payouts';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Check fulfilled Payouts against the Eve API to confirm the Fulfiller has paid the Winner.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

    /**
     * When a command should run
     *
     * @param Scheduler $scheduler
     * @return \Indatus\Dispatcher\Scheduling\Schedulable
     */
    public function schedule(Schedulable $scheduler)
    {

        return $scheduler->minutes('0,30');
    }

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
        foreach ($this->getFulfillers() as $fulfiller)
        {
            $this->getFulfillerTransactions($fulfiller);
        }

        $this->verifyPayouts();
    }

    /**
     * Get a list of Fulfillers with API credentials.
     *
     * @return array
     */
    protected function getFulfillers()
    {
        // Get all fulfillers who have API credentials.
        $fulfillers = Character::whereNotNull('key_id')->whereNotNull('v_code')->whereHas('roles', function($q)
        {
            $q->where('name', '=', 'fulfiller');
        })->get();

        return $fulfillers;
    }

    /**
     * Create an array of Player Donations a fulfiller has made that are negative.
     *
     * @param array $fulfiller Character with Fulfiller role
     * @param int $lastRefID The last entry on a page of the WalletJournal, used to find the start of the next page.
     * @return void
     */
    protected function getFulfillerTransactions($fulfiller, $lastRefID = null)
    {
        // Setup PhealNG and make a call to the Character's WalletJournal endpoint to grab some entries.
        Config::get('phealng');
        $pheal = new Pheal($fulfiller->key_id, $fulfiller->v_code, $fulfiller->id);
        $query = $pheal->charScope->WalletJournal(array(
            'characterID' => $fulfiller->id,
            'fromID' => $lastRefID,
            'rowCount' => 2560
        ));

        // Create an empty array to store RefIDs (so that we can find the lowest one later).
        $refIDs = array();

        foreach ($query->transactions as $transaction)
        {
            // Store all refIDs, even those that aren't related Player Donations.
            array_push($refIDs, $transaction->refID);
            // Only check Player Donations that are negative.
            if ($transaction->refTypeID == 10 && $transaction->amount < 0) {
                $transaction->amount = floatval($transaction->amount);
                array_push($this->transactions, $transaction);
            }
        }

        // Recurse through the function, using a new starting point each time. When the API stops returning entries min
        // will throw an ErrorException. Instead of returning the Exception, we return a report and save it to the log.
        try {
            $this->getFulfillerTransactions($fulfiller, min($refIDs));
        }
        catch (Exception $e) {
            return;
        }
    }

    /**
     * Search through all fulfilled, unverified Payouts and check them against the list of transactions.
     *
     * @return void
     */
    protected function verifyPayouts()
    {
        $payouts = Payout::unverified()->get();
        $transactions = new Collection($this->transactions);

        foreach ($payouts as $payout)
        {
            $output = 'Verifying Payout #' . $payout->id . "\n";
            foreach ($transactions as $transaction)
            {
                // Check the amount, winner and fulfiller all match
                // Any one of these being off will cause it to not verify. In future I might want to make this more
                // robust and check to see if a different fulfiller submitted it.
                if ($payout->prizes['isk'] == $transaction->amount * -1 &&
                    $transaction->ownerID2 == $payout->winner_id &&
                    $transaction->ownerID1 == $payout->fulfiller_id)
                {
                    // Mark as verified
                    $payout->verified = true;
                    $payout->save();

                    // Log output
                    $output .= 'Payout #: ' . $payout->id . "\n";
                    $output .= 'Amount Expected: ' . $payout->prizes['isk'] . "\n";
                    $output .= 'Amount Sent: ' . $transaction->amount * -1 . "\n";
                    $output .= 'Winner: ' . $payout->winner->name . "\n";
                    $output .= 'Fulfiller: ' . $payout->fulfiller->name . "\n";
                }
            }
        }

        Log::info($output);
        echo $output;
    }

}
