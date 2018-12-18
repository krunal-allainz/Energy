<?php 
namespace Energy\Api\Repositories;

use Energy\Models\User;
use Energy\Models\LngNotification;
use Carbon\Carbon;
use DB;
use Hash;

class LngNotificationRepository {

	public function __construct(){

	}

	public function getTimelineData($usertype,$userId){
		$result =array();
		if($usertype == 2){
				$typeList = ['add_notification','update_notification','update_request_qty_status'];

				$result = LngNotification::select('title as title','type as type','data_table as dataTable','data_id as dataId','data_user_id as dataUserId','data_date as Datadate','data_text as text','status as status','nomination_date as nDate')->whereIn('type',$typeList)->where('data_user_id',$userId)->groupBy('type')->orderBy('created_at','desc')->get();
		}
		if($usertype == 3){

			$typeList = ['add_notification','update_notification','update_request_qty_status'];

			$result = LngNotification::select('title as title','type as type','data_table as dataTable','data_id as dataId','data_user_id as dataUserId','data_date as Datadate','data_text as text','status as status','nomination_date as nDate')->whereIn('type',$typeList)->groupBy('type')->orderBy('created_at','desc')->get();
		}
		
			

    	return $result;
	}

	public function insert($dataId,$type,$dataUserId,$dataText,$title,$dataTable,$addedBy,$nDate){

		  $checkForTypeData = '';
		  $data_date = Carbon::now()->format('Y-m-d H:i:s');
		  $checkForTypeData = LngNotification::where('type',$type)->where('data_user_id',$dataUserId)->first();
		  if($checkForTypeData != ''){
             $result =  LngNotification::where('type',$type)->update(array('data_id' => $dataId, 'data_user_id' => $dataUserId , 'data_text' => $dataText , 'data_date' =>  $data_date,'nomination_date'=>$nDate));
		  }else{

		  	$result  = LngNotification::create([
		  			'title' => $title,
		  			'type'  => $type,
		  			'data_table' => $dataTable,
                    'data_id' =>$dataId,
                    'data_user_id' => $dataUserId,
                    'added_by'  => $addedBy,
                    'data_date' => $data_date,
                    'data_text' => $dataText,
                    'status' => '1',
                    'nomination_date'=>$nDate

		  	]);

		  }

		return $result;

	}

}

?>