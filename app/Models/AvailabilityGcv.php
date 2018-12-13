<?php

namespace Energy\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AvailabilityGcv extends Model
{
    //
        protected $table = 'availability_gcv';

        protected $fillable=[
             
              'gcv_quantity',
              'gcv_date'
        ];

    public function getGsv_DateAttribute($value)
    { 
        return Carbon::parse($value)->format('d-m-Y');
    }

     public function setGsv_DateAttribute($value)
    { 
      return $this->attributes['gsv_date'] =   Carbon::createFromFormat('d-m-Y', $value);
    }

}
