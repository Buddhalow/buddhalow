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
            $table->boolean('loceryl_applied')->nullable();
            $table->boolean('vaseline_gel_applied')->nullable();
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
