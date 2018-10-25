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
				 			<div class="col-md-6" v-if="patientReceiptData.charges_type == 1">
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
				 	<div class="col-md-6" v-if="patientReceiptData.charges_type == 2">
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
				<div class="row form-group">	
					<div class="col-md-6" >
						<div class="col-md-9">
				      		<label class="control-label" for="neurological_procedures">Neurological Procedures: </label>
						</div>
						<div class="col-md-9">
				      		<select class="form-control ls-select2"  id="neurological_procedures" name="neurological_procedures"   >
				      			<option value="">Select</option>
								 <option :value="neurological_procedures.id" v-for="neurological_procedures in patientReceiptData.neurological_procedures_option">{{neurological_procedures.text}}</option>
				      		</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-9">
				      		<label class="control-label" for="neurological_procedure_charges">Neurological Procedure Charges: </label>
						</div>
						<div class="col-md-9">
				      		<input class="form-control" type="text" name="neurological_procedure_charges" id="neurological_procedure_charges"  v-validate="'numeric'" v-model="patientReceiptData.neurological_procedure_charges" />
				      		<span class="help is-danger" v-show="errors.has('neurological_procedure_charges')"> 
				      		Please enter valid procedure charges. </span> 
						</div>
					</div>
				</div>
				<div class="row form-group">
					<div class="col-md-6" >
						<div class="col-md-9">
				      		<label class="control-label" for="vascular_procedures">Vascular Procedures: </label>
						</div>
						<div class="col-md-9">
				      		<select class="form-control ls-select2"  id="vascular_procedures" name="vascular_procedures" >
				      			<option value="">Select</option>
								 <option :value="vascular_procedures.id" v-for="vascular_procedures in patientReceiptData.vascular_procedures_option">{{vascular_procedures.text}}</option>
				      		</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-9">
				      		<label class="control-label" for="vascular_procedure_charges">Vascular Procedure Charges: </label>
						</div>
						<div class="col-md-9">
				      		<input class="form-control" type="text" name="vascular_procedure_charges" id="vascular_procedure_charges"  v-validate="'numeric'" v-model="patientReceiptData.vascular_procedure_charges" />
				      		<span class="help is-danger" v-show="errors.has('vascular_procedure_charges')"> 
				      		Please enter valid procedure charges. </span> 
						</div>
					</div>	
				</div>
				<div class="row form-group">
					<div class="col-md-6" >
						<div class="col-md-9">
				      		<label class="control-label" for="physiotherapy_procedures">Physiotherapy And Rehabilitation Procedures: </label>
						</div>
						<div class="col-md-9">
				      		<select class="form-control ls-select2"  id="physiotherapy_procedures" name="physiotherapy_procedures" >
				      		</select>
						</div>
					</div>	
					<div class="col-md-6">
						<div class="col-md-9">
				      		<label class="control-label" for="physiotherapy_procedure_charges">Physiotherapy Procedure Charges: </label>
						</div>
						<div class="col-md-9">
				      		<input class="form-control" type="text" name="physiotherapy_procedure_charges" id="physiotherapy_procedure_charges"  v-validate="'numeric'" v-model="patientReceiptData.physiotherapy_procedure_charges" />
				      		<span class="help is-danger" v-show="errors.has('physiotherapy_procedure_charges')"> 
				      		Please enter valid procedure charges. </span> 
						</div>
					</div>
				</div>
				<div class="row form-group" >
					<div class="col-md-6">
						<div class="col-md-9">
					      		<label class="control-label" for="other_charges_category">Other Procedure Category: </label>
							</div>
							<div class="col-md-9">
					      		<select class="form-control ls-select2"  id="other_charges_category" name="other_charges_category" >
					      		</select>
							</div>
					</div>
					<div class="col-md-6">
						<div class="col-md-9">
				      		<label class="control-label" for="other_charges">Other Procedure Charges: </label>
						</div>
						<div class="col-md-9">
				      		<input class="form-control" type="text" name="other_charges" id="other_charges"  v-validate="'numeric'" v-model="patientReceiptData.other_charges" />
				      		<span class="help is-danger" v-show="errors.has('other_charges')"> 
				      			Please enter valid other charges. </span> 
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
	//$(document).ready(function(){
    //get it if Status key found
    if(localStorage.getItem("Receipt"))
    {
        toastr.success('success.', 'Receipt Saved successfully', {timeOut: 5000});
        localStorage.removeItem("Receipt");
        //localStorage.clear();
    }
    if(localStorage.getItem("ReceiptAdd"))
    {
        toastr.success('success.', 'Receipt Saved successfully', {timeOut: 5000});
        localStorage.removeItem("ReceiptAdd");
        //localStorage.clear();
    }
