<?php
namespace Energy\Api\Repositories;
use Carbon\Carbon;
use DB;
use Energy\Models\Availability;
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

        $date=Carbon::now()->addDays(1)->format('Y-m-d');
        $count=$this->getAvailabilityData($date);
        if($count>0)
        {
            $avail_id=array('availbility_id'=>'','code'=>301);
        }
        else
        {
            $avail= new Availability;
            $avail->date=$date;
            $avail->quantity=1000;
            $avail->save();
            $avail_id=array('availbility_id'=>$avail->id,'code'=>200);
        }
        return $avail_id;
       
    }

    /**
     * [getAvailabilityData description]
     * @param  [type] $date [description]
     * @return [type]       [description]
     */
    public function getAvailabilityData($date)
    {
        $availability=Availability::whereDate('date',$date)->get();
        return count($availability);
    }

    /**
     * [getAvailability description]
     * @param  [type] $date [description]
     * @return [type]       [description]
     */
    public function getAvailability($date)
    {
        $availability=Availability::whereDate('date',$date)->first();
        if($availability)
        {
             return $availability->quantity;
        }
        else
        {
             return 0;
        }
       
    }



    
 }
?>
