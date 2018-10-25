<?php
namespace euro_hms\Api\Repositories;
use Carbon\Carbon;
use DB;
use euro_hms\Models\Laboratory;
use Excel;
use File;



 class LaboratoryRepository 
 {
   
 	/**
 	 * [getLaboratoryList description]
 	 * @param  [type] $userType [description]
 	 * @param  [type] $noOfPage [description]
 	 * @param  [type] $userId   [description]
 	 * @return [type]           [description]
 	 */
    public function getLaboratoryList($userType,$noOfPage,$userId)
    {
        $list= Laboratory::orderBy('laboratory.created_at','desc')->paginate($noOfPage);
        return $list;
    }

    /**
     * [create description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function create($request)
    {
    	$form_data=$request->laboratoryData;
    	$presp= new Laboratory;
    	$presp->name=$form_data['name'];
    	$presp->type=$form_data['type'];
    	$presp->save();
    	return $presp->id;
    }

    /**
     * [getLaboratoryDetailsById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getLaboratoryDetailsById($id)
    {
        return Laboratory::where('id',$id)->first();
    }

    /**
     * [edit description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function edit($request)
    {
        $form_data=$request->laboratoryData;
        $id=$form_data['laboratoryId'];
        $presp= Laboratory::findOrFail($id);
        $presp->name=$form_data['name'];
        $presp->type=$form_data['type'];
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
        $presp_id = Laboratory::find( $id );
        $presp_id ->delete();
        return $id;
    }

    /**
     * [importLaboratoryFile description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function importLaboratoryFile($request)
    {

       $file=$request->file('file');
       
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if($extension == "xlsx" || $extension == "xls" || $extension == "csv") {
                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader) {
                })->get();

                if(!empty($data) && $data->count()){
 
                    foreach ($data as $key => $value) {
                        if(isset($value->name) &&  isset($value->type))
                        {
                            $new_type=strtolower($value->type);
                            $type=trim($new_type);
                            $n_type=0;
                            if($type=='blood')
                            {
                                $n_type=1;
                            }
                            else if($type=='urine')
                            {
                                $n_type=2;
                            }
                            else if($type=='csf')
                            {
                                $n_type=3;
                            }
                            else if($type=='bfa')
                            {
                                $n_type=4;
                            }
                            if($n_type!=0)
                            {
                                $insert[] = [
                                'name' => $value->name,
                                'type' => $n_type,
                                'created_at'=>Carbon::now(),
                                'updated_at'=>Carbon::now(),
                                ];
                            }
                             
                        }
                       
                    }
                    
                    if(!empty($insert)){

                        $insertData = DB::table('laboratory')->insert($insert);
                        if ($insertData) {
                            return 1;
                        }
                        else {                        
                            return 0;
                        }
                    }
                    else
                    {
                         return 0;
                    }
                }
            }
            return 0;
        }
    }
    
 }
?>
