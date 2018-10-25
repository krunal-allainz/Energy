<?php
namespace euro_hms\Api\Repositories;
use Carbon\Carbon;
use DB;
use euro_hms\Models\RadiologyTable;
use Excel;
use File;

class RadiologyRepository 
{
   
 	/**
 	 * [getRadiologyList description]
 	 * @param  [type] $userType [description]
 	 * @param  [type] $noOfPage [description]
 	 * @param  [type] $userId   [description]
 	 * @return [type]           [description]
 	 */
    public function getRadiologyList()
    {
        $list= RadiologyTable::orderBy('radiology.created_at','asc')->get();
        return $list;
    }
     /**
     * [getRadiologyDetailsById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getRadiologyDetailsById($id)
    {
        return RadiologyTable::where('id',$id)->first();
    }

     /**
     * [getRadiologyNameById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getRadiologyNameById($id)
    {
         $rad=RadiologyTable::where('id',$id)->first();
         return $rad->name;
    }
    
 }
?>
