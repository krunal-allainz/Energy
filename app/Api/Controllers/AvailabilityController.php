<?php

namespace Energy\Api\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Energy\Models\User;
use Energy\Models\Availability;
use Energy\Api\Repositories\AvailabilityRepository;
use DB;
use Carbon\Carbon;

class AvailabilityController extends Controller
{
    public function __construct(){
        $this->avlObj = new AvailabilityRepository();

      //  $this->notificationOBJ = new NotificationRepository();
    }

    /**
     * [createAvailability description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createAvailability()
    {
        
        $add_Availability=$this->avlObj->create();
        if($add_Availability['code']==200)
        {
            return ['code' => 200 ,'data'=>$add_Availability,'message'=>'Availability successfully added.'];
        }
        if($add_Availability['code']==301)
        {
            return ['code' => 301 ,'data'=>$add_Availability,'message'=>'Availability added already.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    public function getAvailability(Request $request)
    {
        $selected_date=$request->selected_date;
        $date =Carbon::createFromFormat('d-m-Y',$selected_date )->format('Y-m-d'); 
        $get_Availability=$this->avlObj->getAvailability($date);
        if($get_Availability)
        {
            return ['code' => 200 ,'data'=>$get_Availability,'message'=>'Availability successfully added.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    
    
}
