<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;

class OpdDetailsOption extends Model
{
    //
     protected $table = 'opd_details_option';

      protected $fillable=[
      'opd_id',
      'history',
      'past_history',
      'advice',
      'provisional_diagnosis',
      'follow_up',
      'diagnosis',
      'status',
      'patient_case_management_id',
    ];

}
