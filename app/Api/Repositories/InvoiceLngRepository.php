<?php
namespace Energy\Api\Repositories;
use Carbon\Carbon;
use DB;
use Energy\Models\LngInvoice;
use Energy\Api\Repositories\UserRepository;
use Energy\Api\Repositories\NominationLngRepository;
use Energy\Api\Repositories\LngNotificationRepository;
use Energy\Api\Repositories\AgreementRepository;
use Energy\Api\Controllers\GcvController;
use Excel;
use File;
use Auth;



 class InvoiceLngRepository 
 {
    public function __construct(){
        $this->userObj = new UserRepository();
        $this->nominationLngRepoObj = new NominationLngRepository();
        $this->lngNotificationRepoObj = new LngNotificationRepository();
    }

 	/**
     * [getInvoiceList1 description]
     * @return [type] [description]
     */
    public function getInvoiceList1($userId)
    {
        $list= LngInvoice::where('buyer_id',$userId)->where('status',1)->get();
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
        $list= LngInvoice::where('buyer_id',$userId)->where('status',2)->get();
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
    
    public function generateLngInvoice(){

       // $nominationList = $this->nominationRepoObj->getNominationRequestList();
       
    }

    public function getLngInvoiceListByBuyerId($buyerId,$noOfpage){
         $list = array();
          $list= LngInvoice::where('buyer_id',$buyerId)->orderBy('id','DESC')->paginate($noOfpage);

        $result_array=array();
        $total=0;
        
        foreach($list as $inv)
        {
            $res_arr=array();
            $res_arr['date']=$inv->date;
            $res_arr['invoice_no']=$inv->invoice_no;
            $res_arr['vid']=$inv->id;
            $res_arr['buyer_name']=$this->userObj->getUserNameInfoById($inv->buyer_id);
            $res_arr['seller_name']=$this->userObj->getUserNameInfoById($inv->seller_id);
            $res_arr['supplied_quantity']=$inv->total_supplied_quantity;
            $res_arr['total_supplied_quantity_withGCV']=$inv->total_supplied_quantity_withGCV;
            $res_arr['rate']=$inv->rate;
            $res_arr['status']=$inv->status;
            $res_arr['tax']=$inv->tax;
            $res_arr['per_mmbtu']=$inv->per_mmbtu;
            $res_arr['convert_currency_rate']=$inv->convert_currency_rate;
            $res_arr['total_amount']=$inv->total_amount;
            $res_arr['invoiceHtml']=$inv->invoiceView;
            $total=$total+$inv->total_amount;
            $result_array['inv_arr'][]=$res_arr;
        }
        $result_array['sub_total'] =$total;
        $result_array['rate'] =5;
        $result_array['total_all']=$total-$result_array['rate'];
     
        return $result_array;
    }

    public function viewbyBuyer($buyerId){
        $lastIdRecord  = 0;
        $lastIdRecord = LngInvoice::orderBy('id','DESC')->first();
        if($lastIdRecord != null){
            $lastId =  $lastIdRecord->id;
        }else{
             $lastId = 0;
        }
        $userData = $this->userObj->getUserDetaileById($buyerId);
        $this->agreementObj = new AgreementRepository();
        $agreementData = $this->agreementObj->getAgreementData($buyerId);
        // $price = $agreementData->price;
        $tax_type = $agreementData->tax_type;
        $tax_rate = $agreementData->tax_rate;
        // $external_fuel_type = $agreementData->external_fuel_type;
        // $external_fuel_type_rate = $agreementData->external_fuel_type_rate;
        $perMMbt = 20;
        $convertCurrency = 72;
        $requestTypeNot = array('invoice','pending','rejected');
        $requestList = $this->nominationLngRepoObj->getLngBuyerRequestList($buyerId,$requestTypeNot,'no','yes');
      
        $result = array();
        $invoiceNo = $lastId; 
        $max_loop=4;
        $count = 0;
        $total_supplied_qty = 0;
        $getRequestList = 1;
        $getsupplyQty = 0;
        $total_supply_qty_with_gcv = 0;
        $dateWiseQtyTotal = 0;
        $sameDate = '';
        $cnt =0;
        // dd($requestList);
        foreach($requestList as $request){
           $cnt++;
            $getsupplyQty = $request->supplied_quantity;
            if($getsupplyQty != null && $getsupplyQty != 0.00){
                $lngDate = $request->lngDate;
                if($sameDate != $lngDate){
                    // echo $sameDate."<br>".$lngDate;
                    $sameDate = $lngDate;
                    $dateWiseQtyTotal =0;
                     $supply_qty_with_gcv = 0;
                    $gcvValue = 1;
                    $gvcValueByDate = GcvController::getGcvByDate($lngDate);
                    if($gvcValueByDate != 0){
                      $gcvValue =  $gvcValueByDate; 
                    }
                    
                      $dateWiseQtyTotal = $dateWiseQtyTotal +  $request->supplied_quantity;
                      $count++;
                    
                }else{
                    $dateWiseQtyTotal = $dateWiseQtyTotal +  $request->supplied_quantity;
                    // echo "<pre>";print_r($request->nId);echo"</pre>";
                }

                 $supply_qty_with_gcv =  ($request->supplied_quantity * $gcvValue);
                
                    $total_supplied_qty = $total_supplied_qty +   $request->supplied_quantity;
                   $total_supply_qty_with_gcv = $total_supply_qty_with_gcv + $supply_qty_with_gcv;
                    $result['updatedstatusreuestlist'][$getRequestList][$request->nId]['nid'] =$request->nId;
                //add date
                 //$result['requestList'][$getRequestList][$request->nId]['date'] =$lngDate;
                $result['requestList'][$getRequestList][$lngDate]['GcvValue'] =$gcvValue;
                $result['requestList'][$getRequestList][$lngDate]['cnt'] =$count;
                 
                     $result['requestList'][$getRequestList][$lngDate]['date'] =$lngDate;
                $result['requestList'][$getRequestList][$lngDate]['supplied_Qty'] =$getsupplyQty;
                   $result['requestList'][$getRequestList][$lngDate]['total_date_supplied_Qty'] =$dateWiseQtyTotal;
                $result['requestList'][$getRequestList][$lngDate]['supplu_qty_with_GcvValue'] =$dateWiseQtyTotal*$gcvValue;
                 $result['requestList'][$getRequestList][$lngDate]['nid'] =$request->nId; 
               
                $result['requestList'][$getRequestList][$lngDate]['quantityRequired'] =$request->quantity; 
                $result['requestList'][$getRequestList][$lngDate]['approveQuntity'] =$request->approve_quantity;

                 if(($count%4) == 0){
                    $result['updateList'] = $result['updatedstatusreuestlist'][$getRequestList];

                    $getRequestList = $getRequestList + 1;
                    $supplidQty = $total_supplied_qty;
                    $getsupplyQty = 0;
                    $invoiceNo = $invoiceNo + 1;
                    $dt = Carbon::now()->format('Ymd').$invoiceNo;
                    $result[$invoiceNo]['invoice_no'] = '#'.$dt;
                    $result[$invoiceNo]['sub_amount']  = $total_supply_qty_with_gcv * $perMMbt ;
                    $result[$invoiceNo]['perMMbtu']  =$perMMbt;
                    $result[$invoiceNo]['convertCurrency']  =$convertCurrency;
                    $new_date=Carbon::now()->format('Y-m-d');
                    $result[$invoiceNo]['date']  = $new_date;
                    $result[$invoiceNo]['status']  = 0;
                    $result[$invoiceNo]['supply_qty_with_gcv']  = $total_supply_qty_with_gcv;
                    $subAmount = $result[$invoiceNo]['sub_amount'];
                    // $amountAfterPanelty= $subAmount - $external_fuel_type_rate;
                    $AmountAfterConvertrt = $result[$invoiceNo]['sub_amount'] * $convertCurrency;
                    $taxRateAmount = ($AmountAfterConvertrt/100) * $tax_rate ;
                    $result[$invoiceNo]['afterConvertCurrentcy'] = $AmountAfterConvertrt;
                    $result[$invoiceNo]['tax_rate_amount_cal'] = $taxRateAmount;
                    $result[$invoiceNo]['total_amount'] = $AmountAfterConvertrt +  $taxRateAmount;
                    $result[$invoiceNo]['supplied_quantity']  = $supplidQty;
                    $result['generateInvociedata'][$invoiceNo]= $result[$invoiceNo];
                    $supplidQty = 0;
                    $total_supply_qty_with_gcv = 0;
                    $total_supplied_qty = 0;

                 } 
                 
                  
             }
        }
          
        $addedBy  = Auth::user()->id;
        $result['buyerData']['buyer_id']  = $buyerId;
        $result['buyerData']['seller_id']  = $addedBy;
        $result['buyerData']['rate']  = $tax_rate;
        $result['buyerData']['tax']  = $tax_type;
        $result['buyerData']['permmbtu']  = $perMMbt;
        $result['buyerData']['convertRate']  = $convertCurrency;
        
        $result['buyerData']['first_name'] = $userData->first_name;
        $result['buyerData']['last_name'] = $userData->last_name;
        $result['buyerData']['mobile_no'] = $userData->mobile_no;
        $result['buyerData']['address'] = $userData->address;
        $result['buyerData']['email'] = $userData->email;
        return $result;

    }

    public function generateLngInvoiceLisyByBuyerId($buyerId,$sellerId,$invoicedata,$invoiceHtml,$requestList,$agreementData,$updateRequestList){
        $invoice = LngInvoice::create([
            'buyer_id' => $buyerId, 
            'seller_id' => $sellerId,
            'date' => $invoicedata['date'],
            'total_supplied_quantity' => $invoicedata['supplied_quantity'],
            'total_supplied_quantity_withGCV' => $invoicedata['total_supply_qty_with_gcv'],
            'status' => 0,
            'tax' => $invoicedata['tax_rate_amount_cal'],
            'per_mmbtu' => $agreementData['perMMbtu'],
            'convert_currency_rate' => $agreementData['convertRate'],
            'total_amount' =>  $invoicedata['total_amount'],
            'invoice_no' => $invoicedata['invoice_no'],
            'invoiceView' => $invoiceHtml
        ]);

            $dataUserId = $buyerId;
            $userName = $this->userObj->getUserNameById( $dataUserId);
            $addedBy  = Auth::user()->id;
            $dataId = $invoice->id;
            $qty    = $invoicedata['supplied_quantity'];
            $type   = 'generate_lng_invoice';
            $invoiceNo = $invoicedata['invoice_no'];
            //dd($invoice->date);
            $d_format=Carbon::createFromFormat('Y-m-d',$invoice->date)->format('jS M Y');
            $dataText ='seller has created invoice  '.$invoiceNo.' of total net quantity '.number_format($qty,2).'  on '.$d_format.' for '. ucwords($userName);
            $title  = 'Invoice Created';
            $dataTable = 'invoice_lng';

            $new_date=Carbon::createFromFormat('Y-m-d', $invoice->date)->format('Y-m-d');
            $nomination_date=$new_date;
            
            $this->lngNotificationRepoObj->insert($dataId,$type,$dataUserId,$dataText,$title,$dataTable,$addedBy,$nomination_date);
        // dd($updateRequestList);
        foreach($updateRequestList as $req){
             $nid = 0;
            $nid =  $req['nid'];
           $this->nominationLngRepoObj->updateRequeststatus('invoice', $nid); 
             // $nid = 0;
             //    if($req!='' ||$req!=NULL ) {

             //        foreach($req as $val){
                      
                     
             //        }
                    
             //    }

            // echo $key['nid'];
        }
         
        // dd('test');


        return true;
    }

    public function getInvoiceView($vid){
        return LngInvoice::select('invoiceView as invoiceView')->where('id',$vid)->first();
    }
    
 }
?>
