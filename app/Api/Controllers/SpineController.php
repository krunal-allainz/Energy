<?php

namespace euro_hms\Api\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use euro_hms\Models\User;
use euro_hms\Models\Spine;
use euro_hms\Api\Repositories\SpineRepository;


use DB;
use Carbon\Carbon;

class SpineController extends Controller
{
    public function __construct(){
        $this->spineObj = new SpineRepository();
    }

    /**
     * [getSpineList description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getSpineList(Request $request)
    {
              
        $spine_list=$this->spineObj->getSpineList();
        if($spine_list)
        {
            return ['code' => 200 ,'data'=>$spine_list,'message'=>'Getting spine list successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }


}
