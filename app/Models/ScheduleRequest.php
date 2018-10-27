<?php

namespace Energy\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ScheduleRequest extends Model
{
    //
     protected $table = 'schedule_gas';

      protected $fillable=[
      'id',
      'buyer_id',
      'seller_id',
      'schedule_date',
      'requested_quantity',
      'status',
      'approved_quantity',
      'supplied_quantity',

     ];


     

}
