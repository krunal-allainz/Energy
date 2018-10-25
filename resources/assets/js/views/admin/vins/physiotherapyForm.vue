<template>  
    <div class="container">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6">
                <h3>Physiotherapy Assessment Form</h3>
                </div>
            </div>
        </div>
        <form method = "post">
            
            <patientSearch ref="physiotherapyForm" :user_id="physiotherapyData.user_id"></patientSearch>
            
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-6">
                      <div class="col-md-6 ">
                        <label for="uhid_no">UHID No:</label>
                      </div>
                      <div class="col-md-6">
                        <input type="text" class="form-control" name="uhid_no" id="uhid_no" v-model="physiotherapyData.uhid_no" readonly="" v-validate="'required'">
                        <span class="help is-danger" v-show="errors.has('uhid_no')"> Please enter UHID No.</span>
                      </div>  
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-3">
                     <div class="col-md-12">
                      <div class="col-md-12 ">
                        <label for="name">Name:</label>
                      </div>
                      <div class="col-md-12">
                        <input type="text" class="form-control" v-model="physiotherapyData.name" readonly="">
                      </div>  
                    </div>
                </div>
                 <div class="col-md-3">
                     <div class="col-md-12">
                      <div class="col-md-12 ">
                        <label for="age">Gender/age:</label>
                      </div>
                      <div class="col-md-12">
                        <input type="text" class="form-control" v-model="physiotherapyData.age" readonly="">
                      </div>  
                    </div>
                </div>
                <div class="col-md-3">
                     <div class="col-md-12">
                      <div class="col-md-12 ">
                        <label for="date_of_assessment">Date Of Assessment:</label>
                      </div>
                      <div class="col-md-12">
                        <date-picker  :date.sync="physiotherapyData.doa" :option="option" id = "date_of_assessment" class="" type="date" name="date_of_assessment" :limit="limit" v-model="physiotherapyData.doa.time"></date-picker> 
                            
                      </div>  
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="chief_complaints">Chief Complaints:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="chief_complaints" id="chief_complaints" v-model="physiotherapyData.chief_complaints"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="history">History:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="history" id="history" v-model="physiotherapyData.history"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
            <hr/>
            <h4>Observation:</h4>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="observation_gait">Gait:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="observation_gait" id="observation_gait" v-model="physiotherapyData.observation_gait"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="observation_posture">Posture:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="observation_posture" id="observation_posture" v-model="physiotherapyData.observation_posture"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
            <hr/>
             <h4>Palpation:</h4>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="palpation_tenderness">Tenderness:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="palpation_tenderness" id="palpation_tenderness" v-model="physiotherapyData.palpation_tenderness"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="palpation_muscle">Muscle Spasm:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="palpation_muscle" id="palpation_muscle" v-model="physiotherapyData.palpation_muscle"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
             <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="palpation_trigger">Trigger Paint:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="palpation_trigger" id="palpation_trigger" v-model="physiotherapyData.palpation_trigger"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
            <hr/>
             <h4>Pain History:</h4>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="pain_type">Type:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="pain_type" id="pain_type" v-model="physiotherapyData.pain_type"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="pain_site">Site:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="pain_site" id="pain_site" v-model="physiotherapyData.pain_site"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
             <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="pain_aggravating">Aggravating Factor:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="pain_aggravating" id="pain_aggravating" v-model="physiotherapyData.pain_aggravating"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="pain_relieving">Relieving Factor:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="pain_relieving" id="pain_relieving" v-model="physiotherapyData.pain_relieving"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
             <div class="row form-group">
              <div class="col-md-6">
                 <label for="pain_wrong">Wrong-Baker Face Pain Scale:</label>
              </div>
            </div>
            
            <div class="row form-group">
                <div class="col-md-2" @click="pain_value(0)"><img src="/assets/img/pain/P1.png" class="test"  v-bind:class="[physiotherapyData.pain_wrong==0 ? 'pain_select': '', 'pain_img'  ]"></div>
                <div class="col-md-2" @click="pain_value(2)"><img src="/assets/img/pain/P2.png"  v-bind:class="[physiotherapyData.pain_wrong==2 ? 'pain_select': '' , 'pain_img' ]"> </div>
                <div class="col-md-2" @click="pain_value(4)"><img src="/assets/img/pain/P3.png"   v-bind:class="[physiotherapyData.pain_wrong==4 ? 'pain_select': '', 'pain_img'  ]"></div>
                <div class="col-md-2" @click="pain_value(6)"><img src="/assets/img/pain/P4.png"   v-bind:class="[physiotherapyData.pain_wrong==6 ? 'pain_select': '', 'pain_img'  ]"></div>
                <div class="col-md-2" @click="pain_value(8)"><img src="/assets/img/pain/P5.png"   v-bind:class="[physiotherapyData.pain_wrong==8 ? 'pain_select': '', 'pain_img'  ]"></div>
                <div class="col-md-2" @click="pain_value(10)"><img src="/assets/img/pain/P6.png"   v-bind:class="[physiotherapyData.pain_wrong==10 ? 'pain_select': '', 'pain_img'  ]"></div>
            </div>
            <hr/>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="sensory_assessment">Sensory/Motor Assessment:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="sensory_assessment" id="sensory_assessment" v-model="physiotherapyData.sensory_assessment"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="rom">ROM:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="rom" id="rom" v-model="physiotherapyData.rom"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="balance_examination">Balance Examination / Coordition Examination:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="balance_examination" id="balance_examination" v-model="physiotherapyData.balance_examination"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="diagnosis">Diagnosis:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="diagnosis" id="diagnosis" v-model="physiotherapyData.diagnosis"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
             <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="treatment_plan">Treatment Plan:</label>
                      </div>
                      <div class="col-md-9">
                        <textarea class="form-control" name="treatment_plan" id="treatment_plan" v-model="physiotherapyData.treatment_plan"></textarea>
                      </div>  
                    </div>
                </div>
            </div>
             <div class="row form-group">
                <div class="col-md-12">
                     <div class="col-md-12">
                      <div class="col-md-3">
                        <label for="next_follow_date">Next follow Up Date:</label>
                      </div>
                      <div class="col-md-3">
                        <date-picker  :date.sync="physiotherapyData.nfd" :option="option" id = "next_follow_date" class="" type="date" name="next_follow_date" :limit="limit" v-model="physiotherapyData.nfd.time"></date-picker> 
                      </div>  
                    </div>
                </div>
            </div>

            <div class="row form-group">
                 <div class="col-md-12">
                    <div class="col-md-12">
                        <div class="col-md-6">
                          <label for="signature_therapist">Signature of Therapist: </label>
                        </div>
                        <div class="col-md-9">
                            <textarea class="form-control" name="signature_therapist" id="signature_therapist" v-model="physiotherapyData.signature_therapist"></textarea>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="row form-group">
               <div class="col-md-6">
                     <div class="col-md-12">
                      <div class="col-md-6 ">
                        <label for="name_therapist">Name of Therapist:</label>
                      </div>
                      <div class="col-md-12">
                        <input type="text" class="form-control" name="name_therapist" id="name_therapist" v-model="physiotherapyData.name_therapist" >
                      </div>  
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6">
                     <div class="col-md-6">
                      <div class="col-md-6 ">
                        <label for="form_date">Date:</label>
                      </div>
                      <div class="col-md-12">
                        
                        <input class="form-control" type="text" id="form_date" name="form_date" value="" v-model="physiotherapyData.form_date" readonly="" />
                      </div>  
                    </div>
                </div>
            </div>
          
            <div class="form-group text-center">
                <button class="btn btn-success" type="button" @click="savePhysiotherapy()">Submit</button>
            </div>
        </form>
    </div>

