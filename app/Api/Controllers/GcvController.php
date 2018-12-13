<?php

namespace Energy\Api\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Energy\Models\AvailabilityGcv;
use DB;
use Carbon\Carbon;

class GcvController extends Controller
{
    public function __construct(){
      
      //  $this->notificationOBJ = new NotificationRepository();
    }

    /**
     * [createAvailability description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function addGcv(Request $request)
    {
        // dd();
        $curDate = Carbon::createFromFormat('d-m-Y', $request->all()['curDate']);
       $GcvRec = AvailabilityGcv::where('gcv_date',date('Y-m-d', strtotime($request->all()['curDate'] )))->count();
       if($GcvRec > 0){

        AvailabilityGcv::create([
            'gcv_quantity'=>$request->all()['gcvQuantity'],
            'gcv_date' => $request->all()['curDate']
        ]);
         return ['code' => 200 ,'data'=>'','message'=>'GCV successfully added.'];
       } else {
            return ['code' => 200 ,'data'=>'','message'=>'GCV already added.'];
       }
   }

    public function isGcvAdded(Request $request)
    {
               $GcvRec = AvailabilityGcv::where('gcv_date',date('Y-m-d', strtotime($request->all()['curDate'] )))->count();
               if($GcvRec == 0){
                 return ['code' => 200 ,'data'=>'','message'=>''];
               } else {
                    return ['code' => 300 ,'data'=>'','message'=>'GCV already added.'];
               }
    }
    
}
