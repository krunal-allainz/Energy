<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('receipt', function (Blueprint $table) {    
            $table->increments('id');  
            $table->integer('receipt_id')->nullable(); 
            $table->string('receipt_number')->nullable(); 
            $table->integer('patient_id')->nullable(); 
            $table->string('case_no')->nullable(); 
            $table->string('charges_name')->nullable();    
            $table->integer('amount')->nullable(); 
            $table->dateTime('date')->nullable(); 
            $table->integer('case_type')->nullable();
            $table->integer('charges_type_id')->nullable();
            $table->integer('consultation_charges_id')->nullable(); 
            $table->integer('emergency_charges_id')->nullable();
            $table->integer('charges')->nullable();  
            $table->string('department')->nullable();
            $table->integer('neurological_procedures_id')->nullable();
            $table->integer('vascular_procedures_id')->nullable();
            $table->integer('physiotherapy_procedures_id')->nullable();
            $table->integer('neurological_procedure_charges')->nullable();
            $table->integer('vascular_procedure_charges')->nullable();
            $table->integer('physiotherapy_procedure_charges')->nullable();
            $table->integer('other_charges_id')->nullable();
            $table->integer('other_charges')->nullable(); 
            $table->integer('print_counter')->nullable()->default(0); 
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
        Schema::dropIfExists('receipt');
    }
}
