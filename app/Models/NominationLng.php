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
        'tare_weight',
        'gross_weight',
        'supplied_quantity',
      	'lng_status',
      	'status'
     ];
    
    public function truckDetail()
    {
        return $this->hasMany('Energy\Models\TruckDetails','id','truck_details_id');
    }
     	
    public function buyerDetail()
    {
        return $this->hasMany('Energy\Models\User','id','buyer_id');
    }
      
     	
}
