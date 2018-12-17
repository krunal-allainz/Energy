<?php

namespace Energy\Api\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Energy\Models\User;
use Energy\Models\NominationLng;
use Energy\Api\Repositories\NominationLngRepository;
use DB;
use Carbon\Carbon;

class NominationLngController extends Controller
{
    public function __construct(){
        $this->nomLngObj = new NominationLngRepository();
    }
    

    /**
     * [getNominationLngList description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getNominationLngList(Request $request)
    { 
        
        $userType = $request->userType;
        $userId = $request->userId ;
        $noOfPage = $request->noofRecord;
        $selected_date=$request->selectedDate;
        $date =Carbon::createFromFormat('d-m-Y',$selected_date)->format('Y-m-d');

        $nomination_lng_list=$this->nomLngObj->getNominationLngList($userType,$noOfPage,$userId,$date);
        if($nomination_lng_list)
        {
            return ['code' => 200 ,'data'=>$nomination_lng_list,'message'=>'Getting list successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }

    public function getSuppliedLngList(Request $request)
    { 
        
        $userType = $request->userType;
        $userId = $request->userId ;
        $noOfPage = $request->noofRecord;
        $selected_date=$request->selectedDate;
        $date =Carbon::createFromFormat('d-m-Y',$selected_date)->format('Y-m-d');

        $supplied_lng_list=$this->nomLngObj->getSuppliedLngList($userType,$noOfPage,$userId,$date);
        if($supplied_lng_list)
        {
            return ['code' => 200 ,'data'=>$supplied_lng_list,'message'=>'Getting list successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }

    public function saveTruckLoading(Request $request)
    {
        $truck_loading=$this->nomLngObj->saveTruckLoading($request->all()['data']);
        if($truck_loading)
        {
            return ['code'=> 200 ,'data'=>$truck_loading,'message'=>'Something went wrong'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
    /**
     * [createNominationLng description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createNominationLng(Request $request)
    {
        $add_lng=$this->nomLngObj->createNominationLng($request);
        if($add_lng)
        {
            return $add_lng;
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [editNominationLng description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function editNominationLng(Request $request)
    {
        $edit_lng=$this->nomLngObj->editNominationLng($request);
        if($edit_lng)
        {
            return $edit_lng;
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [getNominationLngDetailsById description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getNominationLngDetailsById(Request $request)
    {
        $id=$request->id;
        $nomination_lng_details=$this->nomLngObj->getNominationLngDetailsById($id);
        if($nomination_lng_details)
        {
            return ['code' => 200 ,'data'=>$nomination_lng_details,'message'=>'Getting details successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [deleteNominationLngById description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteNominationLngById(Request $request)
    {
        $id=$request->id;
        $delete=$this->nomLngObj->deleteNominationLngById($id);
        if($delete)
        {
            return ['code' => 200 ,'data'=>$delete,'message'=>'Nomination LNG deleted successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
    *  Approve Qty For truck Load
    *  Description : approve valide qty for truck load
    *
    *  Auth : Mital Sharma
    **/

    public function approveNominationLngById(Request $request){

        $data = $request->data['data'];

        $approve=$this->nomLngObj->approveNominationLngById($data);
        if($approve == 1)
        {
            return ['code' => 200 ,'data'=>$approve,'message'=>'Nomination LNG approved successfully.'];
        }else if($approve == 0){
             return ['code' => 250 ,'data'=>'','message'=>'Total approve quantity must be less then total availabel quantity .'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }

    }

     /**
    *  Reject Qty For truck Load
    *  Description : reject valide qty for truck load
    *
    *  Auth : Mital Sharma
    **/
    public function rejectNominationLngById(Request $request){

        $data = $request->data['data'];
        $rid = $request->data['rid'];

        $approve=$this->nomLngObj->rejectNominationLngById($data,$rid);
        if($approve == 1)
        {
            return ['code' => 200 ,'data'=>$approve,'message'=>'Nomination LNG reject successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
    /**
     * [getDisabledDates description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getDisabledDates(Request $request)
    {
      $data = $request->input('data');
      $lngData = $this->nomLngObj->getDisabledDates($data);
      return $lngData;
    }
     public function getLngBuyerRequestList(Request $request){

        // write code for get buyer list
        $buyerId = $request->buyerId;
        $requestType = $request->requestType;
        $typeInclude = $request->typeInclude;
        
        $get_details=$this->nomLngObj->getLngBuyerRequestList($buyerId,$requestType,$typeInclude); 
        if($get_details)
        {
            return ['code' => 200 ,'data'=>$get_details,'message'=>'Nomination list successfully get.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }

        return true;
     }
    public function getNominationLngTotals(Request $request)
    {
        $data = $request->all();
        $lngData = $this->nomLngObj->getNominationLngTotals($data);

        if($lngData)
        {
            return ['code' => 200 ,'data'=>$lngData,'message'=>'Nomination LNG reject successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }   
}