</template>
<script >

    //get it if Status key found
    if(localStorage.getItem("physio"))
    {
        toastr.success('Physio Form details have been saved', 'physiotherapy detail', {timeOut: 5000});
        localStorage.removeItem("physio");
        
    }

    import User from '../../../api/users.js';
    import myDatepicker from 'vue-datepicker';

    import moment from 'moment';
    import patientSearch from './patientSearchData.vue';
    
    export default {
        data() {
            return {
                'footer' : 'footer',
                'currentYear': new Date().getFullYear(),
                'option': {
                    type: 'day',
                    week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                    month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                    format: 'DD-MM-YYYY',
                    placeholder: 'Select Date',
                    inputStyle: {
                        'display': 'inline-block',
                        'padding': '6px',
                        'line-height': '22px',
                        'font-size': '16px',
                        'border': '2px solid #fff',
                        'box-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.2)',
                        'border-radius': '2px',
                        'color': '#5F5F5F',
                        'width':'100%',
                    },

                  },
                  limit: [
                  {
                    type: 'fromto',
                    to: new Date()
                  }],
                'physiotherapyData' : {
                    'uhid_no':'',
                    'user_id':this.$store.state.Users.userDetails.id,
                    'patient_id':'',
                    'name':'',
                    'age':'',
                    'doa': {
                        time:''
                    },
                    'chief_complaints':'',
                    'history':'',
                    'observation_gait':'',
                    'observation_posture':'',
                    'palpation_tenderness':'',
                    'palpation_muscle':'',
                    'palpation_trigger':'',
                    'pain_type':'',
                    'pain_site':'',
                    'pain_aggravating':'',
                    'pain_relieving':'',
                    'pain_wrong':0,
                    'sensory_assessment':'',
                    'rom':'',
                    'diagnosis':'',
                    'balance_examination':'',
                    'treatment_plan':'',
                    'nfd': {
                        time:''
                    },
                    'signature_therapist':'',
                    'name_therapist':'',
                    'form_date': moment().format('DD-MM-YYYY hh:mm A'),
                }
            }
        },
        components: {
            'date-picker': myDatepicker,
            patientSearch
        },
        mounted() {
               
                $('.ls-select2').select2({
                    placeholder: "Select",
                    tags: false,
                });
                let vm =this;

                $('.clockpicker').clockpicker({donetext: 'Done',autoclose: true});
                
                
            
        },
        created: function(){
            this.$root.$on('patientData',this.setPatientData);
            this.$root.$on('patientEmpty',this.patientEmpty);
        },
        methods: {
            pain_value(pain){
                this.physiotherapyData.pain_wrong = pain;
            },
            patientEmpty(p_val)
            {
                this.initPhysioData();
            },

            setPatientData(patientData) {
                if(patientData.code==200)
                {
                    let pDetails=patientData.searchdata;
                    this.physiotherapyData.patient_id=pDetails.id;
                    this.physiotherapyData.uhid_no=pDetails.uhid_no;
                    this.physiotherapyData.name = pDetails.first_name+' '+pDetails.last_name;
                    let gender='Female';
                    if(pDetails.gender=='M')
                        gender='Male';
                    this.physiotherapyData.age=gender+'/'+pDetails.age;
                    //this.getAgeCal();
                }
                else if(patientData.code==300)
                {
                    vm.userlistData={};
                    toastr.error('Record not found', 'Error', {timeOut: 5000});
                    this.initPatientData();
                }
                else
                {
                    vm.userlistData={};
                    toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
                    this.initPatientData();
                }
            },
            GetSelectComponent(componentName) {
               this.$router.push({name: componentName})
            },
            initPhysioData(){
                var vm = this;
                this.physiotherapyData.patient_id='';
                this.physiotherapyData.uhid_no='';
                this.physiotherapyData.name = '';
                this.physiotherapyData.age='';
            },
            savePhysiotherapy() {
                // return false;
                this.$validator.validateAll().then(
                (response) => {
                    if (!this.errors.any()) {
                         $("body .js-loader").removeClass('d-none');
                         var pData = this.physiotherapyData;
                        User.savePhysioTherapy(pData).then(
                        (response) => {
                            if(response.data.code == 200) {
                                localStorage.setItem("physio",1)
                                window.location.reload();
                            } else if(response.data.code == 300) {
                                toastr.error('Something goes wrong.', 'Error', {timeOut: 5000});
                            } else{
                                
                             toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
                            }
                             $("body .js-loader").addClass('d-none');
                        },
                        (error) => {
                             $("body .js-loader").addClass('d-none');

                        }
                        )
                    }
                },
                (error) => {
                }
                )
            }
          },

    }
</script>
