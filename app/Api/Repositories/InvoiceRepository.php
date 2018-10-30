<?php
namespace Energy\Api\Repositories;
use Carbon\Carbon;
use DB;
use Energy\Models\Invoice;
use Energy\Api\Repositories\UserRepository;
use Energy\Api\Repositories\NominationRepository;
use Energy\Api\Repositories\AgreementRepository;
use Excel;
use File;
use Auth;



 class InvoiceRepository 
 {
    public function __construct(){
        $this->userObj = new UserRepository();
        $this->nominationRepoObj = new NominationRepository();
    }

 	/**
     * [getInvoiceList1 description]
     * @return [type] [description]
     */
    public function getInvoiceList1($userId)
    {
        $list= Invoice::where('buyer_id',$userId)->where('status',1)->get();
        $result_array=array();
        $total=0;
        foreach($list as $inv)
        {
            $res_arr=array();
            $res_arr['date']=$inv->date;
            $res_arr['buyer_name']=$this->userObj->getUserNameInfoById($inv->buyer_id);
            $res_arr['seller_name']=$this->userObj->getUserNameInfoById($inv->seller_id);
            $res_arr['supplied_quantity']=$inv->supplied_quantity;
            $res_arr['rate']=$inv->rate;
            $res_arr['tax']=$inv->tax;
            $res_arr['total_amount']=$inv->total_amount;
            $total=$total+$inv->total_amount;
            $result_array['inv_arr'][]=$res_arr;
        }
        $result_array['sub_total'] =$total;
        $result_array['rate'] =5;
        $result_array['total_all']=$total-$result_array['rate'];
        return $result_array;
    }

    /**
     * [getInvoiceList2 description]
     * @return [type] [description]
     */
    public function getInvoiceList2($userId)
    {
        $list= Invoice::where('buyer_id',$userId)->where('status',2)->get();
        $result_array=array();
        $total=0;
        foreach($list as $inv)
        {
            $res_arr=array();
            $res_arr['date']=$inv->date;
            $res_arr['buyer_name']=$this->userObj->getUserNameInfoById($inv->buyer_id);
            $res_arr['seller_name']=$this->userObj->getUserNameInfoById($inv->seller_id);
            $res_arr['supplied_quantity']=$inv->supplied_quantity;
            $res_arr['rate']=$inv->rate;
            $res_arr['tax']=$inv->tax;
            $res_arr['total_amount']=$inv->total_amount;
            $total=$total+$inv->total_amount;
            $result_array['inv_arr'][]=$res_arr;
        }
        $result_array['sub_total'] =$total;
        $result_array['rate'] =5;
        $result_array['total_all']=$total-$result_array['rate'];
        return $result_array;
    }
    
    public function generateInvoice(){

       // $nominationList = $this->nominationRepoObj->getNominationRequestList();
       
    }

    public function getInvoiceLisyByBuyerId($buyerId,$noOfpage){

         $list= Invoice::where('buyer_id',$buyerId)->paginate($noOfpage);
        $result_array=array();
        $total=0;
        foreach($list as $inv)
        {
            $res_arr=array();
            $res_arr['date']=$inv->date;
            $res_arr['invoice_no']=$inv->invoice_no;
            $res_arr['buyer_name']=$this->userObj->getUserNameInfoById($inv->buyer_id);
            $res_arr['seller_name']=$this->userObj->getUserNameInfoById($inv->seller_id);
            $res_arr['supplied_quantity']=$inv->supplied_quantity;
            $res_arr['rate']=$inv->rate;
            $res_arr['status']=$inv->status;
            $res_arr['tax']=$inv->tax;
            $res_arr['total_amount']=$inv->total_amount;
            $total=$total+$inv->total_amount;
            $result_array['inv_arr'][]=$res_arr;
        }
        $result_array['sub_total'] =$total;
        $result_array['rate'] =5;
        $result_array['total_all']=$total-$result_array['rate'];
        return $result_array;
    }

    public function viewbyBuyer($buyerId){
        $lastIdRecord = Invoice::orderBy('id','DESC')->first();
        $userData = $this->userObj->getUserDetaileById($buyerId);
        $this->agreementObj = new AgreementRepository();
        $agreementData = $this->agreementObj->getAgreementData($buyerId);
        $price = $agreementData->price;
        $tax_type = $agreementData->tax_type;
        $tax_rate = $agreementData->tax_rate;
        $external_fuel_type = $agreementData->external_fuel_type;
        $external_fuel_type_rate = $agreementData->external_fuel_type_rate;
        $requestList = $this->nominationRepoObj->getBuyerRequestList($buyerId,'Invoice','no');
        $lastId =  $lastIdRecord->id;
        $result = array();
        $invoiceNo = $lastId; 
        $max_loop=5;
        $count = 0;
        $total_supplied_qty = 0;
        $getRequestList = 1;
        $getsupplyQty = '';

        foreach($requestList as $request){ 
            $count++;
            $getsupplyQty = $request->supplied_quantity;

                $total_supplied_qty = $total_supplied_qty +  $getsupplyQty;
                $result['requestList'][$getRequestList][$request->nId]['supplied_Qty'] =$getsupplyQty; 
                $result['requestList'][$getRequestList][$request->nId]['date'] =$request->date;
                $result['requestList'][$getRequestList][$request->nId]['quantityRequired'] =$request->quantity_required; 
                $result['requestList'][$getRequestList][$request->nId]['approveQuntity'] =$request->approved_quantity;
                 if(($count%5) == 0){
                    $getRequestList = $getRequestList + 1;
                    $supplidQty = $total_supplied_qty;
                    $getsupplyQty = 0;
                    $invoiceNo = $invoiceNo + 1;
                    $dt = Carbon::now()->format('Ymd').$invoiceNo;
                    $result[$invoiceNo]['invoice_no'] = '#'.$dt;
                    $result[$invoiceNo]['sub_amount']  = $supplidQty * $price ;
                    $new_date=Carbon::now()->format('Y-m-d');
                    $result[$invoiceNo]['date']  = $new_date;
                    $result[$invoiceNo]['status']  = 0;
                    $subAmount = $result[$invoiceNo]['sub_amount'];
                    $amountAfterPanelty= $subAmount - $external_fuel_type_rate;
                    $taxRateAmount = ($amountAfterPanelty/100) * $tax_rate ;
                    $result[$invoiceNo]['tax_rate_amount_cal'] = $taxRateAmount;
                    $result[$invoiceNo]['total_amount'] = $amountAfterPanelty +  $taxRateAmount;
                    $result[$invoiceNo]['supplied_quantity']  = $supplidQty;
                    $result['generateInvociedata'][$invoiceNo]= $result[$invoiceNo];
                 } 
        }
          
        $addedBy  = Auth::user()->id;
        $result['buyerData']['buyer_id']  = $buyerId;
        $result['buyerData']['seller_id']  = $addedBy;
        $result['buyerData']['rate']  = $tax_rate;
        $result['buyerData']['tax']  = $tax_type;
        $result['buyerData']['price']  = $price;
        $result['buyerData']['paneltyType']  = $external_fuel_type;
        $result['buyerData']['panelty']  = $external_fuel_type_rate;
        $result['buyerData']['first_name'] = $userData->first_name;
        $result['buyerData']['last_name'] = $userData->last_name;
        $result['buyerData']['mobile_no'] = $userData->mobile_no;
        $result['buyerData']['address'] = $userData->address;
        $result['buyerData']['email'] = $userData->email;

        return $result;

    }

    public function generateInvoiceLisyByBuyerId($buyerId,$invoiceData){
       // $lastIncreamentId = Invoice::
      //  dd($invoiceData);
        
    }
    
 }
?>
