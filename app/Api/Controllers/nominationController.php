<?php

namespace euro_hms\Api\Controllers;


use Illuminate\Routing\Controller;
use euro_hms\Models\NominationRequest;
use Illuminate\Http\Request;
use euro_hms\Models\User;
use euro_hms\Models\Nomination;
use euro_hms\Api\Repositories\NominationRepository;
use DB;
use Carbon\Carbon;

class NominationController extends Controller
{
    public function __construct(){
        $this->nomObj = new NominationRepository();

      //  $this->notificationOBJ = new NotificationRepository();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * [getNominationList description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getNominationList(Request $request)
    {
        $userType = $request->userType;
        $userId = $request->userId ;
        $noOfPage = $request->noofRecord;
        
        $nomination_list=$this->nomObj->getNominationList($userType,$noOfPage,$userId);
        if($nomination_list)
        {
            return ['code' => 200 ,'data'=>$nomination_list,'message'=>'Getting case type successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }

    /**
     * [createNomination description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createNomination(Request $request)
    {
        $add_Nomination=$this->nomObj->create($request);
        if($add_Nomination)
        {
            return ['code' => 200 ,'data'=>$add_Nomination,'message'=>'Nomination successfully added.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [getNominationDetailsById description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getNominationDetailsById(Request $request)
    {
        $id = $request->id;
        $nomination_details=$this->nomObj->getNominationDetailsById($id);
        if($nomination_details)
        {
            return ['code' => 200 ,'data'=>$nomination_details,'message'=>'Nomination successfully added.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [editNomination description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function editNomination(Request $request)
    {
        $edit_Nomination=$this->nomObj->edit($request);
        if($edit_Nomination)
        {
            return ['code' => 200 ,'data'=>$edit_Nomination,'message'=>'Nomination successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [deleteNomination description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deleteNomination(Request $request)
    {
        $id = $request->id;
        $delete_nomination=$this->nomObj->delete($id);
        if($delete_nomination)
        {
            return ['code' => 200 ,'data'=>$delete_nomination,'message'=>'Nomination successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
    
}
