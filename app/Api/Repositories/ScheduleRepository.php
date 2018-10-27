<?php 
namespace Energy\Api\Repositories;

use Energy\Models\User;
use Energy\Models\Nomination;
use DB;
use Hash;
use Carbon\Carbon;

class ScheduleRepository {

	public function __construct(){

	}

	public function updateSupplierQty(){
		
	$getScheduleData = Nomination::whereDate('date' ,Carbon::yesterday()->format('Y-m-d'))->get();
	   foreach($getScheduleData as $data){
	   	 $newSupplierQty = $data->approved_quantity - 10;
	   	  Nomination::where('id',$data->id)->update(array('supplied_quantity' => $newSupplierQty));
	   }
	   return true;
	}

	

}

?>