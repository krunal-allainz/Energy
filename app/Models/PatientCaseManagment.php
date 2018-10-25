<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PatientCaseManagment extends Model
{
    //
     protected $table = 'patient_case_managment';

        protected $fillable=[
              'case_type',
              'section_type',
              'section_id',
              'patient_id',
              'references',
              'consultant_id',
              'main_case_id',
              'appointment_datetime',
              'status',
              'is_report',
              'reported_date'
        ];

    public function patientDetails()
    {
        return $this->belongsTo('euro_hms\Models\PatientDetailsForm','patient_id');
    }

    public function getAppointmentDatetimeAttribute($value)
    { 
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

     public function setAppointmentDatetimeAttribute($value)
    { 
      return $this->attributes['appointment_datetime'] =   Carbon::createFromFormat('d-m-Y H:i:s', $value);
    }
    public function getPatientTokenDetail(){
      return $this->belongsTo('euro_hms\Models\TokenManagment','patient_case_id');
    }
}
