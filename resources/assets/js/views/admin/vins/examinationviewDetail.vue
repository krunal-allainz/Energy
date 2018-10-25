<template>
	<div>
		<div class='col-md-6 text-left'>
				<span class='text-left'><b>Examination :-</b></span>
		</div>
	<div class='col-md-6 text-left'>
		<span>{{examination}}</span>
	</div>
	</div>
</template>
<script>
export default {
		props:['examination'],
	}
</script>