<template>
	<div>
		<div v-if="(adviceData.type == 'text')" class="report_space">
			<div class='col-md-4'>
				<span class="report_title">Advice :-</span>
			</div>
			
			<div class='col-md-4' v-if ="(adviceData.type == 'text' && adviceData.value!='' && adviceData.value!=null)">
					<span class="report_details"> {{adviceData.value}}</span>
			</div>
			<div class='col-md-4' v-else>
				<span class="report_details">No record found.</span>
			</div>
		
		</div> 
			<div v-if="(adviceData.type !== 'text')" class="report_space">
				<div class='col-md-4 text-left'>
				<span class="report_title">Advice :-</span>
			</div>
			<div>
				<div class='col-md-4' v-if ="(adviceData.type != 'text' && adviceData.value!='' && adviceData.value!=null)" >
	            <img :src="adviceData.value" title="Advice">
	        </div> 
	        <div class='col-md-4' v-else>
				<span class="report_details">No record found.</span>
			</div> 
		</div>
			</div>
	</div>	
</template>
<script>
	export default {
		props:['adviceData'],
	}
</script>
