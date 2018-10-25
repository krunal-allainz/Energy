<template>
	<div>
		<div class='col-md-12'>
			<span class='report_title'>Provisional Diagnosis:-</span>
		</div>
		
		<div class='col-md-12' v-if="data!='' && data!=null">
			<span class='report_details'> {{data}}</span>
		</div>
		<div class='col-md-12' v-else>
			<span class='report_details'>No record found.</span>
		</div>
		
	</div>	
</template>
<script>
	export default {
		props:['data'],
	}
</script>
