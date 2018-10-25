<?php

namespace euro_hms\Models;

use Illuminate\Database\Eloquent\Model;	
use Carbon\Carbon;	
use DB;


	
class Receipt extends Model	
{	
    // 
  
    protected $table = 'receipt';
    protected $fillable=[ 
      'receipt_id', 
      'receipt_number', 
      'Date', 
      'case_no',  
      'patient_id', 
      'charges_name', 
      'amount', 
      'case_type',
      'charges_type_id',
      'consultation_charges_id',
      'emergency_charges_id',
      'charges',
      'department',
      'neurological_procedures_id',
      'vascular_procedures_id',
      'physiotherapy_procedures_id',
      'neurological_procedure_charges',
      'vascular_procedure_charges',
      'physiotherapy_procedure_charges',
      'other_charges_id',
      'other_charges',
      'created_at', 
      'updated_at',
      'patient_case_management_id', 
  
    ];	
	

    public function __construct(){
      
    }

  public function patientDetails()
    {
        return $this->belongsTo('euro_hms\Models\PatientDetailsForm','patient_id');
    }

    static function saveReceipt($request){ 	
      //dd(Carbon::createFromFormat('dd-MM-yyyy', $request->formData['date_receipt']));	
      //  $lastReceipt = Receipt::orderBy('id', 'desc')->first();	
        $lastReceipt = \DB::table('receipt')->orderBy('receipt_id', 'desc')->first();	
        	
        if($lastReceipt == null){	
        	$receiptId = 1;	
        }else{	
        	$receiptId = $lastReceipt->receipt_id + 1;	
        }	
        $type = $request->type;	
        if ($type == 'opd'){	
        	$receiptNumber = 'OPD'.$receiptId;	
    	}	
        Receipt::create([	  
        	'receipt_id' => $receiptId,	
        	'receipt_number' => $receiptNumber,	
        	'date' =>  $request->formData['date_receipt'],	
        	'case_no' => $request->formData['case_no'],	
        	'patient_id' => $request->formData['patient_id'],	
        	'charges_name' => $request->formData['charges'],	
        	'amount' => $request->formData['amount'],	
        	'created_at'=>Carbon::now() ,	
        	'updated_at'=>Carbon::now() 	
        ]);	
	
        $data = ['receiptId'=>$receiptId,'receiptNumber'=>$receiptNumber,'caseNo'=>$request->formData['case_no'],'chagredName'=>$request->formData['charges'],'amount'=>$request->formData['amount']];	
        return $data;	
      } 

      /**
       * [getDateAttribute description]
       * @param  [type] $value [description]
       * @return [type]        [description]
       */
      public function getDateAttribute($value)
      {
        if($value != null && $value != ''){
            return Carbon::parse($value)->format('d-m-Y');
        }else{
          return null;
        }
      }

      /**
       * [setDateAttribute description]
       * @param [type] $value [description]
       */
    public function setDateAttribute($value)
    { 
      if($value != ''){
        return $this->attributes['date'] =   Carbon::createFromFormat('d-m-Y', $value);
      }else{
         return $this->attributes['date'] = null;
      }

    } 

}
