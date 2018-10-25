<?php namespace euro_hms\Api\Repositories;

use euro_hms\Models\User;
use euro_hms\Models\Role;
use DB;
use Hash;

class NotificationRepository {

	public function __construct(){

	}

	public function getTimelineData(){
		$result = Notification::select('title as title','type as type','data_table as dataTable','data_id as dataId','data_user_id as dataUserId','data_date as Datadate','data_text as text','status as status')->groupBy('type')->orderBy('created_at','desc')->get();

    	return $result;
	}

}

?>