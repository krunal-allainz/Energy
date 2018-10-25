<template>
  <div class="container">
    <div class="page-header">
          <div class="row text-center">
            <div class="col-md-12">
                <h1>Report</h1>
            </div>
          </div>
      </div>
      <div class="page-body">
        <form action="" method="post">
          <div class="row form-group text-center">
            <div class="col-md-12">
              <button type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#generateModal"  @click="printReport('generate_case')" v-if="(opdReport == false)"> Print Report</button>
              <button type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal"  @click = "printReport('print_perceptions')"  id="opd_case_btn">Print Perceptions</button>
              <button   type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal" @click = "printReport('lab')" >Lab Report</button>
              <button   type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal" @click = "printReport('radiology')" >Radiology Report</button>
              <button  type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal" @click = "printReport('prescription')">Print Prescription</button>
            </div>
          </div>
        </form>
      <div id="generateModal" class="modal fade">
        <div class="modal-dialog" >
        <div class="modal-content" >
          <div class="modal-body">
          <div id="demo">
          <label><b>Select Report:</b></label>
          <ul>    
            <li v-for="mainCat in reportList">
              <input type="checkbox" :value="mainCat.reportListId" id="mainCat.reportListId" v-model="checkedreportList" @click="check($event)"> {{mainCat.reportListId}}
            </li>
          </ul>
          <span class="help is-danger" v-if="(reportListSelect == 1)">
                        Please select any report Type.
                  </span> 
        </div>
          <!-- <button type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal"  v-show="(checkedreportList.length != 0)" @click = "printReport('opd_case')" >OPD Case</button> -->
          <button type="button" class="btn btn-primary btn-submit text-right" @click="print_multiple_report()">Print</button>

          <button type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal"  v-show="(checkedreportList.length != 0)" @click = "printReport('opd_case')" >OPD Case</button>
          <!-- <button ty pe="button" lass="btn btn-primary btn-submit text-right" >Print</button> -->

          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
      </div>
      <div id="printModal" class="modal fade">
        <div class="modal-dialog" >
        <div class="modal-content" >
        <!--<div class="modal-header"></div>-->
        <div class="modal-body">
          <opdReportView :opdId="opdId" patinetId="patinetId" :todayDate="todayDate" :patientCheckupDetail="patientCheckupDetail" :signatureName="signatureName" :doctoreName="doctoreName" :regNo="regNo" :patientDetail="patientDetail" :department="department" :timeStamp="timeStamp" :reference="reference" :ReportPageData="ReportPageData" :printType="printType" :checkedreportList="checkedreportList" :reportListSelect="reportListSelect"></opdReportView>
          </div>
          <div class="modal-footer">  
            <button  type="button" class="btn btn-primary"  @click="ClickHereToPrint()">Print</button>  
                    <button type="button" class="btn btn-default" data-dismiss="modal" @click="clearSelection">Close</button>
                  <!--  <button type="button" class="btn btn-primary">Save</button>-->
                </div>  
          </div>
        </div>
      </div>
      </div>
  </div>
