<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PatientDetailsForm extends Model
{
    protected $table = 'patient_details';
    protected $appointment_datetime = 'd-m-Y H:i:s';

    protected $fillable=[
      'uhid_no',
      'date',
      'time',
      'first_name',
      'middle_name',
      'last_name',
      'dob',
      'gender',
      'address',
      'ph_no',
      'mob_no',
      'references',
      'consultant',
      'case_type',
      'consultant_id',
      'appointment_datetime',
     /* 'weight',
      'height',
      'bmi',
      'vitals',
      'pulse',
      'temp',
      'bp_systolic',
      'bp_diastolic'*/
    ];

    /**
     * [userDetails description]
     * @return [type] [description]
     */
    public function userDetails()
    {
        return $this->belongsTo('euro_hms\Models\User','consultant_id');
    }

    public function opdDetails()
    {
        return $this->belongsTo('euro_hms\Models\OpdDetails','patient_id');
    }

    public function getDobAttribute($value)
    {
     
      if($value != null && $value != ''){
          return Carbon::parse($value)->format('d-m-Y');
      }else{
        return null;
      }
    }

    public function setDobAttribute($value)

    { 
      if($value != ''){
        return $this->attributes['dob'] =   Carbon::createFromFormat('d-m-Y', $value);
      }else{
         return $this->attributes['dob'] = null;
      }

    }

     public function getAppointmentDatetimeAttribute($value)
    { 
        if($value != null){
         return Carbon::parse($value)->format('d-m-Y H:i:s');
       }else{
        return null;
       }
    }

     public function setAppointmentDatetimeAttribute($value)
    { 
        if($value != ''){
        return $this->attributes['appointment_datetime'] =   Carbon::createFromFormat('d-m-Y H:i:s', $value);
        }else{
           return $this->attributes['appointment_datetime'] = null;
        }
    }

      public function getIpdDetails()
      {
          return $this->hasMany('euro_hms\Models\IpdDetails');
      }

      public function getOpdDetails(){

        return $this->hasMany('euro_hms\Models\OpdDetails');
      }

    public function patientCaseManagment()
    {
        return $this->belongsTo('euro_hms\Models\PatientCaseManagment','patient_id');
    }

    public function tokenManagment(){
       return $this->belongsTo('euro_hms\Models\TokenManagment','patient_id');
    }

    
}
