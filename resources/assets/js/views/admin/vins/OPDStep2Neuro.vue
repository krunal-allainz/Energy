<template>
<div class="container">
	<div class="page-header">
	 <div class="row">
			<div class="col-md-6">
				<h3>Examination</h3>
			</div>
		</div>
	</div>
  <form action>
    <div class="row form-group">
      <div class="col-md-6" style="padding: 0px;">
        <div class="col-md-6">
          <label for="examination" class="control-label">Examination : </label>
        </div>
        <div class="col-md-6">
          <textarea  class="form-control"  id="examination" name="examination" value="" v-model="neuroExaminationData"  ></textarea>
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
    <div class="row form-group">
      <button type="button" class="btn btn-primary btn-submit text-right " @click="prev()" >Previous</button>
      <button type="button" class="btn btn-primary btn-submit text-right ml-10" @click="next()" >Next</button>
     
    </div>
  </form>
 
    <!-- <div class="col-md-6" style="padding: 0px;">
        
          <div class="col-md-6">
          <label for="plantars" class="control-label">Motor Examination : </label>
        </div>
        <div class="col-md-6">
          <textarea  class="form-control"  id="motor_examination" name="motor_examination" value="" v-model="neuroExaminationData.motor_examination"  ></textarea>
        </div>
      </div>
       <div class="col-md-6" style="padding: 0px;">
       
        <div class="col-md-6">
          <label for="plantars" class="control-label">Sensory Examination : </label>
        </div>
        <div class="col-md-6">
          <textarea  class="form-control"  id="sensory_examination" name="sensory_examination" value="" v-model="neuroExaminationData.sensory_examination"></textarea>
        </div>
         <hr />
      </div> 
    </div>
   

    <div class="row">
      <div class="table-responsive">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th></th>
              <th>Biceps </th>
              <th>Triceps</th>
              <th>Supinator</th>
              <th>Knee</th>
              <th>Ankle</th>
              <th>Hoffmann</th>
              <th>FF</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Right</th>
              <td><input class="form-control" type="text" name="right_biceps" value="  " v-model="neuroExaminationData.right_biceps" />
  						</td>
              <td><input class="form-control" type="text" name="right_triceps" value="  " v-model="neuroExaminationData.right_triceps" />
  						</td>
              <td><input class="form-control" type="text" name="right_supinator" value="  " v-model="neuroExaminationData.right_supinator" />
  						</td>
              <td><input class="form-control" type="text" name="right_knee" value="  " v-model="neuroExaminationData.right_knee" />
  						</td>
              <td><input class="form-control" type="text" name="right_ankle" value="  " v-model="neuroExaminationData.right_ankle" />
  						</td>
              <td><input class="form-control" type="text" name="right_hoffmann" value="  " v-model="neuroExaminationData.right_hoffmann" />
  						</td>
              <td><input class="form-control" type="text" name="right_ff" value="  " v-model="neuroExaminationData.right_ff" />
  						</td>
            </tr>

  					<tr>
              <th>left</th>
              <td><input class="form-control" type="text" name="left_biceps" value="  " v-model="neuroExaminationData.left_biceps" />
  						</td>
              <td><input class="form-control" type="text" name="left_triceps" value="  " v-model="neuroExaminationData.left_triceps" />
  						</td>
              <td><input class="form-control" type="text" name="left_supinator" value="  " v-model="neuroExaminationData.left_supinator" />
  						</td>
              <td><input class="form-control" type="text" name="left_knee" value="  " v-model="neuroExaminationData.left_knee" />
  						</td>
              <td><input class="form-control" type="text" name="left_ankle" value="  " v-model="neuroExaminationData.left_ankle" />
  						</td>
              <td><input class="form-control" type="text" name="left_hoffmann" value="  " v-model="neuroExaminationData.left_hoffmann" />
  						</td>
              <td><input class="form-control" type="text" name="left_ff" value="  " v-model="neuroExaminationData.left_ff" />
  						</td>
            </tr>

          </tbody>
        </table>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-6">
        <div class="col-md-6">
          <label for="plantars" class="control-label">Plantars : </label>
        </div>
        <div class="col-md-6">
					<input class="form-control" type="text" id="plantars" name="plantars" value="" v-model="neuroExaminationData.plantars" />
        </div>
      </div>
      <div class="col-md-6">
        <div class="col-md-6">
          <label for="romberg" class="control-label">Romberg's : </label>
        </div>
        <div class="col-md-6">
					<input class="form-control" type="text" id="romberg" name="romberg" value="" v-model="neuroExaminationData.romberg"/>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-6">
        <div class="col-md-6">
          <label for="gait" class="control-label">Gait</label>
        </div>
        <div class="col-md-6">
					<input class="form-control" type="text" id="gait" name="gait" value="" v-model="neuroExaminationData.gait"/>
        </div>
      </div>
      <div class="col-md-6">
        <div class="col-md-6">
          <label for="cerebellar" class="control-label">Cerebellar Signs : </label>
        </div>
        <div class="col-md-6">
					<select class="form-control ls-select2"  id = "cerebellar" name="cerebellar" value="" :class="{'is-danger': errors.has('cerebellar') }">
            <option value="">SELECT</option>
						<option value="no">No</option>
            <option value="truncal">Truncal</option>
            <option value="appendicular">Appendicular</option>
            <option value="tandemwalking">Tandem Walking</option>
          </select>
        </div>
      </div>
    </div>

    <div class="row form-group">
      <div class="col-md-6">
        <div class="col-md-6">
          <label for="neck_stiffness" class="control-label">Neck Stiffness</label>
        </div>
        <div class="col-md-6">
					<input class="form-control" type="text" id="neck_stiffness" name="neck_stiffness" value="" v-model="neuroExaminationData.neck_stiffness" />
        </div>
      </div>
    </div> 

    <div class="row form-group">
      <div class="col-md-6">
        <div class="col-md-6">
          <label for="diagnosis" class="control-label">Diagnosis</label>
        </div>
        <div class="col-md-6">
					<input class="form-control" type="text" id="diagnosis" name="diagnosis" value="" v-model="neuroExaminationData.diagnosis"/>
        </div>
      </div>
    </div> -->
    
