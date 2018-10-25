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
						<li><input type="checkbox" id="ckbCheckAll"  @click="checkAll(this)"/><b> Select All</b></li>		
						<li v-for="mainCat in reportList">
							<input type="checkbox" class="checkBoxClass" :value="mainCat.reportListId" id="mainCat.reportListId" v-model="checkedreportList" @click="check($event)"> {{mainCat.reportListId}}
						</li>
					</ul>
					<span class="help is-danger" v-if="(checkedreportList.length == 0)">
                  			Please select any report Type .
                	</span> 
				</div>

					<!-- <button type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal"  v-show="(checkedreportList.length != 0)" @click = "printReport('opd_case')" >OPD Case</button> -->
					<button type="button" class="btn btn-primary btn-submit text-right" @click="print_multiple_report()">Print</button>

				 <button type="button" class="btn btn-primary btn-submit text-right" data-toggle="modal" data-backdrop="static" href="#printModal"  v-show="(checkedreportList.length != 0)" @click = "printReport('opd_case')" >OPD Case</button>
					<!-- <button ty pe="button" lass="btn btn-primary btn-submit text-right" >Print</button> -->

					<button type="button" class="btn btn-default close_btn" @click="close_modal()">Close</button>
					</div>
				</div>
			</div>
   		</div>
    	<div id="printModal" class="modal fade">
     		<div class="modal-dialog" >
		 		<div class="modal-content" >
		 		<!--<div class="modal-header"></div>-->
		 		<div class="modal-body">
			 		<opdReportView :caseId="caseId" patinetId="patinetId" :todayDate="todayDate" :patientCheckupDetail="patientCheckupDetail" :signatureName="signatureName" :doctoreName="doctoreName" :regNo="regNo" :patientDetail="patientDetail" :department="department" :timeStamp="timeStamp" :reference="reference" :ReportPageData="ReportPageData" :printType="printType" :checkedreportList="checkedreportList" :prescriptiData="prescriptiData" :past_history="ReportPageData.past_history"
		      	:historyData="ReportPageData.historyData"
		      	:adviceData="ReportPageData.adviceData"></opdReportView>
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
	</div>
