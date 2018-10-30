<?php

namespace Energy\models;

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
              'total_amount',
              'invoice_no',
              'invoiceView'
        ];

        /**
         * [getDateAttribute description]
         * @param  [type] $value [description]
         * @return [type]        [description]
         */
        public function getDateAttribute($value)
        {
          if($value != null && $value != ''){
              return Carbon::parse($value)->format('Y-m-d');
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
            return $this->attributes['date'] =   Carbon::createFromFormat('Y-m-d', $value);
          }else{
             return $this->attributes['date'] = null;
          }

        }
}
