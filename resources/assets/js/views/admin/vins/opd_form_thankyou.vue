<template id="">
  <div class="container" style="padding: 170px 0px;">
    <div class="page-header">
      <div class="row text-center">
        <div class="col-md-12">
          <h1>Thank You</h1>
        </div>
      </div>
    </div>
    <form action="" method="post">
    	 <div class="row form-group text-center">
    	 	 <div class="col-md-12">
    	 	 	<!-- <div class="col-md-4"> -->
    	 	 		<!-- <button type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal"  @click = "printReport('opd_case')" v-if="(opdReport == true)" id="opd_case_btn">OPD Case</button>
 -->    	 	 	
    	 	 		<button type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#generateModal"  @click="printReport('generate_case')" v-if="(opdReport == false)"> Print Report</button>
    	 	 <!-- 	</div>
    	 	 	<div class="col-md-4">
    	 	 		<button type="button" class="btn btn-primary btn-submit text-right " data-toggle="modal" href="#printModal"  @click="printPriscription()">Prescription</button>
    	 	 	</div>
    	 	 	<div class="col-md-4"> 
    	 	 		<button type="button" class="btn btn-primary btn-submit text-right " data-toggle="modal" href="#printModal"  @click="printReferal()">Referal</button>-->
 					<button type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal"  @click = "printReport('print_perceptions')"  id="opd_case_btn">Print Perceptions</button>
    	 	 		<button  v-if="(labReportData)" type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal" @click = "printReport('lab')" >Lab Report</button>
    	 	 		<button  v-if="(radioReportData)" type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal" @click = "printReport('radiology')" >Radiology Report</button>
    	 	 		<button v-if="(prescriptiData)" type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal" @click = "printReport('prescription')">Print Prescription</button>
    	 	 		
    	 	 		<!-- <button type="button" class="btn btn-primary btn-submit text-right" @click = "GetSelectComponent('patients_receipt_form')">Generate Receipts</button>  -->
    	 	 	<!--</div> -->
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
		 				<div id="printData" style="height: 1500px;min-height: 700px;">
			 					<div  id="printContent">
			 					</div>
			 					<vinsletterheadheaderpart></vinsletterheadheaderpart>
			 					<patientDetailReport :patientDetail="patientDetail" :consult_dr="adviceDoctor" :todayDate="todayDate"  :department="department" :reg_no="regNo" :refer_dr="reference"></patientDetailReport>
			 					<patientCheckupReport :patientCheckupDetail="patientCheckupDetail"></patientCheckupReport>
								 	<div v-if="(printType == 'lab')" >
								 		
								 		<div class='row'>
								 				<div class='col-md-12 text-center'>
								 					<h4>Lab Report</h4>
								 				</div>
								 			</div>

								 			   <div class="form-group" v-if="labReportData != null">
									                <div class="col-md-12">
									                  <div class="">
									                    <table class="table table-striped table-bordered" id="laboratory_table_list">
									                        <thead>
									                        <tr>
									                            <th>#</th>
									                            <th>Name</th>
									                           
									                        </tr>
									                        </thead>
									                        <tbody>
									                         <tr :id="res.tr_id" v-for="(res,index) in labReportData">
									                            <td>{{++index}}</td> 
									                            <td>{{res.name }}</td>
									                          
									                          </tr>

									                        </tbody>
									                    </table>
									                  </div>
									                  
									                </div>
									              </div>
								 	</div>
			 <div>	
			 	<div v-if="(printType == 'radiology')">
			 		<div class='row' v-if="(radioReportData)">
			 				<div class='col-md-12 text-center'>
			 					<h4>Radiology Report</h4>
			 				</div>
			 		</div>
			 		<div class="row"  v-if="(radioReportData)">
        				<div class="col-md-12">
        					<div class="">
                    			<table class="table table-striped table-bordered" id="radio_list">
                        		<thead>
                        			<tr>
                            			<th>#</th>
                            			<th>Type</th>
                            			<th>Body parts</th>
			                            <th>Qualifier</th>
			                            <th>Special request</th>
			                            <th>Details</th>
			                            
                        			</tr>
                       			 </thead>
                       			 <tbody>
		                        <tr v-if="res.removed == false" v-for="(res,index) in radioReportData">
		                            <td>{{++index}}</td>
		                            <td>{{res.type}}</td>
		                            <td>{{res.bodyPart}}</td>
		                            <td>{{res.qualifier}}</td>
		                            <td>{{res.special_request}}</td>
		                            <td>{{res.textData | strLimit}}</td>
		                            <!-- <td><img :src="res.imgData" height="100" width="100" /></td> -->
		                            
		                        </tr>
                        		</tbody>
                    			</table>
                			</div>
        				</div>
        			</div>
			 	</div>
			 	<div v-if="(printType == 'prescription' && prescriptiData.length != '')"  >
    	 	 			
			 			<div v-if="presp_count(prescriptiData)>0" >
    	 	 				<div class='row' v-show="presp_count(prescriptiData)>0">
				 				<div class='col-md-12 text-center'>
				 					<span class='text-center'><b>Prescription</b></span>
				 				</div>
			 				</div>
							<prescriptionPrint :prescriptData="prescriptiData" :removeBtn="0"> </prescriptionPrint>
    	 	 			</div>
    	 	 			<div v-if="(referalType == 'cross' && crossSelectedValue != '')">
			 				
				 			<div class='col-md-12 text-center'>
				 				<span class='text-center'><b>Cross Referal </b></span>
				 			</div>
			 				<div v-if="(crossType == 'internal')">
			 					
			 						<div class='col-md-6 text-left'>
			 							<span class='text-left'><b>Internal</b></span> {{this.$store.state.Patient.opdData.cross_type_int}}
			 						</div>
			 				</div>
			 				<div v-if="(crossType == 'external')">
			 					
			 						<div class='col-md-6 text-left'>
			 								<span class='text-left text-capitalize' style='padding-left:30px;padding-right;20px'><b>External
			 					</b></span>{{this.$store.state.Patient.opdData.cross_type_ext}}
			 						</div>
			 					
			 				</div>
				 		</div>

			 	</div>
			 	<div v-if="(printType == 'print_perceptions')" 	>
			 		<div>
		 				<div class='col-md-6 text-left'>
						 				<span class='text-left'><b>Provisional Diagnostic :-</b></span>
						 	</div>
						 	<div class='row'>
					 					<div class='col-md-12 text-left'>
					 							<span class='text-left' style="padding-left:30px;"> {{provisional_diagnostic}}</span>
					 					</div>
									</div>
		 				</div>
		 				<div v-if="presp_count(prescriptiData)>0" >
							<prescriptionPrint :prescriptData="prescriptiData" :removeBtn="0"> </prescriptionPrint>
    	 	 			</div>
		 				<div v-if="(adviceType == 'text' && advice != '')">
		    	 	 				<div class='col-md-6 text-left'>
						 				<span class='text-left'><b>Advice :-</b></span>
						 			</div>
						 			<div class='row'>
					 					<div class='col-md-12 text-left' v-if ="(adviceType == 'text')">
					 							<span class='text-left' style="padding-left:30px;"> {{advice}}</span>
					 					</div>
									</div>
		    	 	 			</div>
		    	 	 			<div v-if="(adviceType !== 'text' && adviceScribleValue != '')">
		    	 	 				<div class='col-md-6 text-left'>
						 				<span class='text-left'><b>Advice :-</b></span>
						 			</div>
						 			<div class='row'>
					 					<div class='col-md-12 text-left' v-if ="(adviceType != 'text')">
								            <img :src="adviceScribleValue" title="Advice">
								        </div>  
									</div>
		    	 	 			</div>
		 				<div v-if="(referalType == 'cross' && crossSelectedValue != '')">
			 				
				 			<div class='col-md-12 text-center'>
				 				<span class='text-center'><b>Cross Referal </b></span>
				 			</div>
			 				<div v-if="(crossType == 'internal')">
			 					
			 						<div class='col-md-6 text-left'>
			 							<span class='text-left'><b>Internal</b></span> {{this.$store.state.Patient.opdData.cross_type_int}}
			 						</div>
			 				</div>
			 				<div v-if="(crossType == 'external')">
			 					
			 						<div class='col-md-6 text-left'>
			 								<span class='text-left text-capitalize' style='padding-left:30px;padding-right;20px'><b>External
			 					</b></span>{{this.$store.state.Patient.opdData.cross_type_ext}}
			 						</div>
			 					
			 				</div>
				 		</div>

		 				<div v-if="(followup != '')">
		    	 	 				<div class='col-md-6 text-left'>
						 				<span class='text-left'><b>FollowUp :-</b></span>
						 			</div>
						 			<div>
					 					<div class='col-md-12 text-left'>
								           {{followup}}
								        </div>  
									</div>
		    	 	 			</div>

			 	</div>
			 	<div v-if="(printType == 'opd_case')"  >

			 			<div class='row'>
			 				<div class='col-md-12 text-center'>
			 					<h4>OPD CASE</h4>
			 				</div>
			 			</div>
				 		
    	 	 			<div v-for="reportName in checkedreportList">

	    	 	 			<div v-if="(reportName == 'Advice + follow ups')">
		    	 	 			<div v-if="(adviceType == 'text' && advice != '')">
		    	 	 				<div class='col-md-6 text-left'>
						 				<span class='text-left'><b>Advice :-</b></span>
						 			</div>
						 			<div class='row'>
					 					<div class='col-md-12 text-left' v-if ="(adviceType == 'text')">
					 							<span class='text-left' style="padding-left:30px;"> {{advice}}</span>
					 					</div>
									</div>
		    	 	 			</div>
		    	 	 			<div v-if="(adviceType !== 'text' && adviceScribleValue != '')">
		    	 	 				<div class='col-md-6 text-left'>
						 				<span class='text-left'><b>Advice :-</b></span>
						 			</div>
						 			<div class='row'>
					 					<div class='col-md-12 text-left' v-if ="(adviceType != 'text')">
								            <img :src="adviceScribleValue" title="Advice">
								        </div>  
									</div>
		    	 	 			</div>
		    	 	 			<br/><br/>
	    	 	 			
		    	 	 			<div v-if="(followup != '')">
		    	 	 				<div class='col-md-6 text-left'>
						 				<span class='text-left'><b>FollowUp :-</b></span>
						 			</div>
						 			<div>
					 					<div class='col-md-12 text-left'>
								           {{followup}}
								        </div>  
									</div>
		    	 	 			</div>
		    	 	 		</div>
	    	 	 			<div v-if="(reportName == 'Radiology')">
	    	 	 				<div class='row' v-if="(radioReportData)">
				 					<div class='col-md-12 text-center'>
				 							<h4>Radiology Report</h4>
				 					</div>
				 				</div>
			 					<div class="row"  style="padding-left: 15px;padding-right:15px;" v-if="(radioReportData)">
        							<div class="col-md-12">
        									<div class="">
                    							<table class="table table-striped table-bordered" id="radio_list">
                        							<thead>
                        								<tr>
                            							<th>#</th>
                            							<th>Type</th>
                            							<th>Body parts</th>
			                            				<th>Qualifier</th>
			                            				<th>Special request</th>
			                            				<th>Details</th>
			                            				</tr>
                       			 					</thead>
                       			 					<tbody>
		                        						<tr v-if="res.removed == false" v-for="(res,index) in radioReportData">
		                            						<td>{{++index}}</td>
		                            						<td>{{res.type}}</td>
		                            						<td>{{res.bodyPart}}</td>
		                            						<td>{{res.qualifier}}</td>
		                            						<td>{{res.special_request}}</td>
		                            						<td>{{res.textData | strLimit}}</td>
		                            						<!-- <td><img :src="res.imgData" height="100" width="100" /></td> -->
		                            						<td></td>
		                        						</tr>
                        							</tbody>
                    							</table>
                							</div>
        								</div>
        							</div>
    	 	 					</div>
    	 	 					<div v-if="(reportName == 'Laboratory')">
    	 	 						abc
    	 	 						<div class='row' v-if="(labReportData)">
										<div class='col-md-12 text-center'>
						 					<h4>Lab Report</h4>
						 				</div>
						 			</div>
								 	<div class="form-group" v-if="(labReportData)">
									    <div class="col-md-12">
										    <div class="">
									            <table class="table table-striped table-bordered" id="laboratory_table_list">
									                <thead>
									                    <tr>
									                    <th>#</th>
									                    <th>Name</th>
									                  
									                    </tr>
									                </thead>
									                <tbody>
									                    <tr :id="res.tr_id" v-for="(res,index) in labReportData">
									                            <td>{{++index}}</td> 
									                            <td>{{res.name }}</td>
									                           
									                    </tr>

									                </tbody>
									            </table>
									        </div>
									    </div>
									</div>
    	 	 					</div>
    	 	 					<div v-if="(reportName == 'Prescription')">
    	 	 			         	<div v-if="(prescriptiData != null)" >
    	 	 							<div class='row' v-show="(prescriptiData.length != '')">
				 							<div class='col-md-12 text-center'>
				 								<span class='text-center'><b>Prescription</b></span>
				 							</div>
			 							</div>
										<prescriptionPrint :prescriptData="prescriptiData" :removeBtn="0"> </prescriptionPrint>
    	 	 						</div>
    	 	 					</div>
		 					</div>
		 				</div>
		 				
		 				<div class='text-right'>
		 					<img  :src="'/assets/img/signature/'+signatureName+'.png'" height="66" width="182"/>
		 					
		 				</div>	
		 				<div class='text-right'>
		 					<!-- <img  :src="'/assets/img/timestamp/'+timeStamp+'.png'" height="66" width="182"/> -->
		 					<span><b>{{doctoreName}}</b></span><br/>
		 					<span><b>{{timeStamp}}</b></span><br>
		 					<span><b>{{regNo}}</b></span>
						</div>	
	 					<div >	
	 						<!-- <div class="row" >
            				<div class='col-md-12 text-right'>
								<span class='text-right'><b>Consultant's Signature</b></span>
	 						</div>
						</div>	 -->
					</div>
				</div>
				<vinsletterheadfooterpart></vinsletterheadfooterpart>
			</div>
		</div>
       	<div class="modal-footer">	
				<button  type="button" class="btn btn-primary"  @click="ClickHereToPrint()">Print</button>	
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
             <!--  <button type="button" class="btn btn-primary">Save</button>-->	
        </div>	
        </div>
     </div>
  </div>
