<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharactersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('characters', function(Blueprint $table)
		{
            $table->increments('id');
            $table->string('name', 24)->unique();
            $table->string('password', 70)->nullable();
            $table->decimal('balance', 14, 2)->default(0.00);
            $table->string('key_id', 8)->nullable();
            $table->string('v_code', 64)->nullable();
            $table->boolean('active')->default(false);
            $table->rememberToken();
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
		Schema::drop('characters');
	}

}
