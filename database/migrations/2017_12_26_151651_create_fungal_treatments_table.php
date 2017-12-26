<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFungalTreatmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fungal_treatments', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->boolean('terbinafine_gel_applied')->nullable();
            $table->text('amorolfine_applied')->nullable();
            $table->integer('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('fungal_treatments');
    }
}
