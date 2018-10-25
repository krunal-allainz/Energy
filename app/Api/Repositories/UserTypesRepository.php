<?php
  namespace euro_hms\Api\Repositories;

 use Carbon\Carbon;
 use DB;
 use euro_hms\Models\UserTypes;



 class UserTypesRepository
 {

 	 public function getUserType()
    {
        $data = DB::table('user_types')->get();
        return $data;
    }

 }


 ?>