<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrescriptionDrugs extends Model
{
    //
    use SoftDeletes;
        protected $table = 'prescription_drugs';

        protected $fillable=[
              'name',
              'doctor',
              'type',
              'remove',
              'status',
        ];

        protected $dates = [
	        'created_at',
	        'updated_at',
	        'deleted_at'
    	];
}
