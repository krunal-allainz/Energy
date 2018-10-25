<template>
	<div class="container">
		<div class="report_space">
            	<adviceViewDetail :adviceData="advice"></adviceViewDetail>
		</div>
		<div class="report_space">
			<historyViewdetail :historyData="history"></historyViewdetail>
		</div>
		<div class="report_space">
			<pasthistoryViewDetail :past_history="past_history"></pasthistoryViewDetail>
		</div>
		<div class="report_space">
				<followupviewDetail :followupData="follow_up"></followupviewDetail>
		</div>
		<div class="report_space">
			<provisonalDaignosticViewDetail :data="provisonal_daignostic"></provisonalDaignosticViewDetail>
		</div>
	</div>
           
			
</template>
<script>	
	import adviceViewDetail from './adviseReportdata.vue';
	import historyViewdetail from './historyReportData.vue';
	import pasthistoryViewDetail from './pastHistoryReportData.vue';
	import followupviewDetail from './followupReportData.vue';
	import provisonalDaignosticViewDetail from './provisionalDiagnosticReportData.vue';
	export default {
		props: ['patientOPDDetail','patientAllOpdDetail','advice','history','past_history','follow_up','provisonal_daignostic'],
		 components: {
			adviceViewDetail,
            historyViewdetail,
            pasthistoryViewDetail,
            followupviewDetail,
            provisonalDaignosticViewDetail
          }
		}

</script>
