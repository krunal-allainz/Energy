<?php
  namespace Energy\Api\Repositories;

 use Carbon\Carbon;
 use DB;
 use Energy\Models\UserTypes;



 class UserTypesRepository
 {

 	 public function getUserType()
    {
        $data = DB::table('user_types')->get();
        return $data;
    }

 }


 ?>