</div>
</template>
<script >
	import User from '../../../api/users.js'
	import addressograph from './addressograph.vue';
	import SelectPatientModal from '../../../components/SelectPatientModal.vue';
   import patientReceiptForm from './patientsReceiptForm.vue';
  import SignaturePad from 'signature_pad';
  import moment from 'moment';
  import _ from 'lodash';
    export default {
      props:['doctor'],
        data() {
            return {
                'footer' : 'footer',
                'currentDatetime': moment().format('DD-MM-YYYY hh:mm A'),
                'deleteConfirmMsg':'Are you sure you want to exit from receipt form?',
                'modal_enabled':'false',
								'type': 'neuroExamination',
                'patient_id': this.$store.state.Patient.patientId,
               	'ipd_id': this.$store.state.Patient.ipdId,
                'hasError':true,
                'neuroExaminationData' : '',
                'provisionalDiagnosis':'',
        //         'neuroExaminationData': {
        //           'right_biceps' : '',
        //           'right_triceps' : '',
        //           'right_supinator' : '',
        //           'right_knee' : '',
        //           'right_ankle' : '',
        //           'right_hoffmann' : '',
        //           'right_ff' : '',
        //           'left_biceps' : '',
        //           'left_triceps' : '',
        //           'left_supinator' : '',
        //           'left_knee' : '',
        //           'left_ankle' : '',
        //           'left_hoffmann' : '',
        //           'left_ff' : '',
        //           'plantars' : '',
        //           'romberg' : '',
        //           'gait' : '',
        //           'cerebellar' : '',
        //           'neck_stiffness' : '',
        //           'diagnosis' : '',
        //           'motor_examination' : '',
        //           'sensory_examination' : '',
        //           'follow_up':''
								// }
            }
        },
				components: {
					 addressograph,
					 SelectPatientModal,
           patientReceiptForm
			 },
      
       created: function() {
        },
			 mounted() {
        let vm =this;
				 $('.ls-select2').select2({
						placeholder: "Select",
				 });
           $(document).on("select2:select",'.ls-select2', function (e) {
            // if(this.id == 'cerebellar') {
                vm.neuroExaminationData=$(this).val();
             //} 
             
          });
         setTimeout(function(){
          vm.initData();
        },1000);
         
			 },
				methods: {
          initData(){
            let vm =this;
            vm.neuroExaminationData = _.cloneDeep(this.$store.state.Patient.neuroExaminationData);
            vm.provisional_diagnosis = _.cloneDeep(this.$store.state.Patient.provisionalDiagnosis);
            // if(vm.neuroExaminationData.cerebellar)
            // {
            //   $("#cerebellar").val(vm.neuroExaminationData.cerebellar).trigger('change.select2');
            // }
            
          },
          prev() {
              let vm =this;
              vm.$store.dispatch('saveNeuroExamination', _.cloneDeep(vm.neuroExaminationData)) ;
              vm.$store.dispatch('saveProvisionalDiagnosis', _.cloneDeep(vm.provisionalDiagnosis)) ;
              vm.$root.$emit('prev');
          },
          next() {
            let vm =this;
            vm.$store.dispatch('saveNeuroExamination', _.cloneDeep(vm.neuroExaminationData)) ;
             vm.$store.dispatch('saveProvisionalDiagnosis', _.cloneDeep(vm.provisionalDiagnosis)) ;
            vm.$root.$emit('next');
          },
		    GetSelectComponent(componentName) {
		       this.$router.push({name: componentName})
		    },
      
          resizeCanvas(canvas) {
              var ratio =  Math.max(window.devicePixelRatio || 1, 1);
              canvas.width = canvas.offsetWidth * ratio;
              canvas.height = canvas.offsetHeight * ratio;
               // canvas.getContext("2d").scale(ratio, ratio);
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
        },
    }
</script>
