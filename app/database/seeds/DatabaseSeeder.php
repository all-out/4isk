<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        Artisan::call('deposits:fetch');
        $this->call('CharactersTableSeeder');
        $this->call('PrizeTypesTableSeeder');
        $this->call('GamesTableSeeder');
	}

}
