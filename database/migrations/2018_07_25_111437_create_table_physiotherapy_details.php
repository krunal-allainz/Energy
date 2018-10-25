<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePhysiotherapyDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('physiotherapy_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('opd_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('patient_id')->nullable();
            $table->string('uhid_no')->nullable();
            $table->string('name')->nullable();
            $table->integer('age')->nullable();
            $table->datetime('date_of_assessment')->nullable();
            $table->text('chief_complaints')->nullable();
            $table->text('history')->nullable();
            $table->text('observation_gait')->nullable();
            $table->text('observation_posture')->nullable();
            $table->text('palpation_tenderness')->nullable();
            $table->text('palpation_muscle')->nullable();
            $table->text('palpation_trigger')->nullable();
            $table->text('pain_type')->nullable();
            $table->text('pain_site')->nullable();
            $table->text('pain_aggravating')->nullable();
            $table->text('pain_relieving')->nullable();
            $table->text('pain_wrong')->nullable();
            $table->text('sensory_assessment')->nullable();
            $table->text('rom')->nullable();
            $table->text('balance_examination')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('treatment_plan')->nullable();
            $table->datetime('follow_date')->nullable();
            $table->text('signature_therapist')->nullable();
            $table->string('name_therapist')->nullable();
            $table->datetime('form_date')->nullable();
            $table->string('form_time')->nullable();
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
        Schema::dropIfExists('physiotherapy_details');
    }
}
