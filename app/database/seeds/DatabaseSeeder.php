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

        Artisan::call('api:fetch-deposits');
        $this->call('PrizeTypesTableSeeder');
        $this->call('CharactersTableSeeder');
        $this->call('GamesTableSeeder');
	}

}
