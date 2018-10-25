<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTokenManagmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token_managment', function (Blueprint $table) {
            $table->increments('id');
            $table->string('token')->nullable();
            $table->dateTime('date')->nullable();  
            $table->string('opd_id')->nullable()->references('opd_id')
            ->on('opd_details');
            $table->integer('patient_id')->nullable()->references('id')
            ->on('patient_details');
            $table->integer('patient_case_id')->nullable()->references('id')
            ->on('patient_case_managment');
            $table->string('status')->nullable();
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
        Schema::dropIfExists('token_managment');
    }
}
