<?php

namespace Energy\Models;

use Illuminate\Database\Eloquent\Model;

class NominationLng extends Model
{
    
     protected $table = 'nomination_lng';

      protected $fillable=[
      	'buyer_id',
      	'truck_details_id',
      	'lngDate',
      	'lngTime',
      	'quantity',
      	'status'
     ];
}
