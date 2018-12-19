<?php

namespace Energy\Models;

use Illuminate\Database\Eloquent\Model;

class TruckDetails extends Model
{
    //
     protected $table = 'truck_details';

      protected $fillable=[
      'truck_no',
      'truck_company',
      'register_no',
      'vin',
      'tare_weight',
      'total_volume_tank',
      'safe_quantity_lng',
      'status'
     ];


  
}
