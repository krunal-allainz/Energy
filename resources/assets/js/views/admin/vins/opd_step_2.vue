<template>
  <div class="container">
    <div class="page-header">
      <div class="row">
        <div class="col-md-6">
        <h3>Examination</h3>  
        </div>
      </div>
    </div>
    <form action="" method="post">
     <div class="row form-group">
      <div class="col-md-6" >
        <div class="col-md-6">
          <label for="examination" class="control-label">Examination : </label>
        </div>
        <div class="col-md-12">
          <textarea  class="form-control"  id="examination" name="examination" value="" v-model="examinationData"  ></textarea>
        </div>
      </div>
     </div>
      <div class="row form-group">
            <div class="col-md-6">
              <div class="col-md-6">  
                <label for="date">Provisional Diagnosis:</label>
              </div>
              <div class="col-md-12">
                <textarea class="form-control" name="provisional_diagnosis" id="provisional_diagnosis" v-model="provisionalDiagnosis" v-validate="'required'"></textarea>
                <i v-show="errors.has('provisional_diagnosis')" class="fa fa-warning"></i>
                <span class="help is-danger" v-show="errors.has('provisional_diagnosis')">
                   Please enter provisional diagnostic.
                </span>
              </div>
            </div>
        </div>
     
          <div class="text-left row form-group">
         <div class="col-md-12">
           <button type="button" class="btn btn-primary btn-submit text-right " @click="prev()" >Previous</button>
           <button type="button" class="btn btn-primary btn-submit text-right ml-10" @click="next()" >Next</button>
        </div>
      </div>
    </form>
  </div>
</template>
<script >
  import User from '../../../api/users.js'
  import addressograph from './addressograph.vue';
  import patientReceiptForm from './patientsReceiptForm.vue';
  import SignaturePad from 'signature_pad';
  import _ from 'lodash';
    export default {
        data() {
            return {
                'setErrorData':{'error':false,'steps':''},
                'modal_val':0,
                'footer' : 'footer',
                'deleteConfirmMsg':'Are you sure you want to exit from receipt form?',
                'currentYear': new Date().getFullYear(),
                'type': 'vascularExamination',
                'patient_id': this.$store.state.Patient.patientId,
                'ipd_id': this.$store.state.Patient.ipdId,
                'patient_opd_details':[],
                'modal_enabled':'false',
                'examinationData' : '',
                'provisionalDiagnosis':'',
            }
        },
        components: {
           addressograph,
           patientReceiptForm,
       },
       created: function() {
         
        },
       mounted() {
        var vm =this;
        $("body .js-loader").removeClass('d-none');
        vm.initData();
        $("body .js-loader").addClass('d-none');
       },
        methods: {
         
          initData(){
            let vm =this;
            vm.examinationData = _.cloneDeep(this.$store.state.Patient.examinationData);
            vm.provisionalDiagnosis = _.cloneDeep(this.$store.state.Patient.provisionalDiagnosis);
             if(vm.$store.state.Patient.setErrorData.error && vm.$store.state.Patient.setErrorData.steps == 2 && vm.$store.state.Patient.opdSubmit) {

                vm.opdFormCheck();
             }
            
          },
          
          prev() {
              let vm =this;
              vm.$store.dispatch('saveExaminationData',vm.examinationData) ;
              vm.$store.dispatch('saveProvisionalDiagnosis', vm.provisionalDiagnosis) ;
              vm.$root.$emit('prev');
          },
         
          next() {
            let vm =this;

            this.$validator.validateAll().then(
              (response) => {
                // return false;
                 
                  if(!vm.$store.state.Patient.setErrorData.error)
                   {
                      if (this.errors.any()) {
                        vm.setErrorData = {'error':true,'steps':2}
                      } else {
                      if(vm.$store.state.Patient.setErrorData.steps == 2 ){

                        vm.setErrorData = {'error':false,'steps':''}
                      }
                    }
                    vm.$store.dispatch('setErrorData',vm.setErrorData);
                  } else {
                    if (this.errors.any()) {
                        // vm.setErrorData = {'error':true,'steps':2}
                      } else {
                      if(vm.$store.state.Patient.setErrorData.steps == 2 ){

                        vm.setErrorData = {'error':false,'steps':''}
                        vm.$store.dispatch('setErrorData',vm.setErrorData);
                      }
                  }
                    

                }
                  vm.$store.dispatch('saveExaminationData',vm.examinationData) ;
                  vm.$store.dispatch('saveProvisionalDiagnosis', vm.provisionalDiagnosis) ;
                  vm.$root.$emit('next');
                },
                (error) => {
                }
                );
          },
            opdFormCheck()
          {
            let vm =this;
            let step=2;
            if(vm.$store.state.Patient.setErrorData.error == true )
            {
              vm.$validator.validateAll().then(
                (response) => {
                 
                     if(vm.$store.state.Patient.setErrorData.steps == 2){

                        toastr.error('Please enter all required fields. qqqq', 'Error', {timeOut: 100});
                     }
                  
                                   
               },
               (error) => {
                }
              )
            }
              // return false;
              
          },
        GetSelectComponent(componentName) {
           this.$router.push({name: componentName})
        },

      },

    }
</script>
