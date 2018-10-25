<?php

namespace euro_hms\Api\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use euro_hms\Models\User;
use euro_hms\Models\SpecialRequest;
use euro_hms\Api\Repositories\SpecialRequestRepository;
use DB;
use Carbon\Carbon;

 class SpecialRequestController extends Controller
{
    public function __construct(){
        $this->bodypObj = new SpecialRequestRepository();
    }
     /**
     * [getSpecialRequestList description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getSpecialRequestList(Request $request)
    {
        $userType = $request->userType;
        $userId = $request->userId ;
        $noOfPage = $request->noofRecord;
        
        $specialRequest_list=$this->bodypObj->getSpecialRequestList($userType,$noOfPage,$userId);
        if($specialRequest_list)
        {
            return ['code' => 200 ,'data'=>$specialRequest_list,'message'=>'Getting specialRequest type successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }
     /**
     * [createSpecialRequest description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createSpecialRequest(Request $request)
    {
        $add_SpecialRequest=$this->bodypObj->create($request);
        if($add_SpecialRequest)
        {
            return ['code' => 200 ,'data'=>$add_SpecialRequest,'message'=>'Special Request successfully added.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

     /**
     * [getSpecialRequestDetailsById description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getSpecialRequestDetailsById(Request $request)
    {
        $id = $request->id;
        $specialRequest_details=$this->bodypObj->getSpecialRequestDetailsById($id);
        if($specialRequest_details)
        {
            return ['code' => 200 ,'data'=>$specialRequest_details,'message'=>'Special Request successfully displayed.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
     /**
     * [editSpecialRequest description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function editSpecialRequest(Request $request)
    {
        $edit_SpecialRequest=$this->bodypObj->edit($request);
        if($edit_SpecialRequest)
        {
            return ['code' => 200 ,'data'=>$edit_SpecialRequest,'message'=>'Special Request successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
    /**
     * [deleteSpecialRequest description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteSpecialRequest(Request $request)
    {
        $id = $request->id;
        $delete_specialRequest=$this->bodypObj->delete($id);
        if($delete_specialRequest)
        {
            return ['code' => 200 ,'data'=>$delete_specialRequest,'message'=>'Special Request successfully deleted.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
    /**
     * [getSpecialRequestByRadiologyId description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getSpecialRequestByRadiologyId(Request $request)
    {
        $r_id = $request->r_id;
        $list_specialRequest=$this->bodypObj->getSpecialRequestByRadiologyId($r_id);
        if($list_specialRequest)
        {
            return ['code' => 200 ,'data'=>$list_specialRequest,'message'=>'Special Request successfully listed.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
}

