<?php 
namespace Energy\Api\Repositories;

use Energy\Models\User;
use Energy\Models\Nomination;
use DB;
use Hash;
use Carbon\Carbon;
use Energy\Api\Repositories\UserRepository;

class ScheduleRepository {

	public function __construct(){
		$this->userObj = new UserRepository();
	}

	public function updateSupplierQty(){
		
		$getScheduleData = Nomination::whereDate('date' ,Carbon::yesterday()->format('Y-m-d'))->get();
		$res_array=array();
   		foreach($getScheduleData as $data){
   			if($data->supplied_quantity=="" || $data->supplied_quantity==NULL || $data->supplied_quantity==0 || $data->supplied_quantity==0.00)
   			{
   				$newSupplierQty = $data->approved_quantity - 10;
	   	  		Nomination::where('id',$data->id)->update(array('supplied_quantity' => $newSupplierQty));
	   	  		$res=array();
	   			$res['date']=$data->date;
	   			$res['buyer_name']=$this->userObj->getUserNameInfoById($data->buyer_id);
	   			$res['quantity_required']=$data->quantity_required;
	   			$res['approved_quantity']=$data->approved_quantity;
	   			$res['supplied_quantity']=$data->supplied_quantity;
	   			$res_array[]=$res;
   			}
   	 		
   		}
	   return $res_array;
	}

	

}

?>