//});
		import User from '../../../api/users.js';
		import myDatepicker from 'vue-datepicker';

		let list=[];
		let charges_list=[];
		var patientId = '';
		var other_option=[{id: '', text: 'Select'},{id: '1', text: 'Procedure Charges', children: [ {id:1,text:'Dressing'}, {id:2,text:'Special dressing'}, {id:3,text:'Strip Method RBS	'}, {id:4,text:'ECG'}, {id:5,text:'Enema'}, {id:6,text:'Urine Sugar (Per Test)'}, {id:7,text:'Suture Removal'}, {id:8,text:'Ambulance Charge (Within city limits only)'}, {id:9,text:'Escort with Ventilator (per hour)'}, {id:10,text:'Escort without Ventilator (per hour)'} ], "element": HTMLOptGroupElement }, {id: '2', text: 'Wound Care', children: [ {id:11,text:'Dressing - Minor'}, {id:12,text:'Dressing - Major'}, {id:13,text:'Vac (per session + actual expenditure)'}, {id:14,text:'Special Dressing'} ], "element": HTMLOptGroupElement } ];
		/*for physiotherapy*/
		var physio_option=[{id: '', text: 'Select'},{id: '1', text: 'Pain Management',children: [ {id:1,text:'Evaluation + Exercise Therapy (Daily)'}, {id:2,text:'Evaluation + Exercise Therapy + Electro Therapy (One Modality) (Daily)'}, {id:3,text:'Evaluation + Exercise Therapy + Electro Therapy (Two Modalities) (Daily)'}, {id:4,text:'Evaluation + Exercise Therapy (Weekly)'}, {id:5,text:'Evaluation + Exercise Therapy + Electro Therapy (One Modality) (Weekly)'}, {id:6,text:'Evaluation + Exercise therapy + Electro Therapy (Two Modalities) (Weekly)'} ], "element": HTMLOptGroupElement }, {id: '2', text: 'Rehabilitation', children: [ {id:7,text:'Evaluation + Exercise Therapy (Daily)'}, {id:8,text:'Evaluation + Exercise Therapy + Assist Modality (Any One)[FES/MEntamove/Treadmill/Tilt Table/Cycling] (Daily)'}, {id:9,text:'Evaluation + Exercise Therapy + Assist Modality (2 Assist Modalities)(Daily)'}, {id:10,text:'Evaluation + Exercise Therapy + Assist Modality (All Assist Modalities)(Daily)'},{id:11,text:'Evaluation + Exercise Therapy (Weekly)'}, {id:12,text:'Evaluation + Exercise Therapy + Assist Modality (Any One)[FES/MEntamove/Treadmill/Tilt Table/Cycling] (Weekly)'}, {id:13,text:'Evaluation + Exercise Therapy + Assist Modality (2 Assist Modalities)(Weekly)'}, {id:14,text:'Evaluation + Exercise Therapy + Assist Modality (All Assist Modalities)(Weekly)'} ], "element": HTMLOptGroupElement } ];
		

		export default {
			props:['receipt_id'],
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
		                	'neurological_procedures':'',
		                	'neurological_procedures_option': [
								{id:1,text:'EEG'},
								{id:2,text:'Bedside EEG'},
								{id:3,text:'Video EEG'},
								{id:4,text:'Nerve Conduction Studies per limb / 2 limbs'},
								{id:5,text:'Nerve Conduction Studies (All 4 limbs)'},
								{id:6,text:'Electromyography with disposable needle'},
								{id:7,text:'Visual evoked potentials (VEP)'},
								{id:8,text:'Auditory evoked potentials (BAEP)'},
								{id:9,text:'Somatosensory potentials (SSEP) / per nerve'},
								{id:10,text:'Facial Nerve study'},
								{id:11,text:'Repetitive Nerve stimulation'},
								{id:12,text:'Lumbar Puncture / +Manometry'},
								{id:13,text:'Neostigmine Test'},
								{id:14,text:'Bedside NCV (all 4 limbs)'},
								{id:15,text:'Bedside NCV (2 limbs)'},
								{id:16,text:'Bedside RNS'},
								{id:17,text:'Stroke Management Charges'},
								],
							'vascular_procedures':'',
		                	'vascular_procedures_option': [
								{id:1,text:'Color Doppler (per leg)'},
								{id:2,text:'Color Doppler Carotid'},
								{id:3,text:'Ankle Brachial Index / TBI'},
								{id:4,text:'Toe Brachial Index'},
								{id:5,text:'Maximum Venous Flow'},
								{id:6,text:'Pneumatic Compression Device'},
								{id:7,text:'Photo Plethysmography'},
							],
							'other_charges_category':'',
		                	'other_charges_category_option':{},
							'other_charges':'',
							'neurological_procedure_charges':'',
							'vascular_procedure_charges':'',
							'physiotherapy_procedure_charges':'',
							'physiotherapy_procedures':'',
							'receiptId':''
		                	
		                	
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
				    
		          	    $('#other_charges_category').select2({
							 //placeholder: "Select",
							 //dropdownParent: $("#receiptAddModel"),
							 data:other_option
						});
						$('#physiotherapy_procedures').select2({
							 //placeholder: "Select",
							 //dropdownParent: $("#receiptAddModel"),
							 data:physio_option
						});
					
	          	    $(document).on("select2:select",'.ls-select2', function (e) { 
			            if(this.id == 'vascular_procedures'){
			             	let vascular_procedures_val=$(this).val();
		          	    	vm.patientReceiptData.vascular_procedures=vascular_procedures_val;
		          	    	if(vascular_procedures_val==1)
		          	    	{
		          	    		vm.patientReceiptData.vascular_procedure_charges=2400;
		          	    	}
		          	    	else if(vascular_procedures_val==2)
		          	    	{
		          	    		vm.patientReceiptData.vascular_procedure_charges=2400;
		          	    	}
		          	    	else if(vascular_procedures_val==3)
		          	    	{
		          	    		vm.patientReceiptData.vascular_procedure_charges=1200;
		          	    	}
		          	    	else if(vascular_procedures_val==4)
		          	    	{
		          	    		vm.patientReceiptData.vascular_procedure_charges=1200;
		          	    	}
		          	    	else if(vascular_procedures_val==5)
		          	    	{
		          	    		vm.patientReceiptData.vascular_procedure_charges=1200;
		          	    	}	
		          	    	else if(vascular_procedures_val==6)
		          	    	{
		          	    		vm.patientReceiptData.vascular_procedure_charges=1200;
		          	    	}
		          	    	else if(vascular_procedures_val==7)
		          	    	{
		          	    		vm.patientReceiptData.vascular_procedure_charges=1800;
		          	    	}
			            }
			            else if(this.id == 'neurological_procedures')
			            {
			            	let neurological_procedures_val=$(this).val();
		          	    	vm.patientReceiptData.neurological_procedures=neurological_procedures_val;
		          	    	if(neurological_procedures_val==1)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=1500;
		          	    	}
		          	    	else if(neurological_procedures_val==2)
		          	    	{

		          	    		vm.patientReceiptData.neurological_procedure_charges=3000;
		          	    	}
		          	    	else if(neurological_procedures_val==3)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=1200;
		          	    	}
		          	    	else if(neurological_procedures_val==4)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=1000;
		          	    	}
		          	    	else if(neurological_procedures_val==5)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=3500;
		          	    	}	
		          	    	else if(neurological_procedures_val==6)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=2500;
		          	    	}
		          	    	else if(neurological_procedures_val==7)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=2000;
		          	    	}
		          	    	else if(neurological_procedures_val==8)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=2000;
		          	    	}
		          	    	else if(neurological_procedures_val==9)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=2000;
		          	    	}
		          	    	else if(neurological_procedures_val==10)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=1500;
		          	    	}
		          	    	else if(neurological_procedures_val==11)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=1500;
		          	    	}
		          	    	else if(neurological_procedures_val==12)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=2000;
		          	    	}
		          	    	else if(neurological_procedures_val==13)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=1200;
		          	    	}
		          	    	else if(neurological_procedures_val==14)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=6000;
		          	    	}
		          	    	else if(neurological_procedures_val==15)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=3500;
		          	    	}
		          	    	else if(neurological_procedures_val==16)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=2500;
		          	    	}
		          	    	else if(neurological_procedures_val==17)
		          	    	{
		          	    		vm.patientReceiptData.neurological_procedure_charges=5000;
		          	    	}
			            }
			            else if(this.id == 'physiotherapy_procedures')
			            {
			            	let physiotherapy_procedures_val=$(this).val();
		          	    	vm.patientReceiptData.physiotherapy_procedures=physiotherapy_procedures_val;
		          	    	if(physiotherapy_procedures_val==1)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=300;
		          	    	}
		          	    	else if(physiotherapy_procedures_val==2)
		          	    	{

		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=400;
		          	    	}
		          	    	else if(physiotherapy_procedures_val==3)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=500;
		          	    	}
		          	    	else if(physiotherapy_procedures_val==4)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=1200;
		          	    	}
		          	    	else if(physiotherapy_procedures_val==5)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=2000;
		          	    	}	
		          	    	else if(physiotherapy_procedures_val==6)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=2500;
		          	    	}
		          	    	else if(physiotherapy_procedures_val==7)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=500;
		          	    	}
		          	    	else if(physiotherapy_procedures_val==8)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=600;
		          	    	}
		          	    	else if(physiotherapy_procedures_val==9)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=700;
		          	    	}
		          	    	else if(physiotherapy_procedures_val==10)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=900;
		          	    	}
		          	    	else if(physiotherapy_procedures_val==11)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=2200;
		          	    	}
		          	    	else if(physiotherapy_procedures_val==12)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=3500;
		          	    	}
		          	    	else if(physiotherapy_procedures_val==13)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=3800;
		          	    	}
		          	    	else if(physiotherapy_procedures_val==14)
		          	    	{
		          	    		vm.patientReceiptData.physiotherapy_procedure_charges=5500;
		          	    	}
			            }
			            else if(this.id == 'case_type')
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
								$('#emergency_type').select2('destroy');
								setTimeout(function(){
								    	 /*for consultation type*/
				       	 				$('#consultation_type').select2({
						          	 	 	placeholder: "Select",
						          	 	});
				           	 	},500);
							}
							else if(charges_type_val==2)
							{
								$('#consultation_type').select2('destroy');
								setTimeout(function(){
							    	/*for emergency type*/
			       	 				$('#emergency_type').select2({
					          	 		placeholder: "Select",
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
			            else if(this.id == 'other_charges_category')
			            {

			            		let other_charges_category_val=$(this).val();
			          	    	vm.patientReceiptData.other_charges_category=other_charges_category_val;
			          	    	if(other_charges_category_val==1)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=400;
			          	    	}
			          	    	else if(other_charges_category_val==2)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=600;
			          	    	}
			          	    	else if(other_charges_category_val==3)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=100;
			          	    	}
			          	    	else if(other_charges_category_val==4)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=400;
			          	    	}
			          	    	else if(other_charges_category_val==5)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=200;
			          	    	}	
			          	    	else if(other_charges_category_val==6)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=100;
			          	    	}
			          	    	else if(other_charges_category_val==7)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=400;
			          	    	}
			          	    	else if(other_charges_category_val==8)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=500;
			          	    	}
			          	    	else if(other_charges_category_val==9)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=3000;
			          	    	}
			          	    	else if(other_charges_category_val==10)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=1800;
			          	    	}
			          	    	else if(other_charges_category_val==11)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=200;
			          	    	}
			          	    	else if(other_charges_category_val==12)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=400;
			          	    	}
			          	    	else if(other_charges_category_val==13)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=2400;
			          	    	}
			          	    	else if(other_charges_category_val==14)
			          	    	{
			          	    		vm.patientReceiptData.other_charges=600;
			          	    	}
			            }
			        });
  					
	             	vm.getReceiptData();
  					
	         },
	         methods: {
	         	getReceiptData()
	         	{
	         		let vm=this;
	         		let receipt_id=vm.receipt_id; 
	         		vm.patientReceiptData.receiptId=receipt_id;
	         		 User.getReceiptDetailsById(receipt_id).then(
				    	(response) => {
	               	 		if(response.data.code == 200) {
	               	 			let receipt_data=response.data.data;
                                vm.setReceiptData(receipt_data);
                            } else if(response.data.code == 300) {
                                toastr.error('Record not found', 'Error', {timeOut: 5000});
                                this.$root.$emit('close_modal',1);
                            } else{
                                toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
                                this.$root.$emit('close_modal',1);
                            }

	               	 	},
	               		(error) => {
	            	 	},
	               	);

	         	},
	         	setReceiptData(receipt_data)
	         	{
	         		let vm=this;
	         		vm.patientReceiptData.patient_name=receipt_data.patient_details.first_name+' '+receipt_data.patient_details.last_name;
	         		vm.patientReceiptData.patient_id=receipt_data.patient_details.id;
	         		vm.patientReceiptData.date_receipt.time=receipt_data.date;
	         		vm.patientReceiptData.charges_type=receipt_data.charges_name;
	         		$("#charges_type").val(receipt_data.charges_name).trigger('change');
	         		if(receipt_data.charges_name==1)
	         		{
	         			
	         			vm.patientReceiptData.consultation_type=receipt_data.consultation_charges_id;
	         			setTimeout(function(){
	         				$("#consultation_type").val(receipt_data.consultation_charges_id).trigger('change');
	         			},300);
	         			
	         		}
	         		else if(receipt_data.charges_name==2)
	         		{
	         			vm.patientReceiptData.emergency_type=receipt_data.emergency_charges_id;
	         			setTimeout(function(){
	         				$("#emergency_type").val(receipt_data.emergency_charges_id).trigger('change');
	         			},300);
	         		}
	         		if(receipt_data.amount!=null && receipt_data.amount!=0 && receipt_data.amount!='')
	         		{
	         			vm.patientReceiptData.chargeAmount=receipt_data.amount;
	         		}
	         		if(receipt_data.neurological_procedures_id!='' && receipt_data.neurological_procedures_id!=null && receipt_data.neurological_procedures_id!=0)
	         		{
	         			vm.patientReceiptData.neurological_procedures=receipt_data.neurological_procedures_id;
	         			$("#neurological_procedures").val(receipt_data.neurological_procedures_id).trigger('change');
	         		}
	         		if(receipt_data.vascular_procedures_id!='' && receipt_data.vascular_procedures_id!=null && receipt_data.vascular_procedures_id!=0)
	         		{
	         			vm.patientReceiptData.vascular_procedures=receipt_data.vascular_procedures_id;
	         			$("#vascular_procedures").val(receipt_data.vascular_procedures_id).trigger('change');
	         		}
	         		if(receipt_data.physiotherapy_procedures_id!='' && receipt_data.physiotherapy_procedures_id!=null && receipt_data.physiotherapy_procedures_id!=0)
	         		{
	         			vm.patientReceiptData.physiotherapy_procedures=receipt_data.physiotherapy_procedures_id;
	         			$("#physiotherapy_procedures").val(receipt_data.physiotherapy_procedures_id).trigger('change');
	         		}
	         		if(receipt_data.neurological_procedure_charges!='' && receipt_data.neurological_procedure_charges!=null && receipt_data.neurological_procedure_charges!=0)
	         		{
	         			vm.patientReceiptData.neurological_procedure_charges=receipt_data.neurological_procedure_charges;
	         		}
	         		if(receipt_data.vascular_procedure_charges!='' && receipt_data.vascular_procedure_charges!=null && receipt_data.vascular_procedure_charges!=0)
	         		{
	         			vm.patientReceiptData.vascular_procedure_charges=receipt_data.vascular_procedure_charges;
	         		}
	         		if(receipt_data.physiotherapy_procedure_charges!='' && receipt_data.physiotherapy_procedure_charges!=null && receipt_data.physiotherapy_procedure_charges!=0)
	         		{
	         			vm.patientReceiptData.physiotherapy_procedure_charges=receipt_data.physiotherapy_procedure_charges;
	         		}
	         		if(receipt_data.other_charges_id!='' && receipt_data.other_charges_id!=null && receipt_data.other_charges_id!=0)
	         		{
	         			vm.patientReceiptData.other_charges_category=receipt_data.other_charges_id;
	         			$("#other_charges_category").val(receipt_data.other_charges_id).trigger('change');
	         		}
	         		if(receipt_data.other_charges!='' && receipt_data.other_charges!=null && receipt_data.other_charges!=0)
	         		{
	         			vm.patientReceiptData.other_charges=receipt_data.other_charges;
	         		}
	         	},
	         	receiptPrintView: function (e) {
		         	let vm=this;
			    	this.$validator.validateAll().then(  	
		            (response) => { 
		            	
		            	if (!this.errors.any()) {
		            		let content = [];
		            		$("body .js-loader").removeClass('d-none');
		            		User.generateEditReceiptData(vm.patientReceiptData).then(	
			                (response) => {
			                	$("body .js-loader").addClass('d-none');
			                	if(response.data.code == 200) {
		               	 			toastr.success('Receipt successfully updated.', 'Success', {timeOut: 5000});
		               	 			this.$root.$emit('close_modal',1);
	                            } 
	                            else if(response.data.code == 300) {
	                                toastr.error('Record not edited.', 'Error', {timeOut: 5000});
	                                this.$root.$emit('close_modal',1);
	                            } 
	                            else{
	                                toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
	                                this.$root.$emit('close_modal',1);
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


