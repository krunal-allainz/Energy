<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyDetails extends Model
{
    protected $table = 'emergency_details';

    protected $fillable=[
      'charges_type_id',
      'emergency_type',
      'emergency_name',
      'charges',
    ];
}
