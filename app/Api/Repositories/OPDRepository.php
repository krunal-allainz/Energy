<?php
  namespace euro_hms\Api\Repositories;
 use euro_hms\Models\OpdDetails;
 use euro_hms\Models\Laboratory;
 use euro_hms\Models\PrescriptionDetails;
  use euro_hms\Models\PrescriptionClockDetails;
 use euro_hms\Models\OPDReferences;
 use euro_hms\Models\Radiology;
 use euro_hms\Models\CrossDetails;
 use euro_hms\Models\LaboratoryDetails;
 use euro_hms\Models\PatientCheckUp;
 use euro_hms\Models\Examination;
 use euro_hms\Models\RadiologyAttachments;
 use euro_hms\Models\PhysiotherapyDetails;
 use euro_hms\Models\OPDPhysioDetails;
 use euro_hms\Models\PatientCaseManagment;
 use euro_hms\Api\Repositories\PatientRepository;
 use euro_hms\Api\Repositories\UserRepository;
 use euro_hms\Models\PatientDetailsForm;
 use euro_hms\Models\OpdDetailsOption;
 use euro_hms\Models\TokenManagment;
 use euro_hms\Models\PrescriptionDrugs;
 use euro_hms\Models\Notification;
 use Carbon\Carbon;
 use DB;

 class OPDRepository 
 {
 	/**
 	 * [__construct description]
 	 */
 	public function __construct(){
        $this->objPatient = new PatientRepository();
        $this->objUser = new UserRepository();
    }
    //
 	/**
 	 * [getLaboratoryByType description]
 	 * @param  [type] $type [description]
 	 * @return [type]       [description]
 	 */
 	public function getLaboratoryByType($type)
 	{
 		return Laboratory::whereRaw('FIND_IN_SET(?,type)', $type)->get();
 	}
 	
 	/**
 	 * [getAllLaboratoryList description]
 	 * @return [type] [description]
 	 */
 	public function getAllLaboratoryList()
 	{
 		return Laboratory::get();
 	}
 	/**
 	 * [getLabListByChildren description]
 	 * @return [type] [description]
 	 */
 	public function getLabListByChildren()
 	{
 		$data_lab=Laboratory::get();
 		foreach($data_lab as $lab)
 		{
 			
 			$types=explode(',', $lab['type']);
 			if(in_array(1,$types))
 			{
 				$blood_array[]=array('id'=>$lab['id'],'text'=>$lab['name']);
 			}
 			if(in_array(2,$types))
 			{
 				$urine_array[]=array('id'=>$lab['id'],'text'=>$lab['name']);
 			}
 			if(in_array(3,$types))
 			{
 				$csf_array[]=array('id'=>$lab['id'],'text'=>$lab['name']);
 			}
 			if(in_array(4,$types))
 			{
 				$bfa_array[]=array('id'=>$lab['id'],'text'=>$lab['name']);
 			}
 			
 		}
 		$lab_array[0]=array('id'=>'1','text'=>'Blood','children'=>$blood_array,'element'=>'HTMLOptGroupElement');
 		$lab_array[1]=array('id'=>'2','text'=>'Urine','children'=>$urine_array,'element'=>'HTMLOptGroupElement');
 		$lab_array[2]=array('id'=>'3','text'=>'CSF','children'=>$csf_array,'element'=>'HTMLOptGroupElement');
 		$lab_array[3]=array('id'=>'4','text'=>'BFA','children'=>$bfa_array,'element'=>'HTMLOptGroupElement');
 		return $lab_array;
 	}
 	
 	/**
 	*   get number of OPD
 	*
 	*
 	*/
 	public function getOPDCounters($id){
 		$result = array();
		// this week results
		$fromDate =Carbon::now()->subDay(30)->startOfWeek()->toDateString(); // or ->format(..)
		$tillDate = Carbon::now()->toDateString();
		$result['today'] = OpdDetails::selectRaw('date(created_at) as date, COUNT(*) as count')
        ->where( DB::raw('date(created_at)'), [$tillDate] )
    	->orderBy('created_at', 'DESC')
    	->count();
		$result['month'] = OpdDetails::selectRaw('date(created_at) as date, COUNT(*) as count')
	    ->whereBetween( DB::raw('date(created_at)'), [$fromDate, $tillDate] )
	    ->orderBy('created_at', 'DESC')
	    ->count();	
		return $result;
 	}
 	public function savePhysiotherapy($request)
 	{
 		$data=$request->all()['physioData'];
 		//print_r($data);exit;
 		$physio_details=new PhysiotherapyDetails();
 		//$physio_details->opd_id=$data['opd_id'];
 		$physio_details->user_id=$data['user_id'];
 		$physio_details->patient_id=$data['patient_id'];
 		$physio_details->uhid_no=$data['uhid_no'];
 		$physio_details->name=$data['name'];
 		//$physio_details->age=$data['age'];
 		if($data['doa']['time']!='')
 			$physio_details->date_of_assessment=Carbon::createFromFormat('d-m-Y', $data['doa']['time'])->format('Y-m-d');
 		$physio_details->chief_complaints=$data['chief_complaints'];
 		$physio_details->history=$data['history'];
 		$physio_details->observation_gait=$data['observation_gait'];
 		$physio_details->observation_posture=$data['observation_posture'];
 		$physio_details->palpation_tenderness=$data['palpation_tenderness'];
 		$physio_details->palpation_muscle=$data['palpation_muscle'];
 		$physio_details->palpation_trigger=$data['palpation_trigger'];
 		$physio_details->pain_type=$data['pain_type'];
 		$physio_details->pain_site=$data['pain_site'];
 		$physio_details->pain_aggravating=$data['pain_aggravating'];
 		$physio_details->pain_relieving=$data['pain_relieving'];
 		$physio_details->pain_wrong=$data['pain_wrong'];
 		$physio_details->sensory_assessment=$data['sensory_assessment'];
 		$physio_details->rom=$data['rom'];
 		$physio_details->balance_examination=$data['balance_examination'];
 		$physio_details->diagnosis=$data['diagnosis'];
 		$physio_details->treatment_plan=$data['treatment_plan'];
 		if($data['nfd']['time']!='')
 			$physio_details->follow_date=Carbon::createFromFormat('d-m-Y', $data['nfd']['time'])->format('Y-m-d');
 		$physio_details->signature_therapist=$data['signature_therapist'];
 		$physio_details->name_therapist=$data['name_therapist'];
 		$physio_details->form_date=Carbon::createFromFormat('d-m-Y h:ia', $data['form_date'])->format('Y-m-d H:i:s');
 		$physio_details->save();
 		return $physio_details->id;
 	}
 	public function getPatientOpdData($opdId){
 		 $result = array();
 		 $result['opdDetails'] = OpdDetails::where('id',$opdId)->first();
 		 $result['opdOptionDetails'] = OpdDetailsOption::where('opd_id',$opdId)->orderBy('id','DESC')->first();
 		 $exam_data="";
 		 $exam_new_data= Examination::where('opd_id',$opdId)->orderBy('id','DESC')->first();
 		 if(!empty($exam_new_data))
 		 {
 		 	$exam_data=$exam_new_data->examination_data;
 		 }
 		 $result['opdExaminationData'] =$exam_data;
 		 $result['opdReferalphysioData'] = OPDPhysioDetails::where('opd_id',$opdId)->first();
 		 $result['opdReferalCrossData'] = CrossDetails::where('opd_id',$opdId)->whereDate('created_at',Carbon::today()->format('Y-m-d'))->get();
 		 $result['opdReferalLaboraryData'] =LaboratoryDetails::join('laboratory','laboratory_details.laboratory_id','=','laboratory.id')->where('laboratory_details.opd_id',$opdId)->where('laboratory_details.referance',0)->whereDate('laboratory_details.created_at',Carbon::today()->format('Y-m-d'))->get();
 		  $result['opdReferalRadiologyData'] = Radiology::where('opd_id',$opdId)->where('referance',0)->whereDate('created_at',Carbon::today()->format('Y-m-d'))->get();
 		  $result['opdLabData'] = LaboratoryDetails::join('laboratory','laboratory_details.laboratory_id','=','laboratory.id')->where('laboratory_details.opd_id',$opdId)->where('laboratory_details.referance',1)->whereDate('laboratory_details.created_at',Carbon::today()->format('Y-m-d'))->get();
 		  $result['opdRadiologyData'] = Radiology::where('opd_id',$opdId)->where('referance',1)->whereDate('created_at',Carbon::today()->format('Y-m-d'))->get();

 		//for prescriptiondata
 		 	$prescript_array=$this->getPrescriptionDataForPrint($opdId);
 			$result['opdprescriptionData']=$prescript_array;
 		//for prescriptiondata over
 		
 		  /*$result['opdprescriptionData'] = PrescriptionDetails::join('prescription_drugs','prescription_drugs.id','=','prescription_details.prescription_drug_id')->where('prescription_details.opd_id',$opdId)->where('prescription_details.remove','false')->get();*/
 		 
 		  $advice = $result['opdOptionDetails']->advice;
 		  $history = $result['opdOptionDetails']->history;
 		$pastHistory = $result['opdOptionDetails']->past_history;
 		//$examinationData =  $result['opdExaminationData']->examination_data;
 		  $result['adviceData'] = json_decode($advice,true); 
 		  $result['historyData'] = json_decode($history,true); 
 		  $result['past_historyData'] = json_decode($pastHistory,true); 
 		 // $result['opdExaminationDataList'] = json_decode($examinationData,true); 

 		 return $result;
 	}

 	public function getPrescriptionDataForPrint($opdId)
 	{
 		 $prescription_details=PrescriptionDetails::where('opd_id',$opdId)->where('remove','false')->orderBy('id','asc')->get();
 		  $prescript_array=array();

 			foreach($prescription_details as $presp)
 			{
 				$rest_presp=array();
 				if(($presp->prescription_drug_id==null || $presp->prescription_drug_id=="") && ($presp->other_prescription!=''))
 				{
 					$rest_presp['pid']='other';
 					$rest_presp['name']=$presp->other_prescription;
 				}
 				else
 				{
 					$rest_presp['pid']=$presp->prescription_drug_id;
 					$rest_presp['name']=$this->getPrescriptionNameById($presp->prescription_drug_id);
 				}
 				
 				$rest_presp['type']=$presp->how_many_times;
 				$rest_presp['total_prescription_days']=$presp->total_prescription_days;
 				$rest_presp['details']=$presp->details;
 				$rest_presp['total_quantity']=$presp->total_quantity;
 				$rest_presp['clock_suggest']=$presp->clock_suggest;
 				$rest_presp['qhrs']="";
 				$rest_presp['total_qhrs']="";
 				$rest_presp['remove']=$presp->remove;
 				$clock_details=PrescriptionClockDetails::where('prescription_id',$presp->id)->orderBy('id','asc')->get();
 				//print_r($clock_details);
 				if($rest_presp['type']=='Q-Hrs')
	 			{	
	 					$rest_presp['qhrs']=$presp->qhrs;
 						$rest_presp['total_qhrs']=$presp->total_qhrs;
	 					$j=1;
	 					for($i=0;$i<$presp->total_qhrs;$i++)
		 				{
				 			$rest_presp['clock_time_'.$j]=$clock_details[$i]['clock_time'];
		 					$rest_presp['clock_quantity_'.$j]=$clock_details[$i]['clock_quantity'];
				 			$j++;
		 				}
	 			}
	 			else
	 			{
	 				$i=1;
		 			foreach($clock_details as $clocks)
		 			{
					 	$rest_presp['clock_time_'.$i]=$clocks->clock_time;
		 				$rest_presp['clock_quantity_'.$i]=$clocks->clock_quantity;
					 	$i++;
		 			}
	 			}
	 			
 				$prescript_array[]=$rest_presp;
 			}
 			return $prescript_array;
 	}

     /**
     *
     * get Patient opd Details by Opd id by case type   *  also for dash board patient detail view
     *
     **/
 	public function getPatientOpdDetailByOpdId($opdId){
 		 $result = array();
 		 $result['opdDetails'] = OpdDetails::where('id',$opdId)->first();
 		 $result['opdOptionDetails'] = OpdDetailsOption::where('opd_id',$opdId)->orderBy('id','DESC')->first();
 		 $result['opdExaminationData'] = Examination::where('opd_id',$opdId)->orderBy('id','DESC')->first();
 		 $result['opdReferalphysioData'] = OPDPhysioDetails::where('opd_id',$opdId)->get();
 		 $result['opdReferalCrossData'] = CrossDetails::where('opd_id',$opdId)->whereDate('created_at',Carbon::today()->format('Y-m-d'))->get();
 		 $result['opdReferalLaboraryData'] =LaboratoryDetails::join('laboratory','laboratory_details.laboratory_id','=','laboratory.id')->where('laboratory_details.opd_id',$opdId)->where('laboratory_details.referance',0)->whereDate('laboratory_details.created_at',Carbon::today()->format('Y-m-d'))->get();
 		  $result['opdReferalRadiologyData'] = Radiology::where('opd_id',$opdId)->where('referance',0)->whereDate('created_at',Carbon::today()->format('Y-m-d'))->get();
 		  $result['opdLabData'] = LaboratoryDetails::join('laboratory','laboratory_details.laboratory_id','=','laboratory.id')->where('laboratory_details.opd_id',$opdId)->where('laboratory_details.referance',1)->whereDate('laboratory_details.created_at',Carbon::today()->format('Y-m-d'))->get();
 		  $result['opdRadiologyData'] = Radiology::where('opd_id',$opdId)->where('referance',1)->whereDate('created_at',Carbon::today()->format('Y-m-d'))->get();
 		  /*$result['opdprescriptionData'] = PrescriptionDetails::join('prescription_drugs','prescription_drugs.id','=','prescription_details.prescription_drug_id')->where('prescription_details.opd_id',$opdId)->where('prescription_details.remove','false')->get();*/
 		  	//for prescriptiondata
 		 		$prescript_array=$this->getPrescriptionDataForPrint($opdId);
 				$result['opdprescriptionData']=$prescript_array;
 			//for prescriptiondata over
 		  $advice = $result['opdOptionDetails']->advice;
 		  $history = $result['opdOptionDetails']->history;
 		$pastHistory = $result['opdOptionDetails']->past_history;
 		//$examinationData =  $result['opdExaminationData']->examination_data;
 		  $result['adviceData'] = json_decode($advice,true); 
 		  $result['historyData'] = json_decode($history,true); 
 		  $result['past_historyData'] = json_decode($pastHistory,true); 
 		  
 		  // $result['opdExaminationDataList'] = json_decode($examinationData,true); 
 		 return $result;


 	}

 	/**
 	 * [getOPDDetailsByPatientID description]
 	 * @param  [type] $pid [description]
 	 * @return [type]      [description]
 	 */
 	public function getOPDDetailsByPatientID($pid)
 	{
 		$getOPDDetails=DB::table('patient_details')
        ->join('opd_details', 'patient_details.id', '=', 'opd_details.patient_id')
        ->join('patient_case_managment', 'opd_details.id', '=', 'patient_case_managment.section_id')
        ->join('token_managment', 'patient_case_managment.id', '=', 'token_managment.patient_case_id')
        ->select('patient_details.first_name', 'patient_details.last_name', 'patient_case_managment.id as case_id','patient_case_managment.appointment_datetime as last_visit','token_managment.token as token_no','patient_details.uhid_no','token_managment.status as t_status','patient_details.id as patient_id','opd_details.id as opd_id','patient_case_managment.is_report')
        ->where('patient_details.id',$pid)
        ->groupBy('patient_case_managment.section_id')
        ->get();
        //echo $getOPDDetails;
        return $getOPDDetails;
 	}

 	/**
 	 * [getUpdateOPDDetails description]
 	 * @param  [type] $patient_id [description]
 	 * @param  [type] $opd_id     [description]
 	 * @return [type]             [description]
 	 */
 	public function getUpdateOPDDetails($patient_id,$opd_id)
 	{
 			$result=array();

 			$result['opdData']['patientlist']=$patient_id;
 			$result['opdData']['opd_id']=$opd_id;
 			$result['opdData']['case_type']="";
 			//$result['opdData']['signaturePad']=array();
 			
 			//for patient details
 			$p_details=$this->objPatient->getPatientDetailsById($patient_id);
 			$result['patient_name']=$p_details->first_name.' '.$p_details->last_name;
 			$last_visit_arr=$this->objPatient->getLastOPDIdByPatientId($patient_id);
 			$result['opdData']['age']=$p_details->age;
 			$result['opdData']['uhid_no']=$p_details->uhid_no;
 			$result['opdData']['last_vist']=$this->objPatient->getPatientLastVisitById($patient_id);
 			//checkup details
 			$patientcheckup=PatientCheckUp::where('opd_id',$opd_id)->orderBy('id','desc')->first();
 			
 			$result['opdData']['height']=$patientcheckup->height;
 			$result['opdData']['weight']=$patientcheckup->weight;
 			$result['opdData']['bmi']=$patientcheckup->bmi;
 			$result['opdData']['vitals']=$patientcheckup->vitals;
 			$result['opdData']['pulse']=$patientcheckup->pulse;
 			$bp_data=explode('/',$patientcheckup->bp);
 			$result['opdData']['bp_systolic']=$bp_data[0];
 			$result['opdData']['bp_diastolic']=$bp_data[1];
 			$result['opdData']['temp']=$patientcheckup->temp;
 			$result['opdData']['pain_value']=$patientcheckup->pain;
 			//options details
 			$option_details=OpdDetailsOption::where('opd_id',$opd_id)->orderBy('id','desc')->first();
 			$result['opdData']['signaturePad_src']="";
 			$result['opdData']['signaturePad1_src']="";
 			$result['opdData']['historyType']="scribble";
 			$result['opdData']['pastHistoryType']="scribble";
 			$history_array=json_decode($option_details->history,true);

 			if(count($history_array)>0)
 			{
 				$result['opdData']['historyType']=$history_array['type'];
 				if($history_array['type']=='text')
 				{
 					$result['opdData']['history']=$history_array['value'];
 				}
 				else
 				{
 					$result['opdData']['signaturePad_src']=$history_array['value'];
 				}
 			}
 			
 			$past_history_array=json_decode($option_details->past_history,true);
 			if(count($past_history_array)>0)
 			{
 				$result['opdData']['pastHistoryType']=$past_history_array['type'];
 				if($past_history_array['type']=='text')
 				{
 					$result['opdData']['past_history']=$past_history_array['value'];
 				}
 				else
 				{
 					$result['opdData']['signaturePad1_src']=$past_history_array['value'];
 				}
 			}
 			$result['step4Data']['advice']='';
 			$result['step4Data']['adviceType']='scribble';
 			$result['step4Data']['signaturePad']=array();
 			$result['step4Data']['signaturePad2_src']='';
 			$result['step4Data']['provisional_diagnosis']='';
 			$advice_array=json_decode($option_details->advice,true);
 			if(count($advice_array)>0)
 			{
 				$result['step4Data']['adviceType']=$advice_array['type'];
 				if($advice_array['type']=='text')
 				{
 					$result['step4Data']['advice']=$advice_array['value'];
 				}
 				else
 				{
 					$result['step4Data']['signaturePad2_src']=$advice_array['value'];
 				}
 			}

 			$result['step4Data']['follow_up']=$option_details->follow_up;
 			$result['provisionalDiagnosis']=$option_details->provisional_diagnosis;
 			$result['diagnosis']=$option_details->diagnosis;

 			//for prescription data
 			$prescription_details=PrescriptionDetails::where('opd_id',$opd_id)->orderBy('id','asc')->get();
 			$prescript_array=array();
 			$other_pid=0;
 			foreach($prescription_details as $presp)
 			{
 				$rest_presp=array();
 				if(($presp->prescription_drug_id==null || $presp->prescription_drug_id=="") && ($presp->other_prescription!=''))
 				{
 					$other_pid=$other_pid+1;
 					$rest_presp['pid']='other_'.$other_pid;

 					$rest_presp['name']=$presp->other_prescription;
 				}
 				else
 				{
 					$rest_presp['pid']=$presp->prescription_drug_id;
 					$rest_presp['name']=$this->getPrescriptionNameById($presp->prescription_drug_id);
 				}
 				
 				$rest_presp['type']=$presp->how_many_times;
 				$rest_presp['total_prescription_days']=$presp->total_prescription_days;
 				$rest_presp['details']=$presp->details;
 				$rest_presp['total_quantity']=$presp->total_quantity;
 				$rest_presp['clock_suggest']=$presp->clock_suggest;
 				$rest_presp['qhrs']="";
 				$rest_presp['total_qhrs']="";
 				$rest_presp['remove']=$presp->remove;
 				$clock_details=PrescriptionClockDetails::where('prescription_id',$presp->id)->orderBy('id','asc')->get();
 				//print_r($clock_details);
 				if($rest_presp['type']=='Q-Hrs')
	 			{	
	 					$rest_presp['qhrs']=$presp->qhrs;
 						$rest_presp['total_qhrs']=$presp->total_qhrs;
	 					$j=1;
	 					for($i=0;$i<$presp->total_qhrs;$i++)
		 				{
				 			$rest_presp['clock_time_'.$j]=$clock_details[$i]['clock_time'];
		 					$rest_presp['clock_quantity_'.$j]=$clock_details[$i]['clock_quantity'];
				 			$j++;
		 				}
	 			}
	 			else
	 			{
	 				$i=1;
		 			foreach($clock_details as $clocks)
		 			{
					 	$rest_presp['clock_time_'.$i]=$clocks->clock_time;
		 				$rest_presp['clock_quantity_'.$i]=$clocks->clock_quantity;
					 	$i++;
		 			}
	 			}
	 			
 				$prescript_array[]=$rest_presp;
 			}
 			$result['other_pid']=$other_pid;
 			$result['prescriptionData']=$prescript_array;
 			/*print_r($result['prescriptionData']);
 			exit;*/
 			

 			//for physio details
 			$result['reffData']['referral']='';
 			$result['reffData']['laboratory']='';
 			$result['reffData']['physio_details']='';
 			$physio_details=OPDPhysioDetails::where('opd_id',$opd_id)->orderBy('id','desc')->first();
 			if($physio_details)
 			{
 				$result['reffData']['physio_details']=$physio_details->details;
 			}
 			
 			//for cross details array
 			$cross_details=CrossDetails::where('opd_id',$opd_id)->orderBy('id','asc')->get();
 			$cross_array=array();
 			$index_cross=1;
 			foreach($cross_details as $cross)
 			{
 				$rest_cross=array();
 				$rest_cross['id']=$index_cross;
 				$rest_cross['type']='Cross';
 				$rest_cross['subtype']=$cross->cross_type;
 				$rest_cross['value']=$cross->cross_value;
 				$cross_array[]=$rest_cross;
 				$index_cross++;
 			}
 			$result['reffData']['reffreal_cross_array']=$cross_array;

 			//for lab data last step
 			$lab_details=LaboratoryDetails::where('opd_id',$opd_id)->orderBy('id','asc')->get();
 			$lab_array=array();
 			$index_lab=1;
 			
 			foreach($lab_details as $lab)
 			{
 				if($lab->referance==0)
 				{

 					$rest_lab=array();
 					if(($lab->laboratory_id)!="")
					{
						$rest_lab['id']=$index_lab;
						$rest_lab['lab_id']=$lab->laboratory_id;
	 					$lab_det=$this->getLabpratoryNameById($lab->laboratory_id);
		 				$rest_lab['name']=$lab_det->name;
		 				$rest_lab['remove']=$lab->remove;
		 				$lab_array[]=$rest_lab;
		 				$index_lab++;
					}
 					
 				}
 				
 			}
 			$result['reffData']['reffreal_laboratory_array']=$lab_array;


 			//for radiology data last step
 			$radio_details=Radiology::where('opd_id',$opd_id)->orderBy('id','asc')->get();
 			$radio_array=array();
 			$index_radio=1;
 			foreach($radio_details as $radio)
 			{
 				if($radio->referance==0)
 				{
 					$rest_radio=array();
	 				$rest_radio['id']=$index_radio;
	 				$rest_radio['uploadType']='image';
		 			$rest_radio['bodyPart']=$radio->bodyparts;
		 			$rest_radio['qualifierPart']='';
	 				$rest_radio['type']=$radio->type;
	 				$rest_radio['spine_option_value']=$radio->subtype;
	 				$rest_radio['subType']=$radio->bodyparts;
		 			$rest_radio['qualifier']=$radio->qualifiers;
		 			$rest_radio['imgData']='';
		 			$rest_radio['textData']=$radio->details;
		 			$rest_radio['subtype_text_enable']=false;
		 			$rest_radio['qualifier_text_enable']=false;
		 			$rest_radio['special_request']=$radio->special_request;
		 			$rest_radio['removed']=$radio->removed;
		 			$rest_radio['body_part_side']=$radio->body_part_side;
		 			$rest_radio['radiologyOther']=$radio->radiology_other;
					$rest_radio['body_part_text']=false;
		 			$rest_radio['type_name']=$radio->type_name;
		 			$rest_radio['body_part_others']='';
		 			$rest_radio['body_part_others_type']='scribble';
		 			$rest_radio['signaturePad']=array();
		 			$rest_radio['signaturePad3_src']='';
		 			if($radio->body_part_side=='Others')
		 			{
		 				$body_part_array=json_decode($radio->body_part_others,true);
			 			if(count($body_part_array)>0)
			 			{
			 				$rest_radio['body_part_others_type']=$body_part_array['type'];
			 				if($body_part_array['type']=='text')
			 				{
			 					$rest_radio['body_part_others']=$body_part_array['value'];
			 				}
			 				else
			 				{
			 					$rest_radio['signaturePad3_src']=$body_part_array['value'];
			 				}
			 			}
		 			}
	 				$radio_array[]=$rest_radio;
	 				$index_radio++;
 				}
 				
 			}
 			$result['reffData']['reffreal_radiology_array']=$radio_array;

 			//for step2 laboratory
 			$lab_array_2=array();
 			foreach($lab_details as $lab_2)
 			{
 				if($lab_2->referance==1)
 				{
 					$rest_lab_2=array();
 					$lab_det=$this->getLabpratoryNameById($lab_2->laboratory_id);
 					$rest_lab_2['id']=$lab_2->laboratory_id;
 					$rest_lab_2['text']=$lab_det->name;
	 				//$rest_lab_2['lab_id']=$lab_2->laboratory_id;
	 				$rest_lab_2['lab_date']['time']=Carbon::createFromFormat('Y-m-d H:i:s', $lab_2->date)->format('d-m-Y');
	 				$rest_lab_2['result']=$lab_2->result;
	 				$rest_lab_2['removed']=$lab_2->remove;
	 				$lab_array_2[]=$rest_lab_2;
 				}
 				
 			}
 			$result['laboratoryData']=$lab_array_2;
 			
 			//for step2 radiology 
 			$radio_array_2=array();
 			$radio_index=1;
 			foreach($radio_details as $radio_2)
 			{
 				if($radio_2->referance==1)
 				{
 					$rest_radio_2=array();
	 				$rest_radio_2['id']=$radio_index;
	 				$rest_radio_2['uploadType']='image';
	 				$rest_radio_2['bodyPart']=$radio_2->bodyparts;
	 				$rest_radio_2['bodyPart_others']='';
	 				$rest_radio_2['type']=$radio_2->type;
	 				$rest_radio_2['spine_option_value']=$radio_2->subtype;
	 				$rest_radio_2['subType']=$radio_2->bodyparts;
	 				$rest_radio_2['qualifier']=$radio_2->qualifiers;
	 				$rest_radio_2['imgData']='';
	 				$rest_radio_2['textData']=$radio_2->details;
	 				$rest_radio_2['subtype_text_enable']=false;
	 				$rest_radio_2['qualifier_radio_text_enable']=false;
	 				$rest_radio_2['special_request']=$radio_2->special_request;
	 				$rest_radio_2['removed']=$radio_2->removed;
	 				$rest_radio_2['qualifierOtherPart']='';
	 				$rest_radio_2['body_part_side']=$radio_2->body_part_side;
	 				$rest_radio_2['radiologyOther']=$radio_2->radiology_other;
	 				$rest_radio_2['body_part_text']=false;
	 				$rest_radio_2['type_name']=$radio_2->type_name;
	 				$rest_radio_2['body_part_others']='';
		 			$rest_radio_2['body_part_others_type']='scribble';
		 			$rest_radio_2['signaturePad']=array();
		 			$rest_radio_2['signaturePad3_src']='';
		 			if($radio->body_part_side=='Others')
		 			{
		 				$body_part_array=json_decode($radio_2->body_part_others,true);
			 			if(count($body_part_array)>0)
			 			{
			 				$rest_radio_2['body_part_others_type']=$body_part_array['type'];
			 				if($body_part_array['type']=='text')
			 				{
			 					$rest_radio_2['body_part_others']=$body_part_array['value'];
			 				}
			 				else
			 				{
			 					$rest_radio_2['signaturePad3_src']=$body_part_array['value'];
			 				}
			 			}
		 			}
	 				$radio_array_2[]=$rest_radio_2;
	 				$radio_index++;
 				}
 			}

 			$result['radioData']=$radio_array_2;

 			//for examination data
 			$examination_details=Examination::where('opd_id',$opd_id)->orderBy('id','desc')->first();
 			$result['examinationData']="";
 			if($examination_details)
 			{
 				$result['examinationData']=$examination_details->examination_data;
 			}
 			
 			
 			return $result; 
 	}

 	/**
 	 * [editOPD description]
 	 * @param  [type] $request [description]
 	 * @return [type]          [description]
 	 */
 	public function editOPD($request)
 	{
 		$data = $request->all()['data']['opdData'];
 		$user_id=$request->all()['data']['doctor'];
 		$department=$request->all()['data']['department'];
 		$prescription_data=$request->all()['data']['prescriptionData'];
 		$radiology_data=$request->all()['data']['radioData'];
 		$labdata=$request->all()['data']['laboratoryData'];
 		$reff_data=$request->all()['data']['reffData'];
 		$cross_opd_data=$request->all()['data']['reffData']['reffreal_cross_array'];
 		$lab_opd_data=$request->all()['data']['reffData']['reffreal_laboratory_array'];
 		$radio_opd_data=$request->all()['data']['reffData']['reffreal_radiology_array'];

 		$step4_data=$request->all()['data']['step4Data'];
 		$crossRefer=$request->all()['data']['crossRefer'];
 		$diagnosis =$request->all()['data']['diagnosis'];
 		$provisional_diagnosis = $request->all()['data']['provisionalDiagnosis'];
 		$patientCaseData =$request->all()['data']['patientCase'];
 		$examinationData=$request->all()['data']['examinationData'];
 		
 		$opd_id_org=$data['opd_id'];
 		
 		//for patient check up
 		if($opd_id_org){
 			$data_case=array();
 			$data_case['is_report']=0;
 			$update=PatientCaseManagment::where('section_id',$opd_id_org)->update($data_case);

 			$del=PatientCheckUp::where('opd_id',$opd_id_org)->delete();
 			$data_patient_checkup_obj=new PatientCheckUp();
 			$data_patient_checkup_obj->patient_id=$data['patientlist'];
 			$data_patient_checkup_obj->user_id=$user_id;
 			$data_patient_checkup_obj->opd_id=$opd_id_org;
			$data_patient_checkup_obj->height=$data['height'];
			$data_patient_checkup_obj->weight=$data['weight'];
			if(isset($data['bmi']))
			{
				$data_patient_checkup_obj->bmi=$data['bmi'];
			}
			$data_patient_checkup_obj->vitals=$data['vitals'];
			$data_patient_checkup_obj->pulse=$data['pulse'];
			$data_patient_checkup_obj->bp=$data['bp_systolic'].'/'.$data['bp_diastolic'];
			$data_patient_checkup_obj->temp=$data['temp'];
			$data_patient_checkup_obj->pain=$data['pain_value'];
			$data_patient_checkup_obj->save();
 		}
       
        
		//opd details 
		$advice=array('type'=>'scribble','value'=>'');
 		if($step4_data['adviceType']=='text')
 		{
 			$advice=array('type'=>$step4_data['adviceType'],'value'=>$step4_data['advice']);
 		}
 		else if(isset($step4_data['signaturePad2_src']))
 		{
 			$advice=array('type'=>$step4_data['adviceType'],'value'=>$step4_data['signaturePad2_src']);
 		}
 		if($data['historyType']=='text')
 		{
 			$history=array('type'=>$data['historyType'],'value'=>$data['history']);
 		}
 		else
 		{
 			$history=array('type'=>$data['historyType'],'value'=>$data['signaturePad_src']);
 		}
 		if($data['pastHistoryType']=='text')
 		{
 			$past_history=array('type'=>$data['pastHistoryType'],'value'=>$data['past_history']);
 		}
 		else
 		{
 			$past_history=array('type'=>$data['pastHistoryType'],'value'=>$data['signaturePad1_src']);
 		}
 		$advice_final=json_encode($advice);
 		$history_final=json_encode($history);
 		$past_history_final=json_encode($past_history);
 		//opd detail option
		$del=OpdDetailsOption::where('opd_id',$opd_id_org)->delete();
		$opdDetailsOptionObj = new OpdDetailsOption();
		$opdDetailsOptionObj->opd_id=$opd_id_org;
		$opdDetailsOptionObj->history=$history_final;
		$opdDetailsOptionObj->advice=$advice_final;
		$opdDetailsOptionObj->past_history=$past_history_final;
		$opdDetailsOptionObj->provisional_diagnosis =$provisional_diagnosis ;
		$opdDetailsOptionObj->follow_up =$step4_data['follow_up'] ;
		$opdDetailsOptionObj->diagnosis = $diagnosis ;
		$opdDetailsOptionObj->status = 1 ;
		$opdDetailsOptionObj->save();

		

 		//save prescription
 		$del=PrescriptionDetails::where('opd_id',$opd_id_org)->delete();
 		$del_sub=PrescriptionClockDetails::where('opd_id',$opd_id_org)->delete();
 		if(!empty($prescription_data))
 		{
 			foreach($prescription_data as $prescription)
	 		{
	 			$prescription_obj=new PrescriptionDetails();
	 			$prescription_obj->opd_id=$opd_id_org;
	 			$prescription_obj->user_id=$user_id;
	 			if(strpos($prescription['pid'],'other_') !== false)
	 			{
	 				$prescription_obj->other_prescription=$prescription['name'];
	 			}
	 			else
	 			{
	 				$prescription_obj->prescription_drug_id=$prescription['pid'];
	 			}
	 			$prescription_obj->how_many_times=$prescription['type'];
	 			$prescription_obj->total_prescription_days=$prescription['total_prescription_days'];
	 			$prescription_obj->details=$prescription['details'];
	 			$prescription_obj->total_quantity=$prescription['total_quantity'];
	 			$prescription_obj->clock_suggest=$prescription['clock_suggest'];
	 			$prescription_obj->qhrs=$prescription['qhrs'];
	 			$prescription_obj->total_qhrs=$prescription['total_qhrs'];
	 			$prescription_obj->remove=$prescription['remove'];
	 			$prescription_obj->save();
	 			$last_prescription_id=$prescription_obj->id;

	 			if($prescription['type']=='Q-Hrs')
	 			{
	 					for($i=1;$i<=$prescription['total_qhrs'];$i++)
		 				{
		 					$prescription_clock_obj=new PrescriptionClockDetails();
		 					$prescription_clock_obj->opd_id=$opd_id_org;
		 					$prescription_clock_obj->prescription_id=$last_prescription_id;
		 					$prescription_clock_obj->clock_quantity=$prescription['clock_quantity_'.$i];
				 			$prescription_clock_obj->clock_time=$prescription['clock_time_'.$i];
				 			$prescription_clock_obj->save();
		 				}
	 			}
	 			else
	 			{
	 				for($i=1;$i<=4;$i++)
	 				{
	 					$prescription_clock_obj=new PrescriptionClockDetails();
	 					$prescription_clock_obj->opd_id=$opd_id_org;
	 					$prescription_clock_obj->prescription_id=$last_prescription_id;
	 					$prescription_clock_obj->clock_quantity=$prescription['clock_quantity_'.$i];
			 			$prescription_clock_obj->clock_time=$prescription['clock_time_'.$i];
			 			$prescription_clock_obj->save();
	 				}
	 			}
	 		}
 		}
 		$del=OPDPhysioDetails::where('opd_id',$opd_id_org)->delete();
 		if($reff_data['physio_details']!='')
 		{
 			$physio_obj=new OPDPhysioDetails();
			$physio_obj->opd_id=$opd_id_org;
			$physio_obj->user_id=$user_id;
			$physio_obj->details=$reff_data['physio_details'];
			$physio_obj->save();
 		}
 		
 		//opd cross references
 		$del=CrossDetails::where('opd_id',$opd_id_org)->delete(); 
 		if(!empty($cross_opd_data))
 		{	
 			
 			foreach($cross_opd_data as $cross)
 			{
 				$cross_obj=new CrossDetails();
 				$cross_obj->opd_id=$opd_id_org;
 				$cross_obj->user_id=$user_id;
 				$cross_obj->cross_type=$cross['subtype'];
 				$cross_obj->cross_value=$cross['value'];
 				$cross_obj->save();
 			}
 		}
 		//opd laboratory references 
 		$del=LaboratoryDetails::where('opd_id',$opd_id_org)->where('referance',0)->delete();
 		if(!empty($lab_opd_data))
 		{	
 			
 			foreach($lab_opd_data as $lab)
 			{
 				$lab_obj=new LaboratoryDetails();
	 			$lab_obj->referance=0;
 				$lab_obj->opd_id=$opd_id_org;
 				$lab_obj->user_id=$user_id;
 				if(isset($lab['lab_id']))
 				{
 					$lab_obj->laboratory_id=$lab['lab_id'];
 				}
 				
 				$lab_obj->remove='false';
 				$lab_obj->save();
 			}
 		}
 		//opd radiology references 
 		$del=Radiology::where('opd_id',$opd_id_org)->where('referance',0)->delete();
 		if(!empty($radio_opd_data))
 		{
 			foreach($radio_opd_data as $radio)
 			{
 				$radiology_obj=new Radiology();
	 			$radiology_obj->opd_id=$opd_id_org;
	 			$radiology_obj->user_id=$user_id;
	 			$radiology_obj->type=$radio['type'];
	 			$radiology_obj->type_name=$radio['type_name'];
	 			$radiology_obj->bodyparts=$radio['bodyPart'];
	 			$radiology_obj->qualifiers=$radio['qualifier'];
	 			$radiology_obj->special_request=$radio['special_request'];
	 			$radiology_obj->referance=0;
	 			$radiology_obj->details=$radio['textData'];
	 			if(isset($radio['body_part_side']))
	 			{
	 				$radiology_obj->body_part_side=$radio['body_part_side'];
	 				if($radiology_obj->body_part_side=='Others')
	 				{
	 					$body_part_others=array();
	 					if($radio['body_part_others_type']=='text')
						{
							$body_part_others=array('type'=>$radio['body_part_others_type'],'value'=>$radio['body_part_others']);
						}
						else
						{
							$body_part_others=array('type'=>$radio['body_part_others_type'],'value'=>$radio['signaturePad3_src']);
						}

						$radiology_obj->body_part_others=json_encode($body_part_others);
	 				}
	 			}
	 			if($radio['type']=='other')
	 			{
	 				$radiology_obj->radiology_other = $radio['radiologyOther'];
	 			}
	 			if($radio['type']=='X-Rays')
	 			{
	 				$radiology_obj->subtype = '';
	 			}
	 			else if($radio['type']=='MRI')
	 			{
	 				if($radiology_obj->bodyparts=='Spine')
	 				{
	 					$radiology_obj->subtype=$radio['spine_option_value'];
	 				}
	 			}
	 			$radiology_obj->save();
 			}
 		}
 		/*for form -2 library*/
 		$del=LaboratoryDetails::where('opd_id',$opd_id_org)->where('referance',1)->delete();
 		if(!empty($labdata))
 		{
 			foreach($labdata['type'] as $lab)
 			{
				$lab_obj_2=new LaboratoryDetails();
				$lab_obj_2->referance=1;
 				$lab_obj_2->opd_id=$opd_id_org;
 				$lab_obj_2->user_id=$user_id;
 				$lab_obj_2->laboratory_id=$lab['id'];
 				$lab_obj_2->date=Carbon::createFromFormat('d-m-Y', $lab['lab_date']['time'])->format('Y-m-d');
 				$lab_obj_2->result=$lab['result'];
 				//$lab_obj_2->assign_dr=$lab['assign'];
 				$lab_obj_2->remove='false';
 				$lab_obj_2->save();
 				
 				
 			}
 			
 		}
 		/*for form -2 library*/
 		/*for radiology */
 		$del=Radiology::where('opd_id',$opd_id_org)->where('referance',1)->delete();
 		if(!empty($radiology_data))
 		{
 			foreach($radiology_data as $r_data)
 			{
 				$radiology_obj_2=new Radiology();
	 			$radiology_obj_2->opd_id=$opd_id_org;
	 			$radiology_obj_2->user_id=$user_id;
	 			$radiology_obj_2->type=$r_data['type'];
	 			$radiology_obj_2->type_name=$r_data['type_name'];
	 			$radiology_obj_2->bodyparts=$r_data['bodyPart'];
	 			$radiology_obj_2->qualifiers=$r_data['qualifier'];
	 			$radiology_obj_2->special_request=$r_data['special_request'];
	 			$radiology_obj_2->referance=1;
	 			$radiology_obj_2->details=$r_data['textData'];
	 			$image_data=$r_data['imgData'];
	 			if(isset($r_data['body_part_side']))
	 			{
	 				$radiology_obj_2->body_part_side=$r_data['body_part_side'];
	 				if($radiology_obj_2->body_part_side=='Others')
	 				{
	 					$body_part_others=array();
	 					if($r_data['body_part_others_type']=='text')
						{
							$body_part_others=array('type'=>$r_data['body_part_others_type'],'value'=>$r_data['body_part_others']);
						}
						else
						{
							$body_part_others=array('type'=>$r_data['body_part_others_type'],'value'=>$r_data['signaturePad3_src']);
						}
						
						$radiology_obj_2->body_part_others=json_encode($body_part_others);     
					}
	 			}
	 			
	 			if($r_data['type']=='other')
	 			{
	 				$radiology_obj_2->radiology_other = $r_data['radiologyOther'];
	 			}
	 			if($r_data['type']=='X-Rays')
	 			{
	 				// $radiology_obj_2->subtype=$r_data['x_ray_type'];
	 				$radiology_obj_2->subtype = '';
	 			}
	 			else if($r_data['type']=='MRI')
	 			{
	 				if($radiology_obj_2->bodyparts=='Spine')
	 				{
	 					$radiology_obj_2->subtype=$r_data['spine_option_value'];
	 				}
	 			}
	 			$radiology_obj_2->save();
	 			$radiology_id=$radiology_obj_2->id;
	 			if(!empty($image_data))
	 			{
		 			foreach($image_data as $image)
		 			{
		 				$attachment=array();
		 				if($image['remove']!='true' && $image['type']=='image')
		 				{
		 					$r_attach_obj=new RadiologyAttachments();
		 					$r_attach_obj->opd_id=$opd_id_org;
		 					$r_attach_obj->radiology_id=$radiology_id;
		 					//$attachment['image']=$image['data'];
		 					//$r_attach_obj->image=$image['data'];
		 					$r_attach_obj->save();
		 					
		 				}
		 				
		 			}
	 			}
 			}
 		}
 		/*for radiology */
 		/*for examination*/
 		$del=Examination::where('opd_id',$opd_id_org)->delete();
 		if(!empty($examinationData))
 		{
 			
 			$examination_obj=new Examination();
 			$examination_obj->opd_id=$opd_id_org;
 			$examination_obj->user_id=$user_id;
 			$examination_obj->department=$department;
 			$examination_obj->examination_data = $examinationData;
 			$examination_obj->save();
 		}
 		$patient_data=array();
 		if($opd_id_org!=0 && $opd_id_org!='')
 		{
 			$opd_details=OpdDetails::with('patientDetails')->where('id',$opd_id_org)->first();
 			$patient_data['patient_id']=$opd_details->patient_id;
 			$patient_data['opd_pr_id']=$opd_details->id;
 			$patient_data['opd_id']=$opd_details->opd_id;
 			$patient_data['p_name']=$opd_details['patientDetails']->first_name.' '.$opd_details['patientDetails']->last_name;
 			if($opd_details['patientDetails']->gender=='M')
 				$patient_data['gender']='Male';
 			else
 				$patient_data['gender']='Female';
 			$patient_data['age']=$opd_details['patientDetails']->age;
 			$patient_data['consultant']=$this->objUser->getUserNameById($opd_details['patientDetails']->consultant_id);
 			$patient_data['consult_id']=$opd_details['patientDetails']->consultant_id;
 			$patient_data['department']=$this->objUser->getDepartmentById($opd_details['patientDetails']->consultant_id);
 		}

 		$consultId =$opd_details['patientDetails']->consultant_id;
 		$notifyType = 'new_opd_update';
 		$dataText = 'OPD case update';
 			 $checkNotifStatus = NotificationRepository::checkRecordStatus($consultId,$notifyType);
 			if( $checkNotifStatus){

 				   $checkNotifStatus->data_consult_id = $consultId;
                    $checkNotifStatus->data_date = Carbon::now()->format('Y-m-d H:i:s');
                    $checkNotifStatus->data_text = $dataText;
                    $checkNotifStatus->status = '1';
                    $checkNotifStatus->save();
                    
 		 	}else{
 				 $addNotificationData = Notification::create([
                    'title' => 'OPD Data Update',
                    'type' => $notifyType,
                    'data_table' => 'OpdDetails',
                    'data_id' =>$opd_id_org,
                    'data_consult_id' => $consultId,
                    'data_date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'data_text' => 'Opd data Update',
                    'status' => '1'

                ]);
 			}
 		if($crossRefer == true) {
 			dd(Carbon::now());
 			$doctor_rec = $this->objUser->getUserDetaileById($user_id);
 			$doctor_name =$doctor_rec->first_name.' '.$doctor_rec->last_name;
			$caseManagement = new PatientCaseManagment();
			$caseManagement->case_type = 'cross';
			$caseManagement->section_type = 'opd';
			$caseManagement->section_id = $opd_details->id;
			$caseManagement->patient_id = $opd_details->patient_id;
			$caseManagement->referencesCarbon= $doctor_name;
			$caseManagement->consultant_id = $Carbon::now();
			$caseManagement->appointment_datetime = Carbon::now();
			// $caseManagement->status = '1';
			// $caseManagement->save();
 		}
 		if(count($patient_data)>0)
 		{
 			return ['code' => '200','data'=>$patient_data, 'message' => 'Record Sucessfully created'];
 		}
 		else
 		{
 			return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
 		}
 		
 	}

 	  /**
    *
    *
    **/
 	  //opd related

    /*public function getPatientDetailAndOpdInfo($patientId,$opdId){
       $result = array();
          $result['patientDetail'] =  PatientDetailsForm::where('id',$patientId)->first();
           $result['caseDetail'] = PatientCaseManagment::join('users','users.id','=','patient_case_managment.consultant_id')->select('patient_case_managment.*','patient_case_managment.section_id as opdId','users.*')->groupBy('patient_case_managment.patient_id')->orderBy('patient_case_managment.created_at','desc')->where('patient_case_managment.section_id',$opdId)->get();
          $result['opdDetails'] =  OpdDetails::select('*','id as opdid')->groupBy('patient_id')->orderBy('created_at','desc')->where('patient_id',$patientId)->get();
           $result['opdOptionDetails'] = OpdDetailsOption::where('opd_id',$opdId)->orderBy('id','DESC')->first();
     $exam_data="";
     $exam_new_data= Examination::where('opd_id',$opdId)->orderBy('id','DESC')->first();
     if(!empty($exam_new_data))
     {
      $exam_data=$exam_new_data->examination_data;
     }
     $result['opdExaminationData'] =$exam_data;
     $result[''] = OPDPhysioDetails::where('opd_id',$opdId)->first();
     $result['opdReferalCrossData'] = CrossDetails::where('opd_id',$opdId)->whereDate('created_at',Carbon::today()->format('Y-m-d'))->get();
     $result['opdReferalLaboraryData'] =LaboratoryDetails::join('laboratory','laboratory_details.laboratory_id','=','laboratory.id')->where('laboratory_details.opd_id',$opdId)->where('laboratory_details.referance',0)->whereDate('laboratory_details.created_at',Carbon::today()->format('Y-m-d'))->get();
      $result['opdReferalRadiologyData'] = Radiology::where('opd_id',$opdId)->where('referance',0)->whereDate('created_at',Carbon::today()->format('Y-m-d'))->get();
      $result['opdLabData'] = LaboratoryDetails::join('laboratory','laboratory_details.laboratory_id','=','laboratory.id')->where('laboratory_details.opd_id',$opdId)->where('laboratory_details.referance',1)->whereDate('laboratory_details.created_at',Carbon::today()->format('Y-m-d'))->get();
      $result['opdRadiologyData'] = Radiology::where('opd_id',$opdId)->where('referance',1)->whereDate('created_at',Carbon::today()->format('Y-m-d'))->get();
      //for prescriptiondata
 		 	$prescript_array=$this->getPrescriptionDataForPrint($opdId);
 			$result['opdprescriptionData']=$prescript_array;
 		//for prescriptiondata over 
      $advice = $result['opdOptionDetails']->advice;
      $history = $result['opdOptionDetails']->history;
      $pastHistory = $result['opdOptionDetails']->past_history;
    //$examinationData =  $result['opdExaminationData']->examination_data;
     //
      $result['adviceData'] = json_decode($advice,true); 
      $result['historyData'] = json_decode($history,true); 
      $result['past_historyData'] = json_decode($pastHistory,true); 
     // $result['opdExaminationDataList'] = json_decode($examinationData,true); 

     return $result;
    }
*/
 	
 }
?>