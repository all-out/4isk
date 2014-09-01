<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//        Schema::table('deposits', function(Blueprint $table) {
//            $table->foreign('depositor_id')->references('id')->on('characters');
//        });
//        Schema::table('games', function(Blueprint $table) {
//            $table->foreign('prize_type_id')->references('id')->on('prize_types');
//            $table->foreign('initiator_id')->references('id')->on('characters');
//            $table->foreign('winner_id')->references('id')->on('characters');
//        });
//        Schema::table('characters_games', function(Blueprint $table)
//        {
//            $table->foreign('character_id')->references('id')->on('characters');
//            $table->foreign('game_id')->references('id')->on('games');
//        });
	}



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('deposits', function(Blueprint $table) {
            $table->dropForeign('deposits_depositor_id_foreign');
        });
        Schema::table('games', function(Blueprint $table) {
            $table->dropForeign('games_prize_type_id_foreign');
            $table->dropForeign('games_initiator_id_foreign');
            $table->dropForeign('games_winner_id_foreign');
        });
        Schema::table('characters_games', function(Blueprint $table)
        {
            $table->dropForeign('characters_games_game_id_foreign');
            $table->dropForeign('characters_games_character_id_foreign');
        });
    }

}
