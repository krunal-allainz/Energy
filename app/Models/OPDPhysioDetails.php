<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;

class OPDPhysioDetails extends Model
{
    //
    protected $table = 'opd_physiotherapy_details';

    protected $fillable=[
      'opd_id',
      'user_id',
      'details',
      'patient_case_management_id',
    ];
}
