<?php
namespace euro_hms\Api\Repositories;

use Carbon\Carbon;
use DB;
use euro_hms\Models\Notification;

class NotificationRepository 
 {

    public function __construct(){
        $this->notificationObj = new Notification();
    }

    public function getTimelineData($id){
    	$result = Notification::select('title as title','type as type','data_table as dataTable','data_id as dataId','data_consult_id as dataConsultId','data_date as Datadate','data_text as text','status as status')->groupBy('type')->orderBy('created_at','desc')->where('data_consult_id',$id)->get();

    	return $result;
    }

    public static function checkRecordStatus($consultId,$type){
        
    	$result = Notification::where('data_consult_id',$consultId)->where('type',$type)->first();

    	return $result;

    }

}