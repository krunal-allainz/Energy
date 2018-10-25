<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientCaseManagmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient_case_managment', function (Blueprint $table) {
            $table->increments('id');
             $table->string('case_type')->nullable();
             $table->string('section_type')->nullable();
             $table->string('section_id')->nullable()->references('opd_id')
            ->on('opd_details');
            $table->integer('patient_id')->nullable()->references('id')
            ->on('patient_details');
            $table->text('references')->nullable();
            $table->integer('consultant_id')->nullable();
            $table->dateTime('appointment_datetime')->nullable();
            $table->integer('main_case_id')->nullable();
            $table->integer('is_report')->nullable();
            $table->text('reported_date')->nullable();
            $table->boolean('status')->nullable();
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
        Schema::dropIfExists('patient_case_managment');
    }
}
