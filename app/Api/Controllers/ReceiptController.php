<?php

namespace euro_hms\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use euro_hms\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;
use euro_hms\Api\Providers\ReceiptServiceProvider;
use ReceiptService;
use euro_hms\Api\Contracts\ReceiptContract as ReceiptContract;
use euro_hms\Api\Repositories\ReceiptRepository;
use euro_hms\Models\Receipt;
use Terbilang;
use euro_hms\Api\Repositories\UserRepository;

class ReceiptController extends Controller
{
    //	
    public function __construct(){
    	$this->receiptObj = new ReceiptRepository();
        $this->userOBJ = new UserRepository();
    }


    /**
    * Get List Of Receipt
    * return array
    */
    public function getPatientReceiptList(){

        $receiptData = $this->receiptObj->getReceiptList();
        return $receiptData;

    }

    /**
    * Delete Receipt
    */

    public function deleteReceipt(Request $request){ 
    	$id = $request->id;
    	$receiptData = $this->receiptObj->deleteReceipt($id);

    	return $receiptData;
    }

    /**
    *  View Receipt By Id
    */
    public function viewReceipt(Request $request){
    	$id = $request->id;
    	$type = $request->type;
        $rec_type = $request->rec_type;
    	$receiptData = $this->receiptObj->getReceiptDetailsById($id);
        //print_r($receiptData);exit;
        $all_amt=$receiptData['charges']+$receiptData['neurological_procedure_charges']+$receiptData['vascular_procedure_charges']+$receiptData['physiotherapy_procedure_charges']+$receiptData['other_charges'];
        $wordAmount = Terbilang::make($all_amt); 
        $consultant_name=$this->userOBJ->getUserNameById($receiptData['consult_id']);  
        $formData = [  
            'name' => $receiptData['fullname'],  
            'date' => $receiptData['date_receipt'] , 
            'consultant' =>$consultant_name,    
            'age' =>   $receiptData['age'],  
            'gender' =>$receiptData['gender'],   
            'wordamount' => $wordAmount  ,
            'total_amount'  =>$all_amt,
            'rec_type' => $rec_type
        ]; 
        $data=$receiptData;
       
        $view = view("receipt",['data'=> $data,'formData' => $formData])->render();    
        return response()->json(['html'=>$view]);  
    	
    }

    /**
     * [getChargesTypes description]
     * @return [array] [get all charges type for receipt]
     */
    public function getChargesTypes()
    {
    	$all=$this->receiptObj->getChargesTypes();
    	return  $all;
    }

    /**
     * [updatePrintCounter description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function updatePrintCounter(Request $request)
    {
        $receipt_id = $request->receipt_id;
        return $this->receiptObj->updatePrintCounter( $receipt_id);
    }

    /**
     * [saveReceiptData description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function saveReceiptData(Request $request){ 

        $receipt_id =   $this->receiptObj->saveReceipt($request);
         if($receipt_id) {
             return ['code' => '200','data'=>$receipt_id, 'message' => 'Patient record '];
        } else {
             //return ['code' => '300','patientData'=>'', 'message' => 'Record not found'];
             return ['code' => '300','data'=>'', 'message' => 'Something went wrong'];
        }
    }

    /**
     * [getReceiptDetailsById description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getReceiptDetailsById(Request $request){ 
        $rid=$request->receipt_id;
        $r_data =   $this->receiptObj->getReceiptDataById($rid);
         if($r_data) {
             return ['code' => '200','data'=>$r_data, 'message' => 'Patient record '];
        } else {
             //return ['code' => '300','patientData'=>'', 'message' => 'Record not found'];
             return ['code' => '300','data'=>'', 'message' => 'Something went wrong'];
        }
    }

    /**
     * [editReceipt description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function editReceipt(Request $request)
    {
        $update_receipt =   $this->receiptObj->editReceipt($request);
         if($update_receipt) {
             return ['code' => '200','data'=>$update_receipt, 'message' => 'Patient record '];
        } else {
             //return ['code' => '300','patientData'=>'', 'message' => 'Record not found'];
             return ['code' => '300','data'=>'', 'message' => 'Something went wrong'];
        }

    }


}
