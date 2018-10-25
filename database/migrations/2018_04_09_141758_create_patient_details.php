<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uhid_no')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('type')->nullable();
            $table->integer('age')->nullable();
            $table->enum('gender', ['M', 'F'])->nullable();
            $table->string('address')->nullable();
            $table->string('ph_no')->nullable();
            $table->string('mob_no')->nullable();
            $table->text('references')->nullable();
            $table->integer('consultant')->nullable();
            $table->integer('consultant_id')->nullable();
            $table->string('case_type')->nullable();
            $table->dateTime('appointment_datetime')->nullable();
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
        Schema::dropIfExists('patient_details');
    }
}
