<template>
	 <section class="content">
		<div class="row">
                <div class="col-sm-6 col-md-6 col-xl-3">
                    <div class="flip">
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon float-left">
                                <i class="fa fa-eye text-warning"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b>{{counterData.dailyPatient}}</b></h3>
                                <p>Daily Visits</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- <div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                <span id="loadspark-chart"></span>
                                <hr>
                                <p>Check summary</p>
                            </div>
                            <div class="clearfix"></div>
                        </div> -->
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-xl-3">
                    <div class="flip">
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon float-left">
                                <i class="fa fa-medkit text-success"></i>
                            </div>
                            <div class="text-right">
                                <h3><b id="widget_count3">{{counterData.dailyOPD}}</b></h3>
                                <p>Daily OPD</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- <div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                <span class="linechart" id="salesspark-chart"></span>
                                <hr>
                                <p>Check summary</p>
                            </div>
                            <div class="clearfix"></div>
                        </div> -->
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-xl-3">
                    <div class="flip">
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon float-left">
                                <i class="fa fa-user text-danger"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b>{{counterData.monthlyPatient}}</b></h3>
                                <p>Monthly Visits</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                <!--         <div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                <span id="visitsspark-chart"></span>
                                <hr>
                                <p>Check summary</p>
                            </div>
                            <div class="clearfix"></div>
                        </div> -->
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-xl-3">
                    <div class="flip">
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon float-left">
                                <i class="fa fa-briefcase text-info"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b>{{counterData.monthlyOPD}}</b></h3>
                                <p>Monthly OPD</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                <span id="subscribers-chart"></span>
                               </div>
                           </div>
                                <hr>
                                <p>Check summary</p>
                            </div>
                            <div class="clearfix"></div> -->
                        </div>
                    </div>
                </div>
            </div>
           
            <div class="row">
                <div class="col-xl-8 col-12">
                	 <!-- First Basic Table strats here-->
                    <patientListview :action="action"></patientListview>
                </div>
                    <timeline></timeline>
                
                </div>
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
           if(vm.$store.state.Users.userDetails.user_type != '1'){
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
