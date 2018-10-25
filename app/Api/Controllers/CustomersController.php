<?php

namespace euro_hms\Api\Controllers;

use Illuminate\Http\Request;
use euro_hms\Http\Controllers\Controller;
use euro_hms\Custom\Helper\Common;

class CustomersController extends Controller
{
    //
    public function __construct()
    {
    }
    
    /**
	* Function For Get Image From Url
	*
    */

     public function getImagefromUrl(Request $request){
        $url = $request->url;
        $image = common::getImagefromUrl($url);

        if ($image['status'] == 200) {
            return response()->json(['status' => 200,'message' => $image['msg'],
               'data' =>$image['imagePath']]);
        }else if( $image['status'] = 201){
               return response()->json(['status' => 200,'message' => $image['msg'],
               'data' =>'']);
        } else {
              return response()->json([
                'status' => 300,
                'message' => 'Something goes wrong',
                'data' =>''
            ]
        );
        }

    }
}
