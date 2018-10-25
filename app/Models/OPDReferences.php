<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;

class OPDReferences extends Model
{
    //
        protected $table = 'opd_references';

        protected $fillable=[
              'opd_id',
              'reference_type',
              'cross_type',
              'lab_id',
              'user_id',
              'radiology_id',
              'cross_value',
        ];
}
