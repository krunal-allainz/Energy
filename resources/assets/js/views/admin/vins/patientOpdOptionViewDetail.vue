<template>
	<div>
		<adviceViewDetail :adviceData="patientOptionDetail.adviceData"></adviceViewDetail>
		<historyViewdetail :historyData="patientOptionDetail.historyData"></historyViewdetail>
		<pasthistoryViewDetail :past_history="patientOptionDetail.past_history"></pasthistoryViewDetail>
	</div>
</template>
<script >
	import adviceViewDetail from './adviceViewDetail.vue';
	import historyViewdetail from '.historyViewdetail.vue';
	import pasthistoryViewDetail from './pasthistoryViewDetail.vue';
	export default {
        props:['patientOptionDetail'],
		data() {
			return{
				
		      }
		},
		 components: {
			adviceViewDetail,
            historyViewdetail,
            patientCaseDetail,
            pasthistoryViewDetail
          }
	}
</script>