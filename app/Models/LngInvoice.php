<?php

namespace Energy\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LngInvoice extends Model
{
    //
        protected $table = 'invoice_lng';

        protected $fillable=[
              'buyer_id',
              'seller_id',
              'date',
              'total_supplied_quantity',
              'total_supplied_quantity_withGCV',
              'status',
              'rate',
              'tax',
              'per_mmbtu',
              'convert_currency_rate',
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
