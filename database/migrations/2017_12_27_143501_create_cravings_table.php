<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCravingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cravings', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('status');
            $table->date('time');
            $table->string('food_id');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cravings');
    }
}
