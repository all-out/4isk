# 4isk - Eve Online Gaming Platform
4isk is a boilerplate web application for facilitating the creation of gaming websites in Eve Online, with
functionality to allow the depositing of in-game currency and the facilities to manage related processes such as
withdrawals and support.

## Deposits
Player Donations are fetched from the /Corp/WalletJournal endpoint and this value is added to a User's account balance.
Individual Deposits are saved into storage for the purposes of auditing. The Deposits model is also used for keeping
track of prizes paid out. These alternative Deposits will have the field Reason set to "prize".

## Characters
Characters are the "Users" of 4isk. Players will register an account under their Eve Online character name, rather than
a typical username or email address. Hopefully when the upcoming Eve Single Sign On (SSO) gets a public release,
integrating that should be relatively straightforward.

## Payouts & Fulfillers
When a game is won, a Payout is created for the winning Character. For now they're ISK amounts. In future, if there is
a large volume of payouts to handle, several could be merged into one. They could be extended to include items and
ships also.

Fulfillers are Characters that can see Payouts and mark the pending ones as Fulfilled. The Fulfiller's API credentials
will be used to check if the payment was actually made to the winning Character and if the amount was correct.

#### Thanks to:
- [Laravel](http://laravel.com/)
- [PhealNG](https://github.com/3rdpartyeve/phealng)
- [Dispatcher](https://github.com/Indatus/dispatcher)


----------

## Commands

PHP Artisan is used to set up and administrate 4isk:

`php artisan migrate` creates the database tables.

`php artisan db:seed` fills them with dummy data. Once a release is ready the seeder will be simplified to just create any necessary static data for a clean install (i.e. Roles).

`php artisan api:fetch-deposits` fetches all the player donations to a corporation (via it's API credentials, set in config/{env}/phealng.php), saves them to the Deposits storage, and updates Character's balances.

`php artisan api:verify-payouts` will check if Fulfiller's did their job properly and didn't pocket the ISK. Requires the Fulfiller to have entered their API credentials.

These last 2 commands are scheduled to run every half hour. Uses [Dispatcher](https://github.com/Indatus/dispatcher): [How to set it up with Cron](https://github.com/Indatus/dispatcher#Cron).