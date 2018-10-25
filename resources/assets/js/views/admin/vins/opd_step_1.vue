<template id="">
  <div class="container">
    <div class="page-header">
      <div class="row text-center">
        <div class="col-md-12">
          <h1>OPD Form <i class="fa fa-refresh red" title="Refresh opd form" aria-hidden="true" @click="reloadOpdForm()"></i></h1>
        </div>
      </div>
    </div>
    <div class="row">
      <step-progress-bar :curstep="curStep"></step-progress-bar>
    </div>
    <form action="" method="post" id="opd_form_id" enctype="multipart/formdata" >
      
      <div v-if="curStep == 1">
         <span v-if="pageName=='EDIT'">
          <div class="row form-group">
            <div class="col-md-12">
                 <div class="col-md-6">
                  <div class="col-md-6 ">
                    <label for="date">Patient Name</label>
                  </div>
                  <div class="col-md-6">
                    <label>{{patient_name}}</label>
                  </div>  
                </div>
            </div>
          </div>
      </span>
      <span v-else>
        <div class="row form-group" v-show="patient_select_enable==true">
          <div class="col-md-6">
            <div class="col-md-6 ">
              <label for="patient">Select Patient:</label>
            </div>
            <div class="col-md-6">
              <select  class="form-control ls-select2"  id = "patient" name="patient" value="" > 
                    <option value="">Select </option>
                   <option :value="pat.id" v-for="pat in opdData.patient_option">{{pat.name}}</option>
                </select> 
            </div>
          </div>
        </div>
          <div v-if="isPatientSearch">
            <patientSearch v-if="patient_select_enable==false" :user_id="doctor_id" ref="opd_form"></patientSearch>
          </div>
          <div class="row form-group">
            <div class="col-md-6" v-if="patient_select_enable==true">
              <div class="col-md-6">
                <button type="button" class="btn btn-primary" @click="patient_select_change(true)">Search Patient By Another</button>
              </div>
            </div>
            <div class="col-md-6" v-if="patient_select_enable==false">
              <div class="col-md-6">
                <button type="button" class="btn btn-primary" @click="patient_select_change(false)">Select Patient</button>
              </div>
            </div>
          </div>   
        </span>
          <div class="row form-group" v-show="(opdData.last_vist != '')">
            <div class="col-md-6">
              <div class="col-md-6" >
                <div class="col-md-6 ">
                  <label for="opd_no">Last Visit:</label>
                </div>
                 <div class="col-md-9">
                  {{opdData.last_vist}}
                 </div>
              </div>
            </div>
            <div class="col-md-6">
                 <div class="col-md-6">
                  <div class="col-md-6 " v-if="opdData.uhid_no!=''" >
                    <label for="date">UHID No:</label>
                  </div>
                  <div class="col-md-9" v-if="opdData.uhid_no!=''" >
                   <!--  <input type="text" class="form-control"  v-model="opdData.uhid_no" readonly=""> -->
                    <label>{{opdData.uhid_no}}</label>
                  </div>  
                </div>
            </div>
          </div>      
         
          <div class="row form-group">
            <div class="col-md-6">
              <div class="col-md-6">
                <label for="date">Weight:</label>
              </div>
              <div class="col-md-6">
                <input type="text" name="weight" id="weight" class="form-control" v-model="opdData.weight"  placeholder="In kgs"   v-validate="'decimal:1|required|min_value:1||max_value:999'">
                  <i v-show="errors.has('weight')" class="fa fa-warning"></i> 
                  <span class="help is-danger" v-show="errors.has('weight')"> 
                    Please enter valid weight.</span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="col-md-6">
                  <label for="date">Height:</label>
                </div>
                <div class="col-md-9" v-if="(opdData.age > 18)">
                  <input type="text" name="height" id="height" class="form-control" placeholder="In cms" v-model="opdData.height"  v-validate="'required|numeric|min_value:1'">
                  <i v-show="errors.has('height')" class="fa fa-warning"></i> 
                    <span class="help is-danger" v-show="errors.has('height')"> 
                      Please enter valid height . </span>
                  </div>
                  <div class="col-md-9" v-if="(opdData.age <= 18)">
                  <input type="text" name="height" id="height" class="form-control" placeholder="In cms" v-model="opdData.height"  v-validate="'numeric|min_value:1'">
                  <i v-show="errors.has('height')" class="fa fa-warning"></i> 
                    <span class="help is-danger" v-show="errors.has('height')"> 
                      Please enter valid height . </span>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="col-md-6">
                    <label for="date">BMI:</label>
                  </div>
                  <div class="col-md-12">
                    <input type="text" name="bmi" id="bmi" class="form-control" readonly="" v-model="bmi_mod">
                    </div>
                  </div>
                </div>
                <hr>
                  <div class="row form-group">
                    <div class="col-md-6">
                      <div class="col-md-6">
                        <label for="date">Doctor:</label>
                      </div>
                      <div class="col-md-6">
                        <input type="text" name="doctor" id="doctor" class="form-control" readonly="" v-model="doctor">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="col-md-6">
                        <label for="date">Department:</label>
                      </div>
                      <div class="col-md-6">
                        <input type="text" name="department" id="department" class="form-control" readonly=""  v-model="department">
                      </div>
                    </div>
                  </div>
                  <div class="row form-group">
                  <div class="col-md-6">
                    <div class="col-md-6">
                      <label for="date">RESP/SPO2:</label>
                    </div>
                    <div class="col-md-6">
                      <input type="text" name="vitals" id="vitals" class="form-control" v-model="opdData.vitals"  v-validate="'required'">
                      <i v-show="errors.has('vitals')" class="fa fa-warning"></i> 
                      <span class="help is-danger" v-show="errors.has('vitals')">
                        Please enter valid vitals. </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-6">
                      <label for="date">Pulse:</label>
                    </div>
                    <div class="col-md-6" >
                      <div class=" input-group">
                        <input type="text" name="pulse" id="pulse" class="form-control" v-model="opdData.pulse"  v-validate="'required|numeric|min_value:1'"> 
                        <div class="input-group-append">
                            <span class="input-group-text ">/mm</span>
                        </div>
                      
                      </div>
                      <i v-show="errors.has('pulse')" class="fa fa-warning"></i>
                       <div class="help is-danger" v-show="errors.has('pulse')"> 
                        Please enter valid pulse.</div>
                    </div>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-6">
                    <div class="col-md-6">
                      <label for="date">BP:</label>
                    </div>
                    <div class="col-md-6">
                      <div class=" input-group"  v-if="(opdData.age > 18)">

                      <input type="text" name="bp_systolic" id="bp_systolic" class="form-control"  v-model="opdData.bp_systolic"  v-validate="'required|numeric|min_value:1'" maxlength="3" > 
                        <div class="input-group-append">
                            <span class="input-group-text ">/</span>
                        </div>
                        <input type="text" name="bp_diastolic" id="bp_diastolic" class="form-control"  v-model="opdData.bp_diastolic"  v-validate="'required|numeric|min_value:1'" maxlength="3">
                      
                      </div>
                       <div class=" input-group"  v-if="(opdData.age <= 18)">

                      <input type="text" name="bp_systolic" id="bp_systolic" class="form-control"  v-model="opdData.bp_systolic"  v-validate="'numeric|min_value:1'" maxlength="3" > 
                        <div class="input-group-append">
                            <span class="input-group-text ">/</span>
                        </div>
                        <input type="text" name="bp_diastolic" id="bp_diastolic" class="form-control"  v-model="opdData.bp_diastolic"  v-validate="'numeric|min_value:1'" maxlength="3">
                      
                      </div>
                     
                      <i v-show="errors.has('bp_systolic')" class="fa fa-warning"></i>
                      <span class="help is-danger" v-show="errors.has('bp_systolic') || errors.has('bp_diastolic')">
                        Please enter valid BP.
                      </span>
                    </div>
                  </div>
                 
                </div>

                <div class="row form-group">

                  <div class="col-md-6">
                    <div class="col-md-6">
                      <label for="date">Temp:</label>
                    </div>
                    <div class="col-md-6">
                      <div class=" input-group">
                      <input type="text" name="temp" id="temp" class="form-control number-with-validation"  v-model="opdData.temp" v-validate="'decimal:1|required|min_value:1|max_value:999'">
                        <div class="input-group-append">
                            <span class="input-group-text ">°F</span>
                        </div>
                      
                      </div>
                      <span class="help is-danger" v-show="errors.has('temp')">
                         Please enter valid temprature.
                      </span>
                    </div>
                  </div>
                </div>


    <div class="row">
      <div class="col-md-6">
        <h3>Pain Assessment</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2" @click="pain_value(0)"><img src="/assets/img/pain/P1.png" class="test"  v-bind:class="[opdData.pain_value==0 ? 'pain_select': '', 'pain_img'  ]"></div>
      <div class="col-md-2" @click="pain_value(2)"><img src="/assets/img/pain/P2.png"  v-bind:class="[opdData.pain_value==2 ? 'pain_select': '' , 'pain_img' ]"> </div>
      <div class="col-md-2" @click="pain_value(4)"><img src="/assets/img/pain/P3.png"   v-bind:class="[opdData.pain_value==4 ? 'pain_select': '', 'pain_img'  ]"></div>
      <div class="col-md-2" @click="pain_value(6)"><img src="/assets/img/pain/P4.png"   v-bind:class="[opdData.pain_value==6 ? 'pain_select': '', 'pain_img'  ]"></div>
      <div class="col-md-2" @click="pain_value(8)"><img src="/assets/img/pain/P5.png"   v-bind:class="[opdData.pain_value==8 ? 'pain_select': '', 'pain_img'  ]"></div>
      <div class="col-md-2" @click="pain_value(10)"><img src="/assets/img/pain/P6.png"   v-bind:class="[opdData.pain_value==10 ? 'pain_select': '', 'pain_img'  ]"></div>
    </div>

      <div class="row form-group">
        <div class="col-md-6">
            <div class="col-md-12">
              <label for="history">History type:</label>
              <button type="button" class="btn btn-submit" @click="setHistoryType('present','text')">Text</button>
              <button type="button" class="btn btn-warning" @click="setHistoryType('present','scribble')">Scribble</button>
            </div>
        </div>
        
      </div>
      <div class="row form-group">
        <div class="col-md-6">
            <div class="col-md-6">
              <label for="history">History: </label>
            </div>
            <div class="col-md-12" v-show="opdData.historyType == 'text'">
              <textarea name="history"  id="history" class="form-control"  v-model="opdData.history" cols=""></textarea> 
            </div>
            <div class="col-md-12" v-show="opdData.historyType == 'scribble'">
              <div id="signature-pad" class="signature-pad">
                <div class="signature-pad--body">
                  <canvas class="can-img w-100" id="history_scribble"  ></canvas> 
                </div>
                <div><button type="button" id="clear_history_scribble" class="btn btn-md btn-danger">Clear</button>
                <button type="button" id="save_history_scribble" class="btn btn-md btn-primary">Save</button></div>

              </div>
            </div>
        </div>
        <div class="col-md-6" v-if="opdData.signaturePad_src!='' && opdData.historyType != 'text' && opdData.signaturePad_src!== null">
          <div class="col-md-12">
              <label for="history">History Preview:     <i class="fa fa-download fa-lg red" @click="download(opdData.signaturePad_src,'History')" aria-hidden="true"></i></label>
            </div>
            <div>
              <img :src="opdData.signaturePad_src" title="past history">
            </div>  
        </div>
      </div>

      <div class="row form-group">
        <div class="col-md-6">
            <div class="col-md-12">
              <label for="history">Past History type:</label>
              <button type="button" class="btn btn-submit" @click="setHistoryType('past','text')">Text</button>
              <button type="button" class="btn btn-warning" @click="setHistoryType('past','scribble')">Scribble</button>
            </div>

        </div>
      </div>
      <div class="row form-group">
        <div class="col-md-6">
            <div class="col-md-6">
              <label for="history">Past History:</label>
            </div>
            <div class="col-md-12" v-show="opdData.pastHistoryType == 'text'">
              <textarea name="history"  id="history" class="form-control"  v-model="opdData.past_history" cols=""></textarea> 
            </div>
            <div class="col-md-12" v-show="opdData.pastHistoryType == 'scribble'">
              <div id="signature-pad1" class="signature-pad">
                <div class="signature-pad--body">
                  <canvas class="can-img w-100" id="past_history_scribble" ></canvas> 
                </div>
                <div>
                  <button type="button" id="clear_past_history_scribble" class="btn btn-md btn-danger">Clear</button>
                  <button type="button" id="save_past_history_scribble" class="btn btn-md btn-primary">Save</button>
                </div>
              </div>
            </div>
        </div>
         <div class="col-md-6" v-if="opdData.signaturePad1_src!='' && opdData.pastHistoryType != 'text' && opdData.signaturePad1_src!== null">
          <div class="col-md-12">
              <label for="history">Past history Preview:  <i class="fa fa-download fa-lg red" @click="download(opdData.signaturePad1_src,'Past history')" aria-hidden="true"></i></label>
            </div>
            <div>
              <img :src="opdData.signaturePad1_src" title="past history">
            </div>  
        </div>
      </div>
    </div>
    <div class="row" v-if="curStep == 2"> 
       <OPDStep2></OPDStep2>
    </div>
    <div class="row form-group"  v-if="curStep == 3">
        <OPDStep3 :labData="laboratoryALLData"></OPDStep3>
    </div>
    <div class="row form-group"  v-if="curStep == 4">
        <OPDStep4 :doctor="doctor" :validatorErrorArray="validateErrors"></OPDStep4>
    </div>
    <div class="row form-group">
      <div class="col-md-6">
        <button type="button" class="btn btn-primary btn-submit text-right " @click="next()" v-if="curStep==1">Next</button>
      </div>
    </div>
    </form>
  </div> 
