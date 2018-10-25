<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpdDetailsOptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('opd_details_option', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('opd_id')->nullable();
            $table->text('history')->nullable();
            $table->text('past_history')->nullable();
            $table->text('advice')->nullable();
            $table->text('follow_up')->nullable();
            $table->text('provisional_diagnosis')->nullable();
            $table->text('diagnosis')->nullable();
            $table->boolean('status'); 
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
        Schema::dropIfExists('opd_details_option');
    }
}
