<template>
	<div>
		<div class='text-right'>
		 <!-- 	<img  :src="'/assets/img/signature/'+signatureName+'.png'" height="66" width="182"/> -->
		 	<img  :src="signatureName" height="66" width="182"/>
		 </div>	
		<div class='text-right'>
		 	<!-- <img  :src="'/assets/img/timestamp/'+timeStamp+'.png'" height="66" width="182"/> -->
		 		<span><b>{{doctoreName}}</b></span><br/>
		 		<span><b>{{department}}</b></span><br>
		 		<span><b>{{regNo}}</b></span>
		</div>	
	 	<div >	
	 	<!-- <div class="row" >
        	<div class='col-md-12 text-right'>
				<span class='text-right'><b>Consultant's Signature</b></span>
	 		</div>
		</div>	 -->
		</div>
	</div>
</template>
<script>
	export default {
		props:['regNo','signatureName','doctoreName','department'],
	}
</script>