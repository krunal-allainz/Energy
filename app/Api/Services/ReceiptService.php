<?php 
namespace euro_hms\Api\Services;

use euro_hms\Api\Repositories\ReceiptRepository;
use euro_hms\Api\Contracts\ReceiptContract;
use euro_hms\Models\Receipt;
use DB;


class ReceiptService implements ReceiptContract 
{
	public function __construct(){
		$this->receiptObj = new ReceiptRepository();
	}

	public function getReceiptList()
 	{
 		$this->receiptObj->getReceiptList();
 	}

 	public function deleteReceipt($id)
 	{
 		$this->receiptObj->deleteReceipt($id);
 	}

 	public function viewReceipt($id,$type)
 	{
 		$this->receiptObj->viewReceipt($id,$type);
 	}
}