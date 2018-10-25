<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BodyPartSide extends Model
{
    //
        use SoftDeletes;
        protected $table = 'bodypart_side';

        protected $fillable=[
              'name'
        ];
         protected $dates = [
          'created_at',
          'updated_at',
          'deleted_at'
      ];
}
