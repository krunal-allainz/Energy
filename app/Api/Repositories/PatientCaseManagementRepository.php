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
 use euro_hms\Api\Repositories\BodypartsRepository;
 use euro_hms\Api\Repositories\QualifiersRepository;
 use euro_hms\Api\Repositories\SpecialRequestRepository;
 use euro_hms\Models\PatientDetailsForm;
 use euro_hms\Models\OpdDetailsOption;
 use euro_hms\Models\TokenManagment;
 use euro_hms\Models\PrescriptionDrugs;
 use euro_hms\Models\Notification;
 use Carbon\Carbon;
 use DB;

 class PatientCaseManagementRepository 
 {
 	/**
 	 * [__construct description]
 	 */
 	public function __construct(){
        $this->objPatient = new PatientRepository();
        $this->objUser = new UserRepository();
        $this->objBodyparts=new BodypartsRepository();
        $this->objQualifiers=new QualifiersRepository();
        $this->objSpecialRequest=new SpecialRequestRepository();
    }

    /**
     * [getPatientCaseDetailsByPatientId description]
     * @param  [type] $pid [description]
     * @return [type]      [description]
     */
     public function getPatientCaseDetailsByPatientId($pid)
    {
        return PatientCaseManagment::where('patient_id',$pid)->orderBy('id','desc')->first();
    }

    /**
     * [getPatientCaseAndTokenDetailByCaseId description]
     * @param  [type] $caseID [description]
     * @return [type]         [description]
     */
    public function getPatientCaseAndTokenDetailByCaseId($caseID)
   {
       $result = PatientCaseManagment::select('patient_case_managment.id as caseId','patient_case_managment.case_type','patient_case_managment.section_id','patient_case_managment.patient_id','patient_case_managment.references','patient_case_managment.main_case_id','patient_case_managment.consultant_id','token_managment.token','token_managment.date','token_managment.status')->join('token_managment','token_managment.patient_case_id','=','patient_case_managment.id')->where('token_managment.patient_case_id',$caseID)->where('patient_case_managment.id',$caseID)->orderBy('patient_case_managment.id','DESC')->first();
      
       return $result;
   }

  /**
   * [storeOpd description]
   * @param  [type] $request [description]
   * @return [type]          [description]
   */
  public function storeOpd($request)
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
        
        $case_id=$data['case_id'];
        
        //for patient check up
        if($case_id){
          $data_patient_checkup_obj=new PatientCheckUp();
          $data_patient_checkup_obj->patient_id=$data['patientlist'];
          $data_patient_checkup_obj->user_id=$user_id;
          $data_patient_checkup_obj->patient_case_management_id=$case_id;
          //$data_patient_checkup_obj->opd_id=$opd_id_org;
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
            //patient case status
           
           
            
        
            if($step4_data['adviceType']=='text')
            {
              $advice=array('type'=>$step4_data['adviceType'],'value'=>$step4_data['advice']);
            }
            else
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
            $opdDetailsOptionObj = new OpdDetailsOption();
            //$opdDetailsOptionObj->opd_id=$opd_id_org;
            $opdDetailsOptionObj->patient_case_management_id=$case_id;
            $opdDetailsOptionObj->history=$history_final;
            $opdDetailsOptionObj->advice=$advice_final;
            $opdDetailsOptionObj->past_history=$past_history_final;
            $opdDetailsOptionObj->provisional_diagnosis =$provisional_diagnosis ;
            $opdDetailsOptionObj->follow_up =$step4_data['follow_up'] ;
            $opdDetailsOptionObj->diagnosis = $diagnosis ;
            $opdDetailsOptionObj->status = 1 ;
            $opdDetailsOptionObj->save();

        //save prescription
        if(!empty($prescription_data))
        {
          foreach($prescription_data as $prescription)
          {
            $prescription_obj=new PrescriptionDetails();
            $prescription_obj->patient_case_management_id=$case_id;
            //$prescription_obj->opd_id=$opd_id_org;
            $prescription_obj->user_id=$user_id;
            if($prescription['pid']=='other')
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
                  //$prescription_clock_obj->opd_id=$opd_id_org;
                  $prescription_clock_obj->patient_case_management_id=$case_id;
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
                //$prescription_clock_obj->opd_id=$opd_id_org;
                $prescription_clock_obj->patient_case_management_id=$case_id;
                $prescription_clock_obj->prescription_id=$last_prescription_id;
                $prescription_clock_obj->clock_quantity=$prescription['clock_quantity_'.$i];
                $prescription_clock_obj->clock_time=$prescription['clock_time_'.$i];
                $prescription_clock_obj->save();
              }
            }
          }
        }
        if($reff_data['referral']=='physiotherapy')
        {
          $physio_obj=new OPDPhysioDetails();
          $physio_obj->patient_case_management_id=$case_id;
          //$physio_obj->opd_id=$opd_id_org;
          $physio_obj->user_id=$user_id;
          $physio_obj->details=$reff_data['physio_details'];
          $physio_obj->save();
        }
        
        //opd cross references 
        if(!empty($cross_opd_data))
        { 
          foreach($cross_opd_data as $cross)
          {
            $cross_obj=new CrossDetails();
            $cross_obj->patient_case_management_id=$case_id;
            //$cross_obj->opd_id=$opd_id_org;
            $cross_obj->user_id=$user_id;
            $cross_obj->cross_type=$cross['subtype'];
            $cross_obj->cross_value=$cross['value'];
            $cross_obj->save();
          }
        }
        //opd laboratory references 
        if(!empty($lab_opd_data))
        { 
          foreach($lab_opd_data as $lab)
          {
            $lab_obj=new LaboratoryDetails();
            $lab_obj->referance=0;
            $lab_obj->patient_case_management_id=$case_id;
            //$lab_obj->opd_id=$opd_id_org;
            $lab_obj->user_id=$user_id;
            $lab_obj->laboratory_id=$lab['lab_id'];
            $lab_obj->remove='false';
            $lab_obj->save();
          }
        }
        //opd radiology references 
        if(!empty($radio_opd_data))
        { 
          foreach($radio_opd_data as $radio)
          {
           
           $radiology_obj=new Radiology();
              $radiology_obj->patient_case_management_id=$case_id;
              //$radiology_obj->opd_id=$opd_id_org;
              $radiology_obj->user_id=$user_id;
              $radiology_obj->radiology_id=$radio['type'];
              $radiology_obj->type_name=$radio['type_name'];
              if($radio['bodyPart']!="" && $radio['bodyPart']!=null)
              {
                  $radiology_obj->bodyparts_id=$radio['bodyPart'];
              }
              else
              {
                  $radiology_obj->bodyparts_text=$radio['bodyPart_text'];
              }
              if($radio['qualifier']!="" && $radio['qualifier']!=null)
              {
                   $radiology_obj->qualifiers_id=$radio['qualifier'];
              }
              else
              {
                  $radiology_obj->qualifiers_text=$radio['qualifier_text'];
              }
              if($radio['special_request']!="" && $radio['special_request']!=null)
              {
                  $radiology_obj->special_request_id=$radio['special_request'];
              }
              else
              {
                  $radiology_obj->special_request_text=$radio['special_request_text'];
              }
             
              
              $radiology_obj->referance=0;
              $radiology_obj->details=$radio['textData'];
              $image_data=$radio['imgData'];
              if(isset($radio['body_part_side']))
              {
                $radiology_obj->body_part_side_id=$radio['body_part_side'];
                if(isset($radio['body_part_side_text']) && $radio['body_part_side_text']=='Others')
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
              
              if($radio['type_name']=='Other')
              {
                $radiology_obj->radiology_other = $radio['radiologyOther'];
              }
              if($radio['type_name']=='MRI')
              {
                if($radio['bodyPart_text']=='Spine')
                {
                  $radiology_obj->spine_id=$radio['spine_option_value'];
                }
              }
              else if($radio['bodyPart_text']=='Other')
              {
                  $radiology_obj->bodyparts_other=$radio['bodyPart_others'];
              }
              $radiology_obj->save();
           
          }
        }
        /*for form -2 library*/
        if(!empty($labdata))
        {
          //print_r($labdata);exit;
          foreach($labdata['type'] as $lab)
          {
            $lab_obj_2=new LaboratoryDetails();
            $lab_obj_2->referance=1;
            $lab_obj_2->patient_case_management_id=$case_id;
            //$lab_obj_2->opd_id=$opd_id_org;
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
        if(!empty($radiology_data))
        {
          
          foreach($radiology_data as $r_data)
          {
           $radiology_obj_2=new Radiology();
              $radiology_obj_2->patient_case_management_id=$case_id;
              //$radiology_obj_2->opd_id=$opd_id_org;
              $radiology_obj_2->user_id=$user_id;
              $radiology_obj_2->radiology_id=$r_data['type'];
              $radiology_obj_2->type_name=$r_data['type_name'];
              if($r_data['bodyPart']!="" && $r_data['bodyPart']!=null)
              {
                  $radiology_obj_2->bodyparts_id=$r_data['bodyPart'];
              }
              else
              {
                  $radiology_obj_2->bodyparts_text=$r_data['bodyPart_text'];
              }
              if($r_data['qualifier']!="" && $r_data['qualifier']!=null)
              {
                   $radiology_obj_2->qualifiers_id=$r_data['qualifier'];
              }
              else
              {
                  $radiology_obj_2->qualifiers_text=$r_data['qualifier_text'];
              }
              if($r_data['special_request']!="" && $r_data['special_request']!=null)
              {
                  $radiology_obj_2->special_request_id=$r_data['special_request'];
              }
              else
              {
                  $radiology_obj_2->special_request_text=$r_data['special_request_text'];
              }
             
              
              $radiology_obj_2->referance=1;
              $radiology_obj_2->details=$r_data['textData'];
              $image_data=$r_data['imgData'];
              if(isset($r_data['body_part_side']))
              {
                $radiology_obj_2->body_part_side_id=$r_data['body_part_side'];
                if(isset($r_data['body_part_side_text']) && $r_data['body_part_side_text']=='Others')
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
              
              if($r_data['type_name']=='Other')
              {
                $radiology_obj_2->radiology_other = $r_data['radiologyOther'];
              }
              if($r_data['type_name']=='MRI')
              {
                if($r_data['bodyPart_text']=='Spine')
                {
                  $radiology_obj_2->spine_id=$r_data['spine_option_value'];
                }
              }
              else if($r_data['bodyPart_text']=='Other')
              {
                  $radiology_obj_2->bodyparts_other=$r_data['bodyPart_others'];
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
                  $r_attach_obj->patient_case_management_id=$case_id;
                  //$r_attach_obj->opd_id=$opd_id_org;
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

        if(!empty($examinationData))
        {
          $examination_obj=new Examination();
          $examination_obj->patient_case_management_id=$case_id;
          //$examination_obj->opd_id=$opd_id_org;
          $examination_obj->user_id=$user_id;
          $examination_obj->department=$department;
          $examination_obj->examination_data = $examinationData;
          $examination_obj->save();
        }
        $patient_data=array();
        if($case_id!=0 && $case_id!='')
        {
          $case_details=PatientCaseManagment::with('patientDetails')->where('id',$case_id)->first();
          $patient_data['patient_id']=$case_details->patient_id;
          $patient_data['case_pr_id']=$case_details->id;
          $patient_data['opd_id']=$case_details->opd_id;
          $patient_data['p_name']=$case_details['patientDetails']->first_name.' '.$case_details['patientDetails']->last_name;
          if($case_details['patientDetails']->gender=='M')
            $patient_data['gender']='Male';
          else
            $patient_data['gender']='Female';
          $patient_data['age']=$case_details['patientDetails']->age;
          $patient_data['consultant']=$this->objUser->getUserNameById($case_details['patientDetails']->consultant_id);
          $patient_data['consult_id']=$case_details['patientDetails']->consultant_id;
          $patient_data['department']=$this->objUser->getDepartmentById($case_details['patientDetails']->consultant_id);
        }
        if($crossRefer == true) {
          
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
        $consultId = $patientCaseData['consult_dr'];
        $notifyType = 'new_opd_save';
        $dataText = 'OPD case add';
           $checkNotifStatus = NotificationRepository::checkRecordStatus($consultId,$notifyType);
          if( $checkNotifStatus){

              $checkNotifStatus->data_id = $consultId;
              $checkNotifStatus->data_date = Carbon::now()->format('Y-m-d H:i:s');
              $checkNotifStatus->data_text = $dataText;
              $checkNotifStatus->status = '1';
              $checkNotifStatus->save();

          }else{
             $addNotificationData = Notification::create([
                        'title' => 'OPD Data Add',
                        'type' => $notifyType,
                        'data_table' => 'PatientCaseManagment',
                        'data_id' =>$case_id,
                        'data_consult_id' => $consultId,
                        'data_date' => Carbon::now()->format('Y-m-d H:i:s'),
                        'data_text' => 'Opd data save',
                        'status' => '1'

                    ]);
          }

        if($case_id!=0 || $case_id!="" || count($patient_data)>0)
        {
           $caseStatusManagment = TokenManagment::where('patient_case_id',$case_id)->where('token',$patientCaseData['token_no'])->where('date',$patientCaseData['token_date'])->update(array('status' => 'examine'));
          return ['code' => '200','data'=>$patient_data, 'message' => 'Record Sucessfully created'];
        }
        else
        {
          return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
        
    }

    public function getUPdateOPDCaseInfo($patient_id,$case_id)
  {
      $result=array();

      $result['opdData']['patientlist']=$patient_id;
      $result['opdData']['case_id']=$case_id;
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
      $patientcheckup=PatientCheckUp::where('patient_case_management_id',$case_id)->orderBy('id','desc')->first();
      
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
      $option_details=OpdDetailsOption::where('patient_case_management_id',$case_id)->orderBy('id','desc')->first();
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
      $prescription_details=PrescriptionDetails::where('patient_case_management_id',$case_id)->orderBy('id','asc')->get();
      $prescript_array=array();
      $p_index=1;
      foreach($prescription_details as $presp)
      {
        
        $rest_presp=array();
        $rest_presp['id']=$p_index;
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
        $p_index=$p_index+1;
      }
     
      $result['prescriptionData']=$prescript_array;
      /*print_r($result['prescriptionData']);
      exit;*/
      

      //for physio details
      $result['reffData']['referral']='';
      $result['reffData']['laboratory']='';
      $result['reffData']['physio_details']='';
      $physio_details=OPDPhysioDetails::where('patient_case_management_id',$case_id)->orderBy('id','desc')->first();
      if($physio_details)
      {
        $result['reffData']['physio_details']=$physio_details->details;
      }
      
      //for cross details array
      $cross_details=CrossDetails::where('patient_case_management_id',$case_id)->orderBy('id','asc')->get();
      $cross_array=array();
      $index_cross=1;
      foreach($cross_details as $cross)
      {
        $rest_cross=array();
        $rest_cross['id']=$index_cross;
        $rest_cross['type']='Cross';
        $rest_cross['subtype']=$cross->cross_type;
        $rest_cross['value']=$cross->cross_value;
        if($cross->cross_type=='Internal')
        {
            $name=$this->objUser->getUserNameById($cross->cross_value);
            $rest_cross['text']=ucwords($name);
        }
        else
        {
           $rest_cross['text']=$cross->cross_value;
        }
        
        $cross_array[]=$rest_cross;
        $index_cross++;
      }
      $result['reffData']['reffreal_cross_array']=$cross_array;

      //for lab data last step
      $lab_details=LaboratoryDetails::where('patient_case_management_id',$case_id)->orderBy('id','asc')->get();
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
      $radio_details=Radiology::where('patient_case_management_id',$case_id)->orderBy('id','asc')->get();
      $radio_array=array();
      $index_radio=1;
      foreach($radio_details as $radio)
      {
        if($radio->referance==0)
        {
          $rest_radio=array();
          $rest_radio['id']=$index_radio;
          $rest_radio['uploadType']='image';
          $rest_radio['bodyPart']=$radio->bodyparts_id;
          $rest_radio['qualifierPart']='';
          if($radio->bodyparts_id!=null && $radio->bodyparts_id!='' && $radio->bodyparts_id!=0)
          {
              $rest_radio['bodyPart_text']=$this->objBodyparts->getBodypartsNameById($radio->bodyparts_id);          
          }
          else
          {
              $rest_radio['bodyPart_text']=$radio->bodyparts_text;
          }
          
          $rest_radio['type']=$radio->type;
          $rest_radio['spine_option_value']=$radio->spine_id;
          $rest_radio['subType']=$radio->bodyparts_id;
          $rest_radio['qualifier']=$radio->qualifiers_id;
          if($radio->qualifiers_id!=null && $radio->qualifiers_id!='' && $radio->qualifiers_id!=0)
          {
              $rest_radio['qualifier_text']=$this->objQualifiers->getQualifiersNameById($radio->qualifiers_id);   
          }
          else
          {
              $rest_radio['qualifier_text']=$radio->qualifiers_text;
          }
          $rest_radio['imgData']='';
          $rest_radio['textData']=$radio->details;
          $rest_radio['subtype_text_enable']=false;
          $rest_radio['qualifier_text_enable']=false;
          $rest_radio['special_request']=$radio->special_request_id;
          if($radio->special_request_id!=null && $radio->special_request_id!='' && $radio->special_request_id!=0)
          {
              $rest_radio['special_request_text']=$this->objSpecialRequest->getSpecialRequestNameById($radio->special_request_id);   
          }
          else
          {
              $rest_radio['special_request_text']=$radio->special_request_text;
          }
          $rest_radio['removed']=$radio->removed;
          $rest_radio['body_part_side']=$radio->body_part_side_id;
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
          $rest_radio_2['bodyPart']=$radio_2->bodyparts_id;
          if($radio_2->bodyparts_id!=null && $radio_2->bodyparts_id!='' && $radio_2->bodyparts_id!=0)
          {
              $rest_radio_2['bodyPart_text']=$this->objBodyparts->getBodypartsNameById($radio_2->bodyparts_id);          
          }
          else
          {
              $rest_radio_2['bodyPart_text']=$radio_2->bodyparts_text;
          }
          
          $rest_radio_2['bodyPart_others']=$radio_2->bodyPart_others;
          $rest_radio_2['type']=$radio_2->radiology_id;
          $rest_radio_2['spine_option_value']=$radio_2->spine_id;
          $rest_radio_2['subType']=$radio_2->bodyparts_id;
          $rest_radio_2['qualifier']=$radio_2->qualifiers_id;
          if($radio_2->qualifiers_id!=null && $radio_2->qualifiers_id!='' && $radio_2->qualifiers_id!=0)
          {
              $rest_radio_2['qualifier_text']=$this->objQualifiers->getQualifiersNameById($radio_2->qualifiers_id);   
          }
          else
          {
              $rest_radio_2['qualifier_text']=$radio_2->qualifiers_text;
          }
          
          $rest_radio_2['imgData']='';
          $rest_radio_2['textData']=$radio_2->details;
          $rest_radio_2['subtype_text_enable']=false;
          $rest_radio_2['qualifier_radio_text_enable']=false;
          $rest_radio_2['special_request']=$radio_2->special_request_id;
          if($radio_2->special_request_id!=null && $radio_2->special_request_id!='' && $radio_2->special_request_id!=0)
          {
              $rest_radio_2['special_request_text']=$this->objSpecialRequest->getSpecialRequestNameById($radio_2->special_request_id);   
          }
          else
          {
              $rest_radio_2['special_request_text']=$radio_2->special_request_text;
          }
          $rest_radio_2['removed']=$radio_2->removed;
          $rest_radio_2['qualifierOtherPart']='';
          $rest_radio_2['body_part_side']=$radio_2->body_part_side_id;
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
      $examination_details=Examination::where('patient_case_management_id',$case_id)->orderBy('id','desc')->first();
      $result['examinationData']="";
      if($examination_details)
      {
        $result['examinationData']=$examination_details->examination_data;
      }
      
      
      return $result; 
  }
  
  /**
   * [getPrescriptionNameById description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function getPrescriptionNameById($id)
  {
    $presp=PrescriptionDrugs::where('id',$id)->first();
    return $presp->name;
  }

  /**
   * [getLabpratoryNameById description]  
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function getLabpratoryNameById($id)
  {
    return Laboratory::where('id',$id)->first();
  }
  /**
   * [getOPDCaseDetailsByPatientId description]
   * @param  [type] $pid [description]
   * @return [type]      [description]
   */
  public function getOPDCaseDetailsByPatientId($pid)
  {
      $getOPDDetails=DB::table('patient_details')
        ->join('patient_case_managment', 'patient_details.id', '=', 'patient_case_managment.patient_id')
        ->join('token_managment', 'patient_case_managment.id', '=', 'token_managment.patient_case_id')
        ->select('patient_details.first_name', 'patient_details.last_name', 'patient_case_managment.id as case_id','patient_case_managment.appointment_datetime as last_visit','token_managment.token as token_no','patient_details.uhid_no','token_managment.status as t_status','patient_details.id as patient_id','patient_case_managment.is_report')
        ->where('patient_details.id',$pid)
        //->groupBy('patient_case_managment.patient_id')
        ->get();
        return $getOPDDetails;
  }

  /**
   * [editOpdCaseDetails description]
   * @param  [type] $request [description]
   * @return [type]          [description]
   */
  public function editOpdCaseDetails($request)
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
        
        $case_id=$data['case_id'];
        
        //for patient check up
        if($case_id){
          $data_case=array();
          $data_case['is_report']=0;
          $update=PatientCaseManagment::where('id',$case_id)->update($data_case);

          $del=PatientCheckUp::where('patient_case_management_id',$case_id)->delete();
          $data_patient_checkup_obj=new PatientCheckUp();
          $data_patient_checkup_obj->patient_id=$data['patientlist'];
          $data_patient_checkup_obj->user_id=$user_id;
          $data_patient_checkup_obj->patient_case_management_id=$case_id;
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
        $del=OpdDetailsOption::where('patient_case_management_id',$case_id)->delete();
        $opdDetailsOptionObj = new OpdDetailsOption();
        $opdDetailsOptionObj->patient_case_management_id=$case_id;
        $opdDetailsOptionObj->history=$history_final;
        $opdDetailsOptionObj->advice=$advice_final;
        $opdDetailsOptionObj->past_history=$past_history_final;
        $opdDetailsOptionObj->provisional_diagnosis =$provisional_diagnosis ;
        $opdDetailsOptionObj->follow_up =$step4_data['follow_up'] ;
        $opdDetailsOptionObj->diagnosis = $diagnosis ;
        $opdDetailsOptionObj->status = 1 ;
        $opdDetailsOptionObj->save();

        

        //save prescription
        $del=PrescriptionDetails::where('patient_case_management_id',$case_id)->delete();
        $del_sub=PrescriptionClockDetails::where('patient_case_management_id',$case_id)->delete();
        if(!empty($prescription_data))
        {
          foreach($prescription_data as $prescription)
          {
            $prescription_obj=new PrescriptionDetails();
            $prescription_obj->patient_case_management_id=$case_id;
            $prescription_obj->user_id=$user_id;
            if($prescription['pid']=='other')
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
                  $prescription_clock_obj->patient_case_management_id=$case_id;
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
                $prescription_clock_obj->patient_case_management_id=$case_id;
                $prescription_clock_obj->prescription_id=$last_prescription_id;
                $prescription_clock_obj->clock_quantity=$prescription['clock_quantity_'.$i];
                $prescription_clock_obj->clock_time=$prescription['clock_time_'.$i];
                $prescription_clock_obj->save();
              }
            }
          }
        }
        $del=OPDPhysioDetails::where('patient_case_management_id',$case_id)->delete();
        if($reff_data['physio_details']!='')
        {
          $physio_obj=new OPDPhysioDetails();
          $physio_obj->patient_case_management_id=$case_id;
          $physio_obj->user_id=$user_id;
          $physio_obj->details=$reff_data['physio_details'];
          $physio_obj->save();
        }
        
        //opd cross references
        $del=CrossDetails::where('patient_case_management_id',$case_id)->delete(); 
        if(!empty($cross_opd_data))
        { 
          
          foreach($cross_opd_data as $cross)
          {
            $cross_obj=new CrossDetails();
            $cross_obj->patient_case_management_id=$case_id;
            $cross_obj->user_id=$user_id;
            $cross_obj->cross_type=$cross['subtype'];
            $cross_obj->cross_value=$cross['value'];
            $cross_obj->save();
          }
        }
        //opd laboratory references 
        $del=LaboratoryDetails::where('patient_case_management_id',$case_id)->where('referance',0)->delete();
        if(!empty($lab_opd_data))
        { 
          
          foreach($lab_opd_data as $lab)
          {
            $lab_obj=new LaboratoryDetails();
            $lab_obj->referance=0;
            $lab_obj->patient_case_management_id=$case_id;
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
        $del=Radiology::where('patient_case_management_id',$case_id)->where('referance',0)->delete();
        if(!empty($radio_opd_data))
        {
          foreach($radio_opd_data as $radio)
          {
              $radiology_obj=new Radiology();
              $radiology_obj->patient_case_management_id=$case_id;
              //$radiology_obj->opd_id=$opd_id_org;
              $radiology_obj->user_id=$user_id;
              $radiology_obj->radiology_id=$radio['type'];
              $radiology_obj->type_name=$radio['type_name'];
              if($radio['bodyPart']!="" && $radio['bodyPart']!=null)
              {
                  $radiology_obj->bodyparts_id=$radio['bodyPart'];
              }
              else
              {
                  $radiology_obj->bodyparts_text=$radio['bodyPart_text'];
              }
              if($radio['qualifier']!="" && $radio['qualifier']!=null)
              {
                   $radiology_obj->qualifiers_id=$radio['qualifier'];
              }
              else
              {
                  $radiology_obj->qualifiers_text=$radio['qualifier_text'];
              }
              if($radio['special_request']!="" && $radio['special_request']!=null)
              {
                  $radiology_obj->special_request_id=$radio['special_request'];
              }
              else
              {
                  $radiology_obj->special_request_text=$radio['special_request_text'];
              }
             
              
              $radiology_obj->referance=0;
              $radiology_obj->details=$radio['textData'];
              $image_data=$radio['imgData'];
              if(isset($radio['body_part_side']))
              {
                $radiology_obj->body_part_side_id=$radio['body_part_side'];
                if(isset($radio['body_part_side_text']) && $radio['body_part_side_text']=='Others')
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
              
              if($radio['type_name']=='Other')
              {
                $radiology_obj->radiology_other = $radio['radiologyOther'];
              }
              if($radio['type_name']=='MRI')
              {
                if($radio['bodyPart_text']=='Spine')
                {
                  $radiology_obj->spine_id=$radio['spine_option_value'];
                }
              }
              else if($radio['bodyPart_text']=='Other')
              {
                  $radiology_obj->bodyparts_other=$radio['bodyPart_others'];
              }
              $radiology_obj->save();
          }
        }
        /*for form -2 library*/
        $del=LaboratoryDetails::where('patient_case_management_id',$case_id)->where('referance',1)->delete();
        if(!empty($labdata))
        {
          foreach($labdata['type'] as $lab)
          {
            $lab_obj_2=new LaboratoryDetails();
            $lab_obj_2->referance=1;
            $lab_obj_2->patient_case_management_id=$case_id;
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
        $del=Radiology::where('patient_case_management_id',$case_id)->where('referance',1)->delete();
        if(!empty($radiology_data))
        {

          foreach($radiology_data as $r_data)
          {
              $radiology_obj_2=new Radiology();
              $radiology_obj_2->patient_case_management_id=$case_id;
              //$radiology_obj_2->opd_id=$opd_id_org;
              $radiology_obj_2->user_id=$user_id;
              $radiology_obj_2->radiology_id=$r_data['type'];
              $radiology_obj_2->type_name=$r_data['type_name'];
              if($r_data['bodyPart']!="" && $r_data['bodyPart']!=null)
              {
                  $radiology_obj_2->bodyparts_id=$r_data['bodyPart'];
              }
              else
              {
                  $radiology_obj_2->bodyparts_text=$r_data['bodyPart_text'];
              }
              if($r_data['qualifier']!="" && $r_data['qualifier']!=null)
              {
                   $radiology_obj_2->qualifiers_id=$r_data['qualifier'];
              }
              else
              {
                  $radiology_obj_2->qualifiers_text=$r_data['qualifier_text'];
              }
              if($r_data['special_request']!="" && $r_data['special_request']!=null)
              {
                  $radiology_obj_2->special_request_id=$r_data['special_request'];
              }
              else
              {
                  $radiology_obj_2->special_request_text=$r_data['special_request_text'];
              }
             
              
              $radiology_obj_2->referance=1;
              $radiology_obj_2->details=$r_data['textData'];
              $image_data=$r_data['imgData'];
              if(isset($r_data['body_part_side']))
              {
                $radiology_obj_2->body_part_side_id=$r_data['body_part_side'];
                if(isset($r_data['body_part_side_text']) && $r_data['body_part_side_text']=='Others')
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
              
              if($r_data['type_name']=='Other')
              {
                $radiology_obj_2->radiology_other = $r_data['radiologyOther'];
              }
              if($r_data['type_name']=='MRI')
              {
                if($r_data['bodyPart_text']=='Spine')
                {
                  $radiology_obj_2->spine_id=$r_data['spine_option_value'];
                }
              }
              else if($r_data['bodyPart_text']=='Other')
              {
                  $radiology_obj_2->bodyparts_other=$r_data['bodyPart_others'];
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
                  $r_attach_obj->patient_case_management_id=$case_id;
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
        $del=Examination::where('patient_case_management_id',$case_id)->delete();
        if(!empty($examinationData))
        {
          
          $examination_obj=new Examination();
          $examination_obj->patient_case_management_id=$case_id;
          $examination_obj->user_id=$user_id;
          $examination_obj->department=$department;
          $examination_obj->examination_data = $examinationData;
          $examination_obj->save();
        }
       $patient_data=array();
        if($case_id!=0 && $case_id!='')
        {
          $case_details=PatientCaseManagment::with('patientDetails')->where('id',$case_id)->first();
          $patient_data['patient_id']=$case_details->patient_id;
          $patient_data['case_pr_id']=$case_details->id;
          $patient_data['opd_id']=$case_details->opd_id;
          $patient_data['p_name']=$case_details['patientDetails']->first_name.' '.$case_details['patientDetails']->last_name;
          if($case_details['patientDetails']->gender=='M')
            $patient_data['gender']='Male';
          else
            $patient_data['gender']='Female';
          $patient_data['age']=$case_details['patientDetails']->age;
          $patient_data['consultant']=$this->objUser->getUserNameById($case_details['patientDetails']->consultant_id);
          $patient_data['consult_id']=$case_details['patientDetails']->consultant_id;
          $patient_data['department']=$this->objUser->getDepartmentById($case_details['patientDetails']->consultant_id);
        }
        if($crossRefer == true) {
          
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

        $consultId =$case_details['patientDetails']->consultant_id;
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
                        'data_table' => 'PatientCaseManagment',
                        'data_id' =>$case_id,
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
   * [getPatientOpdCaseDataReport description]
   * @param  [type] $caseId [description]
   * @return [type]         [description]
   */
  public function getPatientOpdCaseDataReport($caseId){
       $result = array();
       //$result['opdDetails'] = OpdDetails::where('id',$opdId)->first();
      $result['opdCaseDetails'] = PatientCaseManagment::where('id',$caseId)->first();
       $result['opdOptionDetails'] = OpdDetailsOption::where('patient_case_management_id',$caseId)->orderBy('id','DESC')->first();
       $exam_data="";
       $exam_new_data= Examination::where('patient_case_management_id',$caseId)->orderBy('id','DESC')->first();
       if(!empty($exam_new_data))
       {
        $exam_data=$exam_new_data->examination_data;
       }
       $result['opdExaminationData'] =$exam_data;
       $result['opdReferalphysioData'] = OPDPhysioDetails::where('patient_case_management_id',$caseId)->first();
       $result['opdReferalCrossData'] = $this->getCrossDetailsByCaseId($caseId);
       $result['opdReferalLaboraryData'] =LaboratoryDetails::join('laboratory','laboratory_details.laboratory_id','=','laboratory.id')->where('laboratory_details.patient_case_management_id',$caseId)->where('laboratory_details.referance',0)->whereDate('laboratory_details.created_at',Carbon::today()->format('Y-m-d'))->get();
        $result['opdReferalRadiologyData'] =$this->getRadiologyReportData(0,$caseId);
        $result['opdLabData'] = LaboratoryDetails::join('laboratory','laboratory_details.laboratory_id','=','laboratory.id')->where('laboratory_details.patient_case_management_id',$caseId)->where('laboratory_details.referance',1)->whereDate('laboratory_details.created_at',Carbon::today()->format('Y-m-d'))->get();
        $result['opdRadiologyData'] = $this->getRadiologyReportData(1,$caseId);

      //for prescriptiondata
        $prescript_array=$this->getPrescriptionDataForPrint($caseId);
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

  public function getRadiologyReportData($reff,$caseId)
  {
      $radio_data=Radiology::where('patient_case_management_id',$caseId)->where('referance',$reff)->whereDate('created_at',Carbon::today()->format('Y-m-d'))->get();
      $radio_array=array();
      foreach($radio_data as $radio)
      {
          $rad=array();
          $rad['type']=$radio->type_name;
          if($radio->bodyparts_id!=null && $radio->bodyparts_id!='' && $radio->bodyparts_id!=0)
          {
              $rad['bodyparts']=$this->objBodyparts->getBodypartsNameById($radio->bodyparts_id);          
          }
          else
          {
              $rad['bodyparts']=$radio->bodyparts_text;
          }
          if($radio->qualifiers_id!=null && $radio->qualifiers_id!='' && $radio->qualifiers_id!=0)
          {
              $rad['qualifiers']=$this->objQualifiers->getQualifiersNameById($radio->qualifiers_id);   
          }
          else
          {
              $rad['qualifiers']=$radio->qualifiers_text;
          }
          if($radio->special_request_id!=null && $radio->special_request_id!='' && $radio->special_request_id!=0)
          {
              $rad['special_request']=$this->objSpecialRequest->getSpecialRequestNameById($radio->special_request_id);   
          }
          else
          {
              $rad['special_request']=$radio->special_request_text;
          }
          $rad['details']=$radio->details;
          $radio_array[]=$rad;
      }

      return $radio_array;

  }

  public function getCrossDetailsByCaseId($caseId)
  {
      $cross_details=CrossDetails::where('patient_case_management_id',$caseId)->whereDate('created_at',Carbon::today()->format('Y-m-d'))->get();
      $index_cross=1;
      $cross_array=array();
      foreach($cross_details as $cross)
      {
        $rest_cross=array();
        $rest_cross['cross_type']=$cross->cross_type;
        if($cross->cross_type=='Internal')
        {
            $name=$this->objUser->getUserNameById($cross->cross_value);
            $rest_cross['cross_value']=ucwords($name);
        }
        else
        {
           $rest_cross['cross_value']=$cross->cross_value;
        }
        $cross_array[]=$rest_cross;
      }
      return $cross_array;
  }

  /**
   * [getPrescriptionDataForPrint description]
   * @param  [type] $caseId [description]
   * @return [type]         [description]
   */
  public function getPrescriptionDataForPrint($caseId)
  {
     $prescription_details=PrescriptionDetails::where('patient_case_management_id',$caseId)->where('remove','false')->orderBy('id','asc')->get();
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
   * [getPatientCaseDetailById description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function getPatientCaseDetailById($id){ 
      $result = PatientCaseManagment::where('id',$id)->orderBy('id','DESC')->first();
      return $result;
  }

  /**
   * [patientCheckUpDetailsByCaseId description]
   * @param  [type] $cid [description]
   * @return [type]      [description]
   */
  public function patientCheckUpDetailsByCaseId($cid)
  {
      return PatientCheckUp::where('patient_case_management_id',$cid)->orderBy('id', 'desc')->first();
  }

  public function patientDetailAndCaseInfo($patientId,$caseId){
      $result = array();
      
      $result['patientDetail'] =  PatientDetailsForm::where('id',$patientId)->first();
      $result['caseDetail'] = PatientCaseManagment::join('users','users.id','=','patient_case_managment.consultant_id')->select('patient_case_managment.*','patient_case_managment.id as caseId','users.*')->groupBy('patient_case_managment.patient_id')->orderBy('patient_case_managment.created_at','desc')->where('patient_case_managment.id',$caseId)->get();
      $result['opdOptionDetails'] = OpdDetailsOption::where('patient_case_management_id',$caseId)->orderBy('id','DESC')->first();
      $exam_data="";
      $exam_new_data= Examination::where('patient_case_management_id',$caseId)->orderBy('id','DESC')->first();
      if(!empty($exam_new_data))
      {
        $exam_data=$exam_new_data->examination_data;
      }
      $result['opdExaminationData'] =$exam_data;
      $result[''] = OPDPhysioDetails::where('patient_case_management_id',$caseId)->first();
      $result['opdReferalCrossData'] = $this->getCrossDetailsByCaseId($caseId);
      $result['opdReferalLaboraryData'] =LaboratoryDetails::join('laboratory','laboratory_details.laboratory_id','=','laboratory.id')->where('laboratory_details.patient_case_management_id',$caseId)->where('laboratory_details.referance',0)->whereDate('laboratory_details.created_at',Carbon::today()->format('Y-m-d'))->get();
      $result['opdReferalRadiologyData'] = $this->getRadiologyReportData(0,$caseId);
      $result['opdLabData'] = LaboratoryDetails::join('laboratory','laboratory_details.laboratory_id','=','laboratory.id')->where('laboratory_details.patient_case_management_id',$caseId)->where('laboratory_details.referance',1)->whereDate('laboratory_details.created_at',Carbon::today()->format('Y-m-d'))->get();
      $result['opdRadiologyData'] = $this->getRadiologyReportData(1,$caseId);
      //for prescriptiondata
      $prescript_array=$this->getPrescriptionDataForPrint($caseId);
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
 	
 }
?>