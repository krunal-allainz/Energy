<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Qualifiers extends Model
{
    //
        use SoftDeletes;
        protected $table = 'qualifiers';

        protected $fillable=[
              'radiology_id',
              'bodyparts_id',
              'name'
        ];
         protected $dates = [
          'created_at',
          'updated_at',
          'deleted_at'
      ];
}
