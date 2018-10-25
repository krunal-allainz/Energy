<template>
	 <section class="content">
		
           
            <div class="row">
                <div class="col-xl-12 col-12">
                	 <!-- First Basic Table strats here-->
                    
                </div>
                    <!-- <timeline></timeline> -->
                
            </div>
           
    </section>
</template>
<script >
	import User from '../../../api/users.js';
    
	export default{
		data(){
			return {
				post: null,
				'counterData' : {
					'dailyPatient' : '0',
					'dailyOPD' : '0',
					'monthlyPatient' : '0',
					'monthlyOPD' : '0',
				},
				'type' : 'OPD',
				'doctor_id':this.$store.state.Users.userDetails.id,
				'pagination': {},
				'patientList' : '',
                'action' :{
                    'view' : 0,
                    'select' : 1
                }

			}
		},
          components: {
        },
		 mounted(){
            let vm =this;
           /*if(vm.$store.state.Users.userDetails.user_type != '6' || vm.$store.state.Users.userDetails.user_type != '7'){
              vm.$root.$emit('logout','You are not authorise to access this page'); 

          }*/
		 	this.getPatientCounters();
		 	this.getOPDCounters();
		 },
		  methods:{
				makePagination: function(data){
	                let pagination = {
	                    current_page: data.current_page,
	                    last_page: data.last_page,
	                    next_page_url: data.next_page_url,
	                    prev_page_url: data.prev_page_url
	                }
	                this.pagination = pagination;
	                //this.$set('pagination', pagination)
	            },
		  		
		  },
	}
</script>
