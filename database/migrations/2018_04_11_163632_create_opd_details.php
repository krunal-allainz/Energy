<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOpdDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opd_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->nullable();
            $table->string('uhid_no')->nullable();
            $table->string('opd_id')->nullable();
            $table->dateTime('admit_datetime')->nullable();
            $table->dateTime('discharge_datetime')->nullable();
            $table->dateTime('appointment_datetime')->nullable();
            $table->text('history')->nullable();
            $table->text('past_history')->nullable();
            $table->text('advice')->nullable();
            $table->text('follow_up')->nullable();
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
        Schema::dropIfExists('opd_details');
    }

}
