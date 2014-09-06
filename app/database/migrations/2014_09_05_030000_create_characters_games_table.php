<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCharactersGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('characters_games', function(Blueprint $table)
		{
            $table->increments('id');
            $table->integer('game_id')->unsigned();
            $table->smallInteger('seat')->unsigned();
			$table->integer('character_id')->unsigned();
			$table->timestamps();

            $table->foreign('character_id')->references('id')->on('characters');
            $table->foreign('game_id')->references('id')->on('games');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('characters_games');
	}

}
