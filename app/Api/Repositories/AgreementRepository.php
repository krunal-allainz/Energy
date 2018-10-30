<?php
namespace Energy\Api\Repositories;
use Carbon\Carbon;
use DB;
use Energy\Models\Agreement;
use Excel;
use File;



 class AgreementRepository 
 {
    /**
     * [getAllowedQuantityByBuyerId description]
     * @param  [type] $buyer_id [description]
     * @return [type]           [description]
     */
    public function getAllowedQuantityByBuyerId($buyer_id)
    {
        $allowed=Agreement::where('buyer_id',$buyer_id)->first();
        if($allowed)
        {
            return $allowed->allowed_quantity;
        }
        else
        {
            return 0;
        }
       
    }


    public function getAgreementData($buyer_id){
         return Agreement::where('buyer_id',$buyer_id)->first();
    }
    
 }
?>
