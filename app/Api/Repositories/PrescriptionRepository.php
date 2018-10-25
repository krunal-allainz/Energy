<?php
namespace euro_hms\Api\Repositories;
use Carbon\Carbon;
use DB;
use euro_hms\Models\PrescriptionDrugs;
use Excel;
use File;
use Illuminate\Database\Eloquent\SoftDeletes;


 class PrescriptionRepository 
 {
    use SoftDeletes;
    protected $dates = ['deleted_at'];
 	/**
 	 * [getPrescriptionList description]
 	 * @param  [type] $userType [description]
 	 * @param  [type] $noOfPage [description]
 	 * @param  [type] $userId   [description]
 	 * @return [type]           [description]
 	 */
    public function getPrescriptionList($userType,$noOfPage,$userId)
    {
        $list= PrescriptionDrugs::where('status',1)->where('remove','false')->orderBy('prescription_drugs.created_at','desc')->paginate($noOfPage);
        return $list;
    }

    /**
     * [create description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function create($request)
    {
    	$form_data=$request->prescriptionData;
    	$presp= new PrescriptionDrugs;
    	$presp->name=$form_data['name'];
        $presp->doctor=$form_data['doctor'];
    	$presp->type=$form_data['department'];
        $presp->status=1;
    	$presp->save();
    	return $presp->id;
    }

    /**
     * [getPrescriptionDetailsById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function getPrescriptionDetailsById($id)
    {
        return PrescriptionDrugs::where('id',$id)->first();
    }

    /**
     * [edit description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function edit($request)
    {
        $form_data=$request->prescriptionData;
        $id=$form_data['prescriptionId'];
        $presp= PrescriptionDrugs::findOrFail($id);
        $presp->name=$form_data['name'];
        $presp->doctor=$form_data['doctor'];
        $presp->type=$form_data['department'];
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
        $presp_id = PrescriptionDrugs::find( $id );
        $presp_id ->delete();
        return $id;
    }

    /**
     * [importPrescriptionFile description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function importPrescriptionFile($request)
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
                        if(isset($value->name) && isset($value->doctor) && isset($value->department))
                        {
                            $new_dept=strtolower($value->department);
                            $dept=trim(ucfirst($new_dept));
                             $insert[] = [
                                'name' => $value->name,
                                'doctor' => $value->doctor,
                                'type' => $dept,
                                'status'=>1,
                                'created_at'=>Carbon::now(),
                                'updated_at'=>Carbon::now(),

                                ];
                        }
                       
                    }
                    
                    if(!empty($insert)){
 
                        $insertData = DB::table('prescription_drugs')->insert($insert);
                        if ($insertData) {
                            return 1;
                        }else {                        
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
