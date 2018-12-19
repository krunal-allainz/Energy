<?php

namespace Energy\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LngNotification extends Model
{
    //

      protected $table = 'lng_notifications_timeline';

    protected $fillable=[
      'title',
      'type',
      'data_table',
      'data_id',
      'data_user_id',
      'data_date',
      'data_text',
      'added_by',
      'nomination_date',
      'status',

    ];


     public function getData_DateAttribute($value)
    { 
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

     public function setData_DateAttribute($value)
    { 
      return $this->attributes['data_date'] =   Carbon::createFromFormat('d-m-Y H:i:s', $value);
    }

   

}
