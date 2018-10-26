<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Agreement extends Model
{
    //
        protected $table = 'agreement';

        protected $fillable=[
              'buyer_id',
              'seller_id',
              'allowed_quantity',
              'price',
              'tax_type',
              'tax_rate',
        ];
        
}
