<?php
namespace euro_hms\Api\Repositories;
use Carbon\Carbon;
use DB;
use euro_hms\Models\BodyPartSide;
use Excel;
use File;
 class BodyPartSideRepository 

 {
   
 	/**
 	 * [getBodyPartSideList description]
 	 * @param  [type] $userType [description]
 	 * @param  [type] $noOfPage [description]
 	 * @param  [type] $userId   [description]
 	 * @return [type]           [description]
 	 */
    public function getBodyPartSideList()
    {
        $list= BodyPartSide::orderBy('bodypart_side.created_at','asc')->get();
        return $list;
    }
  
     /**
     * [getBodyPartSideDetailsById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getBodyPartSideDetailsById($id)
    {
        return BodyPartSide::where('id',$id)->first();
    }

     /**
     * [getBodyPartSideNameById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getBodyPartSideNameById($id)
    {
         $rad=BodyPartSide::where('id',$id)->first();
         return $rad->name;
    }
    
 }
?>

