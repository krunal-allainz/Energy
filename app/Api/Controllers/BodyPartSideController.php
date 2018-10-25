<?php

namespace euro_hms\Api\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use euro_hms\Models\User;
use euro_hms\Models\BodyPartSide;
use euro_hms\Api\Repositories\BodyPartSideRepository;
use DB;
use Carbon\Carbon;

class BodyPartSideController extends Controller
{
    public function __construct(){
        $this->bpsObj = new BodyPartSideRepository();
    }

     /**
     * [getBodyPartSideList description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getBodyPartSideList(Request $request)
    {
              
        $bodyPartSide_list=$this->bpsObj->getBodyPartSideList();
        if($bodyPartSide_list)
        {
            return ['code' => 200 ,'data'=>$bodyPartSide_list,'message'=>'Getting case type successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }

 }
