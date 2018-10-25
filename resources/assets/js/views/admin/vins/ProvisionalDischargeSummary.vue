<template>
<div class="container">
  <div class="page-header">
    <div class="row">
      <div class="col-md-6">
      <h1>Provisional Discharge Summary</h1>
      </div>
      
    </div>
  </div>


	<form action="" method="post">

          <div class="row form-group">
            <div class="col-md-12">
            <div class="text-right">

            <addressograph></addressograph>

            </div></div>
          </div>
          <hr>
          <div class="row form-group">
            <div class="col-md-6">
            <div class="col-md-6">
              <label class="control-label" for="address">Address :</label>
            </div>
            <div class="col-md-6">
              <input type="text" name="address"  rows="3" class="form-control" value="" v-model="provisionalDischargeSummaryData.address">
            </div></div>
            <div class="col-md-6">
            <div class="col-md-6">
              <label class="control-label" for="date_of_discharge">Date of Discharge :</label>
            </div>
            <div class="col-md-6">
             <date-picker :date.sync="provisionalDischargeSummaryData.date_of_discharge"  name="date_of_discharge" class="form-control " id = "date_of_discharge" v-model="provisionalDischargeSummaryData.date_of_discharge.time"  :option="option"></date-picker>
            </div></div>


        </div>

			<hr>
			<div class="row form-group">
        <div class="col-md-6">
          <div class="col-md-6">
            <label>Referred By : </label>
          </div>
          <div class="col-md-6">
            <input type="text"  name="ref_by" class="form-control" value="" v-model="provisionalDischargeSummaryData.ref_by">
          </div>
        </div>
        <div class="col-md-6">
          <div class="col-md-6">
            <label>Room No. : </label>
          </div>
          <div class="col-md-6">
            <input type="text"  name="room_no" class="form-control" value="" v-model="provisionalDischargeSummaryData.room_no">
          </div>
        </div>
			</div>
      <hr>
      <div class="row form-group">
        <div class="col-md-6">
          <label class="control-label" for="address">Diagnosis :</label>
        </div>
        <div class="col-md-6">
          <input type="text" name="diagnosis"  rows="3" class="form-control" value="" v-model="provisionalDischargeSummaryData.diagnosis">
        </div>
      </div>

      <div class="row form-group">
        <div class="col-md-6">
          <label class="control-label" for="address">Condition on discharge :</label>
        </div>
        <div class="col-md-6">
          <input type="text" name="condition_on_discharge"  rows="3" class="form-control" value="" v-model="provisionalDischargeSummaryData.condition_on_discharge">
        </div>
      </div>

      <div class="row form-group">
        <div class="col-md-6">
          <label class="control-label" for="address">Advice on discharge :</label>
        </div>
        <div class="col-md-6">
          <input type="text" name="advice_on_discharge"  rows="4" class="form-control" value="" v-model="provisionalDischargeSummaryData.advice_on_discharge">
        </div>
      </div>

      <div class="row form-group">
        <div class="col-md-6">
          <label class="control-label" for="address">Followup :</label>
        </div>
        <div class="col-md-6">
          <input type="text" name="followup"  rows="2" class="form-control" value="" v-model="provisionalDischargeSummaryData.followup">
        </div>
      </div>

      <div class="row form-group">
        <h3>Collect final discharge summary</h3>
      </div>
      <div class="row form-group">
        <div class="col-md-6">
          <label class="control-label" for="collect_discharge_summary_on">On Date:</label>
        </div>
        <div class="col-md-6">
          <!-- <input type="date" id = "collect_discharge_summary_on" name="collect_discharge_summary_on" class="form-control" value="" v-model="provisionalDischargeSummaryData.collect_discharge_summary_on"> -->
          <date-picker :date.sync="provisionalDischargeSummaryData.collect_discharge_summary_on"  name="collect_discharge_summary_on" class="form-control " id = "collect_discharge_summary_on" v-model="provisionalDischargeSummaryData.collect_discharge_summary_on.time"  :option="option"></date-picker>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-md-6">
          <label class="control-label" for="collect_discharge_summary_at">At:</label>
        </div>
        <div class="col-md-6">
          <input type="text"  name="collect_discharge_summary_at" class="form-control" value="" v-model="provisionalDischargeSummaryData.collect_discharge_summary_at">
        </div>
      </div>
      <div class="row form-group">
        <div class="col-md-6">
          <label class="control-label" for="collect_discharge_summary_from">From:</label>
        </div>
        <div class="col-md-6">
          <input type="text"  name="collect_discharge_summary_from" class="form-control" value="" v-model="provisionalDischargeSummaryData.collect_discharge_summary_from">
        </div>
      </div>

			<div class="form-group text-center">
				<button class="btn btn-success" type="button" @click = "saveProvisionalDischargeSummary()">Submit</button>
			</div>
		</form>
     <select-patient-modal @confirmed="deleteConfirmed()"></select-patient-modal>
	</div>
