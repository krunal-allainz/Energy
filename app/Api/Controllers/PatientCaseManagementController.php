<?php

namespace euro_hms\Api\Controllers;


use Illuminate\Http\Request;
use euro_hms\Http\Controllers\Controller;
use euro_hms\Models\PatientDetailsForm;
use euro_hms\Models\OpdDetails;
use euro_hms\Models\Receipt;
use Illuminate\Support\Facades\Response;
use euro_hms\Custom\Helper\Common;
use euro_hms\Api\Repositories\OPDRepository;
use euro_hms\Api\Repositories\PatientCaseManagementRepository;
use DB;

class PatientCaseManagementController extends Controller
{

    /**
     * [__construct description]
     */
     public function __construct(){
        $this->opdObj = new OPDRepository();
        $this->caseObj = new PatientCaseManagementRepository();
    }

    /**
     * [getPatientCaseDetailsByPatientId description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getPatientCaseDetailsByPatientId(Request $request)
    {
        
        $patient_id = $request->pid;
        $patientDetail = $this->caseObj->getPatientCaseDetailsByPatientId($patient_id);

        if ($patientDetail) {
            return ['code' => '200','data'=>$patientDetail, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }

    /**
     * [getPatientCaseAndTokenDetailByCaseId description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getPatientCaseAndTokenDetailByCaseId(Request $request){

        $caseID = $request->caseID;
        $patientCaseDetail = $this->caseObj->getPatientCaseAndTokenDetailByCaseId($caseID);
        if ($patientCaseDetail) {
            return ['code' => '200','data'=>$patientCaseDetail, 'message' => 'Record Sucessfully created'];

        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }

    }

    /**
     * [addDetails description]
     * @param Request $request [description]
     */
    public function storeOpd(Request $request)
    {
        return $this->caseObj->storeOpd($request);
    }
    
    /**
     * [getUPdateOPDCaseInfo description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getUPdateOPDCaseInfo(Request $request)
    {
        $pid = $request->patient_id;
        $cid = $request->caseId;
        $opdDetail=$this->caseObj->getUPdateOPDCaseInfo($pid,$cid);
        if($opdDetail)
        {
            return ['code' => '200','data'=>$opdDetail, 'message' => 'Record Sucessfully created'];
        }   
        else
        {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }

    /**
     * [getOPDCaseDetailsByPatientId description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
     public function getOPDCaseDetailsByPatientId(Request $request)
    {
        
        $patient_id = $request->pid;
        $patientDetail = $this->caseObj->getOPDCaseDetailsByPatientId($patient_id);

        if ($patientDetail) {
            return ['code' => '200','data'=>$patientDetail, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }

    /**
     * [editOpdCaseDetails description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function editOpdCaseDetails(Request $request)
    {
        return $this->caseObj->editOpdCaseDetails($request);
    }

    /**
     * [getPatientOpdCaseDataReport description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getPatientOpdCaseDataReport(Request $request){
        $caseID = $request->id;
        $opdDetail=$this->caseObj->getPatientOpdCaseDataReport($caseID);
            if($opdDetail)
            {
                return ['code' => '200','data'=>$opdDetail, 'message' => 'Record Sucessfully created'];
            }   
            else
            {
                return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
            }
    }

    /**
     * [getPatientCaseDetailById description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function getPatientCaseDetailById(Request $request){
        $id = $request->id;
        $case_details=$this->caseObj->getPatientCaseDetailById($id);
        if($case_details)
        {
            return ['code' => '200','data'=>$case_details, 'message' => 'Record Sucessfully created'];
        }   
        else
        {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }

    /**
     * [patientCheckUpDetails description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function patientCheckUpDetails(Request $request)
    {
        $cid=$request->case_id;
        
        $checkupdetails =  $this->caseObj->patientCheckUpDetailsByCaseId($cid);
        if ($checkupdetails) {
            return ['code' => '200','data'=>$checkupdetails, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }   

    /**
     * [patientDetailAndCaseInfo description]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function patientDetailAndCaseInfo(Request $request){
        $patientId = $request->patientId;
        $caseId =  $request->caseId;
        $patientDetail = $this->caseObj->patientDetailAndCaseInfo($patientId,$caseId);
        if ($patientDetail) {
            return ['code' => '200','data'=>$patientDetail, 'message' => 'Record Sucessfully created'];
        } else {
            return ['code' => '300','data'=>'', 'message' => 'Something goes wrong'];
        }
    }

    

   
}
