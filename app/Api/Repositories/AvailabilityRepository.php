<?php
namespace euro_hms\Api\Repositories;
use Carbon\Carbon;
use DB;
use euro_hms\Models\Availability;
use Excel;
use File;
use Auth;

 class AvailabilityRepository 
 {
     

    /**
     * [create description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function create()
    {

        $avail= new Availability;
        $date=Carbon::now()->addDays(1)->format('Y-m-d');
        $avail->date=$date;
        $avail->quantity=1000;
        $avail->save();
        $avail_id=array('availbility_id'=>$avail->id,'code'=>200);

        return $avail_id;
    }

    /**
     * [getAvailability description]
     * @param  [type] $date [description]
     * @return [type]       [description]
     */
    public function getAvailability($date)
    {
        $availability=Availability::whereDate('date',$date)->first();
        return $availability->quantity;
    }



    
 }
?>
