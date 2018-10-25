import api from './siteconfig'

export default { 
  getUserDetails(userData) {
  	return api.post('user/getDetails',{'userId':userData})
  },
  getEditUser(id) {
  	return api.get('user/edit/'+id)
  },
  savePatient(patientData) {
    return api.post('patient/create',{patientData})
  },
  saveAdverseDrugReaction(adverseDrugReaction) {
    return api.post('adverseDrugReaction/create',{'resData': adverseDrugReaction})
  },
  saveAppointmentBook(appointmentBook) {
    return api.post('appointmentBook/create',{'resData': appointmentBook})
  },
  saveBloodSugarMonitoringChart(bloodSugarMonitoringChart) {
    return api.post('bloodSugarMonitoringChart/create',{'resData': bloodSugarMonitoringChart})
  },
  saveBloodTransfusion(bloodTransfusionDetails) {
    return api.post('bloodTransfusionDetails/create',{'resData': bloodTransfusionDetails})
  },
  saveBreifOperativeNote(briefOperativeNoteData) {
    return api.post('briefOperativeNote/create',{'briefOperativeNoteData': briefOperativeNoteData})
  },
  testFunction(testData) {
    return api.post('testFile/create',{'resData': testData})
  },
  saveCodeBlueEvaluationForm(codeBlueEvaluationData) {
    return api.post('codeBlueEvaluationForm/create',{'codeBlueEvaluationData': codeBlueEvaluationData})
  },
  saveCompleteNursingAssessment(completeNursingAssessmentData) {
    return api.post('completeNursingAssessment/create',{'resData': completeNursingAssessmentData})
  },
  saveCounsellingForm(counsellingFormData) {
    return api.post('counsellingForm/create',{'resData': counsellingFormData})
  },
  saveCprFormat(cprFormatData) {
    return api.post('cprFormat/create',{'resData': cprFormatData})
  },
  saveCultureBiopsy(cultureBiopsyData) {
    return api.post('cultureBiopsyForm/create',{'resData': cultureBiopsyData})
  },
  saveDailyDietForm(dailyDietData) {
    return api.post('dailyDietForm/create',{'resData': dailyDietData})
  },
  saveDischargeGatepass(dischargeGatepassData) {
    return api.post('dischargeGatepass/create',{'resData': dischargeGatepassData})
  },
  saveDischargeSummary(dischargeSummaryData) {
    return api.post('dischargeSummary/create',{'resData': dischargeSummaryData})
  },
  saveDoctorsDailyNotes(doctorsDailyNotesData) {
    return api.post('doctorsDailyNotes/create',{'resData': doctorsDailyNotesData})
  },
  saveSurgicalSafetyChecklist(surgicalSafetyChecklistData) {
    return api.post('surgicalSafetyChecklist/create',{'resData': surgicalSafetyChecklistData})
  },
  saveLabSheet(LabSheet) {
    return api.post('LabSheet/create',{'resData': LabSheet})
  },
  saveNurseProgressNotes(NurseProgressNotes) {
    return api.post('NurseProgressNotes/create',{'resData':NurseProgressNotes})
  },

  saveNursingDutyOver(NursingDutyOver) {
    return api.post('NursingDutyOver/create',{'resData':NursingDutyOver})
  },

  saveNutritionalAssessmentForm(NutritionalAssessmentForm) {
    return api.post('NutritionalAssessmentForm/create',{'resData':NutritionalAssessmentForm})
  },

  saveNutritionalScreeningForm(NutritionalScreeningForm) {
    return api.post('NutritionalScreeningForm/create',{'resData':NutritionalScreeningForm})
  },

  saveOperativeDetailSheet(operativeDetailSheetData) {
    return api.post('OperativeDetailSheet/create',{'resData':operativeDetailSheetData})
  },

  savePatientAdmissionSheet(PatientAdmissionSheet) {
    return api.post('PatientAdmissionSheet/create',{'resData':PatientAdmissionSheet})
  },

  savePatientDietRecord(patientDietRecordData) {
    return api.post('PatientDietRecord/create',{'resData':patientDietRecordData})
  },

  savePatientValuableForm(patientValuableFormData) {
    return api.post('PatientValuableForm/create',{'resData':patientValuableFormData})
  },

  savePhysiotherapyAssessment(PhysiotherapyAssessment) {
    return api.post('PhysiotherapyAssessment/create',{'resData':PhysiotherapyAssessment})
  },

  saveRestraintAdministration(RestraintAdministration) {
    return api.post('RestraintAdministration/create',{'resData':RestraintAdministration})
  },
  savePlanOfCare(planOfCareData) {
    return api.post('planOfCare/create',{'resData': planOfCareData})
  },
  savePreAnaesthesiaCheckupForm(preAnaesthesiaCheckupFormData) {
    return api.post('preAnaesthesiaCheckupForm/create',{'resData': preAnaesthesiaCheckupFormData})
  },
  savePostAnaesthesiaEvaluation(postAnaesthesiaEvaluationData) {
    return api.post('postAnaesthesiaEvaluation/create',{'resData': postAnaesthesiaEvaluationData})
  },
  savePreAngiographyAngioplastyChecklist(preAngiographyAngioplastyChecklistData) {
    return api.post('preAngiographyAngioplastyChecklist/create',{'resData': preAngiographyAngioplastyChecklistData})
  },
  savePreOTChecklist(preOTChecklistData) {
    return api.post('savePreOTChecklist/create',{'resData': preOTChecklistData})
  },
  saveProvisionalDischargeSummary(provisionalDischargeSummaryData) {
    return api.post('provisionalDischargeSummary/create',{'resData': provisionalDischargeSummaryData})
  },
  saveRadiologyRequisition(radiologyRequisitionData) {
    return api.post('radiologyRequisition/create',{'resData': radiologyRequisitionData})
  },
  saveTransferChecklistForNurses(transferChecklistForNursesData) {
    return api.post('transferChecklistForNurses/create',{'resData': transferChecklistForNursesData})
  },
  saveTransfusionReactionForm(transfusionReactionFormData) {
    return api.post('transfusionReactionForm/create',{'resData': transfusionReactionFormData})
  },
  saveVentilatorChargeSheet(ventilatorChargeSheetData) {
    return api.post('ventilatorChargeSheet/create',{'resData': ventilatorChargeSheetData})
  },
  saveWardProcedureRecord(wardProcedureRecordData) {
    return api.post('wardProcedureRecord/create',{'resData': wardProcedureRecordData})
  },
  saveDoctorsHandover(doctorsHandoverData) {
    return api.post('doctorsHandover/create',{'resData': doctorsHandoverData})
  },
  saveDrugRequisition(drugRequisitionData) {
    return api.post('drugRequisition/create',{'resData': drugRequisitionData})
  },
  saveerObservation(erObservationData) {
    return api.post('erObservation/create',{'resData': erObservationData})
  },
  savegatePass(gatePassData) {
    return api.post('gatePass/create',{'resData': gatePassData})
  },
  saveglassGow(glassGow) {
    return api.post('glassGow/create',{'resData': glassGowData})
  },
  saveHistoryForm(historyFormData) {
    return api.post('historyForm/create',{'resData': historyFormData})
  },
  saveInformationForm(informationFormData) {
    return api.post('informationForm/create',{'resData': informationFormData})
  },
  saveinvestigationSheet(investigationSheet) {
    return api.post('investigationSheet/create',{'resData': investigationSheetData})
  },
  saveIntraoperativeEventManagement(intraoperativeEventManagementData) {
    return api.post('intraoperativeEventManagement/create',{'resData': intraoperativeEventManagementData})
  },
  saveinfusionTherapyChart(infusionTherapyChartData) {
    return api.post('infusionTherapyChart/create',{'resData': infusionTherapyChartData})
  },

  saveDoctorsInitialAssessment(doctorsInitialAssessmentData) {
    return api.post('doctorsInitialAssessment/create',{'resData': doctorsInitialAssessmentData})
  },

  saveAppointmentBook(appointmentBook) {
    return api.post('appointmentBook/create',{'appointmentBook':appointmentBook})
  },

  saveSurgicalSafetyChecklist(surgicalSafetyChecklistData) {
      return api.post('surgicalSafetyChecklist/create',{'surgicalSafetyChecklistData':surgicalSafetyChecklistData})
    },

  saveNurseProgressNotes(NurseProgressNotes) {
      return api.post('NurseProgressNotes/create',{'NurseProgressNotes':NurseProgressNotes})
    },

  saveWardProcedureRecord(wardProcedureRecordData) {
      return api.post('wardProcedureRecord/create',{'wardProcedureRecordData':wardProcedureRecordData})
    },

  saveIntraoperativeEventManagement(intraoperativeEventManagementData) {
      return api.post('intraoperativeEventManagement/create',{'intraoperativeEventManagement':intraoperativeEventManagementData})
    },
  saveMARFlowSheet(MARFlowSheet) {
    return api.post('MARFlowSheet/create',{'MARFlowSheet': MARFlowSheet})
  },

  getpatientDetail(ipdId) { 
    return api.post('patient/getDetails/'+ipdId)
  },
  saveCentralLineBundleChecklist(CentralLineBundleChecklistData) {
      return api.post('centralLineBundleChecklist/create',{'resData':CentralLineBundleChecklistData})
    },
  submitReport(reportData) {
    return api.post('report/create',{'reportData':reportData})
  },
  getAllPatientName(user_type,user_id) {
      return api.post('patient/getAll',{'userType':user_type,'user_id':user_id});
  },
  createUser(userData) {
      return api.post('user/create',{'userData':userData})

  },
  getPatientOPDDetail(patientId) {
    return api.post('patient/OPDDetails/'+patientId)
  },
  saveOpdData(opdData) {                                                            
        return api.post('opd/saveData',{'opdData':opdData})
  },             
  sendResetLinkInMail(requestData) {  
    return api.post('password/reset/link',{'email':requestData})
  },
  savePatientDetailBySearch(searchData) {
      return api.post('patient/getDetails',{'searchData':searchData})
  },
  getDiagnosis(data) {
      return api.post('provison/getDiagnosis',{'data':data})
  },
  getPrescription(data) {
      return api.post('prescription/getDetails',{'data':data})
  },
  printReceiptPreview(fromData,content){ 
     return api.post('print/receipt',{'fromData':fromData,'content':content})  
  }, 
  generateReceiptData(formData,type){  
    return api.post('generate/receipt',{'formData':formData})  
  },
  printOPDCaseData(OPDCaseData){
      return api.post('print/opdcase',{'OPDCaseData':OPDCaseData})  
  },
  getAllPatientNameByConsultDoctor(doctor,section) {
      return api.post('doctor/patientlist',{'doctor' :doctor,'section':section});
  },
  getReceiptList(page_url){
     return api.post(page_url);
  },
   getChargesTypes(){
     return api.post('receipt/getchargestypes');
  },
   getConsultationCategoryDetails(chargeID) {
    return api.post('receipt/getconsultationcategory/'+chargeID)
  },
  getConsultationCategoryCharges(categoryId,typeId) {
    return api.post('receipt/getconsultationcategorycharges/'+categoryId+'/'+typeId)
  },
   getEmergencyTypes(chargeID) {
    return api.post('receipt/getemergencytypes/'+categoryId+'/'+typeId)
  },
   getEmergencyCharges(typeId) {
    return api.post('receipt/getemergencycharges/'+typeId)
  },
  getDrDepartment(name) {
    return api.post('user/getDepartmentByName',{'name' :name})
  },
  removeReceipt(id){
     return api.post('patient/receipt/remove',{'id':id});
  },
  generateReceiptDataById(id,type,rec_type){
      return api.post('patient/receipt/view',{'id':id,'type':type,'rec_type':rec_type});
  },
  generateUserDetailsByType(type,status){
      return api.post('user/getUserDetailByUserType',{'type':type,'status':status});
  },
  getDrDepartmentById(consult_id) {
    return api.post('user/getDepartmentById',{'id' :consult_id});
  },
  generateUserNameById(consult_id) {
    return api.post('user/getUserNameById',{'id' :consult_id});
  },
  generateUserNameByIdForSignature(consult_id) {
    return api.post('user/getusernameforsignature',{'id' :consult_id});
  },
  generateLaboratoryData(data_obj) {
    return api.post('opd/getLaboratoryData',{'data' :data_obj});
  },
  generatePatientDetailsByID(id) {
      return api.post('patient/getPatientDetailsById',{'id':id});
  },
  generateAllLaboratoryList(data_obj) {
    return api.post('opd/getAllLaboratoryList');
  },
  generateOpdIdByPatirntID(patient_id) {
    return api.post('patient/getOPDIdByPatientId',{'patient_id':patient_id})
  },
  /*generatePatientCheckUpDetails(opd_id) {
    return api.post('patient/getpatientCheckUpDetails',{'opd_id':opd_id})
  },*/

  getNumberOfPatient(type,id){
    return api.post('patient/total',{'type':type,'id':id});
  },
  getOPDCounters(id){
    return api.post('opd/opdtotal',{'id':id});
  },
  getPatientListByDoctor(page_url,id){
    return api.post(page_url,{'id':id})
  },
  getUserTypesList(){
    return api.post('user/types');
  },
  generatePatientListBySearch(searchData) {
      return api.post('patient/getListBySearch',{'searchData':searchData});
  },
  generateAllLaboratoryListByChild() {
    return api.post('opd/getLabListByChildren');
  },
  savePatientCheckup(pData){
     return api.post('patient/save_patient_checkup_data',{'pData':pData});
  },
  getImagefromUrl(url){
    return  api.post('user/getimagefromurl',{'url':url})
  },
  savePhysioTherapy(physioData) {
      return api.post('opd/savePhysiotherapy',{'physioData':physioData})
  },
  getExistingToken(token){
      return api.post('patient/token_exist',{'token':token});
  },
  checkExistUser(type,value){
     return api.post('user/user_exist',{'type': type , value : value});
  },
  getLastOPDIdByPatientId(patient_id) {
    return api.post('patient/getLastOPDIdByPatientId',{'patient_id':patient_id});
  },
  getAllPatientListByDoctoreIdAndPaggination(page_url,type,noofRecord,id,$status) { 
      return api.post(page_url,{'type':type,'noOfRecord':noofRecord,'id':id,'status':$status});
  },
  getAllPatientListWithPaggination(page_url,status,userType,noofRecord,userId) { 
      return api.post(page_url,{'userType':userType,'noofRecord':noofRecord,'userId':userId,'status':status});
  },
  getPatientDetailInfo(patientId){
     return api.post('patient/patientDetailInfo',{'patientId':patientId});
  },
 /* getPatientDetailAndOpdInfo(patientId,opdId){
     return api.post('patient/patientDetailAndOpdInfo',{'patientId':patientId,'opdId':opdId});
  },*/
  getDoctoreInfoById(doctoreId,typeId){
    return api.post('user/getdoctoreinfobyid',{'id' :doctoreId , 'typeId' : typeId});
  },
  getVitalsInfoByPatientId(patientId)
  {
       return api.post('patient/getVitalsInfoByPatientId',{'patientId':patientId});
  },
  getVitalsValidity(vitalId)
  {
       return api.post('patient/getVitalsValidity',{'vitalId':vitalId});
  },
 /* getPatientCaseDetailByOpdId(opdId){
    return api.post('patient/patientCaseDetailInfo',{'opdId':opdId});
  },*/
 /* getOPDDetailsByPatientId(pid)
  {
       return api.post('patient/getOPDDetailsByPatientId',{'pid':pid});
  },*/
  printOPDCaseMultipleData(OPDCaseData){
      return api.post('print/opdcaseMultiple',{'OPDCaseData':OPDCaseData});
  },
  movePatientForNewReferal(OPDCaseData){
     return api.post('patient/movepsatientfornewreferal',{'OPDCaseData':OPDCaseData});
  },
  /*getPatientOpdData(opdId){
     return api.post('opd/patientopddetail',{'id':opdId});
  },*/
  getAgeOfPatient(patientId){
    return api.post('patient/getPatientAge',{'id':patientId});
  },
  getPatientOpdDetailByOpdId(opdId){
     return api.post('opd/patientallopddetail',{'id':opdId});
  },
  getPatientCaseAndTokenDetailByOpdId(opdId){
     return api.post('patient/patientcaseandtokendetailinfo',{'opdId':opdId});
  },
 /* getOPDDetailsByPatient(pid){
     return api.post('opd/getopddetailsbypatient',{'patient_id':pid});
  },*/
 /* getUPdateOPDInfo(pid,oid){
     return api.post('opd/getUPdateOPDInfo',{'patient_id':pid,'opdId':oid});
  },*/
  /*generateEditOpdDetails(opd_data) {
    return api.post('opd/editOpdDetails',{'data':opd_data})
  },*/
  getPatientLastVisitById(pid) {
    return api.post('patient/getPatientLastVisitById',{'patient_id':pid})
  },
  getPatientCaseTypeById(pid){
      return api.post('patient/getPatientCaseTypeById',{'patient_id':pid})
  },
  updatePatient(patientData){
     return api.post('patient/update',{'patientData':patientData})
  },
  generatePatientListSearchByAdminPagintion(page_url,searchData,no_of_page)
  {
      return api.post(page_url,{'searchData':searchData,'no_of_page':no_of_page});
  },
  patientCaseStatusChage(patientId,status){
     return api.post('patient/statusupdate',{'patientId':patientId,'status':status})
  },
  getAllUsersDetails(pageUrl,noOfPage){
     return api.post(pageUrl,{'noOfPage' :noOfPage });
  },
  deleteUserById(userId){
     return api.post('user/delete',{'userId' : userId});
  },
  getUserDetailByUserId(userId){
    return api.post('user/getUserDetailByUserId',{'userId' : userId});
  },
  editUser(userData,userId) {
    return api.post('user/edit',{'userData' : userData , 'userId' :userId})
  },
  generatePrintCounter(rid)
  {
      return api.post('receipt/updatePrintCounter',{'receipt_id':rid});
  },
  getReceiptDetailsById(rid)
  {
      return api.post('receipt/getReceiptDetailsById',{'receipt_id':rid});
  },
  generateEditReceiptData(formData)
  {
      return api.post('receipt/editReceipt',{'formData':formData});
  },

  getPatientCaseTypeOfLastVisit(pid){
    return api.post('patient/getPatientCaseTypeOfLastVisit',{'patient_id':pid})
  },

  getTimelineData(doctoreId){
      return api.post('dashboard/gettimelinedata',{'id':doctoreId});
  },
  generateCrossRefferalUserList(doctor_id)
  {
      return api.post('user/getCrossRefferalUser',{'doctor_id':doctor_id});
  },
  getPatientCaseTypeOfLastVisit(pid){
    return api.post('patient/getPatientCaseTypeOfLastVisit',{'patient_id':pid})
  },
  getPatientCaseDetailsByPatientId(pid)
  {
       return api.post('case/getPatientCaseDetailsByPatientId',{'pid':pid});
  },
  getPatientCaseAndTokenDetailByCaseId(caseID){
     return api.post('case/getPatientCaseAndTokenDetailByCaseId',{'caseID':caseID});
  },
  generateAddOpdDetails(opd_data) {
    return api.post('case/addOpdDetails',{'data':opd_data})
  },
  getUPdateOPDCaseInfo(pid,cid){
     return api.post('case/getUPdateOPDCaseInfo',{'patient_id':pid,'caseId':cid});
  },
  getOPDCaseDetailsByPatientId(pid)
  {
       return api.post('case/getOPDCaseDetailsByPatientId',{'pid':pid});
  },
  generateEditOpdCaseDetails(opd_data) {
    return api.post('case/editOpdCaseDetails',{'data':opd_data})
  },
  getPatientOpdCaseDataReport(cid){
     return api.post('case/getPatientOpdCaseDataReport',{'id':cid});
  },
  getPatientCaseDetailById(id)
  {
     return api.post('case/getPatientCaseDetailById',{'id':id});
  },
  generatePatientCheckUpDetails(case_id) {
    return api.post('case/getpatientCheckUpDetails',{'case_id':case_id})
  },
  getPatientDetailAndCaseInfo(patientId,caseId){
     return api.post('case/patientDetailAndCaseInfo',{'patientId':patientId,'caseId':caseId});
  },
  getPrescriptionList(page_url,userType,noofRecord,userId){
     return api.post(page_url,{'userType':userType,'noofRecord':noofRecord,'userId':userId});
  },
 createPrescription(prescriptionData) {
      return api.post('prescription/create',{'prescriptionData':prescriptionData})
  },
  getPrescriptionDetailsById(id) {
      return api.post('prescription/getPrescriptionDetailsById',{'id':id})
  },
  editPrescription(prescriptionData) {
      return api.post('prescription/edit',{'prescriptionData':prescriptionData})
  },
  deletePrescription(id) {
      return api.post('prescription/delete',{'id':id})
  },
  getLaboratoryList(page_url,userType,noofRecord,userId){
     return api.post(page_url,{'userType':userType,'noofRecord':noofRecord,'userId':userId});
  },
 createLaboratory(laboratoryData) {
      return api.post('laboratory/create',{'laboratoryData':laboratoryData})
  },
  getLaboratoryDetailsById(id) {
      return api.post('laboratory/getLaboratoryDetailsById',{'id':id})
  },
  editLaboratory(laboratoryData) {
      return api.post('laboratory/edit',{'laboratoryData':laboratoryData})
  },
  deleteLaboratory(id) {
      return api.post('laboratory/delete',{'id':id})
  },
  getBodypartsList(page_url,userType,noofRecord,userId){
     return api.post(page_url,{'userType':userType,'noofRecord':noofRecord,'userId':userId});
  },
 createBodyparts(bodypartsData) {
      return api.post('bodyparts/create',{'bodypartsData':bodypartsData})
  },
  getBodypartsDetailsById(id) {
      return api.post('bodyparts/getBodypartsDetailsById',{'id':id})
  },
  editBodyparts(bodypartsData) {
      return api.post('bodyparts/edit',{'bodypartsData':bodypartsData})
  },
  deleteBodyparts(id) {
      return api.post('bodyparts/delete',{'id':id})
  },
  getRadiologyList(id) {
      return api.post('radiology/getRadiologyList')
  },
  getQualifiersList(page_url,userType,noofRecord,userId){
     return api.post(page_url,{'userType':userType,'noofRecord':noofRecord,'userId':userId});
  },
 createQualifiers(qualifiersData) {
      return api.post('qualifiers/create',{'qualifiersData':qualifiersData})
  },
  getQualifiersDetailsById(id) {
      return api.post('qualifiers/getQualifiersDetailsById',{'id':id})
  },
  editQualifiers(qualifiersData) {
      return api.post('qualifiers/edit',{'qualifiersData':qualifiersData})
  },
  deleteQualifiers(id) {
      return api.post('qualifiers/delete',{'id':id})
  },
  getBodypartsByRadiologyId(r_id)
  {
       return api.post('bodyparts/getBodypartsByRadiologyId',{'r_id':r_id})
  },
  getSpecialRequestList(page_url,userType,noofRecord,userId){
     return api.post(page_url,{'userType':userType,'noofRecord':noofRecord,'userId':userId});
  },
 createSpecialRequest(specialRequestData) {
      return api.post('specialRequest/create',{'specialRequestData':specialRequestData})
  },
  getSpecialRequestDetailsById(id) {
      return api.post('specialRequest/getSpecialRequestDetailsById',{'id':id})
  },
  editSpecialRequest(specialRequestData) {
      return api.post('specialRequest/edit',{'specialRequestData':specialRequestData})
  },
  deleteSpecialRequest(id) {
      return api.post('specialRequest/delete',{'id':id})
  },
  getBodypartSideList()
  {
      return api.post('bodyPartSide/getBodypartSideList')
  },
  getQualifierByBodypartsId(b_id)
  {
       return api.post('qualifiers/getQualifierByBodypartsId',{'b_id':b_id})
  },
  getSpecialRequestByRadiologyId(r_id)
  {
      return api.post('specialRequest/getSpecialRequestByRadiologyId',{'r_id':r_id})
  },
  getSpineList()
  {
      return api.post('spine/getSpineList')
  },
  //Hydro
  
  getNominationList(page_url,userType,noofRecord,userId){
     return api.post(page_url,{'userType':userType,'noofRecord':noofRecord,'userId':userId});
  },
 createNomination(nominationData) {
      return api.post('nomination/create',{'nominationData':nominationData})
  },
  getNominationDetailsById(id) {
      return api.post('nomination/getNominationDetailsById',{'id':id})
  },
  editNomination(nominationData) {
      return api.post('nomination/edit',{'nominationData':nominationData})
  },
  deleteNomination(id) {
      return api.post('nomination/delete',{'id':id})
  },
}
