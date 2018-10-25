<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bodyparts extends Model
{
    //
        use SoftDeletes;
        protected $table = 'bodyparts';

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
