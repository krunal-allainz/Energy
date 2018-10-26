<?php 
namespace euro_hms\Api\Repositories;

use euro_hms\Models\User;
use euro_hms\Models\ScheduleRequest;
use DB;
use Hash;
use Carbon\Carbon;

class ScheduleRepository {

	public function __construct(){

	}

	public function updateSupplierQty(){

	$getScheduleData = ScheduleRequest::where('schedule_date' ,Carbon::yesterday())->get();
	
	   foreach($getScheduleData as $data){
	   	 $newSupplierQty = $data->supplied_quantity - 10;
	   	   ScheduleRequest::where('id',$data->id)->update(array('supplied_quantity' => $newSupplierQty));
	   }
	   return true;
	}

	

}

?>