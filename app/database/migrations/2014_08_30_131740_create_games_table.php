<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGamesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games', function(Blueprint $table)
		{
			$table->increments('id');
            $table->integer('prize_type_id')->unsigned();
            $table->integer('initiator_id')->unsigned();
            $table->integer('winner_id')->unsigned()->nullable();
//            $table->integer('prize_type_id')->unsigned()->nullable();
            $table->smallInteger('seats')->unsigned();
            $table->decimal('buy_in', 14, 2)->unsigned();
            $table->softDeletes();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('games');
	}

}
