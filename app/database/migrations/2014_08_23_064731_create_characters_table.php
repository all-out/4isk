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
            $table->integer('id')->primary()->unsigned();
            $table->string('name', 24)->unique();
            $table->string('password', 32)->nullable();
            $table->decimal('balance', 14, 2)->default(0.00);
            $table->boolean('active')->default(false);
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
