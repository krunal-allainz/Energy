<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RadiologyTable extends Model
{
    //
        use SoftDeletes;
        protected $table = 'radiology';

        protected $fillable=[
              'name'
        ];
         protected $dates = [
          'created_at',
          'updated_at',
          'deleted_at'
      ];
}
