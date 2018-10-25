<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;

class LaboratoryDetails extends Model
{
    //
        protected $table = 'laboratory_details';

        protected $fillable=[
              'opd_id',
              'user_id',
              'laboratory_id',
              'date',
              'result',
              'assign_dr',
              'remove',
              'referance',
              'patient_case_management_id',
        ];
}
