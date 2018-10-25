<?php

namespace euro_hms\Api\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use euro_hms\Models\User;
use euro_hms\Models\PrescriptionDrugs;
use euro_hms\Api\Repositories\PrescriptionRepository;


use DB;
use Carbon\Carbon;

class PrescriptionDrugController extends Controller
{
    public function __construct(){
        $this->prescObj = new PrescriptionRepository();
       

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */  
    public function create()
    {
        //
        return view('/PatientsDetailForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }
    
    /**
     * get all details of patient.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getDetails(Request $request)
    {
        // echo "<pre>";print_r($id);echo "</pre>";exit;
       
        $department = $request->all()['data'];
        // if($id!='') {
            $presDetails = PrescriptionDrugs::where('type',$department)->get();
            // dd($details);
            if ($presDetails) {
                return ['code' => '200','data'=>$presDetails, 'message' => 'Record Sucessfully created'];
            } else {
                return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
            }
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * [getPrescriptionList description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getPrescriptionList(Request $request)
    {
        $userType = $request->userType;
        $userId = $request->userId ;
        $noOfPage = $request->noofRecord;
        
        $prescription_list=$this->prescObj->getPrescriptionList($userType,$noOfPage,$userId);
        if($prescription_list)
        {
            return ['code' => 200 ,'data'=>$prescription_list,'message'=>'Getting case type successfully.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
       
    }

    /**
     * [createPrescription description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function createPrescription(Request $request)
    {
        $add_Prescription=$this->prescObj->create($request);
        if($add_Prescription)
        {
            return ['code' => 200 ,'data'=>$add_Prescription,'message'=>'Prescription successfully added.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [getPrescriptionDetailsById description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getPrescriptionDetailsById(Request $request)
    {
        $id = $request->id;
        $presp_details=$this->prescObj->getPrescriptionDetailsById($id);
        if($presp_details)
        {
            return ['code' => 200 ,'data'=>$presp_details,'message'=>'Prescription successfully added.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [editPrescription description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function editPrescription(Request $request)
    {
        $edit_Prescription=$this->prescObj->edit($request);
        if($edit_Prescription)
        {
            return ['code' => 200 ,'data'=>$edit_Prescription,'message'=>'Prescription successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }

    /**
     * [deletePrescription description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function deletePrescription(Request $request)
    {
        $id = $request->id;
        $delete_prescription=$this->prescObj->delete($id);
        if($delete_prescription)
        {
            return ['code' => 200 ,'data'=>$delete_prescription,'message'=>'Prescription successfully edited.'];
        }
        else
        {
            return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
    /**
     * [importPrescriptionFile description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function importPrescriptionFile(Request $request)
    {
        $import_file=$this->prescObj->importPrescriptionFile($request);
        if($import_file==1)
        {
            return back()->with('success', 'Prescription are successfully added!');
            //return ['code' => 200 ,'data'=>$import_file,'message'=>'Prescription successfully edited.'];
        }
        else
        {
            return back()->with('error', 'Something wrong with file!');
            //return ['code'=> 300 ,'data'=>'','message'=>'Something went wrong'];
        }
    }
}
