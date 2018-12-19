<template>
  <div class="col-xl-6  col-12">
                	<div class="row">
                        <div class="col-xl-12 col-sm-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Notification</h3>
                                </div>
                                <div class="card-body">
                                    <div  class="scrollbar" id="style-1">
                                        <ul class="timeline timeline-update force-overflow" style="overflow: auto;">

                                            <li   v-for="data in timelineData">
                                                 <div class="timeline-badge primary wow lightSpeedIn center">
                                                 <!--    <img src="img/authors/avatar1.jpg" height="36" width="36"
                                                         class="rounded-circle float-right" alt="avatar-image"> -->
                                                </div>
                                                 <div class="timeline-card wow slideInLeft"
                                                     style="display:inline-block;">
                                                    <div class="timeline-heading">
                                                        <span v-if="data.dataTable=='nomination_request'">
                                                          <a class="text-info point" @click="nomination_link(data.nDate)"><h4 class="timeline-title">{{data.title}}</h4></a>
                                                        </span>
                                                        
                                                        <p>
                                                            <small class="text-primary">{{data.Datadate}} </small>
                                                        </p>
                                                    </div>
                                                    <div class="timeline-body">
                                                        <p>
                                                           {{data.text}}
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</template>
<script>
    import User from '../../../api/users.js';
    import moment from 'moment';
    export default{
        props :['userData'],
        data(){
           
            return {
                'timelineData' : '',
            }
        },
         mounted(){
              let vm = this;
              vm.getTimelineData();
             if ($('.timeline-update').length > 0) {
                 vm.getTimelineData();
                $('.timeline-update').newsTicker({
                    row_height: 90,
                    max_rows: 6,
                    speed: 2000,
                    direction: 'up',
                    duration: 3500,
                    autostart: 0,
                    pauseOnHover: 1
                });
             
             }
             $('.force-overflow').css({overflow : 'auto'});
            setTimeout(function(){
                 vm.getTimelineData();
            },8000) ;
              
         },
           methods: {
              nomination_link(date)
              {
                   
                  let new_date=moment(date).format('DD-MM-YYYY');
                  let vm=this;

                  vm.$store.dispatch('SetNominationDate',new_date ); 
                  vm.$store.dispatch('SetNominationPage','LIST');
                  vm.$router.push({'name':'nomination_list'});

              },
              getTimelineData(){
                    let vm = this;
                    User.getTimelineData(vm.userData.userType,vm.userData.userId).then(
                             (response)=>{
                                    if(response.data.code == 200){
                                      vm.timelineData = response.data.data;
                                    }
                            },
                            (error)=>{
                             }
                    );
                }
           }
    }
</script>
<style>
.text-info
{
  color: #17a2b8!important;
}
</style>