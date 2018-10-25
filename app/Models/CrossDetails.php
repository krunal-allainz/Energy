<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;

class CrossDetails extends Model
{
    //
        protected $table = 'cross_details';

        protected $fillable=[
              'opd_id',
              'user_id',
              'cross_type',
              'cross_value',
              'patient_case_management_id',
        ];
}
