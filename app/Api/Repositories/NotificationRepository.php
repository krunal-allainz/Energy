<?php 
namespace euro_hms\Api\Repositories;

use euro_hms\Models\User;
use euro_hms\Models\Notification;
use Carbon\Carbon;
use DB;
use Hash;

class NotificationRepository {

	public function __construct(){

	}

	public function getTimelineData($usertype,$userId){
		if($usertype == 6){
				$typeList = ['add_notification','update_notification','update_request_qty_status'];

				$result = Notification::select('title as title','type as type','data_table as dataTable','data_id as dataId','data_user_id as dataUserId','data_date as Datadate','data_text as text','status as status')->whereIn('type',$typeList)->where('data_user_id',$userId)->groupBy('type')->orderBy('created_at','desc')->get();
		}
		if($usertype == 7){

			$typeList = ['add_notification','update_notification','update_request_qty_status'];

			$result = Notification::select('title as title','type as type','data_table as dataTable','data_id as dataId','data_user_id as dataUserId','data_date as Datadate','data_text as text','status as status')->whereIn('type',$typeList)->where('added_by',$userId)->groupBy('type')->orderBy('created_at','desc')->get();
		}
		
			

    	return $result;
	}

	public function insert($dataId,$type,$dataUserId,$dataText,$title,$dataTable,$addedBy){

		  $checkForTypeData = '';
		  $data_date = Carbon::now()->format('Y-m-d H:i:s');
		  $checkForTypeData = Notification::where('type',$type)->where('data_user_id',$dataUserId)->first();
		  if($checkForTypeData != ''){
             $result =  Notification::where('type',$type)->update(array('data_id' => $dataId, 'data_user_id' => $dataUserId , 'data_text' => $dataText , 'data_date' =>  $data_date));
		  }else{

		  	$result  = Notification::create([
		  			'title' => $title,
		  			'type'  => $type,
		  			'data_table' => $dataTable,
                    'data_id' =>$dataId,
                    'data_user_id' => $dataUserId,
                    'added_by'  => $addedBy,
                    'data_date' => $data_date,
                    'data_text' => $dataText,
                    'status' => '1'

		  	]);

		  }

		return $result;

	}

}

?>