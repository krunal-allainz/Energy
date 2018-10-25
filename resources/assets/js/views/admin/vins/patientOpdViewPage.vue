<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h3>Patient Details Page</h3>
				</div>
			</div>
		</div>
		<div>
			  <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link mt-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                           Personal  Info
                        </button>
                      </h5>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                       <patientDetailView :patientinfo="showPatientDetail.patientDetail"></patientDetailView>
                        </div>
                    </div>
                     <h5 class="mb-0">
                        <button class="btn btn-link mt-0" data-toggle="collapse" data-target="#collapseeight" aria-expanded="true" aria-controls="collapseeight">
                           Patient  CheckUp Info
                        </button>
                      </h5>
                    <div id="collapseeight" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                       <patientCheckupViewDetail :patientCheckupDetail="showPatientDetail.patientCheckupDetail"></patientCheckupViewDetail>
                        </div>
                    </div>
                    <h5 class="mb-0">
                        <button class="btn btn-link mt-0" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
                           Case Detail
                         </button>
                     </h5>
                     <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <patientCaseDetail :patientCaseDetail="showPatientDetail.patientCaseDetail"></patientCaseDetail>
                        </div>
                    </div>
                      <h5 class="mb-0" >
                        <button class="btn btn-link mt-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                           OPD Details
                         </button>
                     </h5>
                     <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                         <patientOPDDetailInfo :patientOPDDetail="showPatientDetail.opdOptionDetails" :advice="showPatientDetail.advice" :history="showPatientDetail.history" :past_history="showPatientDetail.past_history" :follow_up="showPatientDetail.opdOptionDetails.follow_up" :provisonal_daignostic="showPatientDetail.opdOptionDetails.provisional_diagnosis"></patientOPDDetailInfo> 
                        </div>
                    </div>
                      <h5 class="mb-0" >
                        <button class="btn btn-link mt-0" data-toggle="collapse" data-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                           Referal Data
                         </button>
                     </h5>
                     <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <labDataViewDetail :labReferalData="showPatientDetail.opdReferalLaboraryData" :printType='lab'></labDataViewDetail>
                        <reportViewDetail :radiologyReferalReportData="showPatientDetail.opdReferalRadiologyData" :printType='radio'></reportViewDetail>
                          <patientCrossReferalViewDetail :CrossReferalData="showPatientDetail.opdReferalCrossData"></patientCrossReferalViewDetail>
                        </div>
                    </div>
                      <h5 class="mb-0" >
                        <button class="btn btn-link mt-0" data-toggle="collapse" data-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                           Investigation 
                         </button>
                     </h5>
                     <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <labDataViewDetail :labReportData="showPatientDetail.opdLabData" :printType='investigationLab'></labDataViewDetail>
                        <reportViewDetail :radiologyReportData="showPatientDetail.opdRadiologyData" :printType='investigationRadio'></reportViewDetail>

                        </div>
                    </div>
                      <h5 class="mb-0" >
                        <button class="btn btn-link mt-0" data-toggle="collapse" data-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                           Examination
                         </button>
                     </h5>
                     <div id="collapseSix" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <examinationviewDetail :examData="showPatientDetail.opdExaminationData"></examinationviewDetail>
                        </div>
                    </div>
                    <h5 class="mb-0" >
                        <button class="btn btn-link mt-0" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                           Prescription
                         </button>
                     </h5>
                     <div id="collapseSeven" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <patientPrescriptionDetail :prescriptData="showPatientDetail.opdprescriptionData"></patientPrescriptionDetail>
                        </div>
                    </div>
                    <h5 class="mb-0" >
                        <button class="btn btn-link mt-0" data-toggle="collapse" data-target="#collapseEight" aria-expanded="true" aria-controls="collapseSeven">
                           Diagnosis
                         </button>
                     </h5>
                     <div id="collapseEight" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <diagnosisReportData :data="showPatientDetail.opdOptionDetails.diagnosis"></diagnosisReportData>
                        </div>
                    </div>
                </div>
	            </div>
			</div>
		</div>
	</div>
