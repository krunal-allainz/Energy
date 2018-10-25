<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCrossDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cross_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('opd_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('cross_type')->nullable();
            $table->string('cross_value')->nullable();
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
        Schema::dropIfExists('cross_details');
    }
}
