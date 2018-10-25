<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;

class ConultationCategoryDetails extends Model
{
    protected $table = 'consultation_category_details';

    protected $fillable=[
      'consultation_category_id',
      'consultation_type',
      'consultation_name',
      'charges',
    ];
}
