<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Nomination extends Model
{
    //
        protected $table = 'nomination_request';

        protected $fillable=[
              'buyer_id',
              'seller_id',
              'date',
              'quantity_required',
              'approved_quantity',
              'supplied_quantity',
              'status',
              'request',
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
