<template>
    <!-- Modal -->
    <div class="modal fade" id="patientOPDModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document" >
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Patient OPD Detail</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="getClose()">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                  <div id="accordion">
                    <div class="">
                        <div class="col-md-12" v-if="opdPatientData.length>0">
                           <card title="<i class='ti-layout-cta-left'></i> OPD Details"  class="filterable">
                             <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Patient Name</th>
                                        <th>UHID No</th>
                                        <th>Token No</th>
                                        <th>Last Visit</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      <tr v-for="(opd_data, index) in opdPatientData">
                                          <td>{{++index}}</td>
                                          <td class="text-uppercase">{{opd_data.first_name}} {{opd_data.last_name}}</td>
                                          <td class="text-uppercase">{{opd_data.uhid_no}}</td>
                                          <td class="text-uppercase">{{opd_data.token_no}}</td>
                                          <td class="text-uppercase">{{opd_data.last_visit}}</td>
                                          <td>
                                            <!--<a :href="'/opd_view_page'"><i class="fa fa-eye" data-toggle="modal" data-target="#patientDetailModal" @click="getPatientInfo(opd_data.patient_id,opd_data.opd_id)"></i></a>-->


                                            <router-link v-if="opd_data.t_status=='examine'" :to="{ path: 'opd_view_page', props: { patientId: opd_data.patient_id }}" :patientId="opd_data.patient_id "><i class="fa fa-eye" @click="SetPatientOpdView(opd_data.patient_id,opd_data.case_id)" ></i></router-link>
                                            <a  v-show="(user_type != 4)" v-if="opd_data.t_status=='examine' || opd_data.is_report==1" :href="'/opd_form'"> <i class="fa fa-pencil" @click="setPatientInfo(opd_data.patient_id,opd_data.case_id)" title="opd form"></i></a>
                                          </td>
                                      </tr>
                                    </tbody>
                                </table>
                              </div>
                            </card>
                        </div>
                    </div>
                  </div>
            </div>  
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="getClose()">Close</button>
              </div>
              
          </div>
      </div>

  </div>
</template>
<script >
    import User from '../../../api/users.js';
    import card from "./card.vue";
   // import patientDetailInfo from './patientDetailInfo.vue';
   // import patientOpdViewPage from './patientOpdViewPage.vue';
     export default {
         data() {
            return {
              'doctore_Id' : this.$store.state.Users.userDetails.id,
              'user_type':this.$store.state.Users.userDetails.user_type,
              'opdPatientData':{},
              // 'patientDetailInfo' : {
              //     'patientDetail' : '',
              //     'opdDetails' : '',
              //     'patientCaseDetail' : ''
              // },
              'patientId':'',
              'isPatientOpdViewPage':false

            }
         },
         props: ['patientDataID'],
        components: {
            card,
          //  patientDetailInfo,
         //   patientOpdViewPage
        },
        mounted(){
            let vm =this;
            vm.getOPDDetailsByPatientID(vm.patientDataID);
         },
         methods: {
          getClose()
          {
              var vm =this;
              vm.$root.$emit('close_modal');
          },
          SetPatientOpdView(patientId,caseId){
              let vm =this;
             
              vm.isPatientOpdViewPage = true;
              if(vm.isPatientOpdViewPage == true){
                vm.$store.dispatch('SetPatientId', patientId);
                vm.$store.dispatch('SetCaseId', caseId);
                vm.$store.dispatch('SetPage', 'VIEW');
              }
              
          },
            getOPDDetailsByPatientID(pid)
            {
                let vm =this;
                User.getOPDCaseDetailsByPatientId(pid).then(
                   (response) => {
                      if(response.data.code==200)
                      {
                          vm.opdPatientData=response.data.data;
                          
                          //$('#patientOPDModal').modal('show');
                      }
                       },
                      (error) => {
                      },
                   );
            },
            
              setPatientInfo(patient_id,case_id){
                var vm =this;
                vm.$store.dispatch('SetPatientId', patient_id);
                vm.$store.dispatch('SetCaseId', case_id);
                vm.$store.dispatch('SetPage', 'EDIT');
              },
        }
     }
</script>
<style>
.fa {cursor:pointer}
</style>