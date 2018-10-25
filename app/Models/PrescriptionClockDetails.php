<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionClockDetails extends Model
{
    //
        protected $table = 'prescription_clock_details';

        protected $fillable=[
        	  'opd_id',
              'prescription_id',
              'clock_time',
              'clock_quantity',
              'patient_case_management_id',
        ];

        
}
