<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeys extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('deposits', function(Blueprint $table) {
            $table->foreign('depositor_id')->references('id')->on('characters')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
        Schema::table('games', function(Blueprint $table) {
            $table->foreign('initiator_id')->references('id')->on('characters')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('winner_id')->references('id')->on('characters')
                ->onDelete('restrict')
                ->onUpdate('restrict');
        });
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
            $table->dropForeign('game_initiator_id_foreign');
            $table->dropForeign('game_winner_id_foreign');
        });
	}

}
