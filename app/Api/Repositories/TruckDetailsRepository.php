<?php
namespace Energy\Api\Repositories;
use Carbon\Carbon;
use DB;
use Energy\Models\TruckDetails;
use Excel;
use File;
use Auth;




 class TruckDetailsRepository 
 {
     public function __construct(){

    }
   
 	
    public function getTruckDetailsList()
    {
        $list=TruckDetails::get();
        return $list;
    }

   
    
    
 }
?>
