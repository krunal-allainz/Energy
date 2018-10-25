<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;

class PrescriptionDetails extends Model
{
    //
        protected $table = 'prescription_details';

        protected $fillable=[
              'opd_id',
              'user_id',
              'prescription_drug_id',
              'how_many_times',
              'total_quantity',
              'total_prescription_days',
              'clock_suggest',
              'qhrs',
              'total_qhrs',
              'details',
              'other_prescription',
              'remove',
              'patient_case_management_id',
              
        ];

        
}
