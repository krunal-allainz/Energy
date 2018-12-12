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
        $date =Carbon::createFromFormat('d-m-Y',$selected_date )->format('Y-m-d');

        $nomination_lng_list=$this->nomLngObj->getNominationLngList($userType,$noOfPage,$userId,$date);
        if($nomination_lng_list)
        {
            return ['code' => 200 ,'data'=>$nomination_lng_list,'message'=>'Getting case type successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }


   
}
