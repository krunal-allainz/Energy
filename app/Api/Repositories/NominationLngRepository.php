<?php
namespace Energy\Api\Repositories;
use Carbon\Carbon;
use DB;
use Energy\Models\NominationLng;
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

    
    
 }
?>
