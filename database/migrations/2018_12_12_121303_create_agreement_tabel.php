<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgreementTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agreement', function (Blueprint $table) {
            $table->increments('id');
             $table->integer('buyer_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->decimal('allowed_quantity',10,2)->nullable();
            $table->decimal('price',10,2)->nullable();
            $table->string('tax_type')->nullable();
            $table->decimal('tax_rate',10,2)->nullable();
            $table->string('external_fuel_type')->nullable();
            $table->integer('external_fuel_type_rate')->nullable();
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
        Schema::dropIfExists('agreement');
    }
}
