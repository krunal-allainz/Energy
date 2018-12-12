<?php
namespace Energy\Api\Repositories;
use Carbon\Carbon;
use DB;
use Energy\Models\NominationLng;
use Energy\Models\TruckDetails;
use Energy\Api\Repositories\NotificationRepository;
use Excel;
use File;
use Energy\Api\Repositories\UserRepository;
use Auth;




 class NominationLngRepository 
 {
    public function __construct(){
        $this->userObj = new UserRepository(); 
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
            })
             ->whereDate('nomination_lng.lngDate',$date)
             ->select('nomination_lng.*','nomination_lng.id as nId','truck_details.truck_no','truck_details.truck_company')
             ->orderBy('nomination_lng.created_at','desc')
             ->paginate($noOfPage);
        }
        
        return $list;
    }

    public function createNominationLng($request)
    {
            $formData=$request->nominationLngData;

            $lngDate=Carbon::createFromFormat('d-m-Y', $formData['lngDate'])->format('Y-m-d');
            
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
            $nominationLng->save();
            if($nominationLng->id!=0)
            {
                return ['code'=> 200 ,'data'=>$nominationLng->id,'message'=>'Record successfully added.'];
            }
            else
            {
                return ['code'=> 300 ,'data'=>'','message'=>'Record not added.'];
            }
    }

    public function checkNominationLngWithTime($lDate,$buyer_id,$time)
    {
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
                return ['code'=> 200 ,'data'=>$nominationLng->id,'message'=>'Record successfully updated.'];
            }
            else
            {
                return ['code'=> 300 ,'data'=>'','message'=>'Record not updated.'];
            }
    }

    /**
     * [getNominationLngDetailsById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getNominationLngDetailsById($id)
    {
        $details=NominationLng::where('id',$id)->first();
        return $details;
    }

    public function deleteNominationLngById($id)
    {
        $presp_id = NominationLng::find( $id );
        $presp_id ->delete();
        return $id;
    }

    
    
 }
?>