<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->string('tender_number');
            $table->date('contract_start_date');
            $table->date('contract_end_date');
            $table->double('daily_contract_quantity');
            $table->double('delivery_capacity');
            $table->double('minimum_nomination');
            $table->boolean('take_or_pay');
            $table->double('take_or_pay_quantity');
            $table->boolean('entitled_to_make_up_gas');
            $table->boolean('has_carry_forward_rights');

            $table->rememberToken();
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
}
