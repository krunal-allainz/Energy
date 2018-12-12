<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceTabel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_id')->nullable();
            $table->integer('seller_id')->nullable();
            $table->date('date')->nullable();
            $table->decimal('supplied_quantity',10,2)->nullable();
            $table->integer('rate')->nullable();
            $table->integer('tax')->nullable();
            $table->decimal('panelty',10,2)->nullable();
            $table->decimal('total_amount',10,2)->nullable();
            $table->string('invoice_no')->nullable();
            $table->longText('invoiceView');
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('invoice');
    }
}
