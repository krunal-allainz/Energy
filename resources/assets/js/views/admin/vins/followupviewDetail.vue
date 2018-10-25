<template>
	<div>
		<div class='col-md-6 text-left'>
				<span class='text-left'><b>Follow Up :-</b></span>
		</div>
	<div class='col-md-6 text-left'>
		<span>{{follow_up}}</span>
	</div>
	</div>
</template>
<script>
export default {
		props:['follow_up'],
	}
</script>