</body>
</template>


<script >
	import User from '../../../api/users.js';
  import addressograph from './addressograph.vue';
  import SelectPatientModal from '../../../components/SelectPatientModal.vue';
  import myDatepicker from 'vue-datepicker';

    export default {
        data() {
            return {
                'footer' : 'footer',
                'currentYear': new Date().getFullYear(),
                'type': 'provisionalDischargeSummary',
                'patient_id': this.$store.state.Patient.patientId,
               	'ipd_id': this.$store.state.Patient.ipdId,
                'option': {
                    type: 'day',
                    week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                    month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    format: 'DD-MM-YYYY',
                    placeholder: 'Select Date',
                    inputStyle: {
                        'border': '2px solid #fff',
                    },
                    
                },
                'provisionalDischargeSummaryData' : {
                    'address' :'',
                    'date_of_discharge' :{
                      time:''
                    },
                    'addressograph' :'',
                    'ref_by' :'',
                    'room_no' :'',
                    'diagnosis' :'',
                    'condition_on_discharge' :'',
                    'advice_on_discharge' :'',
                    'followup' :'',
                    'collect_discharge_summary_on' :{
                      time: ''
                    },
                    'collect_discharge_summary_at' :'',
                    'collect_discharge_summary_from' :'',
                }
            }
        },
        components: {
           addressograph,
           SelectPatientModal,
           'date-picker': myDatepicker,
       },
        mounted() {
          $('.ls-datepicker').datepicker({
              format: 'dd/mm/yyyy',
            'autoclose': true
          })
          if(this.ipd_id == 0){
            $('#delete_modal').modal('show');
          }

          $('.ls-datepicker').datepicker().on('changeDate',function(){

            if (this.id == 'date_of_discharge') {
              vm.provisionalDischargeSummaryData.date_of_discharge = this.value;
            }
          })
          $('.ls-datepicker').datepicker().on('changeDate',function(){
            if (this.id == 'collect_discharge_summary_on') {
               vm.provisionalDischargeSummaryData.collect_discharge_summary_on = this.value;
            }
          });
        },
        methods: {
		    GetSelectComponent(componentName) {
		       this.$router.push({name: componentName})
		    },
		    saveProvisionalDischargeSummary() {
		    	this.$validator.validateAll().then(
	            (response) => {
	            	if (!this.errors.any()) {
	            		 $("body .js-loader").removeClass('d-none');
                   var provisionalDischargeSummaryData = {'type':this.type,'patient_id':this.patient_id,'ipd_id':this.ipd_id,'form_data':this.provisionalDischargeSummaryData};
				    	       User.saveProvisionalDischargeSummary(provisionalDischargeSummaryData).then(
		                (response) => {
		                	if(response.data.status == 200) {
		                		toastr.success('Provisional discharge summary details have been saved', 'provisionalDischargeSummary detail', {timeOut: 5000});
		                	}
		                	 $("body .js-loader").addClass('d-none');

		                },
		                (error) => {
		                	 $("body .js-loader").addClass('d-none');

		                }
		                )
			         	}
			       },
                (error) => {
                }
                )

			}
		  },

    }
</script>
