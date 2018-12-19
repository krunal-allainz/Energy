<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScheduleGasTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedule_gas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->date('schedule_date')->nullable();
            $table->decimal('requested_quantity',10,2)->nullable();
            $table->decimal('approved_quantity',10,2)->nullable();
            $table->decimal('supplied_quantity',10,2)->nullable();
            $table->enum('status',array('Pending', 'Approved'))->nullable();
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
        Schema::dropIfExists('schedule_gas');
    }
}
