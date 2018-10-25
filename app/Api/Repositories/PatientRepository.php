<?php
  namespace euro_hms\Api\Repositories;


 use euro_hms\Models\PatientCheckUp;
 use euro_hms\Models\PatientDetailsForm;
 use Carbon\Carbon;
 use DB;
 use euro_hms\Api\Repositories\UserRepository;
 use euro_hms\Models\OpdDetails;
 use euro_hms\Models\IpdDetails;
 use euro_hms\Models\PatientCaseManagment;
 use euro_hms\Models\TokenManagment;
 use euro_hms\Models\Notification;
 use euro_hms\Api\Repositories\NotificationRepository;

 class PatientRepository 
 {

    public function __construct(){
        $this->patientDetailObj = new PatientDetailsForm();
    }

  public function patient_add($request)   
  { 
        $data = $request->all()['patientData']['patientData'];

        $patientType = $request->all()['patientData']['patientType'];
        $a_time=$data['appointment_datetime']['time'];
        $user_id=$data['consulting_dr'];
        $referance=$data['reference_dr'];
        $uhid="VN";
        $year = date('y');
        $insertedPatientId="";
        $sectionId = '';
        $opdInsert = 0;

        if($data['case'] == 'new') {
          $patientData=new PatientDetailsForm();
           $opdInsert  = 1;
        }
        else
          {

            $patientId =$data['patient_id'];
             if($data['case_type']  == 'new_consult'){
                $opdInsert = 1;
            }else{
               $opdData =  $this->getOPDDetailsByPatientId($patientId);
               $opdInsert = 0;
            }
            if($patientId!=0 && $patientId!="")
            {
              $patientData=PatientDetailsForm::findOrFail($patientId);
            }
            else
            {
              return ['code' => '300','data'=>'', 'message' => 'Record not found'];
            }
        }
        //echo $data['case_type'];exit;
            /*patient details*/
        $age=$data['age'];
        if($data['dob']['time']==null || $data['dob']['time']=="")
        {
           $age=Carbon::now()->format('Y') - $age - 1;
        }
       
        $patientData->first_name=$data['fname'];
        $patientData->middle_name=$data['mname'];
        $patientData->last_name=$data['lname'];
        $patientData->dob= $data['dob']['time'];

    		$patientData->gender=$data['gender'];
        $patientData->age=$age;
        $patientData->type=$data['type'];
        $patientData->address=$data['address'];
        $patientData->ph_no=$data['ph_no'];
        $patientData->mob_no=$data['mob_no'];
        $patientData->references=$data['reference_dr'];
        $patientData->consultant_id=$data['consulting_dr'];
        $patientData->consultant=$data['consulting_dr'];
        $patientData->case_type=$data['case'];
        $patientData->appointment_datetime=$data['appointment_datetime']['time'];
        $pname = $data['fname'].''.$data['mname'].''.$data['lname'];
        /*for patient details end*/
        if($data['case'] == 'new') 
        {
           $patientD =  PatientDetailsForm::orderBy('id', 'desc')->first();
            if($patientD == null){   
                $lastPatientId = 1; 
            }else{  
                $lastPatientId = $patientD->id + 1;  
            }
           $newPatNo = sprintf("%04d",$lastPatientId);
           $insertedPatientId=$uhid.$year.$newPatNo;
           if($data['uhid_no']!="")
           {
              $uhid_no=$data['uhid_no'];
           }
           else
           {
              $uhid_no=$insertedPatientId;
           }

           /*for patient details start*/
            $check_uhid_no=$this->checkUHIDUnique($uhid_no);
            if($check_uhid_no>0)
            {
                 return ['code' => '301','data'=>'', 'message' => 'UHID No. already exist.'];
            }
            $patientData->uhid_no=$uhid_no;
            $patientData->created_at=Carbon::now();
            $patientData->updated_at=Carbon::now();
            $patientData->save();
            $patientId = $patientData->id;
            /*for patient details end*/
        } else {
          /*for patient details start*/
          $patientData->updated_at=Carbon::now();
          $patientData->save();
          /*for patient details end*/
        }

        if($patientId) {
          if($patientType == "opd"){
            if($opdInsert == 1){
              //for new case 
                $opd_prefix="OPD";
                $opdId =  OpdDetails::orderBy('id', 'desc')->first();
                if($opdId == null){   
                  $lastOPD = 1; 
                }else{  
                  $lastOPD = $opdId->id + 1;  
                }
                $newPatOPDNo = sprintf("%04d",$lastOPD);
                $insertedOPDId=$opd_prefix.$year.$newPatOPDNo;
                $caseData = OpdDetails::create([
                  'opd_id'=>$insertedOPDId,
                  'patient_id'=> $patientId,
                  // 'consultant_id'=> $user_id,
                  'references'=> $referance,
                  'uhid_no'=> $patientData->uhid_no,
                  'admit_datetime' =>  Carbon::now(),
                  'appointment_datetime'=> $a_time
                ]);
                if($data['case_type']=='')
                {
                  $data['case_type']='new_case';
                }
                $is_report=0;
                $reported_date="";
                if($data['case_type']=='reports')
                {
                    $is_report=1;
                    $reported_date=Carbon::now()->format('Y-m-d H:i:s');
                }
                $sectionId = $caseData->id;
              
                 /* start add case management data */
                $patientCaseInsert = PatientCaseManagment::create([
                  'case_type' =>$data['case_type'],
                  'section_type' => $patientType,
                  'section_id' => $sectionId,
                  'patient_id' =>$patientId,
                  'references' => $data['reference_dr'],
                  'consultant_id' => $data['consulting_dr'],
                  'appointment_datetime' => $data['appointment_datetime']['time'],
                  'status' =>true,
                  'is_report'=>$is_report,
                  'reported_date'=>$reported_date,
                  'created_at' =>Carbon::now(),
                  'updated_at' =>Carbon::now(),
                ]);
                $tokenInsert =  TokenManagment::create([
                  'token'=>$data['token_no'],
                  'date' =>  date('d-m-Y H:i:s'),
                  'opd_id'=>$sectionId,
                  'patient_id' =>$patientId,
                  'patient_case_id' =>$patientCaseInsert->id,
                  'status' =>$data['token_status'],
                ]);
                 $dataText = '';
                 $notifyType = 'case_add';
                 $consultId =  $data['consulting_dr'];
                 $lastpatientCaseId = $patientCaseInsert->id;
                if($data['case_type'] == 'new_case'){
                  $dataText = 'New patient add' ;
                }
                if($data['case_type'] == 'new_consult'){
                   $dataText = 'Patient add for new consult' ;
                }
                if($data['case_type'] == 'cross_reference'){
                   $dataText = 'Patient add for cross reference' ;
                }
                if($data['case_type'] == 'follow_ups'){
                   $dataText = 'Patient add for follow up' ;
                }
                if($data['case_type'] == 'reports'){
                  $dataText = 'Patient add for report' ;
                }
                $checkNotifStatus = NotificationRepository::checkRecordStatus($consultId,$notifyType);
                
                if( $checkNotifStatus){
                    $checkNotifStatus->data_id = $consultId;
                    $checkNotifStatus->data_date = Carbon::now()->format('Y-m-d H:i:s');
                    $checkNotifStatus->data_text = $dataText;
                    $checkNotifStatus->status = '1';
                    $checkNotifStatus->save();
                }else{
                    $addNotificationData = Notification::create([
                    'title' => $pname,
                    'type' => $notifyType,
                    'data_table' => 'PatientCaseManagment',
                    'data_id' =>$patientCaseInsert->id,
                    'data_consult_id' => $consultId,
                    'data_date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'data_text' => $dataText,
                    'status' => '1',
                     ]);

                }

                if ($caseData) {
                    return ['code' => '200','data'=>['patientId'=> $patientId,'opdId' => $caseData->id,'uhid_no'=>$patientData->uhid_no], 'message' => 'Record Sucessfully created'];
                } else {
                    return ['code' => '400','data'=>'', 'message' => 'Something goes wrong'];
                }   
            }
            else
            {
                $insertedOPDId = $opdData->id;

                $sectionId    = $opdData->id;
                /* start add case management data */
                $is_report=0;
                $reported_date="";
                if($data['case_type']=='reports')
                {
                    $is_report=1;
                    $reported_date=Carbon::now()->format('Y-m-d H:i:s');
                }
                $patientCaseInsert = PatientCaseManagment::create([
                  'case_type' => $data['case_type'],
                  'section_type' => $patientType,
                  'section_id' => $sectionId,
                  'patient_id' =>$patientId,
                  'references' => $data['reference_dr'],
                  'consultant_id' => $data['consulting_dr'],
                  'appointment_datetime' => $data['appointment_datetime']['time'],
                  'status' =>true,
                  'is_report'=>$is_report,
                  'reported_date'=>$reported_date,
                  'created_at' =>Carbon::now(),
                  'updated_at' =>Carbon::now(),
                ]);

                $tokenInsert =  TokenManagment::create([
                  'token'=>$data['token_no'],
                  'date' =>  date('d-m-Y H:i:s'),
                  'opd_id'=>$insertedOPDId,
                  'patient_id' =>$patientId,
                  'patient_case_id' =>$patientCaseInsert->id,
                  'status' =>$data['token_status'],
                ]);

                 $dataText = '';
                 $consultId =  $data['consulting_dr'];
                 $notifyType = 'case_add';
                if($data['case_type'] == 'new_case'){
                  $dataText = 'New patient add' ;
                }else if($data['case_type'] == 'new_consult'){
                   $dataText = 'Patient add for new consult' ;
                }else if($data['case_type'] == 'cross_reference'){
                   $dataText = 'Patient add for cross reference' ;
                }else if($data['case_type'] == 'follow_ups'){
                   $dataText = 'Patient add for follow up' ;
                }else{
                  $dataText = 'Patient add for report' ;
                }

                 $checkNotifStatus = NotificationRepository::checkRecordStatus($consultId,$notifyType);
                $lastpatientCaseId = $patientCaseInsert->id;
                
                if( $checkNotifStatus){
                    $checkNotifStatus->data_id = $consultId;
                    $checkNotifStatus->data_date = Carbon::now()->format('Y-m-d H:i:s');
                    $checkNotifStatus->data_text = $dataText;
                    $checkNotifStatus->status = '1';
                    $checkNotifStatus->save();
                }else{
                    $addNotificationData = Notification::create([
                    'title' => $pname,
                    'type' => 'case_add',
                    'data_table' => 'PatientCaseManagment',
                    'data_id' =>  $lastpatientCaseId,
                    'data_consult_id' => $data['consulting_dr'],
                    'data_date' => Carbon::now()->format('Y-m-d H:i:s'),
                    'data_text' => $dataText,
                    'status' => '1',
                     ]);

                }

                if ($tokenInsert && $patientCaseInsert) {
                  return ['code' => '200','data'=>['token'=> $data['token_no'],'opdId' => $insertedOPDId,'uhid_no'=>$patientData->uhid_no], 'message' => 'Record Sucessfully created'];
                } else {
                  return ['code' => '400','data'=>'', 'message' => 'Something goes wrong'];
                }   

              }

            	/*to get OPD Id*/
            /* end add case management data */
  
            }
            else
            {
                  $ipd_prefix="IPD";
                  $year = date('y');
                  $ipdId =  IpdDetails::orderBy('id', 'desc')->first();
                  if($ipdId == null){   
                    $lastIPD = 1; 
                  }else{  
                    $lastIPD = $ipdId->id + 1;  
                  }
                  $newPatIPDNo = sprintf("%04d",$lastIPD);
                  $insertedIPDId=$ipd_prefix.$year.$newPatIPDNo;
                  $sectionId = $insertedIPDId;
                  $caseData = IpdDetails::create([
                    'ipd_id'=>$insertedIPDId,
                    'patient_id'=> $patientId,
                    'uhid_no'=> $patientData->uhid_no,
                    'admit_datetime' =>  Carbon::now(),
                    'appointment_datetime'=>$patientData->appointment_datetime
                  ]);

                  /* start add case management data */
                  /* PatientCaseManagment::create([
                  'case_type' =>$data['case_type'],
                  'section_type' => $patientType,
                  'section_id' => $sectionId,
                  'patient_id' =>$patientId,
                  'references' => $data['reference_dr'],
                  'consultant_id' => $data['consulting_dr'],
                  'appointment_datetime' => $data['appointment_datetime']['time'],
                  'status' =>true,
                  'created_at' =>Carbon::now(),
                  'updated_at' =>Carbon::now(),

                  ]);

                  $tokenInsert =  TokenManagment::create([
                  'token'=>$data['token_no'],
                  'date' =>  date('d-m-Y H:i:s'),
                  'opd_id'=>$insertedIPDId,
                  'patient_id' =>$patientId,
                  'patient_case_id' =>$patientCaseInsert->id,
                  'status' =>$data['token_status'],
                  ]);*/

                  /* end add case management data */

                  if ($caseData) {
                    return ['code' => '200','data'=>['patientId'=> $patientId,'ipdId' => $caseData->id,'uhid_no'=>$patientData->uhid_no], 'message' => 'Record Sucessfully created'];
                  } else {
                    return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
                  }
            }
            
        }


        return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
  }

  /**
   * [getPatientDetailsById description]
   * @param  [type] $id [description]
   * @return [type]     [description]
   */
  public function getPatientDetailsById($id)
  {
    $get_patient_details=PatientDetailsForm::where('id',$id)->first();
    return $get_patient_details;
  }



   /**
     * [getOPDIdByPatientId description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getLastOPDIdByPatientId($pid)
    {
        $today=Carbon::now()->format('Y-m-d');
        $patient_last_id=PatientCaseManagment::where('patient_id',$pid)->whereDate('appointment_datetime','<=',$today)->orderBy('id', 'desc')->first();
        return $patient_last_id;
    }

     /**
      * [getOPDDetailsByPatientId description]
      * @param  [type] $pid [description]
      * @return [type]      [description]
      */
    public function getOPDDetailsByPatientId($pid)
    {
        return OpdDetails::where('patient_id',$pid)->orderBy('id','desc')->first();
    }

    /**
     * [getOPDIdByPatientId description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getOPDIdByPatientId($pid)
    {
        return OpdDetails::where('patient_id',$pid)->get();
    }
    /**
     * [getPatientListByConsultDr description]
     * @param  [type] $doctor  [description]
     * @param  [type] $section [description]
     * @return [type]          [description]
     */
    public function getPatientListByConsultDr($doctor,$section){
       $result = array();
       $patientList =PatientDetailsForm::where('consultant_id',$doctor)->get();
      foreach ($patientList as $key=>$value){
         $result[$key] = [
            'id' => $value->id,
            'name' =>  $value->first_name.' '.$value->last_name,
            'consultant' =>  $value->consultant_id,
            'dob' => $value->dob,
            'gender' =>  $value->gender,
            'address' =>  $value->address,
            'uhid_no' =>  $value->uhid_no
          ] ;
      }
      return  $result;
    }

     //opd related
    /**
     * [patientCheckUpDetailsByOpdId description]
     * @param  [type] $oid [description]
     * @return [type]      [description]
     */
   /* public function patientCheckUpDetailsByOpdId($oid)
    {
        return PatientCheckUp::where('opd_id',$oid)->orderBy('id', 'desc')->first();
    }
*/
   /**
    * [getPatientListBySearch description]
    * @param  [type] $request [description]
    * @return [type]          [description]
    */
    public function getPatientListBySearch($request)
    {
        $data = $request->all()['searchData'];
        $search_data=$request->all()['searchData']['search_data'];
        $user_id=$data['user_id'];
        $search_by=$data['search_by'];
       $user_type=$search_data['user_type'];
        // dd($search_by);
        $date="";
        if($search_data['select_type_dob']['time']!="")
          $date=Carbon::createFromFormat('d-m-Y', $search_data['select_type_dob']['time'])->format('Y-m-d');

        $patientDetails=array();
        $tes_query=0;
        //query
          $reportQuery= PatientDetailsForm::join('patient_case_managment', function ($join) {
            $join->on('patient_case_managment.patient_id', '=', 'patient_details.id');
          })->join('token_managment', function ($join1) {
                  $join1->on('token_managment.patient_case_id', '=', 'patient_case_managment.id');
          });
          if($user_id!=0 && $user_id!="")
          {
             $reportQuery->where('patient_case_managment.consultant_id',$user_id);
          } 
          if($user_type==1)
          {
               $reportQuery->whereIn('token_managment.status',['vital','waiting'])->where('patient_case_managment.case_type','!=','reports');
          }
          if($user_type==2)
          {
              $reportQuery->whereIn('patient_case_managment.case_type',['follow_ups','new_consult','new_case'])->where('token_managment.status','waiting');
          }
          if(($user_type==1 ||  $user_type==2) && ($search_by=='All'))
          {
              $reportQuery->whereDate('patient_case_managment.appointment_datetime',Carbon::today()->format('Y-m-d'));
          }
          if(($user_type==1 ||  $user_type==2) && ($search_by=='last_week'))
          {
              $to=Carbon::now()->today()->format('Y-m-d');
              $from=Carbon::now()->subDays(7)->format('Y-m-d');
              $reportQuery->whereDate('patient_case_managment.appointment_datetime','<=',$to)
              ->whereDate('patient_case_managment.appointment_datetime','>=',$from);
          }
           $reportQuery->where(function ($query) use ($search_data,$date,$tes_query) {
              $all_stnames=explode(' ',$search_data['name']);

              if($search_data['name']!='' && $tes_query==0)
              {
                  foreach($all_stnames as $st_name)
                  {
                      $query->where('first_name', 'like', '%'.$st_name.'%')
                    ->orWhere('middle_name', 'like', '%'.$st_name.'%')
                    ->orWhere('last_name', 'like', '%'.$st_name.'%');
                  }
                  $tes_query=1;
                 
              }
              else if($search_data['name']!='')
              {
                foreach($all_stnames as $st_name)
                  {
                    $query->orWhere('first_name', 'like', '%'.$st_name.'%')
                    ->orWhere('middle_name', 'like', '%'.$st_name.'%')
                    ->orWhere('last_name', 'like', '%'.$st_name.'%');
                  }
              }
              if($search_data['uhid_no']!='' && $tes_query==0)
              {
                  $query->where('patient_details.uhid_no',$search_data['uhid_no']);
                  $tes_query=1;
              }
              else if($search_data['uhid_no']!='')
              {
                  $query->orWhere('patient_details.uhid_no',$search_data['uhid_no']);
              }
               if($date!='' && $tes_query==0)
               {
                   $query->whereDate('dob', $date);
                   $tes_query=1;
               }
               else if($date!='')
              {
                   $query->orWhereRaw("DATE(dob) = ?", [$date]);
              } 
               if($search_data['mobile_no']!=''  && $tes_query==0)   
               {
                  $query->where('mob_no', 'like', '%'.$search_data['mobile_no'].'%');
                  $tes_query=1;
               }
               else if($search_data['mobile_no']!='')
               {
                  $query->orWhere('mob_no', 'like', '%'.$search_data['mobile_no'].'%');
               }
          });
          $reportQuery->groupBy('patient_case_managment.patient_id')->orderBy('patient_case_managment.created_at','desc');
          $patientDetails = $reportQuery->select(
              'patient_details.id',
              'patient_details.first_name',
              'patient_details.middle_name',
              'patient_details.last_name',
              'patient_details.uhid_no',
              'patient_details.age',
              'patient_details.dob',
              'patient_details.mob_no',
              'patient_case_managment.appointment_datetime',
              'patient_case_managment.consultant_id',
              'patient_case_managment.case_type'
            )->get();

        if(count($patientDetails)>0) {
             return ['code' => '200','data'=>$patientDetails, 'message' => 'Patient record '];
        } else {
             //return ['code' => '300','patientData'=>'', 'message' => 'Record not found'];
             return ['code' => '300','data'=>'', 'message' => 'Something went wrong'];
        }
    }

    public function addPatientCheckup($request){
        
            /*for patient details start*/

        $data = $request->all()['pData']['patientData'];
        $userId = $request->all()['pData']['userId'];
        // dd(Carbon::now()->toDateString())
        // $tokenData-;
        $data_patient_checkup=new PatientCheckUp;
        $data_patient_checkup->user_id=$userId;
        $data_patient_checkup->height=$data['height'];
        $data_patient_checkup->weight=$data['weight'];
        $data_patient_checkup->bmi=$data['bmi'];
        $data_patient_checkup->vitals=$data['vitals'];
        $data_patient_checkup->pulse=$data['pulse'];
        $data_patient_checkup->bp=$data['bp_systolic'].'/'.$data['bp_diastolic'];
        $data_patient_checkup->temp=$data['temp'];
        $data_patient_checkup->pain=$data['pain_value'];
        $data_patient_checkup->patient_case_management_id=$data['case_id'];
        $data_patient_checkup->patient_id=$data['patient_id'];
        $data_patient_checkup->created_at=Carbon::now();
        $data_patient_checkup->updated_at=Carbon::now();
        $data_patient_checkup->save();
        if ($data_patient_checkup) {
        $tokenData = TokenManagment::where('patient_id',$data['patient_id'])->whereDate('date',Carbon::now()->toDateString())->where('status','waiting')->first();
        $tokenRecord = TokenManagment::find($tokenData->id);
        $tokenRecord->status = 'vital';
        $tokenRecord->save();
        
            return ['code' => '200','data'=>$data_patient_checkup, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '400','data'=>'', 'message' => 'Something goes wrong'];
        }
        /*to add data */
    }

    public function tokenExist($token){
      $date =  date('Y-m-d');
      return TokenManagment::where('date','like',$date.'%')->Where('token',$token)->count();
    }

    /**
     * [getPatientList description]
     * @param  [type] $user_type  [description]
     * @param  [type] $noOfRecord [description]
     * @param  [type] $user_id    [description]
     * @param  string $status     [description]
     * @return [type]             [description]
     */
    public function getPatientList($user_type,$noOfRecord,$user_id,$status='waiting'){
      // dd($user_type,$noOfRecord,$user_id);
      $reportQuery= PatientDetailsForm::join('patient_case_managment', function ($join) {
                  $join->on('patient_case_managment.patient_id', '=', 'patient_details.id');
        });
      $reportQuery->join('token_managment', function ($join1) {
                  $join1->on('token_managment.patient_case_id', '=', 'patient_case_managment.id');
        });

        if($user_type == 1)
        {
              $reportQuery->where('patient_case_managment.consultant_id',$user_id);
               if($status=='reports')
               {
                  $reportQuery->where('patient_case_managment.case_type','reports')->where('patient_case_managment.is_report',1);
               }
               else
               {
                    $reportQuery->where('patient_case_managment.case_type','!=','reports');
                    if($status=='waiting')
                    {
                      $reportQuery->whereIn('token_managment.status',['waiting','vital']);
                    }
                    else if($status=='examine') 
                    {
                      $reportQuery->whereIn('token_managment.status',['examine']);
                    }
               }

        } 

        if($user_type==2)
        {
            if($status=='waiting')
            {
              $reportQuery->whereIn('patient_case_managment.case_type',['follow_ups','new_consult','new_case'])->where('token_managment.status','waiting');
            }
            
        }
        if($user_type==3)
        { 
            $reportQuery->whereIn('patient_case_managment.case_type',['follow_ups','new_consult','new_case','cross_reference'])->where('token_managment.status',$status);
        }
        $reportQuery->with('userDetails');
        if($status!='reports')
        {
          $reportQuery->whereDate('patient_case_managment.appointment_datetime',Carbon::today()->format('Y-m-d'));
        }
       
        $reportQuery->select('*','token_managment.token as token_id','patient_case_managment.id as case_id')->groupBy('patient_case_managment.patient_id')->orderBy('patient_case_managment.created_at','desc');

        $r_query=$reportQuery->paginate($noOfRecord);
        
        return $r_query;
        // return PatientDetailsForm::where('consultant_id',$id)->paginate($noOfRecord);
     
    }

    /**
     * [getPatientDetailInfo description]
     * @param  [type] $patientId [description]
     * @return [type]            [description]
     */
    public function getPatientDetailInfo($patientId){

          $result = array();
          $result['patientDetail'] =  PatientDetailsForm::where('id',$patientId)->first();
          $result['caseDetail'] = PatientCaseManagment::join('users','users.id','=','patient_case_managment.consultant_id')->select('patient_case_managment.*','patient_case_managment.section_id as opdId','users.*')->groupBy('patient_case_managment.patient_id')->orderBy('patient_case_managment.created_at','desc')->where('patient_case_managment.patient_id',$patientId)->get();
          $result['opdDetails'] =  OpdDetails::select('*','id as opdid')->groupBy('patient_id')->orderBy('created_at','desc')->where('patient_id',$patientId)->get();

          return $result;
    }

  

    /**
     * [getAllPatientName description]
     * @param  [type] $user_type [description]
     * @return [type]            [description]
     */
    public function getAllPatientName($user_type,$user_id)
    {
        $reportQuery= PatientDetailsForm::join('patient_case_managment', function ($join) {
                  $join->on('patient_case_managment.patient_id', '=', 'patient_details.id');
        })->join('token_managment', function ($join1) {
                  $join1->on('token_managment.patient_case_id', '=', 'patient_case_managment.id');
        });

        if($user_id!=0 && $user_id!="")
        {
           $reportQuery->where('patient_case_managment.consultant_id',$user_id);
        } 
        if($user_type==2)
        {
            $reportQuery->whereIn('patient_case_managment.case_type',['follow_ups','new_consult','new_case'])->where('token_managment.status','waiting')->whereDate('patient_case_managment.appointment_datetime',Carbon::today()->format('Y-m-d'));
        }
        if($user_type==1 )
        {
            $reportQuery->whereIn('token_managment.status',['vital','waiting'])->where('patient_case_managment.case_type','!=','reports')->whereDate('patient_case_managment.appointment_datetime',Carbon::today()->format('Y-m-d'));
        }

         $reportQuery->groupBy('patient_case_managment.patient_id')->orderBy('patient_case_managment.created_at','desc');
         $patientDetails = $reportQuery->select(
              'patient_details.id',
              'patient_details.first_name',
              'patient_details.middle_name',
              'patient_details.last_name',
              'patient_details.uhid_no',
              'patient_details.age',
              'patient_details.dob',
              'patient_details.mob_no',
              'patient_case_managment.appointment_datetime',
              'patient_case_managment.consultant_id',
              'patient_case_managment.case_type'
            )->get();
       
        if (count($patientDetails)>0) {
            return ['code' => '200','data'=>$patientDetails, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }

    /**
     * [getVitalsInfoByPatientId description]
     * @return [type] [description]
     */
    public function getVitalsInfoByPatientId($pid)
    {
        $reportQuery= PatientDetailsForm::join('patient_checkup', function ($join) {
                  $join->on('patient_checkup.patient_id', '=', 'patient_details.id'); });
        $reportQuery->where('patient_checkup.patient_id',$pid);
        $reportQuery->orderBy('patient_checkup.created_at','desc');
        $patientDetails = $reportQuery->select(
              'patient_checkup.opd_id',
              'patient_checkup.id as vital_id',
              'patient_details.id',
              'patient_details.uhid_no',
              'patient_checkup.patient_id',
              'patient_checkup.created_at',
              'patient_checkup.height',
              'patient_checkup.weight',
              'patient_checkup.bmi',
              'patient_checkup.vitals',
              'patient_checkup.pulse',
              'patient_checkup.bp',
              'patient_checkup.temp',
              'patient_checkup.pain'
            )->first();
        //echo $patientDetails;exit;
        if ($patientDetails) {
            return ['code' => '200','data'=>$patientDetails, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }

    /**
     * [checkUHIDUnique description]
     * @param  [type] $no [description]
     * @return [type]     [description]
     */
    public function checkUHIDUnique($no)
    {
         $result = PatientDetailsForm::where('uhid_no',$no)->get();
          return count($result);
    }


    /**
     * [getVitalsValidity description]
     * @param  [type] $vital_id [description]
     * @return [type]           [description]
     */
    public function getVitalsValidity($vital_id)
    {
        //echo $vital_id;
        $from=Carbon::now()->format('Y-m-d');
        $to=Carbon::now()->subMonths(6)->format('Y-m-d');
        $vitalinfo= PatientCheckUp::where('id',$vital_id)->whereDate('created_at','>=',$to)->whereDate('created_at','<=',$from)->get();
        //$vitalinfo;exit;
        if (count($vitalinfo)>0) {
            return ['code' => '200','data'=>$vitalinfo, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
        
    }

    //OPD DETASIL
   /* public function getPatientCaseDetailByOpdId($opdId){ 
      $result = PatientCaseManagment::where('section_id',$opdId)->orderBy('id','DESC')->first();
       return $result;
    }*/

    public function movePatientWithNewReferal(){
      return 0;
    }

    public function getAgeOfPatient($patientId){
       $result = PatientDetailsForm::where('id',$patientId)->first();
          return $result;

    }

   public function getPatientCaseAndTokenDetailByOpdId($opdId)
   {
       $result = PatientCaseManagment::select('patient_case_managment.id as caseId','patient_case_managment.case_type','patient_case_managment.section_id','patient_case_managment.patient_id','patient_case_managment.references','patient_case_managment.main_case_id','patient_case_managment.consultant_id','token_managment.token','token_managment.date','token_managment.status')->join('token_managment','token_managment.patient_case_id','=','patient_case_managment.id')->where('token_managment.opd_id',$opdId)->where('patient_case_managment.section_id',$opdId)->orderBy('patient_case_managment.id','DESC')->first();
      
       return $result;
   }

   /**
    * [getPatientLastVisitById description]
    * @param  [type] $pid [description]
    * @return [type]      [description]
    */
   public function getPatientLastVisitById($pid)
   {
        $today=Carbon::now()->format('Y-m-d');
        $result = PatientCaseManagment::join('token_managment', 'patient_case_managment.id', '=', 'token_managment.patient_case_id')->where('patient_case_managment.patient_id',$pid)->where('token_managment.status','examine')->orderBy('patient_case_managment.id','DESC')->first();
        $las_visit="N/A";
        if(isset($result->appointment_datetime) && $result->appointment_datetime!='')
        {
            $las_visit=$result->appointment_datetime;
        }
        return $las_visit;
   }

   /**
    * [getPatientCaseTypeById description]
    * @param  [type] $pid [description]
    * @return [type]      [description]
    */
   public function getPatientCaseTypeById($pid)
   {
      $today=Carbon::now()->format('Y-m-d');
      $result=PatientCaseManagment::where('patient_id',$pid)->whereDate('appointment_datetime',$today)->orderBy('id','desc')->first();
      if(!empty($result))
      {
          $type="report";
      }
      else
      {
          $type="follow_ups";
      }
      return $type;
   }

   /**
   *
   *
   **/

   public function getAllPatientList($status,$userType,$noOfPage,$userId){
         $reportQuery = PatientDetailsForm::select('patient_details.id as patient_id','patient_details.first_name as fname','patient_details.middle_name  as mname','patient_details.last_name as lname','patient_details.dob as bdate','patient_details.age as age','patient_details.gender as gender','patient_details.address as address','patient_details.ph_no as ph_no','patient_details.mob_no as mob_no','patient_details.uhid_no as uhid_no');

          $reportQuery->join('patient_case_managment', function ($join) {
                  $join->on('patient_case_managment.patient_id', '=', 'patient_details.id');
          });
           $reportQuery->join('token_managment', function ($join1) {
                  $join1->on('token_managment.patient_case_id', '=', 'patient_case_managment.id');
        
            });


      if($status == 'waiting'){
         $reportQuery->where('patient_case_managment.case_type','!=','reports');
         $reportQuery->whereIn('token_managment.status',['waiting','vital']);
       
      }else if($status == 'examine'){
         $reportQuery->where('patient_case_managment.case_type','!=','reports');
         $reportQuery->whereIn('token_managment.status',['examine']);

      }else if ($status == 'reports'){
           $reportQuery->where('patient_case_managment.case_type','reports')->where('patient_case_managment.is_report',1);
      }else{
         $reportQuery->where('patient_case_managment.case_type','!=','reports');
         $reportQuery->whereIn('token_managment.status',['waiting','vital','examine']);

      }
  
        $patientList=$reportQuery->orderBy('token_managment.created_at','desc')->paginate($noOfPage);

        return $patientList;
   }

   
   /**
    * [updatePatient description]
    * @param  [type] $patientData [description]
    * @return [type]              [description]
    */
   public function updatePatient($patientData){
      $data = $patientData['patientData'];
      $patientId = $data['patient_id'];
      $data_patient['first_name'] = $data['fname'];
      $data_patient['middle_name'] = $data['mname'];
      $data_patient['last_name'] = $data['lname'];
      $data_patient['ph_no'] = $data['ph_no'] ;
      $data_patient['mob_no'] =  $data['mob_no'];
      $data_patient['address'] = $data['address'];
      $data_patient['age'] = $data['age'];
      $data_patient['dob']=null;
      if($data['dob']['time'])
        $data_patient['dob'] = Carbon::createFromFormat('d-m-Y', $data['dob']['time'])->format('Y-m-d');
      $data_patient['gender'] = $data['gender'];
      $reportQuery = PatientDetailsForm::where('id',$patientId)->update($data_patient);
      return $reportQuery;

   }



    /**
     * [getPatientListSearchAdmin description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getPatientListSearchAdmin($request)
    {
        $data = $request->all()['searchData'];
        $search_data=$request->all()['searchData']['search_data'];
        $search_by=$data['search_by'];
        //$noOfPage=$data['noOfPage'];
        //echo  $request->noofRecord;;exit;
        //$noOfPage = $request->noofRecord;
        $noOfPage = $request->no_of_page;
           $date="";
           $tes_query=0;
           if($search_data['select_type_dob']['time']!="")
              $date=Carbon::createFromFormat('d-m-Y', $search_data['select_type_dob']['time'])->format('Y-m-d');
           $reportQuery = PatientDetailsForm::select('patient_details.id as patient_id','patient_details.first_name as fname','patient_details.middle_name  as mname','patient_details.last_name as lname','patient_details.dob as bdate','patient_details.age as age','patient_details.gender as gender','patient_details.address as address','patient_details.ph_no as ph_no','patient_details.mob_no as mob_no','patient_details.uhid_no as uhid_no');

              $reportQuery->join('patient_case_managment', function ($join) {
                      $join->on('patient_case_managment.patient_id', '=', 'patient_details.id');
              });
               $reportQuery->join('token_managment', function ($join1) {
                      $join1->on('token_managment.patient_case_id', '=', 'patient_case_managment.id');
            
                });


          if($search_by == 'waiting'){
             $reportQuery->where('patient_case_managment.case_type','!=','reports');
             $reportQuery->whereIn('token_managment.status',['waiting','vital']);
           
          }else if($search_by == 'examine'){
             $reportQuery->where('patient_case_managment.case_type','!=','reports');
             $reportQuery->whereIn('token_managment.status',['examine']);

          }else if ($search_by == 'reports'){
               $reportQuery->where('patient_case_managment.case_type','reports')->where('patient_case_managment.is_report',1);
          }else{
             $reportQuery->where('patient_case_managment.case_type','!=','reports');
             $reportQuery->whereIn('token_managment.status',['waiting','vital','examine']);
          }
           if($search_by=='last_week')
          {
              $to=Carbon::now()->today()->format('Y-m-d');
              $from=Carbon::now()->subDays(7)->format('Y-m-d');
              $reportQuery->whereDate('patient_case_managment.appointment_datetime','<=',$to)
              ->whereDate('patient_case_managment.appointment_datetime','>=',$from);
          }
           $reportQuery->where(function ($query) use ($search_data,$date,$tes_query) {
              $all_stnames=explode(' ',$search_data['name']);

              if($search_data['name']!='' && $tes_query==0)
              {
                  foreach($all_stnames as $st_name)
                  {
                      $query->where('first_name', 'like', '%'.$st_name.'%')
                    ->orWhere('middle_name', 'like', '%'.$st_name.'%')
                    ->orWhere('last_name', 'like', '%'.$st_name.'%');
                  }
                  $tes_query=1;
                 
              }
              else if($search_data['name']!='')
              {
                foreach($all_stnames as $st_name)
                  {
                    $query->orWhere('first_name', 'like', '%'.$st_name.'%')
                    ->orWhere('middle_name', 'like', '%'.$st_name.'%')
                    ->orWhere('last_name', 'like', '%'.$st_name.'%');
                  }
              }
              if($search_data['uhid_no']!='' && $tes_query==0)
              {
                  $query->where('patient_details.uhid_no',$search_data['uhid_no']);
                  $tes_query=1;
              }
              else if($search_data['uhid_no']!='')
              {
                  $query->orWhere('patient_details.uhid_no',$search_data['uhid_no']);
              }
               if($date!='' && $tes_query==0)
               {
                   $query->whereDate('dob', $date);
                   $tes_query=1;
               }
               else if($date!='')
              {
                   $query->orWhereRaw("DATE(dob) = ?", [$date]);
              } 
               if($search_data['mobile_no']!=''  && $tes_query==0)   
               {
                  $query->where('mob_no', 'like', '%'.$search_data['mobile_no'].'%');
                  $tes_query=1;
               }
               else if($search_data['mobile_no']!='')
               {
                  $query->orWhere('mob_no', 'like', '%'.$search_data['mobile_no'].'%');
               }
          });
            //$reportQuery->groupBy('patient_case_managment.patient_id')->orderBy('patient_case_managment.created_at','desc');
            $patientList=$reportQuery->orderBy('token_managment.created_at','desc')->paginate($noOfPage);

            return $patientList;
        }

   /**
   *
   *
   *
   **/

   public function updatePatientStatus($patientId,$status){

      $reportQuery =  TokenManagment::where('patient_id',$patientId)->update(array('status' => $status));

       return $reportQuery;
   }

   public function getPatientCaseTypeOfLastVisit($pid){

        $result = PatientCaseManagment::join('token_managment', 'patient_case_managment.id', '=', 'token_managment.patient_case_id')->where('patient_case_managment.patient_id',$pid)->where('token_managment.status','waiting')->orderBy('patient_case_managment.id','DESC')->first();

        $caseType="N/A";
        if($result != null)
        {
            $caseType=$result->case_type;
        }
        return $caseType;
  }

 }
?>
