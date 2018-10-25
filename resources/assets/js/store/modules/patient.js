import * as types from '../mutation-types'
import _ from 'lodash'
import user from '../../api/users'
import moment from 'moment'

// initial state
const state = {
	  'patientId':0,
    'doctorId':0,
    'ipdId':'',
  	'opdId':'',
    'caseId':'',
    'uhid_no':'',
    'admitDatetime': '',
  	'patientData': {},
    'ipdData': {},
    'opdData':{},
    'patientCase':{},
    'opd_resultData':{},
    'radioData':{},
    'examinationData':'',
    'laboratoryData':{},
    'saveOpd':false,
    'prescriptionData':{},
    'refferelReportData':{},
    'step4Data':{},
    'curStep':1,
    'provisionalDiagnosis' : '',
    'diagnosis' : '',
    'setErrorData':{'error':false,'steps':''},
    'opdSubmit':false,
    'setPage':'ADD',
    'otherPId':0,
 }

 // getters
const getters = {
   getIpdID: state => {
      return state.ipdId
    },
    getUhIDNo: state => {
      return state.uhid_no
    },
  }
// actions  
const actions = {
  SetPatientId ({commit},patientId) {
    commit(types.SET_PATIENT_ID, patientId)
  },
  SetDoctorId ({commit},doctorId) {
    commit(types.SET_DOCTOR_ID, doctorId)
  },
  setOpdData({commit},opdData) {
    commit(types.SET_OPD_DATA, opdData);
  },
  setPatientCase({commit},patientCase){
      commit(types.SET_PATIENT_CASE, patientCase);
  },
  setResData({commit},resultData) {
    commit(types.SET_OPD_RESULT_DATA, resultData);
  },
  setOtherPrescCount({commit},otherPId) {
    commit(types.SET_OTHER_PRESP_COUNT, otherPId);
  },
  saveRadioData({commit},radioData) {
    commit(types.SET_RADIO_DATA, radioData);
  },
  SetIpdId ({commit},ipdId) {
    commit(types.SET_IPD_ID, ipdId)
  },
  SetOpdId ({commit},opdId) {
    commit(types.SET_OPD_ID, opdId)
  },
  SetCaseId ({commit},caseId) {
    commit(types.SET_CASE_ID, caseId)
  },
  SetPage ({commit},setPage) {
    commit(types.SET_PAGE, setPage)
  },
  SetUhidNo ({commit},uhid_no) {
    commit(types.SET_UHID_NO, uhid_no)
  },
  setErrorData ({commit},setErrorData) {
    commit(types.SET_ERROR_DATA, setErrorData)
  },
  saveNeuroExamination({commit},neuroData) {
    // console(uhid_no);
    commit(types.SET_NEURO_DATA, neuroData)
  },
  saveExaminationData({commit},examinationData) {
    // console(uhid_no);
    commit(types.SET_EXAMINATION_DATA, examinationData)
  },
  saveLabReportData({commit},labReportData){
    commit(types.SET_LAB_REPORT_DATA,labReportData)
  },
  saveReferralReportData({commit},refferelReportData){
    commit(types.SET_REFFEREL_REPORT_DATA,refferelReportData)
  },
  saveStep4Data({commit},step4Data) {
    commit(types.SET_Step4_DATA, step4Data);
  },
   saveProvisionalDiagnosis({commit},provisionalDiagnosis) {
    commit(types.SET_Provisional_Diagnosis, provisionalDiagnosis);
  },
   saveDiagnosis({commit},diagnosis) {
    commit(types.SET_Diagnosis, diagnosis);
  },
  SetPatientData ({commit},ipdId) {
    
    user.getpatientDetail(ipdId).then(
    (response) => {
      if(response.data.code == 200) {
        commit(types.SET_PATIENT_DATA, response.data.data);
      }
    },)
  },
  GetAllPatientName({commit}) {
        user.getAllPatientName().then(
    (response) => {
      if(response.data.code == 200) {
        commit(types.SET_IPD_DATA, response.data.data);
      }
    },
    
    )
  },
  resetOpdForm({commit}) {
      commit(types.RESET_OPD_FORM);
    
  },
  reloadOpdForm({commit}) {
      commit(types.RELOAD_OPD_FORM);
    
  },
  saveOpdData({commit,state}) {
    

  },
  setPrescriptionData({commit},prescriptionData) {
      commit(types.SET_PRESCRIPTION_DATA,prescriptionData);
    
  },
  resetErrorData({commit}) {
      commit(types.RESET_ERROR_DATA);

  },
  setOpdSubmit({commit},data) {
      commit(types.OPD_SUBMIT,data);

  },
  
}

