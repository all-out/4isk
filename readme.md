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

#### Thanks to:
- [Laravel](http://laravel.com/)
- [PhealNG](https://github.com/3rdpartyeve/phealng)