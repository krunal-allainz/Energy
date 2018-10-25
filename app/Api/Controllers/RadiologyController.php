<?php

namespace euro_hms\Api\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use euro_hms\Models\User;
use euro_hms\Models\Radiology;
use euro_hms\Api\Repositories\RadiologyRepository;


use DB;
use Carbon\Carbon;

class RadiologyController extends Controller
{
    public function __construct(){
        $this->radioObj = new RadiologyRepository();
    }

    /**
     * [getRadiologyList description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getRadiologyList(Request $request)
    {
              
        $radiology_list=$this->radioObj->getRadiologyList();
        if($radiology_list)
        {
            return ['code' => 200 ,'data'=>$radiology_list,'message'=>'Getting case type successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }


}