// mutations
const mutations = {
  [types.SET_IPD_ID] (state, ipdId) {
    state.ipdId = ipdId
  },
  [types.SET_OPD_ID] (state, opdId) {
    state.opdId = opdId
  },
  [types.SET_CASE_ID] (state, caseId) {
    state.caseId = caseId
  },
  [types.SET_PAGE] (state, setPage) {
    state.setPage = setPage
  },
  [types.SET_PATIENT_ID] (state, patientId) {
      state.patientId = patientId
  },
  [types.SET_DOCTOR_ID] (state, doctorId) {
      state.doctorId = doctorId
  },
  [types.SET_UHID_NO] (state, uhid_no) {
      state.uhid_no = uhid_no
  },
  [types.SET_OTHER_PRESP_COUNT] (state, otherPId) {
      state.otherPId = otherPId
  },
  [types.SET_ERROR_DATA] (state, setErrorData) {
      state.setErrorData = setErrorData
  },
  [types.SET_PATIENT_DATA] (state, patientData) {
      state.patientData = patientData.patient_details;
      state.admitDatetime = patientData.admit_datetime;
      state.patientId = patientData.patient_details.id;
      state.ipdId = patientData.id;
  },
  [types.SET_IPD_DATA] (state, ipdData) {
      state.ipdData = ipdData;
  },
  [types.SET_OPD_DATA] (state, opdData) {
      state.opdData = opdData;
  },
  [types.SET_OPD_RESULT_DATA] (state, resultData) {
      state.opd_resultData = resultData;
  },
  [types.SET_RADIO_DATA] (state, radioData) {
      state.radioData = radioData;
  },
  [types.SET_NEURO_DATA] (state, neuroData) {
      state.neuroExaminationData = neuroData;
  },
  [types.SET_VASC_DATA] (state, vascData) {
      state.vascExaminationData = vascData;
  },
  [types.SET_EXAMINATION_DATA] (state, examinationData) {
      state.examinationData = examinationData;
  },
  [types.SET_LAB_REPORT_DATA](state, labData){

      state.laboratoryData = {'type':labData};
  },
  [types.SET_REFFEREL_REPORT_DATA](state, refData){
      state.refferelReportData = refData;
  },
  [types.SET_Step4_DATA](state, step4data){

      state.step4Data = step4data;
  },
  [types.SET_Provisional_Diagnosis](state, provisionalDiagnosis){

      state.provisionalDiagnosis = provisionalDiagnosis;
  },
  [types.SET_Diagnosis](state, diagnosis){

      state.diagnosis = diagnosis;
  },
  [types.SET_PATIENT_CASE](state, patientCase){
      state.patientCase = patientCase;
  },
  [types.RESET_OPD_FORM] (state) {
      state.opdData = {};
      state.opd_resultData = {};
      state.radioData = {};
      state.prescriptionData = {};
      state.laboratoryData = {};
      state.neuroExaminationData = '';
      state.vascExaminationData ='' ;
      state.refferelReportData={};
      state.step4Data={};
      state.patientCase = '';
      state.patientData={};
      state.provisionalDiagnosis = '';
      state.diagnosis = '';
      state.examinationData = '';

  },
  [types.RELOAD_OPD_FORM] (state) {
    // console.log(patientData)
      state.opdData = {};
      state.opd_resultData = {};
      state.radioData = {};
      state.prescriptionData = {};
      state.laboratoryData = {};
      state.neuroExaminationData = '';
      state.vascExaminationData ='' ;
      state.refferelReportData={};
      state.step4Data={};
      state.patientCase = '';
      state.patientData={};
      state.provisionalDiagnosis = '';
      state.diagnosis = '';
      state.patientId='';
      state.opdId='';
      state.caseId='';
      state.setErrorData={'error':false,'steps':''};
      state.setPage='ADD';
      state.examinationData = '';
      state.opdSubmit = false;
      state.otherPId=0;
  },
  [types.SAVE_OPD_DATA] (state) {
  },
  [types.SAVE_OPD] (state,oData) {
    state.saveOpd = oData;
  },
  [types.SET_PRESCRIPTION_DATA] (state,pData) {
    state.prescriptionData = pData;
  },
  [types.RESET_ERROR_DATA] (state) {
    state.setErrorData= {
      'error':false,
      'steps':''
    }
  },
  [types.OPD_SUBMIT] (state,data) {
    state.opdSubmit = data;
  },
}

export default {
  state,
  // getters,
  actions,
  mutations
}