</div>
</template>
<script >
	import User from '../../../api/users.js';
	import vinsletterheadheaderpart from './vins_letter_header.vue';
	import vinsletterheadfooterpart from './vins_letter_footer.vue';
	import patientDetailReport from './patientDetailReport.vue';
	import patientCheckupReport from './patientCheckupReport.vue';
	import prescriptionData from './prescriptionData.vue';
	import prescriptionPrint from './prescriptionPrint.vue';
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
				'printContent':'',
				'print_content_shows':false,
				'adviceType' :this.$store.state.Patient.opdData.adviceType,
				'adviceDoctor':this.$store.state.Users.userDetails.first_name+' '+this.$store.state.Users.userDetails.last_name,
				'referalType':this.$store.state.Patient.opdData.referral,
				'crossType':this.$store.state.Patient.opdData.cross,
				'radiologyData':this.$store.state.Patient.opd_resultData,
				//'radiologyData':this.$store.state.Patient.opdData.reffreal_radiology_array,
				'printType':'opd_case',
				'todayDate' : formattedDate,
				'crossSelectedValue' : '',
				'adviceScribleValue' : '',
				'advice' : this.$store.state.Patient.opdData.advice,
				'prescriptiData' : this.$store.state.Patient.prescriptionData,

				//'radioReportData' : this.$store.state.Patient.radioData, 
				'radioReportData' : this.$store.state.Patient.opdData.reffreal_radiology_array, 
				//'labReportData' : this.$store.state.Patient.laboratoryData.type,
				'labReportData' :  this.$store.state.Patient.opdData.reffreal_laboratory_array,
				'consultntId' : '',
				'consultName' : '',
				'signatureName' : '',
				'doctoreName' :'',
				'timeStamp' : '',
				'regNo':'',
				'followup' : this.$store.state.Patient.neuroExaminationData.follow_up,
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
		      	'opdReport' : false,
		      	'reportListSelect' : 0,
		      	'patinetId' : this.$store.state.Patient.patientId,
		      	'opdId' : '',
		      	'patientDetail' : {},
		      	'patientCheckupDetail' : {},
		      	'department': '',
		      	'provisional_diagnostic' : this.$store.state.Patient.opdData.provisional_diagnosis,
		      	'reference' : '',
		      	'sectionOpdId' : '',
		      	'historyType' : this.$store.state.Patient.opdData.historyType,
		      	'historyScableValue' : '',
		      	'history' : this.$store.state.Patient.opdData.history,
		      	'pastHistoryType' : this.$store.state.Patient.opdData.pastHistoryType,
				'pastHistoryScableValue' : '',
		      	'past_history' :  this.$store.state.Patient.opdData.past_history,
			}
		},
		components: {
         vinsletterheadheaderpart,
         vinsletterheadfooterpart,
         prescriptionPrint,
         patientDetailReport,
         patientCheckupReport,
       },
       mounted(){
			let vm =this;
			if(vm.$store.state.Users.userDetails.user_type != '1'){
              vm.$root.$emit('logout','You are not authorise to access this page'); 
          	}
       		if(this.referalType == 'cross'){
				if(this.crossType == 'internal'){
					this.crossSelectedValue = this.$store.state.Patient.opdData.cross_type_int;
			    }
				if(this.crossType == 'external'){
					this.crossSelectedValue = this.$store.state.Patient.opdData.cross_type_ext;
				}
			}
			if(this.adviceType != 'text'){
				this.adviceScribleValue = this.$store.state.Patient.opdData.signaturePad2_src;
			}

			if(this.historyType != 'text'){
				this.historyScableValue = this.$store.state.Patient.opdData.signaturePad_src;
			}
			if(this.pastHistoryType != 'text'){
				this.pastHistoryScableValue = this.$store.state.Patient.opdData.signaturePad1_src;
			}
			if(vm.checkedreportList != null){
				vm.reportListSelect = 0;
	       }else{
				vm.reportListSelect = 1;
			}

  			this.getPatientData(this.patinetId);
       },
		methods: {
			print_multiple_report()
			{
				let vm=this;
				if(vm.checkedreportList.length>0){
					vm.reportListSelect = 0;
		       }else{
					vm.reportListSelect = 1;
					return false;
				}
				this.ClickHereToPrintMultiple('opd_case');
			},
			getPatientData(patinetId)
			{
				var vm=this;
				User.generatePatientDetailsByID(patinetId).then(
	  				(response) => {
	  					
	  					if(response.data.code == 200){
	  						//console.log(response.data.data);
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
			  					console.log(response.data.data);
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
			presp_count(array)
            {
                var vm=this;
                var array_presp=_.filter(array, ['remove', 'false']);
                vm.count_false=array_presp.length;
                return  vm.count_false;

            },
			 check: function(e) {
			 	let vm=this;
	     		 if (e.target.checked) {
	      		  //vm.reportListSelect = 0;
	     		 }else{
	     		 	 vm.reportListSelect = 1;
	     		 }
	   		 },
			printReport(type){
				let vm = this;
					vm.printType = type;
				
				if(type == 'opd_case'){
						$('#generateModal').modal({ show: false})
						
				}
			},
			ClickHereToPrintMultiple()
			{
				let vm = this;
				const style = '@page { margin: 0 } @media print { .page-break {page-break-after: always; page-break-inside: avoid; page-break-before: avoid; break-after: always; break-inside: avoid; break-before: avoid; } }'
				var  OPDCaseData = {
					'advice' : this.advice,
					'adviceType' : this.adviceType,
					'adviceDoctor' : this.adviceDoctor,
					'priscriptionData': this.prescriptiData,
					'referalType' :this.referalType,
					'crossType' : this.crossType,
					'radiologyData' : this.radiologyData,
					'todayDate': this.todayDate,
					'crossSelectedValue' : this.crossSelectedValue,
					'adviceScribleValue' : this.adviceScribleValue,
					'printType' : 'opd_case',
					'radioReportData' : this.radioReportData,
					'labReportData' : this.labReportData,
					'signatureName' : this.signatureName,
					'timeStamp' : this.timeStamp,
					'regNo' : this.regNo,
					'followup' : this.followup,
					'checkedreportList' : this.checkedreportList,
					'patientDetail' : this.patientDetail,
					'patientCheckupDetail' : this.patientCheckupDetail,
					'department' : this.department,
					'provisional_diagnostic' : this.provisional_diagnostic,
					'doctoreName' : this.doctoreName,
					'historyType' : this.historyType,
					'historyScableValue' : this.historyScableValue,
		      		'history' : this.history,
		      		'pastHistoryType' : this.pastHistoryType,
					'pastHistoryScableValue' : this.pastHistoryScableValue,
		      		'past_history' : this.past_history,
				};

		      	User.printOPDCaseMultipleData(OPDCaseData).then(	
                (response) => {
                	var printContent = "";
                	printContent = response.data;
	    	 		var windowUrl = '';
			        var uniqueName = '';/*new Date();	*/
			        var windowName = '';/*'Print' + uniqueName.getTime();	*/
			        var printWindow = window.open('','','left=0,top=0,width=950,height=600,toolbar=0,scrollbars=0,status=0,addressbar=0');
			        var is_chrome = Boolean(printWindow.chrome);
					printWindow.document.write(printContent);
					printWindow.document.close(); 
					 if (is_chrome) {
				        setTimeout(function () { // wait until all resources loaded 
				            printWindow.focus(); // necessary for IE >= 10
				            printWindow.print();  // change window to printWindow
				            return false;
				            printWindow.close();// change window to printWindow
				        }, 250);
				    }
				    else {
				         // necessary for IE >= 10
				        printWindow.focus(); // necessary for IE >= 10
				        printWindow.print();
				        printWindow.close();
				    }
            	},	
                (error) => {	
                	 $("body .js-loader").addClass('d-none');
                	}	
                );
			},
			ClickHereToPrint() {
				
				let vm = this;
				var  OPDCaseData = {
							'advice' : this.advice,
							'adviceType' : this.adviceType,
							'adviceDoctor' : this.adviceDoctor,
							'priscriptionData': this.prescriptiData,
							'referalType' :this.referalType,
							'crossType' : this.crossType,
							'radiologyData' : this.radiologyData,
							'todayDate': this.todayDate,
							'crossSelectedValue' : this.crossSelectedValue,
							'adviceScribleValue' : this.adviceScribleValue,
							'printType' : this.printType,
							'radioReportData' : this.radioReportData,
							'labReportData' : this.labReportData,
							'signatureName' : this.signatureName,
							'timeStamp' : this.timeStamp,
							'regNo' : this.regNo,
							'followup' : this.followup,
							'checkedreportList' : this.checkedreportList,
							'patientDetail' : this.patientDetail,
							'patientCheckupDetail' : this.patientCheckupDetail,
							'department' : this.department,
							'provisional_diagnostic' : this.provisional_diagnostic,
							'doctoreName' : this.doctoreName


						};

				      	User.printOPDCaseData(OPDCaseData).then(	
		                (response) => {


		                	var printContent = "";
		                	printContent = response.data;
		                	 //$('#receiptModal').modal({show:true}); 
		                	// try {
		                    var windowUrl = '';	
					       // var uniqueName = new Date();	
					        //var windowName = 'Print' + uniqueName.getTime();	
					        var uniqueName = '';/*new Date();	*/
					        var windowName = '';/*'Print' + uniqueName.getTime();	*/
					        var printWindow = window.open('','','left=0,top=0,width=950,height=600,toolbar=0,scrollbars=0,status=0,addressbar=0');
					        
					        var is_chrome = Boolean(printWindow.chrome);
    						printWindow.document.write(printContent);
    						printWindow.document.close(); 
    						 if (is_chrome) {
						        setTimeout(function () { // wait until all resources loaded 
						            printWindow.focus(); // necessary for IE >= 10
						            printWindow.print();  // change window to printWindow
						            return false;
						            printWindow.close();// change window to printWindow
						        }, 250);
						    }
						    else {
						         // necessary for IE >= 10
						        printWindow.focus(); // necessary for IE >= 10
						        printWindow.print();
						        printWindow.close();
						    }
	

						    // 	}	
						    // catch (e) {	
						    //     self.print();	
						    // }	
				        	
	
		            	},	
		                (error) => {	
		                	 $("body .js-loader").addClass('d-none');	
	
		                }	
		                )	
	
				    	
				},
				html2text(html) {
				    var tag = document.createElement('div');
				    tag.innerHTML = html;
				    
				    return tag.innerText;
				},
				 GetSelectComponent(componentName) {
		       this.$router.push({name: componentName})
		   	 }
		}
	}
</script>
