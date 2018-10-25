<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laboratory extends Model
{
    //
    /*type=
		1=blood
		2=urine
		3=csf
		4=body fluid analysis
    */
    use SoftDeletes;
    protected $table = 'laboratory';

    protected $fillable=[
      'name','type'
    ];
    protected $dates = [
            'created_at',
            'updated_at',
            'deleted_at'
        ];
}
