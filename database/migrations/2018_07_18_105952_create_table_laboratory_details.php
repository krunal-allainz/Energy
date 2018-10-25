<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLaboratoryDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Schema::drop('laboratory_details');
        Schema::create('laboratory_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('opd_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('laboratory_id')->nullable();
            $table->datetime('date')->nullable();
            $table->string('result')->nullable();
            $table->string('assign_dr')->nullable();
            $table->string('remove')->nullable();
            $table->tinyInteger('referance')->nullable();
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
        Schema::dropIfExists('laboratory_details');
    }
}
