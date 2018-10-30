<?php

namespace Energy\Api\Controllers;


use Illuminate\Routing\Controller;
use Energy\Models\NominationRequest;
use Illuminate\Http\Request;
use Energy\Models\User;
use Energy\Models\Nomination;
use Energy\Api\Repositories\NominationRepository;
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
        if($edit_Nomination['code']==200)
        {
            return ['code' => 200 ,'data'=>$edit_Nomination,'message'=>'Nomination successfully edited.'];
        }
        else if($edit_Nomination['code']==301)
        {
            return ['code' => 301 ,'data'=>$edit_Nomination,'message'=>'Quantity is higher.'];
        }
        else if($edit_Nomination['code']==302)
        {
            return ['code' => 302 ,'data'=>$edit_Nomination,'message'=>'Approved quantity limit exceed.'];
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

    /**
     * [getNominationDetailsByDate description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
     public function getNominationDetailsByDate(Request $request)
    {
       
        $date = $request->date;
        $get_details=$this->nomObj->getNominationDetailsByDate($date);
        if($get_details)
        {
            return ['code' => 200 ,'data'=>$get_details,'message'=>'Nomination successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }


    public function getBuyerRequestList(){

        // write code for get buyer list
        return true;
     }


     /**
      * [getTotalRequestedQuantityForSeller description]
      * @param  Request $request [description]
      * @return [type]           [description]
      */
    public function getTotalRequestedQuantityForSeller(Request $request)
    {
        $selected_date=$request->selected_date;
        $date =Carbon::createFromFormat('d-m-Y',$selected_date )->format('Y-m-d'); 
        $get_details=$this->nomObj->getTotalRequestedQuantityForSeller($date);
        if($get_details)
        {
            return ['code' => 200 ,'data'=>$get_details,'message'=>'Nomination successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [getTotalApprovedQuantity description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getTotalApprovedQuantity(Request $request)
    {
        $selected_date=$request->selected_date;
        $date =Carbon::createFromFormat('d-m-Y',$selected_date )->format('Y-m-d'); 
        $get_details=$this->nomObj->getTotalApprovedQuantity($date);
        if($get_details)
        {
            return ['code' => 200 ,'data'=>$get_details,'message'=>'Nomination successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [getTotalSuppliedQuantity description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getTotalSuppliedQuantity(Request $request)
    {
         $selected_date=$request->selected_date;
        $date =Carbon::createFromFormat('d-m-Y',$selected_date )->format('Y-m-d'); 
        $get_details=$this->nomObj->getTotalSuppliedQuantity($date);
        if($get_details)
        {
            return ['code' => 200 ,'data'=>$get_details,'message'=>'Nomination successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [getTotalRequestedQuantity description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getTotalRequestedQuantity(Request $request)
    {
        $selected_date=$request->selected_date;
        $date =Carbon::createFromFormat('d-m-Y',$selected_date )->format('Y-m-d'); 
        $userId = $request->userId;
        $get_details=$this->nomObj->getTotalRequestedQuantity($userId,$date);
        if($get_details)
        {
            return ['code' => 200 ,'data'=>$get_details,'message'=>'Nomination successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [getTotalApprovedQuantityByBuyer description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
     public function getTotalApprovedQuantityByBuyer(Request $request)
    {
        $selected_date=$request->selected_date;
        $date =Carbon::createFromFormat('d-m-Y',$selected_date )->format('Y-m-d'); 
        $userId = $request->userId;
        $get_details=$this->nomObj->getTotalApprovedQuantityByBuyer($userId,$date);
        if($get_details)
        {
            return ['code' => 200 ,'data'=>$get_details,'message'=>'Nomination successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

     /**
     * [getTotalSuppliedQuantityByBuyer description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getTotalSuppliedQuantityByBuyer(Request $request)
    {
        $selected_date=$request->selected_date;
        $date =Carbon::createFromFormat('d-m-Y',$selected_date )->format('Y-m-d'); 
        $userId = $request->userId;
        $get_details=$this->nomObj->getTotalSuppliedQuantityByBuyer($userId,$date);
        if($get_details)
        {
            return ['code' => 200 ,'data'=>$get_details,'message'=>'Nomination successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [getNominationCountForBuyer description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getNominationCountForBuyer(Request $request)
    {
        $date=Carbon::now()->addDays(1)->format('Y-m-d');
        $userId = $request->userId;
        $get_details=$this->nomObj->getNominationCountForBuyer($userId,$date);
        if($get_details)
        {
            return ['code' => 200 ,'data'=>$get_details,'message'=>'Nomination successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
    
    /**
     * [getNominationDetailsByDateById description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getNominationDetailsByDateById(Request $request){


        $date = $request->date;
        $buyerId = $request->buyerId;
        $get_details=$this->nomObj->getNominationDetailsByDateById($date,$buyerId);
        if($get_details)
        {
            return ['code' => 200 ,'data'=>$get_details,'message'=>'Nomination successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

   
}
