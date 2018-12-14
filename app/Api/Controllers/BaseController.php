<?php

namespace Energy\Api\Controllers;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Energy\Api\Repositories\SettingRepository;

class BaseController extends Controller
{
    use Helpers;

      public function __construct(){
        $this->confObj = new SettingRepository(); 
    }
   

    /**
    *
    *
    **/

    public function getAvailabelQty(Request $request){
    	
    	$filedName = $request->data['fieldName'];
    	$filedType = $request->data['fieldType'];
    	 $availabelLimit  = '';
        $availabelLimit = $this->confObj->getFieldValue($filedName,$filedType);
        
         if($availabelLimit)
        {
            return ['code' => 200 ,'data'=>$availabelLimit,'message'=>'Getting data successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }

    }

}
