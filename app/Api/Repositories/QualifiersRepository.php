<?php
namespace euro_hms\Api\Repositories;
use Carbon\Carbon;
use DB;
use euro_hms\Models\Qualifiers;
use euro_hms\Models\Bodyparts;
use euro_hms\Models\RadiologyTable;
use Excel;
use File;
class QualifiersRepository 
{
   
 	/**
 	 * [getQualifiersList description]
 	 * @param  [type] $userType [description]
 	 * @param  [type] $noOfPage [description]
 	 * @param  [type] $userId   [description]
 	 * @return [type]           [description]
 	 */
    public function getQualifiersList($userType,$noOfPage,$userId)
    {
        $list= Qualifiers::join('radiology', function ($join) {
                  $join->on('radiology.id', '=', 'qualifiers.radiology_id');
        })->join('bodyparts', function ($join) {
                  $join->on('bodyparts.id', '=', 'qualifiers.bodyparts_id');
        })->select('qualifiers.id as qualifier_id','qualifiers.name as qualifier_name','radiology.name as radio_name','bodyparts.name as bodypart_name')->orderBy('qualifiers.created_at','desc')->paginate($noOfPage);
        return $list;
    }
   /**
     * [create description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function create($request)
    {
    	$form_data=$request->qualifiersData;
    	$presp= new Qualifiers;
    	$presp->radiology_id=$form_data['radiology_id'];
        $presp->bodyparts_id=$form_data['bodyparts_id'];
        $presp->name=$form_data['name'];
    	$presp->save();
    	return $presp->id;
    }
    /**
     * [getQualifiersDetailsById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getQualifiersDetailsById($id)
    {
        return Qualifiers::where('id',$id)->first();
    }
   /**
     * [edit description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function edit($request)
    {
        $form_data=$request->qualifiersData;
        $id=$form_data['qualifiersId'];
        $presp= Qualifiers::findOrFail($id);
        $presp->radiology_id=$form_data['radiology_id'];
        $presp->bodyparts_id=$form_data['bodyparts_id'];
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
        $presp_id = Qualifiers::find( $id );
        $presp_id ->delete();
        return $id;
    }
    /**
     * [getQualifierByBodypartsId description]
     * @param  [type] $b_id [description]
     * @return [type]       [description]
     */
    public function getQualifierByBodypartsId($b_id)
    {
        return Qualifiers::where('bodyparts_id',$b_id)->get();
    }

    /**
     * [getQualifiersNameById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getQualifiersNameById($id)
    {
        $qualifier= Qualifiers::where('id',$id)->first();
        return $qualifier->name;
    }
   
    
 }
?>
