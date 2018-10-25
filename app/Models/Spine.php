<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spine extends Model
{
    //
        use SoftDeletes;
        protected $table = 'spine';

        protected $fillable=[
              'name',
              'radiology_id',
              'bodyparts_id'
        ];
        protected $dates = [
          'created_at',
          'updated_at',
          'deleted_at'
      ];
}
