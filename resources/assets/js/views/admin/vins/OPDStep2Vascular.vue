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
        <div class="col-md-6">
          <textarea  class="form-control"  id="examination" name="examination" value="" v-model="vascularExaminationData"  ></textarea>
        </div>
      </div>
     </div>
      <div class="row form-group">
            <div class="col-md-6" style="padding: 0px;">
              <div class="col-md-6">  
                <label for="date">Provisional Diagnostic:</label>
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
      <!--<div class="row form-group">
         <div class="col-md-6">
          <div class="col-md-6">
            <label>Pulsations : </label>
          </div>
          <div class="col-md-6">
            <input class="form-control" type="text" name="pulsations" id="pulsations" v-model="vascularExaminationData.pulsations" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="col-md-6">
            <label>RR : </label>
          </div>
          <div class="col-md-6">
            <input class="form-control" type="text" name="rr" id="rr" v-model="vascularExaminationData.rr" />
          </div>
        </div>
      </div>

  

      <div class="row form-group">
        <div class="col-md-6">
          <div class="col-md-6">
            <label>Ulcer : </label>
          </div>
          <div class="col-md-6">
            <input class="form-control" type="text" name="ulcer" id="ulcer" v-model="vascularExaminationData.ulcer" />
          </div>
        </div>
        <div class="col-md-6">
          <div class="col-md-6">
            <label>Gangrene : </label>
          </div>
          <div class="col-md-6">
            <input class="form-control" type="text" name="gangrene" id="gangrene" v-model="vascularExaminationData.gangrene" />
          </div>
        </div>
      </div>

     

      <div class="row">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th></th>
              <th>CAR</th>
              <th>SCA</th>
              <th>BR</th>
              <th>RAD</th>
              <th>UL</th>
              <th>FEM</th>
              <th>POP</th>
              <th>PT</th>
              <th>DP</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>R</th>
              <td><input class="form-control" type="text" name="car_r" id="car_r" v-model="vascularExaminationData.car_r" /></td>
              <td><input class="form-control" type="text" name="sca_r" id="sca_r" v-model="vascularExaminationData.sca_r" /></td>
              <td><input class="form-control" type="text" name="br_r" id="br_r" v-model="vascularExaminationData.br_r" /></td>
              <td><input class="form-control" type="text" name="rad_r" id="rad_r" v-model="vascularExaminationData.rad_r" /></td>
              <td><input class="form-control" type="text" name="ul_r" id="ul_r" v-model="vascularExaminationData.ul_r" /></td>
              <td><input class="form-control" type="text" name="fem_r" id="fem_r" v-model="vascularExaminationData.fem_r" /></td>
              <td><input class="form-control" type="text" name="pop_r" id="pop_r" v-model="vascularExaminationData.pop_r" /></td>
              <td><input class="form-control" type="text" name="pt_r" id="pt_r" v-model="vascularExaminationData.pt_r" /></td>
              <td><input class="form-control" type="text" name="dp_r" id="dp_r" v-model="vascularExaminationData.dp_r" /></td>
            </tr>
            <tr>
              <th>L</th>
              <td><input class="form-control" type="text" name="car_l" id="car_l" v-model="vascularExaminationData.car_l" /></td>
              <td><input class="form-control" type="text" name="sca_l" id="sca_l" v-model="vascularExaminationData.sca_l" /></td>
              <td><input class="form-control" type="text" name="br_l" id="br_l" v-model="vascularExaminationData.br_l" /></td>
              <td><input class="form-control" type="text" name="rad_l" id="rad_l" v-model="vascularExaminationData.rad_l" /></td>
              <td><input class="form-control" type="text" name="ul_l" id="ul_l" v-model="vascularExaminationData.ul_l" /></td>
              <td><input class="form-control" type="text" name="fem_l" id="fem_l" v-model="vascularExaminationData.fem_l" /></td>
              <td><input class="form-control" type="text" name="pop_l" id="pop_l" v-model="vascularExaminationData.pop_l" /></td>
              <td><input class="form-control" type="text" name="pt_l" id="pt_l" v-model="vascularExaminationData.pt_l" /></td>
              <td><input class="form-control" type="text" name="dp_l" id="dp_l" v-model="vascularExaminationData.dp_l" /></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="row form-group">
        <div class="col-md-6">
          <div class="col-md-6">
            <label>Doppler ABPi : </label>
          </div>
          <div class="col-md-6">
            <input class="form-control" type="text" name="doppler_abpi" id="doppler_abpi" v-model="vascularExaminationData.doppler_abpi" />
          </div>
        </div>
      </div>

      <div class="row form-group">
        <div class="col-md-6">
          <label>Varicose Vein Pattern : </label>
        </div>
      </div>
      <div class="row form-check form-inline">
        <div class="col-md-3">
          <label>
            <input class="form-check-input" type="checkbox" name="gsv" id="gsv" v-model="vascularExaminationData.gsv"/>GSV
          </label>
        </div>
        <div class="col-md-3">
          <label>
            <input class="form-check-input" type="checkbox" name="ssv" id="ssv" v-model="vascularExaminationData.ssv"/>SSV
          </label>
        </div>
        <div class="col-md-3">
          <label>
            <input class="form-check-input" type="checkbox" name="both" id="both" v-model="vascularExaminationData.both"/>BOTH
          </label>
        </div>
        <div class="col-md-3">
          <label>
            <input class="form-check-input" type="checkbox" name="ipv" id="ipv" v-model="vascularExaminationData.ipv"/>iPV
          </label>
        </div>
      </div>
      <hr />
      <div class="row form-group" >
          <div class="col-md-4">
            <textarea  class="form-control"  id="vasculartext1" name="vasculartext1" value="" v-model="vascularExaminationData.vasculartext1"  ></textarea>
          </div>
           <div class="col-md-4">
             <textarea  class="form-control"  id="vasculartext2" name="vasculartext2" value="" v-model="vascularExaminationData.vasculartext2"  ></textarea>
          </div>
          <div class="col-md-4">
             <textarea  class="form-control"  id="vasculartext3" name="vasculartext3" value="" v-model="vascularExaminationData.vasculartext3"  ></textarea>
          </div>
    </div> 

      <div class="row form-group">
        <div class="col-md-12">
          <div class="col-md-12">
            <label>Clinical Diagnosis : </label>
          </div>
          <div class="col-md-12">
            <input class="form-control" type="text" name="clinical_diagnosis" id="clinical_diagnosis" v-model="vascularExaminationData.clinical_diagnosis" />
          </div>
        </div>
      </div> -->
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
                'modal_val':0,
                'footer' : 'footer',
                'deleteConfirmMsg':'Are you sure you want to exit from receipt form?',
                'currentYear': new Date().getFullYear(),
                'type': 'vascularExamination',
                'patient_id': this.$store.state.Patient.patientId,
                'ipd_id': this.$store.state.Patient.ipdId,
                'patient_opd_details':[],
                'modal_enabled':'false',
                'vascularExaminationData' : '',
                'provisionalDiagnosis':'',
                // 'vascularExaminationData': {
                //   'vitals' : '',
                //   'temp' : '',
                //   'pulse' : '',
                //   'rr' : '',
                //   'bp' : '',
                //   'ulcer' : '',
                //   'gangrene' : '',
                //   'pulsations' : '',
                //   'car_r' : '',
                //   'sca_r' : '',
                //   'br_r' : '',
                //   'rad_r' : '',
                //   'ul_r' : '',
                //   'fem_r' : '',
                //   'pop_r' : '',
                //   'pt_r' : '',
                //   'dp_r' : '',
                //   'car_l' : '',
                //   'sca_l' : '',
                //   'br_l' : '',
                //   'rad_l' : '',
                //   'ul_l' : '',
                //   'fem_l' : '',
                //   'pop_l' : '',
                //   'pt_l' : '',
                //   'dp_l' : '',
                //   'doppler_abpi' : '',
                //   'gsv' : '',
                //   'ssv' : '',
                //   'both' : '',
                //   'ipv' : '',
                //   'clinical_diagnosis' : '',
                //   'vasculartext1' : '',
                //   'vasculartext2' : '',
                //   'vasculartext3' : '',
                // }
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
        setTimeout(function(){
          vm.initData();
        },2000);
        
       },
        methods: {
          initData(){
            let vm =this;
            vm.vascularExaminationData = _.cloneDeep(this.$store.state.Patient.vascExaminationData);
            vm.provisional_diagnosis = _.cloneDeep(this.$store.state.Patient.provisionalDiagnosis);
          },
          prev() {
              let vm =this;
              vm.$store.dispatch('saveVascularExamination', _.cloneDeep(vm.vascularExaminationData)) ;
                vm.$store.dispatch('saveProvisionalDiagnosis', _.cloneDeep(vm.provisionalDiagnosis)) ;
              vm.$root.$emit('prev');
          },
          next() {
            let vm =this;
            this.$validator.validateAll().then(
              (response) => {
            
                  //console.log('this.errors',this.errors);
                  if (this.errors.any()) {

                    console.log(vm.error);
                    // vm.setErrorData = {'error':true,'steps':vm.curStep}
                  } else {
                    console.log('tesdt');


                  }
                },
                (error) => {
                }
                );
            //  vm.$store.dispatch('saveVascularExamination', _.cloneDeep(vm.vascularExaminationData)) ;
            //    vm.$store.dispatch('saveProvisionalDiagnosis', _.cloneDeep(vm.provisionalDiagnosis)) ;
            vm.$root.$emit('next');

          },

        GetSelectComponent(componentName) {
           this.$router.push({name: componentName})
        },

      },

    }
</script>
