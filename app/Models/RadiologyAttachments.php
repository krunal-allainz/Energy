<?php

namespace euro_hms\models;

use Illuminate\Database\Eloquent\Model;

class RadiologyAttachments extends Model
{
    //
        protected $table = 'radiology_attachments';

        protected $fillable=[
              'opd_id',
              'radiology_id',
              'image',
              'patient_case_management_id',
        ];
}
