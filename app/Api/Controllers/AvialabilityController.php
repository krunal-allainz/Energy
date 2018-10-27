<?php

namespace euro_hms\Api\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use euro_hms\Models\User;
use euro_hms\Models\Availability;
use euro_hms\Api\Repositories\AvailabilityRepository;
use DB;
use Carbon\Carbon;

class AvialabilityController extends Controller
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
        if($add_Availability)
        {
            return ['code' => 200 ,'data'=>$add_Availability,'message'=>'Availability successfully added.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    
    
}
