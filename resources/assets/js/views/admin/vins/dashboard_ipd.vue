<template>

  <div class="container">
  	<div>
  	</div>
 </div>

</template>

<script >
    export default {
        data() {
            return {
                'footer' : 'footer',
                'currentYear': new Date().getFullYear(),
                'userType': this.$store.state.Users.userDetails.user_type
            }
        },
        mounted() {
        	let vm =this;
        	$("body .js-loader").removeClass('d-none');
        	// setTimeout(function(){
        		if(vm.userType == 1){
                		vm.$router.push({'name':'opd_form'});
	        	} else if(vm.userType == 2){
                        vm.$router.push({'name':'patients_detail_form'});
	        		// vm.$router.push('nabhReport');
	        	}else if(vm.userType == 3){
                        vm.$router.push({'name':'patients_detail_form'});
                    // vm.$router.push('nabhReport');
                }else {
                        vm.$router.push({'name':'patients_detail_form'});
                    // vm.$router.push('nabhReport');
                }
	        	
	        	$("body .js-loader").addClass('d-none');
        	// },500)
        	
        	// this.$store.dispatch('SetIpdId',0);

    },
        methods: {
		    GetSelectComponent(componentName) {
		       this.$router.push({name: componentName})
		    }
		  },
    }
</script>
