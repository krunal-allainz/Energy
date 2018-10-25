<?php
  namespace euro_hms\Api\Repositories;

 use euro_hms\Models\Receipt;
 use euro_hms\Models\ChargesType;
 use euro_hms\Models\PatientDetailsForm;
 use Carbon\Carbon;
 use DB;
 use euro_hms\Api\Repositories\UserRepository;
 use euro_hms\Api\Repositories\PatientRepository;

 class ReceiptRepository 
 {

 	public function getReceiptList()
 	{
 			return Receipt::with('patientDetails.userDetails')->paginate(10);
 	}

 	public function deleteReceipt($id){
 		$delete= Receipt::where('id', $id)->delete();
        if ($delete) {
                return ['code' => '200','data'=>'', 'message' => 'Receipt successfully deleted'];
            } else {
                return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
            }

 	}

 	public function viewReceipt($id,$type){
 		return Receipt::with('patientDetails')->where('receipt.id',$id)->first();
 	}

 	/**
 	 * [getReceiptDetailsById description]
 	 * @param  [type] $id   [description]
 	 * @param  [type] $type [description]
 	 * @return [type]       [description]
 	 */
 	public function getReceiptDataById($id){
 		return Receipt::with('patientDetails')->where('receipt.id',$id)->first();
 	}



	 	/**
	 	 * [getChargesTypes for recipt charges types]
	 	 * @return [array] [return all types]
	 	 */
	 	public static function getChargesTypes()
	 	{
	 			return ChargesType::get();
	 	}

	 	/**
	 	 * [saveReceipt description]
	 	 * @param  [type] $request [description]
	 	 * @return [type]          [description]
	 	 */
	 	public static function saveReceipt($request){
      
		        $lastReceipt = \DB::table('receipt')->orderBy('receipt_id', 'desc')->first();	
		        	
		        if($lastReceipt == null){	
		        	$receiptId = 1;	
		        }else{	
		        	$receiptId = $lastReceipt->receipt_id + 1;	
		        }

		       // print_r($request->formData);exit;
		        $receipt = new Receipt();

		         $receiptNumber = 'OPD'.$receiptId;	
		         $charges_type_id=$request->formData['charges_type'];
		         $charges_id=0;
		        if($charges_type_id==1)
		        {
		            $receipt->consultation_charges_id=$request->formData['consultation_type'];
		            $charges_id=$request->formData['consultation_type'];
		        }
		        else if($charges_type_id==2)
		        {
		            $receipt->emergency_charges_id=$request->formData['emergency_type'];
		            $charges_id=$request->formData['emergency_type'];
		        }
				$receipt->receipt_id = $receiptId ;
				$receipt->patient_case_management_id = $request->formData['case_id'];
				$receipt->receipt_number = $receiptNumber ;
				$receipt->date = $request->formData['date_receipt']['time'];
				$receipt->case_no = $request->formData['case_no'] ;
				$receipt->patient_id = $request->formData['patient_id'] ;
				$receipt->charges_name = $request->formData['charges_type'] ;
				$receipt->amount = $request->formData['chargeAmount'] ;
				$receipt->case_type = $request->formData['case_type'];
				$receipt->charges_type_id = $request->formData['charges_type'];
				$receipt->charges = $request->formData['chargeAmount'];
				$receipt->created_at=Carbon::now();
				$receipt->updated_at=Carbon::now();
				$receipt->save();
		        return $receipt->id;	
      }

      /**
       * [getReceiptDetailsById description]
       * @param  [type] $id [description]
       * @return [type]     [description]
       */
      public function getReceiptDetailsById($id)
      {
      		
      		//$data_all=Receipt::where('id',$id)->first();
      		$data_all=Receipt::with('patientDetails')->where('receipt.id',$id)->first();
      		//for date receipt 
      		
      		$date_r = Carbon::parse($data_all['date']);
		    $date_receipt=$date_r->format('Y-m-d H:i:s');
		    $charges_id=0;
      		if($data_all['charges_type_id']==1)
		        {
		            //$charges_type_val="consultation_charges_id"; 
		            $charges_id=$data_all['consultation_charges_id'];
		        }
		        else if($data_all['charges_type_id']==2)
		        {
		            //$charges_type_val="emergency_charges_id";
		           $charges_id=$data_all['emergency_charges_id'];
		        }
		    
		    $n_charges=0;
		    $v_charges=0;
		    $p_charges=0;
		    if($data_all['neurological_procedure_charges']!='' && $data_all['neurological_procedure_charges']!=0)
		    {
		    	$n_charges=$data_all['neurological_procedure_charges'];
		    }
		    if($data_all['vascular_procedure_charges']!='' && $data_all['vascular_procedure_charges']!=0)
		    {
		    	$v_charges=$data_all['vascular_procedure_charges'];
		    }
		    if($data_all['physiotherapy_procedure_charges']!='' && $data_all['physiotherapy_procedure_charges']!=0)
		    {
		    	$p_charges=$data_all['physiotherapy_procedure_charges'];
		    }

      		$fullname=$data_all['patientDetails']['first_name'].' '.$data_all['patientDetails']['last_name'];
      		$age="";
      		$age_val="";
      		     		
      		 if($data_all['patientDetails']['age'] > 999){
	      		 	$age = date("Y") - $data_all['patientDetails']['age'] ;
	      		 	if($age != 0){
	      		 		$age_val = $age;
	      		 	}else{
	      		 		$age_val = 1;
	      		 	}

	      		 }else{
	      		 	$age_val =$data_all['patientDetails']['age'];
	      		 }
      		
      		$gender='Female';
      		if($data_all['patientDetails']['gender']=='M')
      		{
      			$gender='Male';
      		}
      		$data = ['receiptId'=>$data_all['receipt_id'],'receiptNumber'=>$data_all['receipt_number'],'caseNo'=>$data_all['case_no'],'chagredName'=>$data_all['charges_type_id'],'amount'=>$data_all['charges'],'case_type'=>$data_all['case_type'],'charges_type'=>$data_all['charges_type_id'],'charges_type_val'=>$charges_id,'charges'=>$data_all['charges'],'department'=>$data_all['department'],'neurological_procedures_id'=>$data_all['neurological_procedures_id'],'vascular_procedures_id'=>$data_all['vascular_procedures_id'],'physiotherapy_procedures_id'=>$data_all['physiotherapy_procedures_id'],'neurological_procedure_charges'=>$n_charges,'vascular_procedure_charges'=>$v_charges,'physiotherapy_procedure_charges'=>$p_charges,'other_charges_category'=>$data_all['other_charges_id'],'other_charges'=>$data_all['other_charges'],'date_receipt'=>$date_receipt,'consult_id'=>$data_all['patientDetails']['consultant_id'],'fullname'=>$fullname,'gender'=>$gender,'age'=>$age_val];
      		 return $data;	
      }

      /**
       * [updatePrintCounter description]
       * @param  [type] $receipt_id [description]
       * @return [type]             [description]
       */
      	public function updatePrintCounter($receipt_id)
      	{
      		$receipt_update=Receipt::where('id',$receipt_id)->increment('print_counter',1);
      		$receipt=Receipt::where('id',$receipt_id)->first();
      		if($receipt_update)
      		{
      			return $receipt->print_counter;
      		}
      		else
      		{
      			return 0;
      		}
      	}


      	/**
      	 * [editReceipt description]
      	 * @param  [type] $request [description]
      	 * @return [type]          [description]
      	 */
      	public function editReceipt($request)
      	{
  			$data=$request->formData;
	        $receipt =Receipt::findOrFail($data['receiptId']);
	        $charges_type_id=$data['charges_type'];
	        $charges_id=0;
	        if($charges_type_id==1)
	        {
	            $receipt->consultation_charges_id=$data['consultation_type'];
	            $charges_id=$data['consultation_type'];
	        }
	        else if($charges_type_id==2)
	        {
	            $receipt->emergency_charges_id=$data['emergency_type'];
	            $charges_id=$data['emergency_type'];
	        }
            $receipt->neurological_procedures_id=$data['neurological_procedures'];
            $receipt->vascular_procedures_id=$data['vascular_procedures'];
            $receipt->physiotherapy_procedures_id=$data['physiotherapy_procedures'];
			$receipt->charges_name = $data['charges_type'] ;
			$receipt->amount = $data['chargeAmount'] ;
			$receipt->case_type = $data['case_type'];
			$receipt->charges_type_id = $data['charges_type'];
			$receipt->charges = $data['chargeAmount'];
			$receipt->neurological_procedure_charges = $data['neurological_procedure_charges'];
			$receipt->vascular_procedure_charges = $data['vascular_procedure_charges'];
			$receipt->physiotherapy_procedure_charges = $data['physiotherapy_procedure_charges'];
			$receipt->other_charges_id = $data['other_charges_category'];
			$receipt->other_charges = $data['other_charges'];
			$receipt->created_at=Carbon::now();
			$receipt->updated_at=Carbon::now();
			$receipt->save();
			return $receipt->id;
      	}
 }
?>