<?php
namespace euro_hms\Api\Repositories;
use Carbon\Carbon;
use DB;
use euro_hms\Models\Agreement;
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
        return $allowed->allowed_quantity;
    }
    
 }
?>
