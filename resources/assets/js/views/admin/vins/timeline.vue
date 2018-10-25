<template>
                <div class="col-xl-4  col-12">
                	<div class="row">
                        <div class="col-xl-12 col-sm-6 col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Timeline</h3>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <ul class="timeline timeline-update">
                                            <li   v-for="data in timelineData">
                                                 <div class="timeline-badge primary wow lightSpeedIn center">
                                                 <!--    <img src="img/authors/avatar1.jpg" height="36" width="36"
                                                         class="rounded-circle float-right" alt="avatar-image"> -->
                                                </div>
                                                 <div class="timeline-card wow slideInLeft"
                                                     style="display:inline-block;">
                                                    <div class="timeline-heading">
                                                        <h4 class="timeline-title">{{data.title}}</h4>
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
<script >
    import User from '../../../api/users.js';
    import moment from 'moment';
    export default{
        data(){
            return {
                'doctorId':this.$store.state.Users.userDetails.id,
                'timelineData' : '',
            }
        },
         mounted(){
              let vm = this;
              vm.getTimelineData(vm.doctorId);
             if ($('.timeline-update').length > 0) {
                 vm.getTimelineData(vm.doctorId);
                $('.timeline-update').newsTicker({
                    row_height: 117,
                    max_rows: 4,
                    speed: 2000,
                    direction: 'up',
                    duration: 3500,
                    autostart: 1,
                    pauseOnHover: 1
                });
             
             }
            setTimeout(function(){
                 vm.getTimelineData(vm.doctorId);
            },8000) ;
              
         },
           methods: {
                getTimelineData(doctorId){
                    let vm = this;
                    User.getTimelineData(doctorId).then(
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