<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Notification extends Model
{
    //

      protected $table = 'notifications_timeline';

    protected $fillable=[
      'title',
      'type',
      'data_table',
      'data_id',
      'data_user_id',
      'data_date',
      'data_text',
      'added_by',
      'status'
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
