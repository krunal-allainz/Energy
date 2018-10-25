<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;

class PhysiotherapyDetails extends Model
{
    //
    protected $table = 'physiotherapy_details';

    protected $fillable=[
      	'opd_id',
		'user_id',
		'patient_id',
		'uhid_no',
		'name',
		'age',
		'date_of_assessment',
		'chief_complaints',
		'history',
		'observation_gait',
		'observation_posture',
		'palpation_tenderness',
		'palpation_muscle',
		'palpation_trigger',
		'pain_type',
		'pain_site',
		'pain_aggravating',
		'pain_relieving',
		'pain_wrong',
		'sensory_assessment',
		'rom',
		'balance_examination',
		'diagnosis',
		'treatment_plan',
		'follow_date',
		'signature_therapist',
		'name_therapist',
		'form_date',
		'form_time',
		'patient_case_management_id',
    ];
}
