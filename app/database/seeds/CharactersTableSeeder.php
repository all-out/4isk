<?php

class CharactersTableSeeder extends Seeder {

    public function run()
    {
        $admin = Role::create([ 'name' => 'administrator']);
        $fulfiller = Role::create([ 'name' => 'fulfiller']);

        $character1 = Character::firstOrNew(array('name' => 'Swift Canton'));
        $character1->password = Hash::make('1234');
        $character1->active = true;
        $character1->save();
        $character1->roles()->attach($admin);

        $character2 = Character::firstOrNew(array('name' => 'Regis Bloom'));
        $character2->password = Hash::make('1234');
        $character2->active = true;
        $character2->save();
        $character2->roles()->attach($fulfiller);
    }

}