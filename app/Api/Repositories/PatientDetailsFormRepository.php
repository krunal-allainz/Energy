<?php

namespace euro_hms\Api\Repositories;

use DB;
use hash;
use Carbon\Carbon;
use euro_hms\Models\PatientDetailsForm;
use euro_hms\Models\OpdDetails;

class PatientDetailsFormRepository
{

	public function getNumberOfPatient($type,$id){
		$result = array();

		// this week results
		$fromDate =Carbon::now()->subDay(30)->startOfWeek()->toDateString(); // or ->format(..)
		$tillDate = Carbon::now()->toDateString();
		$result['today'] = PatientDetailsForm::selectRaw('date(created_at) as date, COUNT(*) as count')
        ->where( DB::raw('date(created_at)'), [$tillDate] )
        ->where('consultant_id',$id)
    	->orderBy('created_at', 'DESC')
    	->count();

		$result['month'] = PatientDetailsForm::selectRaw('date(created_at) as date, COUNT(*) as count')
	    ->whereBetween( DB::raw('date(created_at)'), [$fromDate, $tillDate] )
	    ->where('consultant_id',$id)
	    ->orderBy('created_at', 'DESC')
	    ->count();
		


	return $result;
	}

	public function getPatientListByDoctor($id){
		 $patientList =PatientDetailsForm::where('consultant_id',$id)->paginate(10);

		 return $patientList;
	}

	
}