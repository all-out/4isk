<?php

class PrizeTypesTableSeeder extends Seeder {

	public function run()
	{
        PrizeType::create([
            'name' => 'isk'
        ]);
	}

}