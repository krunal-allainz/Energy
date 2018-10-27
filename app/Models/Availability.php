<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Availability extends Model
{
    //
        protected $table = 'availability';

        protected $fillable=[
             
              'seller_id',
              'date',
              'quantity'
        ];

       
}
