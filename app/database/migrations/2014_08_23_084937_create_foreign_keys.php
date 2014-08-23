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
	}

}
