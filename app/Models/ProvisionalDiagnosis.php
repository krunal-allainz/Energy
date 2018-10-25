<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;

class ProvisionalDiagnosis extends Model
{
    protected $table = 'provisional_diagnosis';

    protected $fillable=[
      'name',
      'category_id',
      'status',
    ];

}
