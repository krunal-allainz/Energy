<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablePrescriptionDrugs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescription_drugs', function (Blueprint $table) {
            
             DB::statement('ALTER TABLE prescription_drugs MODIFY  type varchar (255) NULL;');
            $table->string('remove')->nullable()->default('false');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescription_drugs', function (Blueprint $table) {
            //
        });
    }
}
