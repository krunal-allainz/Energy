<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRadiology extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radiology_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('opd_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('type')->nullable();
            $table->text('subtype')->nullable();
            $table->string('bodyparts')->nullable();
            $table->string('qualifiers')->nullable();
            $table->string('special_request')->nullable();
            $table->text('details')->nullable();
            $table->string('referance')->nullable();
            $table->string('body_part_side')->nullable();
            $table->string('radiology_other')->nullable();
            $table->string('type_name')->nullable();
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
        Schema::dropIfExists('radiology_details');
    }
}
