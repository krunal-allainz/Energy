<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;

class IpdDetails extends Model
{
   protected $table = 'ipd_details';

    protected $fillable=[
      'ipd_id',
      'patient_id',
      'uhid_no',
      'admit_datetime',
      'discharge_datetime',
      'appointment_datetime',
    ];

	public function patientDetails()
    {
        return $this->belongsTo('euro_hms\Models\PatientDetailsForm','patient_id');
    }
}
