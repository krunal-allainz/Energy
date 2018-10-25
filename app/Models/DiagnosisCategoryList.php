<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosisCategoryList extends Model
{
    protected $table = 'diagnosis_category_list';

    protected $fillable=[
      'name',
      'parent_id',
      'status',
    ];

}
