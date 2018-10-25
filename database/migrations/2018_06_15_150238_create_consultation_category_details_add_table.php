<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultationCategoryDetailsAddTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultation_category_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('consultation_category_id');
            $table->string('consultation_type',255)->nullable();
            $table->string('consultation_name',255)->nullable();
            $table->float('charges', 11, 2)->nullable();
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
        Schema::dropIfExists('consultation_category_details');
    }
}
