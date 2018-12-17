<?php
namespace Energy\Api\Repositories;
use Carbon\Carbon;
use DB;
use Energy\Models\TruckDetails;
use Excel;
use File;
use Auth;
use Energy\Api\Repositories\NominationLngRepository;




 class TruckDetailsRepository 
 {
     public function __construct(){
     	$this->nomLngObj = new NominationLngRepository();
    }
   
 	
 	/**
 	 * [getTruckDetailsList description]
 	 * @param  [type] $data [description]
 	 * @return [type]       [description]
 	 */
    public function getTruckDetailsList($data)
    {
        // dd($data);
        $truckList=TruckDetails::get();
        $truckData=array();
        $lngDate= $lngDate=Carbon::createFromFormat('d-m-Y', $data->lngDate)->format('Y-m-d');
        // dd($lngDate);
        $buyer_id=$data->buyer_id;
        foreach($truckList as $truck)
        {
        	$truckD=array();
        	$truckD['id']=$truck->id;
        	$truckD['truck_name']=$truck->truck_company.'('.$truck->truck_no.')';
        	$truckD['available']=$this->nomLngObj->checkNominationLng($truck->id,$lngDate,$buyer_id);
        	$truckData[]=$truckD;
        }
        return $truckData;
    }

   
    
    
 }
?>
