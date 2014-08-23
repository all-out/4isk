<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class FetchDeposits extends Command {

    protected $nonDeposits = 0;
    protected $existingDeposits = 0;
    protected $newDeposits = 0;
    protected $iskAdded = 0;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'deposits:fetch';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Check WalletJournal for new deposits and save to storage.';

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
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$this->info($this->saveNewDeposits());
	}

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(

        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

    /**
     * Check WalletJournal for new deposits and save to storage.
     *
     * @param int $lastRefID The last entry on a "page", used to find the start of the next "page".
     */
    protected function saveNewDeposits($lastRefID = null)
    {
        // Setup PhealNG and make a call to the WalletJournal endpoint to grab some entries.
        $pheal = new Pheal(Config::get('phealng.keyID'), Config::get('phealng.vCode'));
        $query = $pheal->corpScope->WalletJournal(array(
            'rowCount' => 3,
            'fromID' => $lastRefID
        ));

        // Allow mass assignment so we can add records to our secure Deposit model.
        Eloquent::unguard();
        // Create an empty array to store RefIDs (so that we can find the lowest one later).
        $refIDs = array();

        foreach ($query->entries as $entry)
        {
            // Store all refIDs, even those that aren't related Player Donations.
            array_push($refIDs, $entry->refID);
            // Only check Player Donations
            if ($entry->refTypeID == 10)
            {
                // If the refID exists in storage, ignore that entry. Otherwise, save it.
                $newDeposit = Deposit::firstOrNew(array('ref_id' => $entry->refID));
                if (empty($newDeposit['original']))
                {
                    $newDeposit->amount = $entry->amount;
                    $newDeposit->reason = trim($entry->reason);
                    $newDeposit->sent_at = $entry->date;
                    if ($newDeposit->save())
                    {
                        $this->newDeposits++;
                        $this->iskAdded += $entry->amount;
                    }
                }
                else if (!empty($newDeposit['original'])) $this->existingDeposits++;
            }
            else $this->nonDeposits++;
        }

        // Recurse through the function, using a new starting point each time. When the API stops returning entries min
        // will throw an ErrorException. Instead of returning the Exception, we return an int reporting how many new
        // records were saved to the storage.
        try {
            $this->saveNewDeposits(min($refIDs));
        }
        catch (Exception $e) {
            echo "Unrelated entries ignored: " . $this->nonDeposits . "\n";
            echo "Existing Deposits ignored: " . $this->existingDeposits . "\n";
            echo "New Deposits saved: " . $this->newDeposits . "\n";
            echo "Total deposited since last fetch: " . $this->iskAdded . " isk\n";
        }
    }

}
