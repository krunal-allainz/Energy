<?php
namespace Energy\Api\Repositories;
use Carbon\Carbon;
use DB;
use Energy\Models\NominationLng;
use Energy\Models\TruckDetails;
use Energy\Models\Setting;
use Energy\Models\AvailabilityGcv;

use Energy\Models\Agreement;
use Energy\Api\Repositories\LngNotificationRepository;
use Excel;
use File;
use Energy\Api\Repositories\UserRepository;
use Energy\Api\Repositories\SettingRepository;
use Energy\Api\Repositories\TruckDetailsRepository;
use Auth;





 class NominationLngRepository 
 {
    public function __construct(){
        $this->userObj = new UserRepository(); 
        $this->confObj = new SettingRepository(); 
        $this->lngNotificationRepoObj = new LngNotificationRepository();
    }
   
 	/**
 	 * [getNominationLngList description]
 	 * @param  [type] $userType [description]
 	 * @param  [type] $noOfPage [description]
 	 * @param  [type] $userId   [description]
 	 * @return [type]           [description]
 	 */
    public function getNominationLngList($userType,$noOfPage,$userId,$date)
        {
         
        if($userType==2)
        {
             $list= NominationLng::join('truck_details', function ($join) {
                $join->on('truck_details.id', '=', 'nomination_lng.truck_details_id');
            })
             ->whereDate('nomination_lng.lngDate',$date)
             ->where('nomination_lng.buyer_id',$userId)
             ->select('nomination_lng.*','nomination_lng.id as nId','truck_details.truck_no','truck_details.truck_company')
             ->orderBy('nomination_lng.created_at','desc')
             ->paginate($noOfPage);

        }
        else if($userType==3)
        {
             $list= NominationLng::join('truck_details', function ($join) {
                $join->on('truck_details.id', '=', 'nomination_lng.truck_details_id');
            })->join('users',function($join){
                $join->on('users.id','=','nomination_lng.buyer_id');
            })
             ->whereDate('nomination_lng.lngDate',$date)
             ->whereIn('nomination_lng.lng_status',['pending','approved'])
             ->select('nomination_lng.*','users.first_name','users.last_name','nomination_lng.id as nId','truck_details.truck_no','truck_details.truck_company')

             ->orderBy('nomination_lng.buyer_id','ASC')
             ->paginate($noOfPage);
        }
       
        return $list;
    }


        public function getSuppliedLngList($userType,$noOfPage,$userId,$date)
        {
            // dd($userType,$noOfPage,$userId,$date);
        if($userType==2)
        {
             $list= NominationLng::with('truckDetail')
             ->whereDate('nomination_lng.lngDate',$date)
             ->where('nomination_lng.buyer_id',$userId)
             // ->select('nomination_lng.*','nomination_lng.id as nId','truck_details.truck_no','truck_details.truck_company')
             ->orderBy('nomination_lng.created_at','desc')
             ->paginate($noOfPage);

        }
        else if($userType==3)
        {
             $list= NominationLng::with('truckDetail','buyerDetail')
             ->whereDate('nomination_lng.lngDate',$date)
             ->orderBy('nomination_lng.lngTime','desc')
             ->paginate($noOfPage);
             // ->get();
        }
        // dd($list);
        return $list;
    }

    public function saveTruckLoading($data)
    {
        // dd($data);
        $tare_weight = $data['tare_weight'] ? $data['tare_weight'] : '';
        $gross_weight = $data['gross_weight'] ? $data['gross_weight'] : '';
        if($gross_weight == '' || $tare_weight == ''){
            $net_weight = 0.00;    
        } else {
            $net_weight = intval($gross_weight)- intval($tare_weight);
        }
        
        // dd($net_weight);
        if($net_weight < 0){
         $net_weight = 0.00;   
        }

         $truckLoading =NominationLng::where('id', $data['nominationLngId'])->update([
            'tare_weight' => $tare_weight,
            'gross_weight' => $gross_weight,
            'supplied_quantity' => $net_weight
        ]);
        
        if($truckLoading == 1){
            $nominationDataFornotification = NominationLng::where('id', $data['nominationLngId'])->first();
         $dataUserId = $nominationDataFornotification->buyer_id;
            $userName = $this->userObj->getUserNameById( $dataUserId);
            $addedBy  = Auth::user()->id;
            $dataId = $nominationDataFornotification->id;
            $qty    = $net_weight;
            $type   = 'net_quantity_add';
             $reqTime = $nominationDataFornotification->lngTime;
              $this->truckDetailObj = new TruckDetailsRepository(); 
            $nominationTruckDetail = $this->truckDetailObj->getTruckDetailById($nominationDataFornotification->truck_details_id);
            //dd($invoice->date);
            $truckCompapnyName =$nominationTruckDetail->truck_company; 
            $d_format=Carbon::createFromFormat('Y-m-d',$nominationDataFornotification->lngDate)->format('jS M Y');
             /*$dataText = 'Seller added net weight quantity of '. ucwords($userName).' requested '.$truckCompapnyName.' to '.number_format($qty,2).' KG for nomination request on '.$d_format.' '.$reqTime.'.';*/
             $dataText = 'Net '.$truckCompapnyName.'[ '.number_format($qty,2).' Kg ] quantity added for nomination request of'.ucwords($userName);

            $title  = 'Net quantity added';
            $dataTable = 'nomination_lng';

            $new_date=Carbon::createFromFormat('Y-m-d', $nominationDataFornotification->lngDate)->format('Y-m-d');
            $nomination_date=$new_date;
            
            $this->lngNotificationRepoObj->insert($dataId,$type,$dataUserId,$dataText,$title,$dataTable,$addedBy,$nomination_date);
        }


        // return Nomination::where('id',$id)->first();
        return $truckLoading;
       
    }

    public function createNominationLng($request)
    {
            $formData=$request->nominationLngData;
            // dd($request->all());
            // $lngDate=$request->all()['nominationLngData']['lngDate'];
            $lngDate=Carbon::createFromFormat('d-m-Y', $request->all()['nominationLngData']['lngDate'])->format('Y-m-d');
            $checkNominationLng=$this->checkNominationLngWithTime($lngDate,$formData['buyer_id'],$formData['lngTime']);
            if($checkNominationLng>0)
            {
                return ['code'=> 300 ,'data'=>'','message'=>'Truck is already added for this day.'];
            }
            $checkTruckSafeQuantity=$this->checkTruckSafeQuantity($formData['truck_details_id']);
            if($checkTruckSafeQuantity<$formData['quantity'])
            {
                return ['code'=> 300 ,'data'=>'','message'=>'Safe quantity lng is exceed.The Safe quantity of lng for this truck is '.$checkTruckSafeQuantity.'.'];
            }
            $nominationLng=new NominationLng;
            $nominationLng->buyer_id=$formData['buyer_id'];
            $nominationLng->truck_details_id=$formData['truck_details_id'];
            $nominationLng->lngTime=$formData['lngTime'];
            $nominationLng->lngDate=$lngDate;

            $nominationLng->quantity=$formData['quantity'];
            $nominationLng->tare_weight='0.00';
            $nominationLng->gross_weight='0.00';
            $nominationLng->save();
            if($nominationLng->id!=0)
            {
                $dataUserId = $formData['buyer_id'];
                $userName = $this->userObj->getUserNameById( $dataUserId);
                $addedBy  = Auth::user()->id;
                $dataId = $nominationLng->id;
                $qty    = $formData['quantity'];
                $type   = 'add_lng_nomination';
                 $reqTime = $nominationLng->lngTime;
                  $this->truckDetailObj = new TruckDetailsRepository(); 
                $nominationTruckDetail = $this->truckDetailObj->getTruckDetailById($formData['truck_details_id']);
                //dd($invoice->date);
                $truckCompapnyName =$nominationTruckDetail->truck_company; 
                $d_format=Carbon::createFromFormat('Y-m-d',$nominationLng->lngDate)->format('jS M Y');
                /*$dataText = ucwords($userName).'  added LNG nomination request of '.$truckCompapnyName.' to '.number_format($qty,2).' KG for '.$d_format.' on '.$reqTime;*/
                $dataText = ucwords($userName).' requests '.$truckCompapnyName.'[ '.number_format($qty,2).'Kg ] LNG Nomination for '.$d_format.' on '.$reqTime;
                
                $title  = 'New LNG Nomination request';
                $dataTable = 'nomination_lng';

                $new_date=Carbon::createFromFormat('Y-m-d', $nominationLng->lngDate)->format('Y-m-d');
                $nomination_date=$new_date;
                
                $this->lngNotificationRepoObj->insert($dataId,$type,$dataUserId,$dataText,$title,$dataTable,$addedBy,$nomination_date);
                return ['code'=> 200 ,'data'=>$nominationLng->id,'message'=>'Record successfully added.'];
            }
            else
            {
                return ['code'=> 300 ,'data'=>'','message'=>'Record not added.'];
            }
    }

    public function checkNominationLngWithTime($lDate,$buyer_id,$time)
    {
        // dd($lDate,$buyer_id,$time);
        $list=NominationLng::whereDate('lngDate',$lDate)
        ->where('buyer_id',$buyer_id)
        ->where('lngTime',$time)
        ->get();
        return count($list);
    }
    /**
     * [checkNominationLng description]
     * @param  [type] $truck_details_id [description]
     * @param  [type] $lDate            [description]
     * @param  [type] $buyer_id         [description]
     * @return [type]                   [description]
     */
    public function checkNominationLng($truck_details_id,$lDate,$buyer_id)
    {
        $list=NominationLng::where('truck_details_id',$truck_details_id)
        ->whereDate('lngDate',$lDate)
        ->where('buyer_id',$buyer_id)
        ->get();
        return count($list);
    }

    /**
     * [checkTruckSafeQuantity description]
     * @param  [type] $t_id [description]
     * @return [type]       [description]
     */
    public function checkTruckSafeQuantity($t_id)
    {
        $list=TruckDetails::where('id',$t_id)->first();
        return $list->safe_quantity_lng;
    }

    /**
     * [editNominationLng description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function editNominationLng($request)
    {
        $formData=$request->nominationLngData;
            $checkTruckSafeQuantity=$this->checkTruckSafeQuantity($formData['truck_details_id']);
            if($checkTruckSafeQuantity<$formData['quantity'])
            {
                return ['code'=> 300 ,'data'=>'','message'=>'Safe quantity lng is exceed.The Safe quantity of lng for this truck is '.$checkTruckSafeQuantity.'.'];
            }
            $id=$formData['nominationLngId'];
            $nominationLng=NominationLng::findOrFail($id);
            $nominationLng->truck_details_id=$formData['truck_details_id'];
            $nominationLng->lngTime=$formData['lngTime'];
            //$nominationLng->lngDate=$formData['lngDate'];
            $nominationLng->quantity=$formData['quantity'];
            $nominationLng->save();
            if($nominationLng->id!=0)
            {

                $dataUserId = $formData['buyer_id'];
            $userName = $this->userObj->getUserNameById( $dataUserId);
            $addedBy  = Auth::user()->id;
            $dataId = $nominationLng->id;
            $qty    = $formData['quantity'];
            $type   = 'update_lng_nomination';
            $reqTime = $nominationLng->lngTime;
             $this->truckDetailObj = new TruckDetailsRepository(); 

            $nominationTruckDetail = $this->truckDetailObj->getTruckDetailById($formData['truck_details_id']);
              $truckCompapnyName =$nominationTruckDetail->truck_company; 
            //dd($invoice->date);
            $d_format=Carbon::createFromFormat('Y-m-d',$nominationLng->lngDate)->format('jS M Y');
            $dataText = ucwords($userName).' updated LNG nomination request of '.$truckCompapnyName.'  to  '.number_format($qty,2).' KG for '.$d_format.' on '. $reqTime;
            //$dataText =  $userName.' update notification for '.$qty;
            
            $title  = 'LNG Nomination request updated';
            $dataTable = 'nomination_lng';

            $new_date=Carbon::createFromFormat('Y-m-d', $nominationLng->lngDate)->format('Y-m-d');
            $nomination_date=$new_date;
            
            $this->lngNotificationRepoObj->insert($dataId,$type,$dataUserId,$dataText,$title,$dataTable,$addedBy,$nomination_date);
                return ['code'=> 200 ,'data'=>$nominationLng->id,'message'=>'Record successfully updated.'];
            }
            else
            {
                return ['code'=> 300 ,'data'=>'','message'=>'Record not updated.'];
            }
    }
    /**
     * [getNominationDetailsByDate description]
     * @param  [type] $date [description]
     * @return [type]       [description]
     */
    public function getNominationDetailsByDate($date)
    {
        $new_date=Carbon::createFromFormat('d-m-Y', $date)->format('Y-m-d');
        $list= NominationLng::join('users', function ($join) {
                $join->on('users.id', '=', 'nomination_lng.buyer_id');
            })->whereDate('lngDate',$new_date)->get();
        return $list;

    }

    /**
     * [getNominationLngDetailsById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getNominationLngDetailsById($id)
    {
        $details=NominationLng::with('truckDetail')->where('id',$id)->first();
        return $details;
    }

    public function deleteNominationLngById($id)
    {
        $presp_id = NominationLng::find( $id );
        $presp_id ->delete();
        return $id;
    }

    /**
    * update approve qty and status in related tabel
    *
    *  Auth : Mital Sharma
    **/

    public function approveNominationLngById($data){
        $result = 0;
        $totalApproveQty = 0;
        $availabelLimit  = '';
        $availabelLimit = $this->confObj->getFieldValue('lng_supply_daily_limit','numeric');

        if(!empty($data)){

            foreach($data as $key){
                 $totalApproveQty = (int)$totalApproveQty + (int)$key['quantity'] ; 
             } 
                // NominationLng::where('id',$key['id'])->update(array('lng_status' => 'approved','approve_quantity' => $key['quantity']));

           
            if( $totalApproveQty <= $availabelLimit){
                foreach($data as $key){
               
                NominationLng::where('id',$key['id'])->update(array('lng_status' => 'approved','approve_quantity' => $key['quantity']));
                $nominationDataFornotification = NominationLng::where('id', $key['id'])->first();

                $dataUserId = $nominationDataFornotification->buyer_id;

                $userName = $this->userObj->getUserNameById( $dataUserId);
                $addedBy  = Auth::user()->id;
                $dataId = $nominationDataFornotification->id;
                $qty    = $key['quantity'];
                $type   = 'lng_nomination_qty_approve';
                $reqTime = $nominationDataFornotification->lngTime;
                $this->truckDetailObj = new TruckDetailsRepository(); 
                 $nominationTruckDetail = $this->truckDetailObj->getTruckDetailById($nominationDataFornotification->truck_details_id);
            
                $truckCompapnyName =$nominationTruckDetail->truck_company; 
                $d_format=Carbon::createFromFormat('Y-m-d',$nominationDataFornotification->lngDate)->format('jS M Y');
             /*$dataText = 'Seller approved quantity of '. ucwords($userName).' requested '.$truckCompapnyName.' to '.number_format($qty,2).' KG for nomination request on '.$d_format.' '.$reqTime;*/
             $dataText = 'Nomination request of '.ucwords($userName).' for '.$truckCompapnyName .'[ '.number_format($qty,2).' Kg]'.' has been approved by seller.';
            $title  = 'LNG Nomination request approved';
            $dataTable = 'nomination_lng';

            $new_date=Carbon::createFromFormat('Y-m-d', $nominationDataFornotification->lngDate)->format('Y-m-d');
            $nomination_date=$new_date;
            
            $this->lngNotificationRepoObj->insert($dataId,$type,$dataUserId,$dataText,$title,$dataTable,$addedBy,$nomination_date);
                $result = 1;
                }
            }else{
                 $result = 0;
            }
        }

        return $result;

    }


    

    /**
    * reject qty and status in related tabel
    *
    *  Auth : Mital Sharma
    **/

    public function rejectNominationLngById($data,$rid){

        $result = 0;
        if(!empty($rid)){

           // foreach($data as $key){
                NominationLng::where('id',$rid)->update(array('lng_status' => 'rejected'));
                $result = 1;
            //}
        }

        return $result;

    }

    public function getDisabledDates($data){
       $date = date('Y-m-d', strtotime($data['lngDate']));
       $list = NominationLng::select('lngTime')->where('buyer_id',$data['buyer_id'])->where('lngDate', $date)->get()->toArray();
       return $list;
    }
    /**
    *
    *
    *
    **/

    public function getLngBuyerRequestList($buyerId,$requestType,$typeInclude,$multipleType='no'){

        if($typeInclude == 'no'){
                if($multipleType == 'no'){
                    $list = NominationLng::select('nomination_lng.id as nId','nomination_lng.*','users.*')->where('nomination_lng.lng_status','!=',$requestType)->where('buyer_id',$buyerId)->join('users', function ($join) {
                    $join->on('users.id', '=', 'nomination_lng.buyer_id');
                            })->get();

                }
                if($multipleType == 'yes'){
                   $list = NominationLng::select('nomination_lng.id as nId','nomination_lng.*','users.*')->whereNotIn('nomination_lng.lng_status',$requestType)->where('buyer_id',$buyerId)->join('users', function ($join) {
                    $join->on('users.id', '=', 'nomination_lng.buyer_id');
                            })->get();  
                }
           
        }else if($typeInclude == 'yes'){

            $list = NominationLng::select('nomination_lng.id as nId','nomination_lng.*','users.*')->where('nomination_lng.lng_status','=',$requestType)->where('buyer_id',$buyerId)->join('users', function ($join) {
                $join->on('users.id', '=', 'nomination_lng.buyer_id');
            })->get();
        }else{

            $list = NominationLng::select('nomination_lng.id as nId','nomination_lng.*','users.*')->where('nomination_lng.buyer_id',$buyerId)->join('users', function ($join) {
                $join->on('users.id', '=', 'nomination_lng.buyer_id');
            })->get();
        }

        return $list;

    }

    public function updateRequeststatus($requestType,$nid){
        return NominationLng::where('id',$nid)->update(array('nomination_lng.lng_status' => $requestType));
    }
    
    public function getNominationLngTotals($data){
        $date = date('Y-m-d', strtotime($data['date']));
        
        $lng['AvailabilityGcv'] = AvailabilityGcv::where('gcv_date', $date)->sum('gcv_quantity');
        $lng['LngTotal'] = NominationLng::where('lngDate', $date)->sum("quantity");
        $lng['ApprovedLngTotal'] = NominationLng::where('lngDate', $date)->where('lng_status', 'approved')->sum("approve_quantity");
        $lng['SuppliedQuantity'] = NominationLng::where('lngDate', $date)->where('lng_status', 'approved')->sum("supplied_quantity");
        // dd($lng);
        return $lng;
    }

    public function getBuyerNominationLngTotals($data){
        $date = date('Y-m-d', strtotime($data['date']));
        $requestDate = date('Y-m-d', strtotime($data['date'].'+ 1 days'));
        $approvedDate = date('Y-m-d', strtotime($data['date']));
        $supplyDate = date('Y-m-d', strtotime($data['date'].'- 1 days'));
        
        $lng['AvailabilityGcv'] = AvailabilityGcv::where('gcv_date', $date)->sum('gcv_quantity');
        $lng['LngTotal'] = NominationLng::where('lngDate', $requestDate)->where('buyer_id', $data['buyerId'])->sum("quantity");
        $lng['ApprovedLngTotal'] = NominationLng::where('lngDate', $approvedDate)->where('buyer_id', $data['buyerId'])->where('lng_status', 'approved')->sum("approve_quantity");
        $lng['SuppliedQuantity'] = NominationLng::where('lngDate', $supplyDate)->where('buyer_id', $data['buyerId'])->where('lng_status', 'approved')->sum("supplied_quantity");
        
        $lng['date'] = date('d-m-Y',strtotime($date));
        $lng['requestDate'] = date('d-m-Y',strtotime($requestDate));
        $lng['approvedDate'] = date('d-m-Y',strtotime($approvedDate));
        $lng['supplyDate'] = date('d-m-Y',strtotime($supplyDate));

        return $lng;
    }

    public function getBuyerAllowedQuantity($buyerId)
    {
        $allowedQuantity = Agreement::select('allowed_quantity')->where('buyer_id',$buyerId)->get()->toArray();
        
        return $allowedQuantity[0];
    }

    public function getBuyerUsedQuantity($requestDate, $buyerId)
    {
        $requestDate = date('Y-m-d', strtotime($requestDate));
        $usedQuantity = NominationLng::where('buyer_id',$buyerId)->where('lngDate', $requestDate)->sum('quantity');

        return $usedQuantity;
    }
 }
?>
