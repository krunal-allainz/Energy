<template>
	<div class="modal fade bg-modal-color refdel" id="createPatientDetail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    	<div class="modal-dialog delete-modal" role="document">
        	<div class="modal-content">
            	<form method="delete" class="js-delete-modal-form" id="createPatientDetailForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="patient_details">
                    	Patient Details Form
                    </h5>
                </div>
                <div class="modal-body">
                   <form method = "post">
                   		<div class="row m-t-10">
                                <div class="col-sm-12 col-md-10 col-lg-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                             	<label for="first_name" class="control-label">First Name : </label>
												<input class="form-control" type = "text" v-validate="'required'" id = "first_name" name="first_name" value="" :class="{'is-danger': errors.has('first_name') }" v-model="patientData.fname"/>
				 								<span class="help is-danger" v-show="errors.has('first_name')">
							                		Field is required
							              		</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                           		<label for="middle_name" class="control-label">Middle Name: </label>
												<input class="form-control" type="text" id="middle_name" name="middle_name" value=""  v-model="patientData.mname"/>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                            	<label for="last_name" class="control-label">Last Name: </label>
												<input class="form-control" type="text" id="last_name" name="last_name" value="" v-model="patientData.lname" v-validate="'required'"/>
												<span class="help is-danger" v-show="errors.has('last_name')">
						            	         Field is required
						          				</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-sm-12 col-md-10 col-lg-12">
                            	<div class="row">
                            		<div class="col-sm-6 col-md-5">
		                            	<div class="form-group">
		                                    <label for="date_of_birth">Date of Birth: </label><br>

		                                    <date-picker  :date.sync="patientData.dob" :option="option" id = "date_of_birth" class="" type="text" name="date_of_birth"  v-model="patientData.dob.time" v-validate="'required'"></date-picker> 
											
											<span class="help is-danger" v-show="errors.has('date_of_birth')">
						            			Field is required
						            		</span>
		                                </div>
		                            </div>
		                            <div class="col-sm-6 col-md-5">
		                                <div class="form-group">
		                                	<label class="control-label" for="sex">Gender: </label>
											<select  class="form-control" v-model="patientData.gender" id = "gender" name="gender">
					            				<option value="M">Male</option>
								            	<option value="F">Female</option>
								          	</select>
								          	<span class="help is-danger" v-show="errors.has('gender')">
								            	Field is required
								          	</span>	  
		                                </div>
		                            </div>
	                            </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                       		 <div class="col-sm-12 col-md-10 col-lg-12">
                            	<div class="row">
                            		<div class="col-sm-6 col-md-5">
		                            	<div class="form-group">
		                                   <label for="address">Address: </label>
											<input class="form-control" type="text" id="address" name="address" value="" v-model="patientData.address" v-validate="'required'"/>
									      	<span class="help is-danger" v-show="errors.has('address')">
							                	Field is required
							                </span>
		                                </div>
		                            </div>
		                            <div class="col-sm-6 col-md-5">
		                                <div class="form-group">
		                                	<label class="control-label" for="phone_no">Phone no.: </label>
									      	<input class="form-control" type="text" id="phone_no" name="ph_no" value="" v-validate="'required|numeric'" v-model="patientData.ph_no"/>
									      	<span class="help is-danger" v-show="errors.has('ph_no')">
							                	Field and Numeric value required
							                </span>	  
		                                </div>
		                            </div>
	                            </div>
                            </div>
                        </div>
                        <div class="row m-t-10">
                            <div class="col-sm-12 col-md-10 col-lg-12">
                            	<div class="row">
                            		<div class="col-sm-6 col-md-5">
		                            	<div class="form-group">
		                                	<label class="control-label" for="mobile_no">Mobile no.: </label>
									      	<input class="form-control" type="text" id="mobile_no" name="mob_no" value="" v-model="patientData.mob_no" v-validate="'required|numeric'"/>
									      		<span class="help is-danger" v-show="errors.has('mob_no')">
								                	Field and Numeric value is required
								                </span>
		                                </div>
		                            </div>
		                            <div class="col-sm-6 col-md-5">
		                                <div class="form-group">
		                                	<label class="control-label" for="reference_dr">Reference Dr.: </label>
									      	<input class="form-control" type="text" id="reference_dr" name="reference_dr" value="" v-model="patientData.reference_dr" v-validate="'required'"/>
									      	<span class="help is-danger" v-show="errors.has('reference_dr')">
								                Field is required
								            </span>	  
		                                </div>
		                            </div>
	                            </div>
                            </div>
                        </div>
					</form>
    				</div>
			    	<div class="modal-body js-delete-confirmation-msg"></div>
			        <div class="modal-footer">
			        	<button type="button" class="btn btn-danger"  @click="hideModal()">Cancel</button>
			            <button class="btn btn-success" type="button" @click="savePatient()">Submit</button> 
			        </div>
		   			</form>
				</div>
		</div>
    </div>
</template>
<script >
	import User from '../../../api/users.js';
  	import myDatepicker from 'vue-datepicker';
  	import moment from 'moment';

    export default {
    	props:['patientType','doctor'],
        data() {
            return {
                'footer' : 'footer',
                'currentYear': new Date().getFullYear(),
                'deleteConfirmMsg': 'Are you sure you would like to delete this referee? All information associated with this referee will be permanently deleted.',
                'option': {
                    type: 'day',
                    week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                    month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    format: 'DD-MM-YYYY',
                    placeholder: 'Select Date',
                    inputStyle: {
                        'display': 'inline-block',
                        'padding': '6px',
                        'line-height': '22px',
                        'font-size': '16px',
                        'border': '2px solid #fff',
                        'box-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.2)',
                        'border-radius': '2px',
                        'color': '#5F5F5F',
                        'width':'100%',
                    },
                    
                  },
                  'patientData' : {
                	'fname':'',
                	'mname': '',
                	'lname': '',
                	'dob': {
                		time:''
                	},
                	'gender': '',
                	'address': '',
                	'ph_no': '',
                	'mob_no': '',
                	'consulting_dr': this.doctor,
                	'case':'new',
                	'reference_dr': ''
                }

            }
        },
        mounted() {
	 			let vm = this;
        		$('.ls-select2').select2();
             	$('.ls-datepicker').datepicker({
			         format: 'dd/mm/yyyy',
			         'autoclose': true
			 	});
			 	$('.ls-datepicker').datepicker().on('changeDate',function(){
	 				vm.patientData.dob = this.value;
	 			});

        },
        components: {
        	'date-picker': myDatepicker,
        },
        methods: {

		    GetSelectComponent(componentName) {
		       this.$router.push({name: componentName})
		    },
		    hideModal() {
            	$('#createPatientDetail').modal('hide')
                    return false
            },
		     savePatient() {
		     	// return false;
		    	this.$validator.validateAll().then(
	            (response) => {
	            	if (!this.errors.any()) {
	            		 $("body .js-loader").removeClass('d-none');
	            		 var pData = {'patientData':this.patientData,'patientType':this.patientType};
				    	User.savePatient(pData).then(
		                (response) => {
		                	if(response.data.code == 200) {
		                		toastr.success('Patient details have been saved', 'patient detail', {timeOut: 5000});
		    					var uhidNo=response.data.data.uhid_no;
								$("#createPatientDetail").modal("hide");
		    					this.$store.dispatch('SetUhidNo',uhidNo);
		    					 this.$root.$emit('SetUhidNo',uhidNo);
		                	} else if(response.data.code == 300) {
		                		toastr.error('Record not found', 'Error', {timeOut: 5000});
		                	} else{
		                		
		                	 toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
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
		}
    }
</script>
