<?php 
namespace Energy\Api\Services;

use Energy\Api\Repositories\ReceiptRepository;
use Energy\Api\Contracts\ReceiptContract;
use Energy\Models\Receipt;
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