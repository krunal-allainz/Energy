<?php
namespace Energy\Api\Repositories;

use Carbon\Carbon;
use DB;
use Energy\Models\Setting;


 class SettingRepository
 {
    public function __construct(){
       
    }


    /**
    * Get data field value 
    *
    * Author : Mital 
    **/

    public function getFieldValue($filedName,$filedType){
       
    	$result = '';

    	$result = Setting::select('data_field_value')->where('date_field_name',$filedName)->where('date_field_type',$filedType)->where('status','active')->first();

    	return $result->data_field_value;

    }
 }


?>