</template>
<script>
	import User from '../../../api/users.js';
	import patientDetailView from './patientDetailView.vue';
    import patientOPDDetailInfo from './patientOPDDetailInfo.vue';
    import patientCaseDetail from './patientCaseDetail.vue';
    import patientPrescriptionDetail from './prescriptionReportData.vue';
    import examinationviewDetail from './examinationOrgReportData.vue';
    import labDataViewDetail from './labDataViewDetail.vue';
    import reportViewDetail from './reportViewDetail.vue';
    import patientCrossReferalViewDetail from './patientCrossReferalViewDetail.vue';
    import patientCheckupViewDetail from './patientCheckupViewDetail.vue';
    import diagnosisReportData from './diagnosisReportData.vue';
	    export default {
       // props: ['patientId','opdId','showPatientDetail'],
        data() {
            return {
                'patientId' : this.$store.state.Patient.patientId,
                'caseId' :this.$store.state.Patient.caseId, 
                'page' :this.$store.state.Patient.setPage,
                'investigationRadio' : 'investigationRadio',
                'investigationLab' : 'investigationLab',
                'radio' : 'radio',
                'lab' : 'lab',
                'showPatientDetail' : {
                    'opdDetails' : '',
                    'patientCaseDetail' : '',
                    'patientDetail' : '',
                    'opdOptionDetails' : '',
                    'opdReferalphysioData': '',
                    'opdExaminationData': '',
                    'opdReferalCrossData' : '',
                    'opdReferalLaboraryData' : '',
                    'opdReferalRadiologyData': '',
                    'opdLabData' : '',
                    'opdRadiologyData' : '',
                    'opdprescriptionData' : '',
                    'advice' : {},
                    'history' : {},
                    'past_history' : {},
                    'patientCheckupDetail' : {},
                    'prescriptionclockDetail' : '',
                    'diagnosis':'',
                }
            }
        },
         components: {
            patientDetailView,
            patientOPDDetailInfo,
            patientCaseDetail,
            examinationviewDetail,
            labDataViewDetail,
            reportViewDetail,
            patientPrescriptionDetail,
            patientCrossReferalViewDetail,
            patientCheckupViewDetail,
            diagnosisReportData
          },
         mounted(){
            var vm = this;
            if(vm.page == 'VIEW'){
                 $("div").removeClass("modal-backdrop fade show");
                vm.getPatientInfo(vm.patientId,vm.caseId);
            }
         },
         methods: {

             getPatientInfo(patientInfo,caseId)   {
                var vm =this;
                
                vm.patientId = patientInfo;
                User.getPatientDetailAndCaseInfo(vm.patientId,vm.caseId).then(
                  (response) => { 
                    if(response.data.code == 200){
                        var vm = this;
                        User.generatePatientCheckUpDetails(vm.caseId).then(
            							(response) => {
          	  							if(response.data.code == 200){
          	  							vm.showPatientDetail.patientCheckupDetail = response.data.data;
          	  							}
          	  						},
  	  							   (error) => {
  									    },
						  	     ); 
                       
                       vm.showPatientDetail.patientDetail = response.data.data.patientDetail;
                       
                       vm.showPatientDetail.patientCaseDetail = response.data.data.caseDetail;
                       vm.showPatientDetail.opdprescriptionData =  response.data.data.opdprescriptionData;
                       //vm.showPatientDetail.prescriptionclockDetail = response.data.data.prescriptionclockDetail;

                      if(response.data.data.opdExaminationData){
                      vm.showPatientDetail.opdExaminationData = response.data.data.opdExaminationData;
                    }
                    if(response.data.data.opdReferalLaboraryData){
                      vm.showPatientDetail.opdReferalLaboraryData = response.data.data.opdReferalLaboraryData;
                    }
                    if(response.data.data.opdReferalRadiologyData){
                        vm.showPatientDetail.opdReferalRadiologyData = response.data.data.opdReferalRadiologyData;
                    }
                    if(response.data.data.opdReferalCrossData){
                      vm.showPatientDetail.opdReferalCrossData = response.data.data.opdReferalCrossData;
                    }
                    if(response.data.data.opdLabData){
                      vm.showPatientDetail.opdLabData = response.data.data.opdLabData;
                    }
                    if(response.data.data.opdRadiologyData){
                      vm.showPatientDetail.opdRadiologyData = response.data.data.opdRadiologyData;
                    }
                     if(response.data.data.opdOptionDetails){
                      vm.showPatientDetail.opdOptionDetails = response.data.data.opdOptionDetails;
                    }
                     if(response.data.data.adviceData){
                      vm.showPatientDetail.advice = response.data.data.adviceData;
                    }
                    if(response.data.data.historyData){
                      vm.showPatientDetail.history = response.data.data.historyData;
                    }
                    if(response.data.data.past_historyData){
                      vm.showPatientDetail.past_history = response.data.data.past_historyData;
                    }

                     }else{
                        toastr.error('Record not found', 'Error', {timeOut: 5000});
                     }
                  },
                  (error) => {
                     },
                  );
              },
           }
      }
</script>