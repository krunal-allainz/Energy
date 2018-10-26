<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Invoice extends Model
{
    //
        protected $table = 'invoice';

        protected $fillable=[
              'buyer_id',
              'seller_id',
              'date',
              'supplied_quantity',
              'status',
              'rate',
              'tax',
              'panelty',
              'total_amount'
        ];

        /**
         * [getDateAttribute description]
         * @param  [type] $value [description]
         * @return [type]        [description]
         */
        public function getDateAttribute($value)
        {
         
          if($value != null && $value != ''){
              return Carbon::parse($value)->format('d-m-Y');
          }else{
            return null;
          }
        }
        /**
         * [setDateAttribute description]
         * @param [type] $value [description]
         */
        public function setDateAttribute($value)
        {
          if($value != ''){
            return $this->attributes['date'] =   Carbon::createFromFormat('d-m-Y', $value);
          }else{
             return $this->attributes['date'] = null;
          }

        }
}
