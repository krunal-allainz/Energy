<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;

class PatientCheckUp extends Model
{
  protected $table = "patient_checkup";

  protected $fillable = [
    'id',
    'patient_id',
	'opd_id',
	'user_id',
	'height',
	'weight',
	'bmi',
	'vitals',
	'pulse',
	'bp',
	'temp',
	'pain',
	'patient_case_management_id',
  ];

    public function patientCheckupDetails()
    {
        return $this->belongsTo('euro_hms\Models\PatientDetailsForm','patient_id');
    }


}
