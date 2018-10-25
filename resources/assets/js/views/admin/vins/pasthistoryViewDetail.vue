<template>
	<div>
		
		<div v-if="(past_history.type == 'text')">
			<div class='col-md-4'>
				<span class="report_title">Past History:-</span>
			</div>
			
			<div class='col-md-4' v-if ="(past_history.type == 'text' && past_history.value!='' && past_history.value!=null)">
				<span class="report_details"> {{past_history.value}}</span>
			</div>
			<div class='col-md-4' v-else>
				<span class='report_details'> No record found. </span>
			</div>
			
		</div> 
		 <div v-if="(past_history.type !== 'text')">
		   	<div class='col-md-4'>
				<span class="report_title">Past History :-</span>
			</div>
			<div class='col-md-4' v-if ="(past_history.type != 'text' && past_history.value!='' && past_history.value!=null)">
				<img :src="past_history.value" title="Past History">
			</div>
			<div class='col-md-4' v-else>
				<span class='report_details'> No record found. </span>
			</div>
		</div>
	</div>	
</template>
<script>
	export default {
		props:['past_history'],
	}
</script>
