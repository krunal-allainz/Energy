<template>
	<div>
		<div class='col-md-6 text-left'>
			<span class="report_title">FollowUp:-</span>
		</div>
		<div>
		<div class='col-md-12 report_details'>
			<span class="report_details">{{followupData}}</span>
		</div> 
		</div> 
	</div>
</template>
<script>
export default {
		props:['followupData'],
	}
</script>