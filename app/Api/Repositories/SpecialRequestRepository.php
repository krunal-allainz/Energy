<?php
namespace euro_hms\Api\Repositories;
use Carbon\Carbon;
use DB;
use euro_hms\Models\SpecialRequest;
use euro_hms\Models\RadiologyTable;
use Excel;
use File;

class SpecialRequestRepository 
{
   
 	/**
 	 * [getSpecialRequestList description]
 	 * @param  [type] $userType [description]
 	 * @param  [type] $noOfPage [description]
 	 * @param  [type] $userId   [description]
 	 * @return [type]           [description]
 	 */
    public function getSpecialRequestList($userType,$noOfPage,$userId)
    {
        $list= SpecialRequest::join('radiology', function ($join) {
                  $join->on('radiology.id', '=', 'special_request.radiology_id');
        })->select('special_request.id as special_id','special_request.name as special_name','radiology.name as radio_name')->orderBy('special_request.created_at','desc')->paginate($noOfPage);
        return $list;
    }

     /**
     * [create description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function create($request)
    {
    	$form_data=$request->specialRequestData;
    	$presp= new SpecialRequest;
    	$presp->radiology_id=$form_data['radiology_id'];
        $presp->name=$form_data['name'];
    	$presp->save();
    	return $presp->id;
    }
     /**
     * [getSpecialRequestDetailsById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getSpecialRequestDetailsById($id)
    {
        return SpecialRequest::where('id',$id)->first();
    }
     /**
     * [edit description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function edit($request)
    {
        $form_data=$request->specialRequestData;
        $id=$form_data['specialRequestId'];
        $presp= SpecialRequest::findOrFail($id);
        $presp->radiology_id=$form_data['radiology_id'];
        $presp->name=$form_data['name'];
        $presp->save();
        return $presp->id;
    }
     /**
     * [delete description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $presp_id = SpecialRequest::find( $id );
        $presp_id ->delete();
        return $id;
    }
    /**
     * [getSpecialRequestListOptions description]
     * @return [type] [description]
     */
    public function getSpecialRequestByRadiologyId($r_id)
    {
        return SpecialRequest::where('radiology_id',$r_id)->get();
    }


    /**
     * [getSpecialRequestNameById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getSpecialRequestNameById($id)
    {
        $special_req= SpecialRequest::where('id',$id)->first();
        return $special_req->name;
    }
 }
?>