</template>

<script >
    var resData1=[];

  import User from '../../../api/users.js';
  import createPatientDetail from './createPatientDetail.vue';
  import OPDStep2 from './opd_step_2.vue';
  import OPDStep3 from './investigation.vue';
  import OPDStep4 from './opd_step_4.vue';
  import SignaturePad from 'signature_pad';
  import patientSearch from './patientSearchData.vue';
  import _ from 'lodash';
  import card from "./card.vue";
  import stepProgressBar from './stepProgressBar.vue';

      var  medicine ;
      var  timeList ;
      var patient_list = [];
      var b=0;
    export default {
        data() {
            return {
              'footer' : 'footer',
              'pageName':'ADD',
              'laboratoryALLData':[],
              'patient_name':'',
              'validateErrors':{},
              'currentYear': new Date().getFullYear(),
              'type': 'opdForms',
              'doctor':this.$store.state.Users.userDetails.first_name + " "+ this.$store.state.Users.userDetails.last_name ,
              'doctor_id':this.$store.state.Users.userDetails.id,
              'department':this.$store.state.Users.userDetails.department,
              'user_type':this.$store.state.Users.userDetails.user_type,
              'finalResultData':{},
              'patient_select_enable':true,
              'isPatientSearch':true,
              'curStep':1,
              'totalStep':4,
              'case_id':'',
              'patient_id':'',
              'patientCase' : {
                'id': '',
                'type' : '',
                'status' : '',
                'token_no' : '',
                'token_date' : '',
                'consult_dr' : '',
              },
              'setErrorData': {
                'error':false,
                'steps':''
              },
              'setLocalErrors':false,
              'opdData': {
                'pain_value':0,
                'patientlist':'',
                'patient_option':[],
                'case_id':'',
                'case_type': '',
                'uhid_no': '',
                'name':'',
                'age':'',
                'gender':'',
                'history':'',
                'historyType': 'scribble',
                'past_history':'',
                'pastHistoryType': 'scribble',
                'signaturePad':{},
                'signaturePad_src':'',
                'signaturePad1_src':'',
                'weight':'',
                'height': '',
                'bmi':'',
                'vitals':'',
                'pulse':'',
                'bp_systolic':'',
                'bp_diastolic':'',
                'temp':'',
                'last_vist' : '',
                'patientCaseType':'',
                'physio_details':'',
                'laboratoryALLData':[],
                'signaturePad1':{}
              },
          }
        },
        components: {
         createPatientDetail,
         OPDStep2,
         card,
         patientSearch,
         OPDStep3,
         OPDStep4,
         stepProgressBar
       },
        computed: {
          bmi_mod() {
            if(this.opdData.weight!='' && this.opdData.height!=''){
              var height_met = this.opdData.height / 100;
              var bmiVal = (this.opdData.weight )/(height_met * height_met);
              var bm_val=bmiVal.toFixed(1);
              this.opdData.bmi=bm_val;
              return bm_val;
            } else {
              return 0;
            }
          },

       },
       created: function() {
             this.$root.$on('SetUhidNo', this.updateUhidNo);
             this.$root.$on('prev', this.prev);
             this.$root.$on('next', this.next);
             this.$root.$on('patientData',this.setPatientData);
             this.$root.$on('patientEmpty',this.patientEmpty);
             this.$root.$on('check_validation',this.check_validation);
             this.$root.$on('setCurSteps',this.setCurSteps);
             this.$on('mountedMethod',this.mounted);
        },
        
        mounted(){
         var vm =this;
          if(vm.$store.state.Users.userDetails.user_type != '1'){
              vm.$root.$emit('logout','You are not authorise to access this page'); 
          }
          $('.ls-select2').select2({
            placeholder: "Select",
            tags:false 
          });
          let opd_list_new=[];

          
          vm.$store.dispatch('resetOpdForm');
          if(vm.setLocalErrors == false){
              vm.$store.dispatch('resetErrorData');
          }

         /*for laboratory data*/
            let labpratory_all_data=[];
            User.generateAllLaboratoryListByChild().then(
              (response) => {
                let lab_data = response.data.data;
                vm.laboratoryALLData = lab_data;
                $('#laboratory_report_opd').select2({
                  placeholder: 'Select',
                  data:lab_data
                });
              },
              (error) => 
              {
              },
            );
          setTimeout(function(){
            vm.doctor = vm.$store.state.Users.userDetails.first_name + " "+ vm.$store.state.Users.userDetails.last_name;  
            vm.doctor_id = vm.$store.state.Users.userDetails.id;  
          },1000);
          $(document).on("select2:select",'.ls-select2', function (e) {
             if($(this).val() == 'old') {
             } 
             else if($(this).val() == 'new') {
                setTimeout(function(){
                $('#createPatientDetail').modal('show');  
             },500)
            }
          });
       
         
          setTimeout(function(){

            $('#patient').select2({
              placeholder: "Select",
              tags:false 
            });
          },500);
          $(document).on("select2:select",'#patient', function (e) { 
            vm.patientEmpty();
            vm.opdData.patientlist=$(this).val();
            vm.patient_id=$(this).val();
            let pId = $(this).val();
            vm.opdData.patientlist=pId;
            vm.$store.dispatch('SetPatientId',pId);
            vm.getAgeOfPatient(pId);
            vm.get_vitals();


          });
          $(document).on('hidden.bs.modal','#createPatientDetail', function () {
            $('#case_type').val('old').trigger('change.select2');
            vm.opdData.case_type = 'old';
             // if(vm.patientCase.type == follow_ups){
             // //vm.setUpdateData();
             // console.log('test')
             //  }
          });
          setTimeout(function(){
            vm.examinationChangeImage();
          },500);
          // vm.getResults();
          vm.getResults();
          vm.newPatient();
          vm.initData();

        },
        methods: {
          initData()
          {
            let vm=this;
              if(vm.$store.state.Patient.setPage=='EDIT')
              {
                  vm.pageName='EDIT';
                  $('#patient').select2('destroy');
                  vm.setUpdateData();
              }
              else if(vm.$store.state.Patient.setPage=='PLIST')
              {
                  vm.patient_id= parseInt(this.$store.state.Patient.patientId);
                  vm.opdData.patientlist=vm.patient_id;
                  $('#patient').val(vm.opdData.patientlist).trigger('change');
                  if(vm.opdData.patientlist)
                  {
                      vm.getAgeOfPatient(vm.patient_id);
                      vm.get_vitals();
                  }
                  
              }
          },
          setUpdateData()
          {
              var vm =this;
              vm.patient_id= vm.$store.state.Patient.patientId;
              vm.case_id= vm.$store.state.Patient.caseId;
              vm.opdData.signaturePad="";
              vm.opdData.signaturePad1="";
            
              User.getUPdateOPDCaseInfo(vm.patient_id,vm.case_id).then(
              (response) => {
                if(response.data.code==200)
                {
                    let all_opd_data=response.data.data;

                    vm.opdData=all_opd_data.opdData;
                    vm.opdData.signaturePad={};
                    vm.opdData.signaturePad1={};
                    vm.patient_name=_.cloneDeep(all_opd_data.patient_name);
                    //vm.$store.dispatch('setOpdData',all_opd_data.opdData);
                    vm.$store.dispatch('saveExaminationData',all_opd_data.examinationData);
                    vm.$store.dispatch('saveProvisionalDiagnosis',all_opd_data.provisionalDiagnosis);
                    vm.$store.dispatch('saveLabReportData',all_opd_data.laboratoryData);
                    vm.$store.dispatch('saveRadioData',all_opd_data.radioData);
                    vm.$store.dispatch('saveStep4Data',all_opd_data.step4Data);
                    vm.$store.dispatch('saveDiagnosis',all_opd_data.diagnosis);
                    vm.$store.dispatch('saveReferralReportData',all_opd_data.reffData);
                    vm.$store.dispatch('setPrescriptionData',all_opd_data.prescriptionData);
                    vm.$store.dispatch('setOtherPrescCount',all_opd_data.other_pid);

                      setTimeout(function(){
                        vm.examinationChangeImage();
                      },500)
                }
               
              },
              (error) => 
              {
              },
            );
          },
          reloadOpdForm()
          {
            this.$store.dispatch('reloadOpdForm');
            location.reload();
          },
          setCurSteps(step){
            let vm = this;
                vm.setLocalErrors = true;
                vm.curStep = step;  
                vm.opdData =  _.cloneDeep(vm.$store.state.Patient.opdData);
                vm.resultData = _.cloneDeep(vm.$store.state.Patient.opd_resultData);
                if(vm.patient_select_enable==true)
                {
                 $('#patient').val(vm.opdData.patientlist).trigger('change:select2');
                }
                vm.initLastData();
                if(step == 1)
                {  
                  setTimeout(function(){
                      vm.opdFormCheck(step);
                  },500);
                }
          },
          opdFormCheck(step)
          {
            let vm =this;
            
                vm.$validator.validateAll().then(
                (response) => {
                 if (!this.errors.any()) {
                    let setErrorData={'error':false,'steps':''};
                    vm.$store.dispatch('setErrorData',setErrorData);
                 }
                 else
                 {
                    toastr.error('Please enter all required fields.', 'Error', {timeOut: 5000});
                 }
                  
               },
               (error) => {
                }
              )
            
               
              // return false;
              
          },
           getAgeOfPatient(patientId){
           var vm =this;
           var getpatientId = patientId;
          
           User.getAgeOfPatient(getpatientId).then(
            (response) => {
               
               var patientAge = '';
               if(response.data.data.age > 999){
                 patientAge = vm.currentYear - patientAge ; 
                 if(patientAge == 0){
                   vm.opdData.age =  1  
                 }else
                 vm.opdData.age = patientAge;
               }else{
                patientAge = response.data.data.age;
               }
                vm.opdData.age = patientAge;  
              
                 },
            
            );

         },
          newPatient()
          {
              var vm =this;
              
             // setInterval(function() {

                 vm.getResults();
                // $('#patient').select2('destroy');
                 $('#patient').select2({
                    placeholder: "Select",
                    tags:false 
                  });

              //}, 8000);

            },
          getResults(patient_list_new) {
            var vm =this;
            var patient_list_new=[];
            let section = 'OPD';
             User.getAllPatientName(vm.user_type,vm.doctor_id).then(
                   (response) => {
                    vm.opdData.patient_option=[];
                      let patien_data=response.data.data;
                      $.each(patien_data, function(key, value) {
                      let name = value.first_name +' '+value.last_name;
                      let pid  = value.id ;
                      let uhid_no  = value.uhid_no ;
                      patient_list_new.push({
                          name:name,
                          id:pid,
                          uhid_no:uhid_no
                        });
                      });

                      vm.opdData.patient_option=_.cloneDeep(patient_list_new);
                        
                     },
                      (error) => {
                  },
                   );
             
            
          },
          patient_select_change(val)
          {
            let vm =this;
            vm.opdData.patientlist="";
            vm.patient_id="";
            vm.patientEmpty();
              if(val==true)
              {
                vm.patient_select_enable=false;
                $('#patient').val('').trigger('change.select2');
                $('#patient').select2('destroy');
              }
              else
              {
                
                vm.isPatientSearch =false;
                setTimeout(function(){
                  vm.isPatientSearch  =true;
                },500);
                vm.patient_select_enable=true;
                 setTimeout(function(){
                  $('#patient').select2({
                    placeholder: "Select",
                    tags:false 
                  });
                },500);
              
              }

          },
          patientEmpty()
          {
              let vm =this;
              vm.opdData.last_vist="";
              vm.opdData.patientlist="";
              vm.patient_id="";
              vm.opdData.uhid_no="";
              vm.opdData.weight="";
              vm.opdData.height="";
              vm.opdData.bmi="";
              vm.opdData.vitals="";
              vm.opdData.pulse="";
              vm.opdData.bp_systolic="";
              vm.opdData.bp_diastolic="";
              vm.opdData.temp="";
              vm.opdData.pain_value=0;
              
              
          },
          pain_value(pain){
            this.opdData.pain_value = pain;
          },
          setPatientData(patientData) {
            let vm=this;
            vm.patientEmpty();
            if(patientData.code==200)
            {
              let pDetails=patientData.searchdata;
              //for opd list
                vm.opdData.uhid_no=pDetails.uhid_no;
                vm.opdData.patientlist=pDetails.id;
                vm.patient_id=pDetails.id;
                vm.get_vitals();
            }
            else if(patientData.code==300)
            {
              toastr.error('Record not found', 'Error', {timeOut: 5000});
              this.initPatientData();
            }
            else
            {
              toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
              this.initPatientData();
            }
          },
          getPatientCaseAndTokenDetailByCaseId(caseID){
            let vm=this;
            User.getPatientCaseAndTokenDetailByCaseId(caseID).then(
               (response) => {
                if(response.data.code == 200){
                  vm.patientCase.id =response.data.data.caseId;
                  vm.patientCase.type = response.data.data.case_type;
                  vm.patientCase.status = response.data.data.status;
                  vm.patientCase.token_no =  response.data.data.token;
                  vm.patientCase.main_case_id  = response.data.data.main_case_id;
                  vm.patientCase.token_date = response.data.data.date;
                  vm.patientCase.consult_dr = response.data.data.consultant_id;
                }
               },
               (error) => {
                    },

              );

          },
          get_vitals()
          {
             let vm=this;
              //for uhid
                if(vm.opdData.patientCaseType == 'follow_ups'){
                   $('#patient').select2('destroy');
                   vm.setUpdateData();
                }
                User.generatePatientDetailsByID(vm.opdData.patientlist).then(
                    (response) => {
                      let patient_data=response.data.data;
                      vm.opdData.uhid_no =patient_data.uhid_no;
                    },
                    (error) => {
                    },
                );
                //for opd list
                User.getPatientCaseDetailsByPatientId(vm.opdData.patientlist).then(
                    (response) => {
                      let caseID ;
                      caseID = response.data.data.id;
                      vm.case_id=caseID;
                      vm.opdData.case_id=caseID;
                      vm.getPatientCaseAndTokenDetailByCaseId(caseID);
                      vm.getPatientLastVisit(vm.opdData.patientlist);
                      vm.getCaseType(vm.opdData.patientlist);
                    },
                    (error) => {
                    },
                );
              User.getVitalsInfoByPatientId(vm.opdData.patientlist).then(
              (response) => {
                   let vitals_data=response.data.data;
                  if(vitals_data.code==200)
                  {
                      
                      let patient_checkup_details=vitals_data.data;
                      vm.opdData.height =patient_checkup_details.height;
                      vm.opdData.weight =patient_checkup_details.weight;
                      vm.opdData.bmi =patient_checkup_details.bmi;
                      vm.opdData.vitals =patient_checkup_details.vitals;
                      vm.opdData.pulse =patient_checkup_details.pulse;
                      if(patient_checkup_details.bp!="")
                      {
                        let bp =patient_checkup_details.bp.split("/");
                        vm.opdData.bp_systolic =bp[0];
                        vm.opdData.bp_diastolic =bp[1];
                       }
                      vm.opdData.temp =patient_checkup_details.temp;
                      vm.opdData.pain_value=patient_checkup_details.pain;
                      
                  }
                  else if(vitals_data.code==300)
                  {
                    //toastr.error('Record not found', 'Error', {timeOut: 5000});
                  }
                  else
                  {
                     //toastr.error('Something went wrong.', 'Error', {timeOut: 5000});
                  }
                },
                (error) => {
                },
            );
          },
          getPatientLastVisit(p_id)
          {
              let vm=this;
              User.getPatientLastVisitById(p_id).then(
                (response) => {
                  if(response.data.code==200)
                  {
                      let lastVist;
                      lastVist = response.data.data;
                      vm.opdData.last_vist=lastVist;
                  }
                   
                  },
                  (error) => {
                  },
              );
          },
          getCaseType(p_id)
          {
            let vm=this;
            User.getPatientCaseTypeOfLastVisit(p_id).then(
              (response) => {
                  let caseType;
                  caseType = response.data.data;
                  vm.opdData.patientCaseType=caseType;

              },
              (error) => {
                  },
            );

          },
          updateUhidNo(uhid) {
            let vm = this;
            vm.opdData.uhid_no = uhid;
          },
          prev(){
            let vm =this;
            // vm.$root.$emit('submitNeuroData');
            // setTimeout(function(){
              if(vm.curStep> 0){
                vm.curStep = vm.curStep-1;
              }  
            // },3000)
            
            vm.opdData =  _.cloneDeep(vm.$store.state.Patient.opdData);
            vm.resultData = _.cloneDeep(vm.$store.state.Patient.opd_resultData);
            vm.patientCase = _.cloneDeep(vm.$store.state.Patient.patientCase);
            if(vm.patient_select_enable==true)
            {
                 $('#patient').val(vm.opdData.patientlist).trigger('change:select2');
            }
            vm.initLastData();
          },
         
          next() {
            let vm =this;
            this.tpt = [];
            
            if(vm.curStep == 1){
              this.$validator.validateAll().then(
              (response) => {
                  if (this.errors.any()) {
                    vm.setErrorData = {'error':true,'steps':vm.curStep}
                  } else {
                    if(vm.setErrorData.steps == vm.curStep ){

                      vm.setErrorData = {'error':false,'steps':''}
                    }
                  }
                  vm.$store.dispatch('setErrorData',vm.setErrorData);
                  vm.onNextStep();
                },
                (error) => {
                }
                );
            } else {
              vm.onNextStep();
           }
          },
          onNextStep()
          {
              let vm =this;
              vm.curStep = vm.curStep+1;
              vm.$store.dispatch('setOpdData',vm.opdData);
              vm.$store.dispatch('setResData',vm.finalResultData);
              vm.$store.dispatch('setPatientCase',vm.patientCase);
              // vm.$store.dispatch('setErrorData',vm.setErrorData);
          },
          initLastData(){
            let vm = this;
            let p_list = _.cloneDeep(vm.opdData.patient_option);
            let pres = _.cloneDeep(vm.opdData.prescription);
            let labs = _.cloneDeep(vm.opdData.laboratoryALLData);
            setTimeout(function(){
              $('#prescription').val(p_list).trigger('change');
              //$('#patient').val(pres).trigger('change');

              $('.ls-select2').select2({
                placeholder: "Select",
                tags:false 
              });
               $('#laboratory_report_opd').select2({
                  placeholder: 'Select',
                  data: _.cloneDeep(labs)
                });
              if(vm.curStep == 1){
                vm.examinationChangeImage();
              } 

            },1500)
          }, 
          removeReport(did) {
                let vm =this;
                // _.pullAt(resData, 0);
                _.find(vm.finalResultData, function(res) {
                    if(res.id == did) {
                         res.removed = true;
                    }
                });
          },
          setHistoryType(res,type){
            var vm =this;
            if(res == 'present'){
              vm.opdData.historyType = type;
            } else if(res == 'past') {
              vm.opdData.pastHistoryType = type;

            }
            setTimeout(function(){
              if(type == 'scribble'){
                if(res == 'present'){
                  var canvas = document.getElementById("history_scribble");
                   vm.opdData.signaturePad = new SignaturePad(canvas, {
                    backgroundColor: 'rgb(255, 255, 255)',
                  });
                    window.onresize = vm.resizeCanvas;
                  vm.resizeCanvas(canvas);
                  vm.clearHistory('clear_history_scribble');

                  vm.saveHistory('save_history_scribble');

                } else {
                  // vm.opdData.signaturePad1="";

                  var canvas1 = document.getElementById("past_history_scribble");
                  vm.opdData.signaturePad1 = new SignaturePad(canvas1, {
                    backgroundColor: 'rgb(255, 255, 255)',
                  });
                  window.onresize = vm.resizeCanvas;
                  vm.resizeCanvas(canvas1);
                  vm.clearHistory('clear_past_history_scribble');

                  vm.saveHistory('save_past_history_scribble');
                }
              }
            },500)
            
          },
          
          resizeCanvas(canvas) {
              var ratio =  Math.max(window.devicePixelRatio || 1, 1);
              canvas.width = canvas.offsetWidth * ratio;
              canvas.height = canvas.offsetHeight * ratio;
               canvas.getContext("2d").scale(ratio, ratio);
            },
         dataURLToBlob(dataURL) {
              // Code taken from https://github.com/ebidel/filer.js
              var parts = dataURL.split(';base64,');
              var contentType = parts[0].split(":")[1];
              var raw = window.atob(parts[1]);
              var rawLength = raw.length;
              var uInt8Array = new Uint8Array(rawLength);
              for (var i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
              }
              return new Blob([uInt8Array], { type: contentType });
            },
          saveInformation() {

              this.$validator.validateAll().then(
              (response) => {
                if (!this.errors.any()) {
                   $("body .js-loader").removeClass('d-none');
                   var vm=this;
                    this.$store.dispatch('SetDoctorId',vm.doctor_id);
                   let res= vm.$store.dispatch('saveOpdData');
                   if(res=='success')
                   {
                   }
                  }
                },
                (error) => {
                }
                );
          },
          download(dataURL, filename) {
            var vm =this;
              var blob = vm.dataURLToBlob(dataURL);
              var url = window.URL.createObjectURL(blob);
              var a = document.createElement("a");
              a.style = "display: none";
              a.href = url;
              a.download = filename;
              document.body.appendChild(a);
              a.click();
              window.URL.revokeObjectURL(url);
            },
            decodeBase64Image(dataString) {
              var matches = dataString.match(/^data:([A-Za-z-+\/]+);base64,(.+)$/),
                response = {};

              if (matches.length !== 3) {
                return new Error('Invalid input string');
              }

              response.type = matches[1];
              response.data = new Buffer(matches[2], 'base64');

              return response;
            },
          examinationChangeImage() {
            var vm =this;
            vm.opdData.signaturePad="";
            vm.opdData.signaturePad1="";
            // savePNGButton.addEventListener("click", function (event) {
            // var wrapper = document.getElementById("signature-pad");
            // var wrapper1 = document.getElementById("signature-pad1");
            
            var canvas = document.getElementById("history_scribble");
            var canvas1 = document.getElementById("past_history_scribble");
            // var clear_history_scribble = document.getElementById("clear_history_scribble");
            // var clear_past_history_scribble = document.getElementById("clear_past_history_scribble");
            // var save_history_scribble = document.getElementById("save_history_scribble");
            // var save_past_history_scribble = document.getElementById("save_past_history_scribble");
            vm.opdData.signaturePad = new SignaturePad(canvas, {
              backgroundColor: 'rgb(255, 255, 255)',
            });
            vm.opdData.signaturePad1 = new SignaturePad(canvas1, {
              backgroundColor: 'rgb(255, 255, 255)',
            });
            
            window.onresize = vm.resizeCanvas;
            vm.resizeCanvas(canvas);
            vm.resizeCanvas(canvas1);
            vm.clearHistory('clear_history_scribble');
            vm.clearHistory('clear_past_history_scribble');
            vm.saveHistory('save_history_scribble');
            vm.saveHistory('save_past_history_scribble');
            // clear_history_scribble.addEventListener("click", function (event) {
            //   vm.opdData.signaturePad.clear();
            //   vm.opdData.signaturePad_src='';
            // });
            // clear_past_history_scribble.addEventListener("click", function (event) {
            //   vm.opdData.signaturePad1.clear();
            //   vm.opdData.signaturePad1_src='';
            // });
            // save_history_scribble.addEventListener("click", function (event) {
            //   vm.opdData.signaturePad_src = vm.opdData.signaturePad.toDataURL();
            // });
            // save_past_history_scribble.addEventListener("click", function (event) {
            //   vm.opdData.signaturePad1_src = vm.opdData.signaturePad1.toDataURL();
            // });
          },
          setSignaturePad(canvasData) {
            if(canvasData == 'history_scribble') {
              var canvas = document.getElementById(canvasData);
              vm.opdData.signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)',
              });
            } 
            if(canvasData == 'past_history_scribble') {
              var canvas = document.getElementById(canvasData);
              vm.opdData.signaturePad = new SignaturePad(canvas, {
                backgroundColor: 'rgb(255, 255, 255)',
              });
            }
           
          },
          clearHistory(data) {
            let vm =this;
            if(data == 'clear_history_scribble') {
              var clear_history_scribble = document.getElementById(data);
              clear_history_scribble.addEventListener("click", function (event) {
              vm.opdData.signaturePad.clear();
              vm.opdData.signaturePad_src='';
            });
            } else if(data == 'clear_past_history_scribble') {
              var clear_past_history_scribble = document.getElementById("clear_past_history_scribble");
              clear_past_history_scribble.addEventListener("click", function (event) {
              vm.opdData.signaturePad1.clear();
              vm.opdData.signaturePad1_src='';
            });
            }
            
          },
          saveHistory(data){
            let vm =this;
            if(data == 'save_history_scribble') {
               var save_history_scribble = document.getElementById(data);
                save_history_scribble.addEventListener("click", function (event) {
              vm.opdData.signaturePad_src = vm.opdData.signaturePad.toDataURL();
            });
          } else if(data == 'save_past_history_scribble') {
             var save_past_history_scribble = document.getElementById(data);
              save_past_history_scribble.addEventListener("click", function (event) {
              vm.opdData.signaturePad1_src = vm.opdData.signaturePad1.toDataURL();
            });
          }
        }
                      
    }
  }
        
</script>
