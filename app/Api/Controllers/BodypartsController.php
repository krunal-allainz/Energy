<?php
namespace euro_hms\Api\Controllers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use euro_hms\Models\User;
use euro_hms\Models\Bodyparts;
use euro_hms\Api\Repositories\BodypartsRepository;
use DB;
use Carbon\Carbon;
 class BodypartsController extends Controller
{
    public function __construct(){
        $this->bodypObj = new BodypartsRepository();
    }
     /**
     * [getBodypartsList description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getBodypartsList(Request $request)
    {
        $userType = $request->userType;
        $userId = $request->userId ;
        $noOfPage = $request->noofRecord;
        
        $bodyparts_list=$this->bodypObj->getBodypartsList($userType,$noOfPage,$userId);
        if($bodyparts_list)
        {
            return ['code' => 200 ,'data'=>$bodyparts_list,'message'=>'Getting bodyparts type successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }
     /**
     * [createBodyparts description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createBodyparts(Request $request)
    {
        $add_Bodyparts=$this->bodypObj->create($request);
        if($add_Bodyparts)
        {
            return ['code' => 200 ,'data'=>$add_Bodyparts,'message'=>'Bodyparts successfully added.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
     /**
     * [getBodypartsDetailsById description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getBodypartsDetailsById(Request $request)
    {
        $id = $request->id;
        $bodyparts_details=$this->bodypObj->getBodypartsDetailsById($id);
        if($bodyparts_details)
        {
            return ['code' => 200 ,'data'=>$bodyparts_details,'message'=>'Bodyparts successfully displayed.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
     /**
     * [editBodyparts description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function editBodyparts(Request $request)
    {
        $edit_Bodyparts=$this->bodypObj->edit($request);
        if($edit_Bodyparts)
        {
            return ['code' => 200 ,'data'=>$edit_Bodyparts,'message'=>'Bodyparts successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
     /**
     * [deleteBodyparts description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteBodyparts(Request $request)
    {
        $id = $request->id;
        $delete_bodyparts=$this->bodypObj->delete($id);
        if($delete_bodyparts)
        {
            return ['code' => 200 ,'data'=>$delete_bodyparts,'message'=>'Bodyparts successfully deleted.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
    /**
    * [getBodypartsByRadiologyId description]
    * @param  Request $request [description]
    * @return [type]           [description]
    */
    public function getBodypartsByRadiologyId(Request $request)
    {
        $r_id = $request->r_id;
        $list_bodyparts=$this->bodypObj->getBodypartsByRadiologyId($r_id);
        if($list_bodyparts)
        {
            return ['code' => 200 ,'data'=>$list_bodyparts,'message'=>'Bodyparts successfully listed.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }    
}