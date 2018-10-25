<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;

class Examination extends Model
{
    //
        protected $table = 'examination';

        protected $fillable=[
              'opd_id',
              'user_id',
              'department',
              'examination_image',
              'examination_data',
              'patient_case_management_id',
        ];
}
