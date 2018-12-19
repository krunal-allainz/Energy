<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActualSuppliedGasTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actual_supplied_gas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->date('date')->nullable();
            $table->decimal('supplied_quantity',10,2)->nullable();
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
        Schema::dropIfExists('actual_supplied_gas');
    }
}
