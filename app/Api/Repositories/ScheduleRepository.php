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
		$id_array=array();
   		foreach($getScheduleData as $data){
   			if($data->supplied_quantity=="" || $data->supplied_quantity==NULL || $data->supplied_quantity==0 || $data->supplied_quantity==0.00)
   			{
   				if($data->approved_quantity!="" || $data->approved_quantity!=NULL || $data->approved_quantity!=0 || $data->approved_quantity!=0.00)
   				{
   					$newSupplierQty = $data->approved_quantity - 10;
		   	  		Nomination::where('id',$data->id)->update(array('supplied_quantity' => $newSupplierQty));
		   	  		$id_array[]=$data->id;
   				}
   				else
   				{
   					return array('result'=>'','code'=>302);
   				}
   			}
   		}
   		if(count($id_array)>0)
   		{
   			foreach($id_array as $id)
   			{
   				$nom_data = Nomination::where('id' ,$id)->first();
   				$res=array();
	   			$res['date']=$nom_data->date;
	   			$res['buyer_name']=$this->userObj->getUserNameInfoById($nom_data->buyer_id);
	   			$res['quantity_required']=$nom_data->quantity_required;
	   			$res['approved_quantity']=$nom_data->approved_quantity;
	   			$res['supplied_quantity']=$nom_data->supplied_quantity;
	   			$res_array[]=$res;
   			}
   			
   			return array('result'=>$res_array,'code'=>200);
   		}
   		else if(count($getScheduleData)==0)
   		{
   			return array('result'=>'','code'=>300);
   		}
   		else
   		{
   			return array('result'=>'','code'=>301);
   		}
   		
	}

	

}

?>