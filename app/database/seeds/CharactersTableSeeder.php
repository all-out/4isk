<?php

class CharactersTableSeeder extends Seeder {

    public function run()
    {
        $character = Character::firstOrNew(array('name' => 'Swift Canton'));
        $character->password = Hash::make('1234');
        $character->active = true;
        $character->save();
    }

}