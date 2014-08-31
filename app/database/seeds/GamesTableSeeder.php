<?php

use Faker\Factory as Faker;

class GamesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();
        $characters = Character::all()->toArray();
        $isk = PrizeType::where('name', '=', 'isk')->firstOrFail();

        foreach(range(1, 50) as $index) {
            $initiator = $faker->randomElement($characters);
            $winner = $faker->randomElement($characters);
            Game::create([
                'prize_type_id' => $isk->id,
                'initiator_id' => $initiator['id'],
                'winner_id' => $winner['id'],
                'seats' => $faker->numberBetween(4, 12),
                'buy_in' => $faker->randomFloat(2, 10000, 50000000),
                'deleted_at' => new DateTime
            ]);
        }

        foreach(range(1, 10) as $index) {
            $initiator = $faker->randomElement($characters);
            Game::create([
                'prize_type_id' => $isk->id,
                'initiator_id' => $initiator['id'],
                'seats' => $faker->numberBetween(4, 12),
                'buy_in' => $faker->numberBetween(10000, 100000000) . 00
            ]);
        }
	}

}