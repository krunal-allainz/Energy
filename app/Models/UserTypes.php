<?php

namespace Energy\Models;

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
        return $this->belongsTo('Energy\Models\User','user_type');
    }

}