</template>
<script>
  import User from '../../../api/users.js';
  import vinsletterheadheaderpart from './vins_letter_header.vue';
  import vinsletterheadfooterpart from './vins_letter_footer.vue';
  import opdReportView from './opdReportView.vue';  import prescriptionPrint from './prescriptionPrint.vue';
  import moment from 'moment';
  import print from 'print-js'
  import _ from 'lodash';
  var myDate = new Date();
  var month = ('0' + (myDate.getMonth() + 1)).slice(-2);
  var date = ('0' + myDate.getDate()).slice(-2);
  var year = myDate.getFullYear();
  var formattedDate = date + '/' + month + '/' + year ;
  export default {
    data() {
      return{
        'printType' : '',
        'todayDate' : formattedDate,
        'opdId' : 1,
        'patinetId' : this.$store.state.Patient.patientId,
        'opdReport' : false,
        'consultntId' : '',
        'consultName' : '',
        'signatureName' : '',
        'doctoreName' :'',
        'timeStamp' : '',
        'regNo':'',
        'reportListSelect' : 0,
        'patientDetail' : {},
            'patientCheckupDetail' : {},
            'department': '',
            'reference' : '',
            'checkedreportList': [],
          'reportList': [{
               'reportListId': 'Advice + follow ups'
              }, {
                'reportListId': 'Radiology'
              }, {
                'reportListId': 'Laboratory'
              }, {
                'reportListId': 'Prescription'
              },
              {
                'reportListId': 'History' 
              },
              {
                'reportListId': 'Past History'  
              },
              {
                'reportListId': 'Investigation Lab'
              },
              {
                'reportListId': 'Investigation Radiology'
              },
               {
                 'reportListId': 'Examination'
               },
              {
                'reportListId': 'Referrals'
              }] ,
              'ReportPageData' : {
            'labReferalReportData' : {},
            'radiologyReferalReportData' : {},
            'ExaminationData' : '',
            'examinationData':'',
            'opdData' : {},
            'CrossReferalData' : {},
            'phisioyoData' : {},
            'labReportData' : {},
            'radiologyReportData' : {},
            'prescriptionReportData' : {},
          }
      }
    },
    components: {
         opdReportView,
       },
       mounted(){
        let vm =this;
        if(vm.$store.state.Users.userDetails.user_type != '1'){
              vm.$root.$emit('logout','You are not authorise to access this page'); 
          }
        if(vm.checkedreportList != null){
          vm.reportListSelect = 0;
         }else{
          vm.reportListSelect = 1;
        }
        vm.getOpdData(vm.opdId);
        vm.getPatientData(vm.patinetId);
       },
       methods: {
          clearSelection(){
            let vm = this;
            vm.checkedreportList = [];
            vm.printType = '';
          },
          printReport(type){
            let vm = this;
            vm.printType = type;
           if(type == 'opd_case'){
              $('#generateModal').modal({ show: false})
            }
          },
          getOpdData(opdId){
            let vm = this;
            User.getPatientOpdData(opdId).then(
              (response) => {
                vm.ReportPageData.opdData = response.data.data.opdOptionDetails;
                vm.ReportPageData.examinationData = response.data.data.opdExaminationData;
                vm.ReportPageData.ExaminationData = response.data.data.opdExaminationData;
                vm.ReportPageData.labReferalReportData = response.data.data.opdReferalLaboraryData;
                vm.ReportPageData.radiologyReferalReportData = response.data.data.opdReferalRadiologyData;
                vm.ReportPageData.CrossReferalData = response.data.data.opdReferalCrossData;
                vm.ReportPageData.labReportData = response.data.data.opdLabData;
                vm.ReportPageData.radiologyReportData = response.data.data.opdRadiologyData;
                vm.ReportPageData.prescriptionReportData = response.data.data.opdReferalLaboraryData;
              },
              (error) => {
              }
            );
          },
          getPatientData(patinetId)
      {
        var vm=this;
        User.generatePatientDetailsByID(patinetId).then(
            (response) => {
              if(response.data.code == 200){
                vm.patientDetail = response.data.data;
              }
            },
            (error) => {
            }
          );
          User.getOPDDetailsByPatientId(patinetId).then(
            (response) => {
              if(response.data.code == 200){
                vm.opdId = response.data.data.id;
                vm.sectionOpdId = response.data.data.opd_id;
                User.generatePatientCheckUpDetails(vm.opdId).then(
                (response) => {
                  if(response.data.code == 200){
                  vm.patientCheckupDetail = response.data.data;
                  }
                  var sectionOpdId = vm.sectionOpdId;
                User.getPatientCaseDetailByOpdId(sectionOpdId).then(
                  (response) => {
                    if(response.data.code == 200){
                    vm.reference = response.data.data.references;
                    vm.consultntId = response.data.data.consultant_id;
                    }
                    var userType = 1;
                    User.getDoctoreInfoById(vm.consultntId,userType).then(
                      (response) => {
                        if(response.data.code == 200){
                          var data = response.data.data;
                          //vm.signatureName = data.name;
                          vm.doctoreName = data.name;
                          vm.timeStamp =data.dagree;  
                          vm.department =data.department; 
                          vm.regNo =data.regNo;
                        }
                      },
                      (error) => {
                      }
                    );
                    User.generateUserNameById(vm.consultntId).then(
                      (response) => {
                      vm.consultName = response.data;
                      vm.signatureName = response.data;
                    },
                      (error) => {
                      },
                    ); 
        
                  },
                  (error) => {
                  }
                  );
                },
                (error) => {
                  }
                );
              }
            },
            (error) => {
            }
          );
      },
      GetSelectComponent(componentName) {
           this.$router.push({name: componentName})
        }
       }
  }
</script>