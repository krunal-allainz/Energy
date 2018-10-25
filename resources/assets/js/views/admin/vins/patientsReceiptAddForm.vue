<template>
   <div class="">
       <form action="" method="post" enctype="multipart/formdata" @submit="receiptPrintView">
    	   <div class="row form-group">
    	   		<div class="col-md-6">
    	   			<div class="col-md-9">
			          <label for="date">Select Patient:</label>
			        </div>
	    	   		<div class="col-md-9">
	    	   			<input class="form-control" type = "text" id = "name" name="name"  v-model="patientReceiptData.patient_name" readonly=""/>
	    	   			<input class="form-control" type = "hidden" id = "patient" name="patient"  v-model="patientReceiptData.patient_id" />
		          	</div>
	          	</div>
	          	<div class="col-md-6">	
		          	<div class="col-md-9">	
		            	<label>Date :</label>	
		         	</div>	
		         	<div class="col-md-9">
	       				<date-picker  :date.sync="patientReceiptData.date_receipt" :option="option" id = "date_receipt" class="" type="text" name="date_receipt" :limit="limit" v-model="patientReceiptData.date_receipt.time" ></date-picker> 
					
	           		</div>	
	        	</div>
			</div>

				<div class="row form-group" >	
					<div class="col-md-6">	
							<div class="col-md-9">	
								<label for="charges">Charges Type:</label>
							</div>	
							<div class="col-md-9">
								<select  class="form-control ls-select2" id = "charges_type" name="charges_type" v-on:change="ChargesTypeFunction()">
									<option value="">Select</option>
	            		 			<option :value="charges_type.id" v-for="charges_type in patientReceiptData.charges_type_option">{{charges_type.text}}</option>
	          					</select>	
								
							</div>
				 	</div>
				 			<div class="col-md-6" v-if="patientReceiptData.charges_type == '1'">
						<div class="col-md-9">
							<label class="control-label" for="consultation_type">Consultation Charges: </label>
						</div>
						<div class="col-md-9">
							<select class="form-control ls-select2"  id="consultation_type" name="consultation_type"  >
    								<option value="">Select</option>
  									<optgroup label="Super Specialists" value="1">
    									<option class="level_0" value="1">First</option>
    									<option class="level_0" value="2">Follow up</option>
    									<option class="level_0" value="3">Emergency</option>
  								 	</optgroup>
  								 <optgroup label="Specialists" value="2">
    								<option class="level_1" value="4">First</option>
    								<option class="level_1" value="5">Follow up</option>
    								<option class="level_1" value="6">Emergency</option>
  								 </optgroup>
							</select>
						</div>
					</div>
				 	<div class="col-md-6" v-if="patientReceiptData.charges_type == '2'">
						<div class="col-md-9">
				      		<label class="control-label" for="emergency_type">Emergency Charges: </label>
						</div>
						<div class="col-md-9">
				      		<select class="form-control ls-select2"  id="emergency_type" name="emergency_type"  v-model="patientReceiptData.emergency_type" >
				      			<option value="">Select</option>
								 <option :value="emergency_type.id" v-for="emergency_type in patientReceiptData.emergency_type_option">{{emergency_type.text}}</option>
				      		</select>
				      		
						</div>
					</div>
			 
				</div>
				<div class="row form-group" >	
					<div class="col-md-6">
						<div class="col-md-9">
				      		<label class="control-label" for="chargeAmount">Charges: </label>
						</div>
						<div class="col-md-9">
				      		<input class="form-control" type="text" name="chargeAmount" id="chargeAmount"  v-validate="'numeric'" 	v-model="patientReceiptData.chargeAmount" />
				      		<span class="help is-danger" v-show="errors.has('chargeAmount')">
				      		 Please enter valid charges. </span>
						</div>
					</div>
					 	
				</div>
				
			 
			 	<div class="row form-group" >
					<div class="col-md-12">
					 	<button class="btn btn-primary pull-left" type="submit" id="modellink" >Save Receipt</button>
					</div>
				</div>
       		
		</form>
				
		</div>
	 </template>
	<script>
	
		import User from '../../../api/users.js';
		import myDatepicker from 'vue-datepicker';

		let list=[];
		let charges_list=[];
		var patientId = '';
		
		

		export default {
			props:['patientOPDDetails'],
			data() {
				return {
					post: null,
					'footer' : 'footer',
					 'currentYear': new Date().getFullYear(),
					 /*date code*/
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
				      limit: [
				      {
				        type: 'fromto',
				       	to: new Date()
				      }],
					 'patientReceiptData' : {
					 		'fullname' : '',
					 		'case_id':this.$store.state.Patient.caseId,
					 		'gender': '',
					 		'case_no': '',
					 		'case_type' : '',
					 		'case_type_option': [{id:1,text:'OPD'}, {id:2,text:'IPD'}] ,
					 		'dob' : '',	
                			'age' : '',
		                	'reference_dr': '',
		                	'patient_id':'',
		                	'patient_name':'',
		                	'date_receipt': {
                				time:''
                			},
                 			'patient_option':list,
                 			'case_detail':{},
                 			'consult' : '',
                 			'charges_type':'',
                 			'charges_type_option':{},
                 			'chargeAmount' : '',
                 			'select_patient_detail':{},
		                	'consultation_type':'',
		                	'emergency_type':'',
		                	'emergency_type_option': [{id:1,text:'Day visit (8 am to 8 pm)'}, {id:2,text:'Night visit (8 pm to 8 am)'}],
                 		}
                 	}
                },
                components: {	
	       			 'date-picker': myDatepicker,	
	         	},
	          mounted(){
                     $("body .js-loader").removeClass('d-none');

	          		setTimeout(function(){
	          			$('.ls-select2').select2({
	          	 	 		placeholder: "Select",
	          	 		});	
                     	$("body .js-loader").addClass('d-none');
					},1000);
		          	 
		          	
		         
	          	   let vm =this;
	          	   
	          	   vm.patientReceiptData.patient_name=vm.patientOPDDetails.p_name;
	          	   vm.patientReceiptData.patient_id=vm.patientOPDDetails.patient_id;
	          	   vm.patientReceiptData.case_no=vm.patientOPDDetails.case_pr_id;
	          	   vm.patientReceiptData.department=vm.patientOPDDetails.department;
	          	   vm.patientReceiptData.consult=vm.patientOPDDetails.consult_id;
	          	   /*for receipt charges types start*/
	          	   
				    User.getChargesTypes().then(
				    	 (response) => {
	               	 		let charges_type_data ;
	               	 		charges_type_data = response.data;
	               	 		let charges_list_new=[];
	               	 		$.each(charges_type_data, function(key, value) {
	               	 			//console.log(value);
		               	 		let name = value.name;
		               	 		let id  = value.id ;
		               	 		
		               	 		charges_list_new.push({
		               	 				text:name,
		               	 				id:id,
		               	 				
		               	 		});
	               	 		});
	               	 		vm.patientReceiptData.charges_type_option=charges_list_new;

	               	 	},
	               		(error) => {
	            	 	},
	               	);
				    
		          	   
					
	          	    $(document).on("select2:select",'.ls-select2', function (e) { 
			          
			            if(this.id == 'case_type')
			            {
			            	let case_type_val=$(this).val();
							vm.patientReceiptData.case_type =  case_type_val;
			            }
			            else if(this.id == 'charges_type')
			            {
			            	let charges_type_val=$(this).val();
							vm.patientReceiptData.charges_type=charges_type_val;
							if(charges_type_val==1)
							{
								setTimeout(function(){
								    	 /*for consultation type*/
				       	 				$('#consultation_type').select2({
						          	 	 	placeholder: "Select",
						          	 	 	dropdownParent: $("#receiptAddModel"),
						          	 	 	show: true, 
			        						backdrop: 'static',
			        						keyboard: true
						          	 	});
				           	 	},500);
							}
							else if(charges_type_val==2)
							{
								setTimeout(function(){
							    	/*for emergency type*/
			       	 				$('#emergency_type').select2({
					          	 		placeholder: "Select",
					          	 	 	dropdownParent: $("#receiptAddModel"),
					          	 	 	show: true, 
			        					backdrop: 'static',
			        					keyboard: true
					          	    });
				           	 	},500);
							}
			            }
			            else if(this.id == 'emergency_type')
			            {
			            	let emergency_type_val=$(this).val();
		          	    	vm.patientReceiptData.emergency_type=emergency_type_val;
		          	    	if(emergency_type_val==1)
		          	    	{
		          	    		vm.patientReceiptData.chargeAmount=4000;
		          	    	}
		          	    	else if(emergency_type_val==2)
		          	    	{
		          	    		vm.patientReceiptData.chargeAmount=6000;
		          	    	} 
			            }
			            else if(this.id == 'consultation_type')
			            {

			            	let consultation_type_val=$(this).val();
		          	    	vm.patientReceiptData.consultation_type=consultation_type_val;
		          	    	if(consultation_type_val==1)
		          	    	{
		          	    		vm.patientReceiptData.chargeAmount=800;
		          	    	}
		          	    	else if(consultation_type_val==2)
		          	    	{
		          	    		vm.patientReceiptData.chargeAmount=400;
		          	    	}
		          	    	else if(consultation_type_val==3)
		          	    	{
		          	    		vm.patientReceiptData.chargeAmount=2000;
		          	    	}
		          	    	else if(consultation_type_val==4)
		          	    	{
		          	    		vm.patientReceiptData.chargeAmount=500;
		          	    	}
		          	    	else if(consultation_type_val==5)
		          	    	{
		          	    		vm.patientReceiptData.chargeAmount=250;
		          	    	}	
		          	    	else if(consultation_type_val==6)
		          	    	{
		          	    		vm.patientReceiptData.chargeAmount=1000;
		          	    	}
			            }
			            
			        });
  					
	             	
  					
	         },
	         methods: {
	         receiptPrintView: function (e) {
	         	let vm=this;
		    	this.$validator.validateAll().then(  	
	            (response) => { 

	            	if (!this.errors.any()) {
	            		let content = [];
	            		$("body .js-loader").removeClass('d-none');
	            		User.generateReceiptData(this.patientReceiptData).then(	
		                (response) => {
		                		$("body .js-loader").addClass('d-none');
		                		if(response.data.code == 200) {
		               	 			vm.$root.$emit('printReceipt',1);
	                            } 
	                            else if(response.data.code == 300) {
	                                toastr.error('Record not added.', 'Error', {timeOut: 5000});
	                                vm.$root.$emit('printReceipt',1);
	                            } 
	                            else{
	                                toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
	                                vm.$root.$emit('printReceipt',1);
	                            }
		            	},	
		                (error) => {	
		                	 $("body .js-loader").addClass('d-none');	
							toastr.error('Something Went wrong.', 'receipt error', {timeOut: 5000});	
		                }	
		                )	
				    	
			    }

		    },	
               (error) => {	
                }	
               )	
				e.preventDefault();
			},
			 GetSelectComponent(componentName) {
                this.$router.push({name: componentName})
          },
		  },
     }	
</script>


