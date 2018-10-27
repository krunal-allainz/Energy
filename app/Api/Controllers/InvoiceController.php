<?php

namespace euro_hms\Api\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use euro_hms\Models\User;
use euro_hms\Models\Invoice;
use euro_hms\Api\Repositories\InvoiceRepository;


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

   
    
}
