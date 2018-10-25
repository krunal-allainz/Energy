<template>
	<div>
		
		<div id="printData" style="height: 1500px;min-height: 700px;" class="report_start">
			<div  id="printContent"></div>
			<div>
				<div class="report_header"></div>
				<!-- <vinsletterheadheaderpart></vinsletterheadheaderpart> -->
				<!-- Patient Detail Start -->

				<patientDetailReport :patientDetail="patientDetail" :consult_dr="doctoreName" :todayDate="todayDate"  :department="department" :reg_no="regNo" :refer_dr="reference">
				</patientDetailReport>
				<!-- patient Detail Report End -->

				<!-- patient checkup detail start -->
			 	<patientCheckupReport :patientCheckupDetail="patientCheckupDetail">
			 	</patientCheckupReport>
			 	<!-- patient checkup detail end -->

			 	<!-- lab referal data start -->
			 	<labDataReport :labReferalData="ReportPageData.labReferalReportData"  :printType="printType" v-if="(printType == 'lab')"></labDataReport>
			 	<!-- lab referal data end -->

			 	<!-- Radiology referal start -->
			 	<radiologyDataReport :radiologyReferalReportData="ReportPageData.radiologyReferalReportData"  v-show="(printType == 'radiology')"></radiologyDataReport>
			 	<!-- Radiology referal end -->

			 	<!-- print Perceptions Report start  -->
			 	<prescriptionPrint :prescriptData="ReportPageData.prescriptionReportData" :removeBtn="0" :checkedreportList="checkedreportList" :printType="printType" v-show="(printType == 'prescription')"> </prescriptionPrint>
			 	<!-- print Perceptions Report end -->

			 	<!-- cross referal report data start  -->
			 	<crossReportData :CrossReferalData="ReportPageData.CrossReferalData" :checkedreportList="checkedreportList" :printType="printType" v-show="(printType == 'prescription')"></crossReportData>
			 	<!-- cross referal  report data end-->

			 	<!-- print Perceptions Report start -->
			 	<printPerceptionsReportData :ReportPageData="ReportPageData" :prescriptData="ReportPageData.prescriptionReportData" :adviceData="adviceData":checkedreportList="checkedreportList" :printType="printType" v-show="(printType == 'print_perceptions')"></printPerceptionsReportData> 
			 	<!-- print Perceptions Report end  -->
			 	
			 	<!-- opd data start -->
			 	<opdDataReport :ReportPageData="ReportPageData" :prescriptiData="ReportPageData.prescriptionReportData" :adviceData="adviceData" :historyData="historyData" :past_history="past_history" :checkedreportList="checkedreportList" :printType="printType" v-show="(printType == 'opd_case')"></opdDataReport>
			 	<!-- opd data end -->

			 	<signatureReportData :department="department" :regNo="regNo" :doctoreName="doctoreName" :signatureName="signatureName"></signatureReportData>
				<!-- <vinsletterheadfooterpart></vinsletterheadfooterpart > -->
			</div>
		</div>
		
	</div>

</template>
<script>
	import vinsletterheadheaderpart from './vins_letter_header.vue';
	import vinsletterheadfooterpart from './vins_letter_footer.vue';
	import patientDetailReport from './patientDetailReport.vue';
	import patientCheckupReport from './patientCheckupReport.vue';
	import labDataReport from './labDataReport.vue';
	import radiologyDataReport from './radiologyDataReport.vue';
	import prescriptionData from './prescriptionData.vue';
	import prescriptionPrint from './prescriptionReportData.vue';
	import printPerceptionsReportData from './printPerceptionsReportData.vue';
	import crossReportData from './crossReportData.vue';
	import opdDataReport from './opdDataReport.vue';
	import signatureReportData from './signatureReportData.vue';
	import print from 'print-js'
	import _ from 'lodash';
	
	export default {
		props: ['opdId','patinetId','todayDate','patientDetail','patientCheckupDetail','department','regNo','doctoreName','signatureName','consultntId','reference','ReportPageData','printType','checkedreportList','reportListSelect','adviceData','historyData','past_history'],
		data() {
			return{
		      }
		},
		 mounted(){
       	let vm =this;
       },
		components: {
         vinsletterheadheaderpart,
         vinsletterheadfooterpart,
         prescriptionPrint,
         patientDetailReport,
         patientCheckupReport,
         labDataReport,
         radiologyDataReport,
         opdDataReport,
         crossReportData,
         printPerceptionsReportData,
         signatureReportData
       },
        methods: {
			GetSelectComponent(componentName) {
		       this.$router.push({name: componentName})
		   	},
		   	presp_count(array)
            {
                var vm=this;
                var array_presp=_.filter(array, ['remove', 'false']);
                vm.count_false=array_presp.length;
                return  vm.count_false;

            },
       }
   }
</script>