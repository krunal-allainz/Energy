<?php
namespace euro_hms\Api\Repositories;
use Carbon\Carbon;
use DB;
use euro_hms\Models\Nomination;
use Excel;
use File;
use euro_hms\Api\Repositories\AgreementRepository;



 class NominationRepository 
 {
     public function __construct(){
        $this->agmtObj = new AgreementRepository();
    }
   
 	/**
 	 * [getNominationList description]
 	 * @param  [type] $userType [description]
 	 * @param  [type] $noOfPage [description]
 	 * @param  [type] $userId   [description]
 	 * @return [type]           [description]
 	 */
    public function getNominationList($userType,$noOfPage,$userId)
    {
        if($userType==6)
        {
             $list= Nomination::where('nomination_request.buyer_id',$userId)->select('nomination_request.*','nomination_request.id as nId')->orderBy('nomination_request.created_at','desc')->paginate($noOfPage);

        }
        else if($userType==7)
        {
             $list= Nomination::join('users', function ($join) {
                $join->on('users.id', '=', 'nomination_request.buyer_id');
            })->select('nomination_request.*','nomination_request.id as nId','users.first_name as buyer_name')->groupBy('nomination_request.id')->orderBy('nomination_request.created_at','desc')->paginate($noOfPage);
        }
        
        return $list;
    }

    /**
     * [create description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function create($request)
    {
    	$form_data=$request->nominationData;
        //$check_duplicate=$this->check_duplicate('ADD',0,$form_data['buyer_id'],$form_data['seller_id']);
        //if($check_duplicate=='yes')
        //{
            //$nom_id=array('nomination_id'=>0,'code'=>301);
        //}
        //else
        //{
            $nom= new Nomination;
            $nom->buyer_id=$form_data['buyer_id'];
            //$nom->seller_id=$form_data['seller_id'];
            $nom->date=$form_data['date']['time'];
            $nom->quantity_required=$form_data['quantity'];
            $nom->status=1;
            $nom->request='Pending';
            $nom->save();
            $nom_id=array('nomination_id'=>$nom->id,'code'=>200);
        //}
        return $nom_id;
    }

    /**
     * [getNominationDetailsById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getNominationDetailsById($id)
    {
        return Nomination::where('id',$id)->first();
    }

    /**
     * [edit description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function edit($request)
    {
        $form_data=$request->nominationData;
        $id=$form_data['nominationId'];
        //$check_duplicate=$this->check_duplicate('EDIT',$id,$form_data['name'],$form_data['type']);
        //if($check_duplicate=='yes')
       // {
            //$lab_id=array('nomination_id'=>0,'code'=>301);
        //}
        //else
        //{
            $get_buyer=$this->getNominationDetailsById($id);
            $check_quantity=$this->check_quantity($form_data['approved_quantity'],$get_buyer->buyer_id);
            if($check_quantity=='yes')
            {
                $nom_id=array('nomination_id'=>'','code'=>301);
            }
            else
            {
                $nom= Nomination::findOrFail($id);
                $nom->date=$form_data['date']['time'];
                $nom->quantity_required=$form_data['quantity'];
                $nom->approved_quantity=$form_data['approved_quantity'];
                $nom->status=1;
                $nom->request=$form_data['request'];
                $nom->save();
                $nom_id=array('nomination_id'=>$nom->id,'code'=>200);

            }
           
        //}
       
        return  $nom_id;
    }

    public function check_quantity($approved_quantity,$buyer_id)
    {
        $allowed_quantity=$this->agmtObj->getAllowedQuantityByBuyerId($buyer_id);
        $total_quantity=($allowed_quantity*120)/100;
        if($approved_quantity>$total_quantity)
        {
            return 'yes';
        }
        else
        {
            return 'no';
        }
        return 'no';
    }

    /**
     * [check_duplicate description]
     * @param  [type] $page_name [description]
     * @param  [type] $id        [description]
     * @param  [type] $name      [description]
     * @param  [type] $type      [description]
     * @return [type]            [description]
     */
    public function check_duplicate($page_name,$id,$name,$type)
    {
        if($page_name=='ADD')
        {
            $get_nomination=Nomination::whereRaw('LOWER(name)  = ?', $name)->whereRaw('LOWER(type)  = ?', $type)->get();
            if(count($get_nomination)>0)
            {
                return 'yes';
            }
            else
            {
                 return 'no';
            }
        }
        else if($page_name=='EDIT')
        {
            $get_nomination=Nomination::whereRaw('LOWER(name) = ?', $name)->whereRaw('LOWER(type)  = ?', $type)->whereRaw('id != ?',$id)->get();
            if(count($get_nomination)>0)
            {
                return 'yes';
            }
            else
            {
                 return 'no';
            }
        }
        return 'no';
    }

    /**
     * [delete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $presp_id = Nomination::find( $id );
        $presp_id ->delete();
        return $id;
    }
    
 }
?>
