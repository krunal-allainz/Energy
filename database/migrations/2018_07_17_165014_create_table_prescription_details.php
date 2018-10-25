<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePrescriptionDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('opd_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('prescription_drug_id')->nullable();
            $table->integer('total_quantity')->nullable();
            $table->string('how_many_times')->nullable();
            $table->integer('total_prescription_days')->nullable();
            $table->string('clock_suggest')->nullable();
            $table->string('qhrs')->nullable();
            $table->string('total_qhrs')->nullable();
            $table->text('details')->nullable();
            $table->string('remove')->nullable();
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
        Schema::dropIfExists('prescription_details');
    }
}
