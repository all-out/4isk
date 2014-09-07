<?php

class PrizeTypesTableSeeder extends Seeder {

	public function run()
	{
        PrizeType::create([ 'name' => 'isk' ]);
        PrizeType::create([ 'name' => 'Atron']);
        PrizeType::create([ 'name' => 'Avatar']);
	}

}