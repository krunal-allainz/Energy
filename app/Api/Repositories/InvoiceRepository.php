<?php
namespace euro_hms\Api\Repositories;
use Carbon\Carbon;
use DB;
use euro_hms\Models\Invoice;
use euro_hms\Api\Repositories\UserRepository;
use euro_hms\Api\Repositories\NominationRepository;
use Excel;
use File;



 class InvoiceRepository 
 {
    public function __construct(){
        $this->userObj = new UserRepository();
        $this->nominationRepoObj = new NominationRepository();
    }

 	/**
     * [getInvoiceList1 description]
     * @return [type] [description]
     */
    public function getInvoiceList1($userId)
    {
        $list= Invoice::where('buyer_id',$userId)->where('status',1)->get();
        $result_array=array();
        $total=0;
        foreach($list as $inv)
        {
            $res_arr=array();
            $res_arr['date']=$inv->date;
            $res_arr['buyer_name']=$this->userObj->getUserNameInfoById($inv->buyer_id);
            $res_arr['seller_name']=$this->userObj->getUserNameInfoById($inv->seller_id);
            $res_arr['supplied_quantity']=$inv->supplied_quantity;
            $res_arr['rate']=$inv->rate;
            $res_arr['tax']=$inv->tax;
            $res_arr['total_amount']=$inv->total_amount;
            $total=$total+$inv->total_amount;
            $result_array['inv_arr'][]=$res_arr;
        }
        $result_array['sub_total'] =$total;
        $result_array['rate'] =5;
        $result_array['total_all']=$total-$result_array['rate'];
        return $result_array;
    }

    /**
     * [getInvoiceList2 description]
     * @return [type] [description]
     */
    public function getInvoiceList2($userId)
    {
        $list= Invoice::where('buyer_id',$userId)->where('status',2)->get();
        $result_array=array();
        $total=0;
        foreach($list as $inv)
        {
            $res_arr=array();
            $res_arr['date']=$inv->date;
            $res_arr['buyer_name']=$this->userObj->getUserNameInfoById($inv->buyer_id);
            $res_arr['seller_name']=$this->userObj->getUserNameInfoById($inv->seller_id);
            $res_arr['supplied_quantity']=$inv->supplied_quantity;
            $res_arr['rate']=$inv->rate;
            $res_arr['tax']=$inv->tax;
            $res_arr['total_amount']=$inv->total_amount;
            $total=$total+$inv->total_amount;
            $result_array['inv_arr'][]=$res_arr;
        }
        $result_array['sub_total'] =$total;
        $result_array['rate'] =5;
        $result_array['total_all']=$total-$result_array['rate'];
        return $result_array;
    }

    public function generateInvoice(){

        $nominationList = $this->nominationRepoObj->getNominationRequestList();
        dd($nominationList);
        foreach($nominationList as $nomination){
            
        }
    }

    
 }
?>
