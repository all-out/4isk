<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DropForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
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
            $table->dropForeign('games_payout_id_foreign');
        });
        Schema::table('characters_games', function(Blueprint $table)
        {
            $table->dropForeign('characters_games_game_id_foreign');
            $table->dropForeign('characters_games_character_id_foreign');
        });
        Schema::table('characters_roles', function(Blueprint $table)
        {
            $table->dropForeign('characters_roles_role_id_foreign');
            $table->dropForeign('characters_roles_character_id_foreign');
        });
        Schema::table('payouts', function(Blueprint $table)
        {
            $table->dropForeign('payouts_winner_id_foreign');
            $table->dropForeign('payouts_fulfiller_id_foreign');
        });
    }

}
