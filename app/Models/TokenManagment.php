<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TokenManagment extends Model
{
    //
      protected $table = 'token_managment';

        protected $fillable=[
              'token',
              'date',
              'opd_id',
              'patient_id',
              'patient_case_id',
              'status',
        ];

    public function getDateAttribute($value)
    {
      if($value != null){
          return Carbon::parse($value)->format('d-m-Y H:i:s');
      }else{
        return null;
      }
    }

    public function setDateAttribute($value)
    { 
      if($value != ''){
        return $this->attributes['date'] =   Carbon::createFromFormat('d-m-Y H:i:s', $value);
      }else{
         return $this->attributes['date'] = null;
      }

    }

   public function getIpdDetails()
  {
       return $this->hasMany('euro_hms\Models\IpdDetails');
  }

  public function getOpdDetails(){

     return $this->hasMany('euro_hms\Models\OpdDetails');
  }

  public function getPatientCaseDetail(){
    return $this->belongsTo('euro_hms\Models\PatientCaseManagment','patient_case_id');
  }

}
