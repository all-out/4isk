<?php

use Faker\Factory as Faker;

class GamesTableSeeder extends Seeder {

    public function putPlayersInSeats($game, $seats, $initiator, $winner = null)
    {
        $players = [];

        // Add initiator
        $game->players()->attach($initiator['id'], ['seat' => 1]);

        // Add winner
        if ($winner) {
            $game->players()->attach($winner['id'], ['seat' => $seats]);
        }

        // Add some other players
        $faker = Faker::create();
        $characters = Character::all()->toArray();
        for ($i = 2; $i < $seats; $i++) {
            $character = $faker->randomElement($characters);
            $game->players()->attach($character['id'], ['seat' => $i]);
        }

        return $players;
    }

	public function run()
	{
		$faker = Faker::create();
        $characters = Character::all()->toArray();
        $isk = PrizeType::where('name', '=', 'isk')->firstOrFail();

        // Completed
        foreach(range(1, 20) as $index) {
            $initiator = $faker->randomElement($characters);
            $winner = $faker->randomElement($characters);
            $seats = $faker->numberBetween(4, 12);

            $game = Game::create([
                'prize_type_id' => $isk->id,
                'initiator_id' => $initiator['id'],
                'winner_id' => $winner['id'],
                'seats' => $seats,
                'buy_in' => $faker->randomFloat(2, 10000, 50000000),
                'deleted_at' => new DateTime
            ]);

            $this->putPlayersInSeats($game, $seats, $initiator, $winner);
        }

        // In Progress
        foreach(range(1, 5) as $index) {
            $initiator = $faker->randomElement($characters);
            $seats = $faker->numberBetween(4, 12);
            $numberOfPlayers = $faker->numberBetween(0, $seats);

            $game = Game::create([
                'prize_type_id' => $isk->id,
                'initiator_id' => $initiator['id'],
                'seats' => $seats,
                'buy_in' => $faker->numberBetween(10000, 100000000) . 00
            ]);

            $this->putPlayersInSeats($game, $numberOfPlayers, $initiator);
        }
	}

}