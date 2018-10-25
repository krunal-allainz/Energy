<template>
	<div>
		
		<div v-if="(historyData.type == 'text')">
			<div class='col-md-4'>
				<span class='report_title'>History :-</span>
			</div>
			
			<div class='col-md-4' v-if ="(historyData.type == 'text' && historyData.value!='' && historyData.value!=null)">
				<span class='report_details'>{{historyData.value}} </span>
			</div>
			<div class='col-md-4' v-else>
				<span class='report_details'> No record found. </span>
			</div>
			
		</div> 
		 <div v-if="(historyData.type !== 'text' && historyData.value != '')">
		   	<div class='col-md-4'>
				<span class='report_title'>History :-</span>
			</div>
			<div class='col-md-4' v-if ="(historyData.type != 'text') && historyData.value!=null && historyData.value!=''">
				<img :src="historyData.value" title="History">
			</div>  
			<div class='col-md-4' v-else>
				<span class='report_details'> No record found. </span>
			</div>
			
		</div>
	
	</div>	
</template>
<script>
	export default {
		props:['historyData'],
	}
</script>
