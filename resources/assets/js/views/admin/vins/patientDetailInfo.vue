<template>
    <!-- Modal -->
    <div class="modal fade" id="patientDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="exampleModalLabel">Patient Detail</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
             <div id="accordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                      <h5 class="mb-0">
                        <button class="btn btn-link mt-0" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                           Personal  Info
                        </button>
                      </h5>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <patientDetailView :patientinfo="showPatientDetail.patientDetail"></patientDetailView>
                        </div>
                    </div>
                    <h5 class="mb-0">
                        <button class="btn btn-link mt-0" data-toggle="collapse" data-target="#collapseThree" aria-expanded="true" aria-controls="collapseTwo">
                           Case Detail
                         </button>
                     </h5>
                     <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                       <patientCaseDetail :patientCaseDetail="showPatientDetail.patientCaseDetail"></patientCaseDetail>
                        </div>
                    </div>
                      <h5 class="mb-0" v-if="(showPatientDetail.opdDetails != null)">
                        <button class="btn btn-link mt-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                           OPD Details
                         </button>
                     </h5>
                     <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                        <patientOPDDetailInfo :patientOPDDetail="showPatientDetail.opdDetails" ></patientOPDDetailInfo> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>  
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
</template>
<script>
    import patientDetailView from './patientDetailView.vue';
    import patientOPDDetailInfo from './patientOPDDetailInfo.vue';
    import patientCaseDetail from './patientCaseDetail.vue';
     export default {
        props: ['showPatientDetail'],
          components: {
            patientDetailView,
            patientOPDDetailInfo,
            patientCaseDetail
          }
    }

</script>