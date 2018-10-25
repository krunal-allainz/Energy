<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;

class UserTypes extends Model
{
    //
     protected $table = 'user_types';

      protected $fillable=[
      'id',
      'name',
      'status',
     ]


      public function userTypesDetail()
    {
        return $this->belongsTo('euro_hms\Models\User','user_type');
    }

}
