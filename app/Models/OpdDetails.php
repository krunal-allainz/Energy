<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class OpdDetails extends Model
{
    protected $table = 'opd_details';
     protected $appointment_datetime = 'd-m-Y H:i:s';

    protected $fillable=[
      'opd_id',
      'patient_id',
      'uhid_no',
      'admit_datetime',
      'discharge_datetime',
      'appointment_datetime',
      'history',
      'past_history',
      'advice',
      'reference',
      'consultant_id',
      'provisional_diagnosis',
      'follow_up'

    ];

	public function patientDetails()
    {
        return $this->belongsTo('euro_hms\Models\PatientDetailsForm','patient_id');
    }
  public function patientDetailsByConsultant()
    {
        return $this->belongsTo('euro_hms\Models\PatientDetailsForm','consultant_id');
    }

     public function getAppointmentDatetimeAttribute($value)
    { 
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

     public function setAppointmentDatetimeAttribute($value)
    { 
      return $this->attributes['appointment_datetime'] =   Carbon::createFromFormat('d-m-Y H:i:s', $value);
    }
}
