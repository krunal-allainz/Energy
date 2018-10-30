<?php

namespace Energy\Api\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Energy\Models\User;
use Energy\Models\Invoice;
use Energy\Api\Repositories\InvoiceRepository;


use DB;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    public function __construct(){
        $this->invObj = new InvoiceRepository();
    }

    /**
     * [getInvoiceList1 description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getInvoiceList1(Request $request)
    {
        $userId=$request->userId;

        $invoice_list=$this->invObj->getInvoiceList1($userId);
        if($invoice_list)
        {
            return ['code' => 200 ,'data'=>$invoice_list,'message'=>'Getting case type successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }

    /**
     * [getInvoiceList2 description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getInvoiceList2(Request $request)
    {
        $userId=$request->userId;         
        $invoice_list2=$this->invObj->getInvoiceList2($userId);
        if($invoice_list2)
        {
            return ['code' => 200 ,'data'=>$invoice_list2,'message'=>'Getting case type successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }

    public function generateInvoice(){

        $invoice=$this->invObj->generateInvoice();
        if($invoice)
        {
            return ['code' => 200 ,'data'=>$invoice,'message'=>'Invoce generate successfully'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    public function getInvoiceLisyByBuyerId(Request $request){

         $buyerId = $request->buyerId; 
         $noOfpage  = $request->noOfpage; 
         $invoice=$this->invObj->getInvoiceLisyByBuyerId($buyerId,$noOfpage);
        if($invoice)
        {
            return ['code' => 200 ,'data'=>$invoice,'message'=>'Invoce list successfully'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
    *
    *
    *
    *
    **/

    public function generateInvoiceLisyByBuyerId(Request $request){
        
        $invoicedata = $request->all()['invoiceData'];
        $invoiceGenerateNo = $request->invoiceDataIndex;
        $invoiceHtml =  $request->invoiceHtml;
        $requestList = $request->all()['requestList'];
        $agreementData = $request->all()['agreementData'];
        $buyerId = $request->buyerId;
        $sellerId = $request->sellerId;
        $invoice=$this->invObj->generateInvoiceLisyByBuyerId($buyerId,$sellerId,$invoicedata[$invoiceGenerateNo],$invoiceHtml,$requestList[$invoiceGenerateNo+1],$agreementData);
        if($invoice)
        {
            return ['code' => 200 ,'data'=>$invoice,'message'=>'Invoce generate successfully'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }


    /**
    *
    *
    *
    **/

    public function viewbyBuyer(Request $request){
        $buyerId = $request->buyerId;
        $invoice=$this->invObj->viewbyBuyer($buyerId);
        if($invoice)
        {
            return ['code' => 200 ,'data'=>$invoice,'message'=>'Invoce viewgenerate successfully'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

   
    
}
