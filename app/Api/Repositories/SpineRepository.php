<?php
namespace euro_hms\Api\Repositories;
use Carbon\Carbon;
use DB;
use euro_hms\Models\Spine;
use Excel;
use File;



 class SpineRepository 
 {
   
 	/**
 	 * [getSpineList description]
 	 * @param  [type] $userType [description]
 	 * @param  [type] $noOfPage [description]
 	 * @param  [type] $userId   [description]
 	 * @return [type]           [description]
 	 */
    public function getSpineList()
    {
        $list= Spine::orderBy('spine.created_at','asc')->get();
        return $list;
    }

   

    /**
     * [getSpineDetailsById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getSpineDetailsById($id)
    {
        return Spine::where('id',$id)->first();
    }

    /**
     * [getSpineNameById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getSpineNameById($id)
    {
         $rad=Spine::where('id',$id)->first();
         return $rad->name;
    }
    
 }
?>
