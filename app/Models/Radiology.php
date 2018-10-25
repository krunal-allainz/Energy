<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;

class Radiology extends Model
{
    //
        protected $table = 'radiology_details';

        protected $fillable=[
              'opd_id',
              'user_id',
              'radiology_id',
              'spine_id',
              'bodyparts_id',
              'qualifiers_id',
              'special_request_id',
              'details',
              'attachments',
              'referance',
              'body_part_side_id',
              'radiology_other',
              'type_name',
              'bodyparts_other'
        ];
}
