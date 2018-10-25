<template>
	 <section class="content">
		
           
            <div class="row">
                <div class="col-xl-12 col-12">
                	 <!-- First Basic Table strats here-->
                    <patientListview :action="action"></patientListview>
                </div>
                    <!-- <timeline></timeline> -->
                
            </div>
           
    </section>
</template>
<script >
	import User from '../../../api/users.js';
    import patientListview from './patientList.vue';
    import timeline from './timeline.vue';
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
            patientListview,
            timeline
        },
		 mounted(){
            let vm =this;
           if(vm.$store.state.Users.userDetails.user_type != '3'){
              vm.$root.$emit('logout','You are not authorise to access this page'); 
          }
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
		  		getPatientCounters(){
                    
                    var vm =this;
		  			User.getNumberOfPatient(vm.type,vm.doctor_id).then(
		  				 (response) => {
		  				 	this.counterData.dailyPatient = response.data.data.today;
		  				 	this.counterData.monthlyPatient = response.data.data.month;
		  				 },
		  				  (error) => {	
		  				  }

		  				);

		  		},
		  		getOPDCounters(){
                     var vm =this;
		  			User.getOPDCounters(vm.doctor_id).then(
		  				(response) => {
		  					this.counterData.dailyOPD = response.data.data.today;
		  				 	this.counterData.monthlyOPD = response.data.data.month;
		  				 
		  				},
		  				(error) => {

		  				}
		  			);

		  		}
		  },
	}
</script>