</template>
<script>
	import User from '../../../api/users.js';
	import vinsletterheadheaderpart from './vins_letter_header.vue';
	import vinsletterheadfooterpart from './vins_letter_footer.vue';
	import opdReportView from './opdReportView.vue';
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
				'caseId' : this.$store.state.Patient.caseId,
				'patinetId' : this.$store.state.Patient.patientId,
				'prescriptiData' : {},
				'opdReport' : false,
				'consultntId' : '',
				'consultName' : '',
				'signatureName' : '',
				'doctoreName' :'',
				'timeStamp' : '',
				'regNo':'',
				'patientDetail' : {},
		      	'patientCheckupDetail' : {},
		      	'department': '',
		      	'reference' : '',
		      	'checkedreportList': [],
		      	'reportListSelect' : 0,
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
		      			'reportListId': 'Diagnosis'
		      		},
		      		{
		      			'reportListId': 'Referrals'
		      		}] ,
		      		'ReportPageData' : {
				      	'labReferalReportData' : {},
				      	'radiologyReferalReportData' : {},
				      	'ExaminationData' : '' ,
				      	'opdData' : {},
				      	'CrossReferalData' : {},
				      	'phisioyoData' : {},
				      	'labReportData' : {},
				      	'radiologyReportData' : {},
				      	'prescriptionReportData' : {},
				      	'past_history' : {},
				      	'historyData' : {},
				      	'adviceData' : {},
				      	'examinationData':'',
				      	
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
       	vm.getOpdCaseData(vm.caseId);
       	vm.getPatientData(vm.patinetId);
       },
       methods: {
       		close_modal()
       		{
       			let vm=this;
       			vm.checkedreportList=[];
				vm.reportListSelect = 0;
				$('#generateModal').modal('hide');
       		},
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
			checkAll(test)
			{	
				let vm=this;
				if($('#ckbCheckAll').is(':checked'))
				{
					vm.reportListSelect = 1;
					var check_list_data=[];
					_.forEach(vm.reportList,function(value){
						check_list_data.push(value.reportListId);
					});
					vm.checkedreportList=check_list_data;
					$(".checkBoxClass").prop('checked', true);
				}
				else
				{
					vm.checkedreportList=[];
					vm.reportListSelect = 0;
					$(".checkBoxClass").prop('checked', false);
				}
				
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
					'priscriptionData': this.prescriptiData,
					'todayDate': this.todayDate,
					'printType' : 'opd_case',
					'signatureName' : this.signatureName,
					'regNo' : this.regNo,
					'ReportPageData' : this.ReportPageData,
					'checkedreportList' : this.checkedreportList,
					'patientDetail' : this.patientDetail,
					'patientCheckupDetail' : this.patientCheckupDetail,
					'department' : this.department,
					'doctoreName' : this.doctoreName,
					'reference' : this.reference
				};

		      	User.printOPDCaseMultipleData(OPDCaseData).then(	
                (response) => {
                	var printContent = "";
                	printContent = response.data;
	    	 		var windowUrl = '';
			        var uniqueName = '';/*new Date();	*/
			        var windowName = '';/*'Print' + uniqueName.getTime();	*/
			        var printWindow = window.open('','','left=0,top=0,width=950,height=700,toolbar=0,scrollbars=0,status=0,addressbar=0');
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
       		getOpdCaseData(caseId){
       			let vm = this;
       			
       			User.getPatientOpdCaseDataReport(caseId).then(
       				(response) => {
					
       				if(response.data.data.opdOptionDetails){
       				 	 vm.ReportPageData.opdData = response.data.data.opdOptionDetails;
       				}
       				if(response.data.data.opdExaminationData){
       				  vm.ReportPageData.examinationData = response.data.data.opdExaminationData;
       				}
       				if(response.data.data.opdReferalLaboraryData){
       				  vm.ReportPageData.labReferalReportData = response.data.data.opdReferalLaboraryData;
       				}
       				if(response.data.data.opdReferalRadiologyData){
       				  	vm.ReportPageData.radiologyReferalReportData = response.data.data.opdReferalRadiologyData;
       				}
       				if(response.data.data.opdReferalCrossData){
       				  vm.ReportPageData.CrossReferalData = response.data.data.opdReferalCrossData;
       				}
       				if(response.data.data.opdLabData){
       				  vm.ReportPageData.labReportData = response.data.data.opdLabData;
       				}
       				if(response.data.data.opdRadiologyData){
       				  vm.ReportPageData.radiologyReportData = response.data.data.opdRadiologyData;
       				}
       				if(response.data.data.opdprescriptionData){
       				  vm.ReportPageData.prescriptionReportData = response.data.data.opdprescriptionData;
       				}
       				if(response.data.data.past_historyData){
       				  vm.ReportPageData.past_history =response.data.data.past_historyData; 
       				}
       				if(response.data.data.historyData){
       				  vm.ReportPageData.historyData =response.data.data.historyData; 
       				}
       				if(response.data.data.adviceData){
       				  vm.ReportPageData.adviceData =response.data.data.adviceData; 
       				}
       				
       				
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
  				/*User.getOPDCaseDetailsByPatientId(patinetId).then(
  					(response) => {
	  					if(response.data.code == 200){
	  						console.log(response.data.data);
	  						vm.caseId = response.data.data.case_id;
	  						vm.sectionOpdId = response.data.data.opd_id;*/
	  						User.generatePatientCheckUpDetails(vm.caseId).then(
  							(response) => {
	  							if(response.data.code == 200){
	  							vm.patientCheckupDetail = response.data.data;
	  							}
	  							var caseId = vm.caseId;
	  							
			  					User.getPatientCaseDetailById(caseId).then(
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
						  			User.generateUserNameByIdForSignature(vm.consultntId).then(
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
	  					/*}
	  				},
	  				(error) => {

	  				}
  				);*/
			},
			GetSelectComponent(componentName) {
		       this.$router.push({name: componentName})
		   	},
		   	  ClickHereToPrint() {
				
				let vm = this;

				var  OPDCaseData = {
							
							'priscriptionData': this.prescriptiData,
							
							'todayDate': this.todayDate,
							
							'printType' : this.printType,
							
							'signatureName' : this.signatureName,
							'timeStamp' : this.timeStamp,
							'regNo' : this.regNo,
							'ReportPageData' : this.ReportPageData,
							'checkedreportList' : this.checkedreportList,
							'patientDetail' : this.patientDetail,
							'patientCheckupDetail' : this.patientCheckupDetail,
							'department' : this.department,
							'doctoreName' : this.doctoreName,
							'reference' : this.reference
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
					        var printWindow = window.open('','','left=0,top=0,width=950,height=700,toolbar=0,scrollbars=0,status=0,addressbar=0');
					        
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
       }
	}
</script>