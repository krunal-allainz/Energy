<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;

class ConultationCategory extends Model
{
    protected $table = 'cosultation_category';

    protected $fillable=[
      'charges_type_id',
      'name'
    ];
}
