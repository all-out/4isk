<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayoutsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payouts', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('winner_id')->unsigned();
            $table->integer('fulfiller_id')->unsigned()->nullable();
            $table->boolean('fulfilled')->default(false);
            $table->boolean('verified')->default(false);
            $table->timestamps();

            $table->foreign('winner_id')->references('id')->on('characters');
            $table->foreign('fulfiller_id')->references('id')->on('characters');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('payouts');
    }

}
