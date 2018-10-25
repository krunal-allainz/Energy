<?php
namespace euro_hms\Api\Repositories;
use Carbon\Carbon;
use DB;
use euro_hms\Models\Bodyparts;
use euro_hms\Models\RadiologyTable;
use Excel;
use File;
 class BodypartsRepository 
 {
   
    /**
     * [getBodypartsList description]
     * @param  [type] $userType [description]
     * @param  [type] $noOfPage [description]
     * @param  [type] $userId   [description]
     * @return [type]           [description]
     */
    public function getBodypartsList($userType,$noOfPage,$userId)
    {
        $list= Bodyparts::join('radiology', function ($join) {
                  $join->on('radiology.id', '=', 'bodyparts.radiology_id');
        })->select('bodyparts.id as bodypart_id','bodyparts.name as bodypart_name','radiology.name as radio_name')->orderBy('bodyparts.created_at','desc')->paginate($noOfPage);
        return $list;
    }
    /**
     * [create description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function create($request)
    {
        $form_data=$request->bodypartsData;
        $presp= new Bodyparts;
        $presp->radiology_id=$form_data['radiology_id'];
        $presp->name=$form_data['name'];
        $presp->save();
        return $presp->id;
    }
    /**
     * [getBodypartsDetailsById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getBodypartsDetailsById($id)
    {
        return Bodyparts::where('id',$id)->first();
    }
    /**
     * [edit description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function edit($request)
    {
        $form_data=$request->bodypartsData;
        $id=$form_data['bodypartsId'];
        $presp= Bodyparts::findOrFail($id);
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
        $presp_id = Bodyparts::find( $id );
        $presp_id ->delete();
        return $id;
    }
    /**
     * [getBodypartsListOptions description]
     * @return [type] [description]
     */
    public function getBodypartsByRadiologyId($r_id)
    {
        return Bodyparts::where('radiology_id',$r_id)->get();
    }

    /**
     * [getBodypartsNameById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getBodypartsNameById($id)
    {
        $bodyparts= Bodyparts::where('id',$id)->first();
        return $bodyparts->name;
    }
    
 }
?>