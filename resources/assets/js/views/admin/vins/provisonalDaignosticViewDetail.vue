<template>
	<div>
		<div class='col-md-6 text-left'>
				<span class='text-left'><b>Provisional Diagnosis:-</b></span>
		</div>
	<div class='col-md-6 text-left'>
		<span>{{provisonal_daignostic }}</span>
	</div>
	</div>
</template>
<script>
export default {
		props:['provisonal_daignostic'],
	}
</script>