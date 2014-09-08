<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCharactersRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('characters_roles', function(Blueprint $table)
		{
            $table->integer('character_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->unique(['character_id', 'role_id']);

            $table->foreign('character_id')->references('id')->on('characters');
            $table->foreign('role_id')->references('id')->on('roles');
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('characters_roles');
	}

}
