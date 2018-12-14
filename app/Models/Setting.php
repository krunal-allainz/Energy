<?php

namespace Energy\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //

    protected $table = 'setting';

      protected $fillable=[
      'id',
      'date_field_type',
      'date_field_name',
      'data_field_value',

     ];
}
