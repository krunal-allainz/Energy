<template>
	<div>
		<div>
			<allPatientList ></allPatientList>
		</div>
	</div>
</template>
<script>
	import allPatientList from './allPatientList.vue';


    export default {
        data() {
            return {
            	
            }
        },
         mounted(){
            let vm = this;
             if(vm.$store.state.Users.userDetails.user_type != '4'){
              vm.$root.$emit('logout','You are not authorise to access this page'); 
            }
         
         },
         components: {
         	allPatientList
         }
    }
</script>