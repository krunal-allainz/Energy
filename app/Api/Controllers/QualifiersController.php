<?php

namespace euro_hms\Api\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use euro_hms\Models\User;
use euro_hms\Models\Bodyparts;
use euro_hms\Models\Qualifiers;
use euro_hms\Api\Repositories\QualifiersRepository;
use DB;
use Carbon\Carbon;

class QualifiersController extends Controller
{
    public function __construct(){
        $this->qualObj = new QualifiersRepository();
    }

    /**
     * [getQualifiersList description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getQualifiersList(Request $request)
    {
        $userType = $request->userType;
        $userId = $request->userId ;
        $noOfPage = $request->noofRecord;
        
        $qualifiers_list=$this->qualObj->getQualifiersList($userType,$noOfPage,$userId);
        if($qualifiers_list)
        {
            return ['code' => 200 ,'data'=>$qualifiers_list,'message'=>'Getting case type successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }

    /**
     * [createQualifiers description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createQualifiers(Request $request)
    {
        $add_Qualifiers=$this->qualObj->create($request);
        if($add_Qualifiers)
        {
            return ['code' => 200 ,'data'=>$add_Qualifiers,'message'=>'Qualifiers successfully added.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [getQualifiersDetailsById description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getQualifiersDetailsById(Request $request)
    {
        $id = $request->id;
        $qualifiers_details=$this->qualObj->getQualifiersDetailsById($id);
        if($qualifiers_details)
        {
            return ['code' => 200 ,'data'=>$qualifiers_details,'message'=>'Qualifiers successfully added.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [editQualifiers description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function editQualifiers(Request $request)
    {
        $edit_Qualifiers=$this->qualObj->edit($request);
        if($edit_Qualifiers)
        {
            return ['code' => 200 ,'data'=>$edit_Qualifiers,'message'=>'Qualifiers successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [deleteQualifiers description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteQualifiers(Request $request)
    {
        $id = $request->id;
        $delete_qualifiers=$this->qualObj->delete($id);
        if($delete_qualifiers)
        {
            return ['code' => 200 ,'data'=>$delete_qualifiers,'message'=>'Qualifiers successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [getQualifierByBodypartsId description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getQualifierByBodypartsId(Request $request)
    {
        $b_id = $request->b_id;
        $qualifier_list=$this->qualObj->getQualifierByBodypartsId($b_id);
        if($qualifier_list)
        {
            return ['code' => 200 ,'data'=>$qualifier_list,'message'=>'Qualifiers successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
}
