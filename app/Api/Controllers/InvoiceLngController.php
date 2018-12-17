<?php

namespace Energy\Api\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Energy\Models\User;
use Energy\Models\LngInvoice;
use Energy\Api\Repositories\InvoiceLngRepository;


use DB;
use Carbon\Carbon;

class InvoiceLngController extends Controller
{
    public function __construct(){
        $this->invLngObj = new InvoiceLngRepository();
    }

    /**
     * [getInvoiceList1 description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getInvoiceList1(Request $request)
    {
        $userId=$request->userId;

        $invoice_list=$this->invLngObj->getInvoiceList1($userId);
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
        $invoice_list2=$this->invLngObj->getInvoiceList2($userId);
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

        $invoice=$this->invLngObj->generateInvoice();
        if($invoice)
        {
            return ['code' => 200 ,'data'=>$invoice,'message'=>'Invoce generate successfully'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    public function getLngInvoiceLisyByBuyerId(Request $request){
         $buyerId = $request->buyerId; 
         $noOfpage  = $request->noOfpage; 

         $invoice=$this->invLngObj->getLngInvoiceListByBuyerId($buyerId,$noOfpage);
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

    public function generateLngInvoiceLisyByBuyerId(Request $request){
        
        $invoicedata = $request->all()['invoiceData'];
        $invoiceGenerateNo = $request->invoiceDataIndex;
        $invoiceHtml =  $request->invoiceHtml;
        $requestList = $request->all()['requestList'];
        $agreementData = $request->all()['agreementData'];
        $buyerId = $request->buyerId;
        $sellerId = $request->sellerId;
        $invoice=$this->invLngObj->generateLngInvoiceLisyByBuyerId($buyerId,$sellerId,$invoicedata[$invoiceGenerateNo],$invoiceHtml,$requestList[$invoiceGenerateNo+1],$agreementData);
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
        $invoice=$this->invLngObj->viewbyBuyer($buyerId);
        if($invoice)
        {
            return ['code' => 200 ,'data'=>$invoice,'message'=>'Invoce viewgenerate successfully'];
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

    public function getInvoiceView(Request $request){
         $vId = $request->id;
        $invoice=$this->invLngObj->getInvoiceView($vId);
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
