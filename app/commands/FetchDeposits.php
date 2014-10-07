<?php

use Indatus\Dispatcher\Scheduling\ScheduledCommand;
use Indatus\Dispatcher\Scheduling\Schedulable;
use Indatus\Dispatcher\Drivers\Cron\Scheduler;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class FetchDeposits extends ScheduledCommand {

    protected $nonDeposits = 0;
    protected $existingDeposits = 0;
    protected $newDeposits = 0;
    protected $newCharacters = 0;
    protected $iskAdded = 0;

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'api:fetch-deposits';

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
        $this->saveNewDeposits();
	}

    /**
     * Check WalletJournal for new deposits and save to storage.
     *
     * @param int $lastRefID The last entry on a page of the WalletJournal, used to find the start of the next page.
     * @return void
     */
    protected function saveNewDeposits($lastRefID = null)
    {
        // Setup PhealNG and make a call to the Corporation's WalletJournal endpoint to grab some entries.
        Config::get('phealng');
        $pheal = new Pheal(Config::get('phealng.keyID'), Config::get('phealng.vCode'));
        $query = $pheal->corpScope->WalletJournal(array(
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
            // Only check Player Donations.
            if ($entry->refTypeID == 10)
            {
                // If the Character doesn't already exist in our storage, let's add it.
                $character = Character::firstOrNew(array('id' => $entry->ownerID1, 'name' => $entry->ownerName1));
                if (empty($character['original']))
                {
                    $this->newCharacters++;
                }

                // If the refID exists in storage, ignore that entry. Otherwise, save it.
                $deposit = Deposit::firstOrNew(array('ref_id' => $entry->refID));
                if (empty($deposit['original']))
                {
                    $deposit->depositor_id = $entry->ownerID1;
                    $deposit->amount = $entry->amount;
                    $deposit->reason = trim($entry->reason);
                    $deposit->sent_at = $entry->date;
                    // Now that we know if the Deposit is new or not, we can se the Character's updated balance.
                    $character->balance = $character->balance + $entry->amount;
                    if ($character->save() && $deposit->save())
                    {
                        $this->newDeposits++;
                        $this->iskAdded += $entry->amount;
                    }
                }
                else if (!empty($deposit['original'])) $this->existingDeposits++;
            }
            else $this->nonDeposits++;
        }

        // Recurse through the function, using a new starting point each time. When the API stops returning entries min
        // will throw an ErrorException. Instead of returning the Exception, we return a report and save it to the log.
        try {
            $this->saveNewDeposits(min($refIDs));
        }
        catch (Exception $e) {
            $output = "Unrelated entries ignored: " . $this->nonDeposits . "\n";
            $output .= "Existing Deposits ignored: " . $this->existingDeposits . "\n";
            $output .= "New Deposits saved: " . $this->newDeposits . "\n";
            $output .= "New (inactive) Characters added: " . $this->newCharacters . "\n";
            $output .= "Total deposited since last fetch: " . $this->iskAdded . " isk\n";
            Log::info($output);
            echo $output;
        }
    }

}
