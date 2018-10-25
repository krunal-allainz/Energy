<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialRequest extends Model
{
    //
        use SoftDeletes;
        protected $table = 'special_request';

        protected $fillable=[
              'radiology_id',
              'name'
        ];
         protected $dates = [
          'created_at',
          'updated_at',
          'deleted_at'
      ];
}
