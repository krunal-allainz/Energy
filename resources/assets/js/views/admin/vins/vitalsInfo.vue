<template>	
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h3>Vitals Info Form</h3>
				</div>
			</div>
		</div>
		<form method = "post">
			 <div class="row form-group" v-show="patient_select_enable==true">
			 	<div class="col-md-6">
            		<div class="col-md-6 ">
              			<label for="patient">Select Patient:</label>
            		</div>
           			<div class="col-md-6">
           				<select  class="form-control ls-select2" id = "patient" name="patient" v-model="patientData.patient_id"> 
           					 <option value="">Select</option>
                   				<option :value="pat.id" v-for="pat in patientData.patient_option">{{pat.name}}</option>
                		</select> 
                		<i v-show="errors.has('patient')" class="fa fa-warning"></i>  
                		<span class="help is-danger" v-show="errors.has('patient')">
                  			Please Select patient.
                		</span> 
            		</div>
            	</div>
			 </div>

       <div v-if="isPatientSearch">
			   <patientSearch v-show="patient_select_enable==false" :user_id="0" ref="vitals_info" :copyVitals="1"></patientSearch>
        </div>

	        <div class="row form-group">
	            <div class="col-md-6" v-if="patient_select_enable==true">
                <div class="col-md-6">
                 <button type="button" class="btn btn-primary" @click="patient_select_change(true)">Search Patient By Another</button>
                </div>
	            </div>
	            <div class="col-md-6" v-if="patient_select_enable==false">
	              <div class="col-md-6">
	                <button type="button" class="btn btn-primary" @click="patient_select_change(false)">Select Patient</button>
	              </div>
	            </div>
               <div class="col-md-6 " v-if="patient_copy_vitals_enable==true">
                  <div class="col-md-6 pull-right">
                    <button type="button" class="btn btn-info" @click="copy_vitals_func()">Copy Vitals</button>
                  </div>
              </div>
	         </div>
			<div class="row form-group">	
              <div class="col-md-6" v-show="(patientData.last_vist != '')">
                   <div class="col-md-6 "> 
                    <label for="opd_no">Last Visit:</label>
                    </div>
                    <div class="col-md-6">
                      {{patientData.last_vist}}
                    </div>
              </div>
		           
          		 <div class="col-md-6"  v-if="patientData.uhid_no!=''">
                  <div class="col-md-6 " v-if="patientData.uhid_no!=''" >
                    <label for="date">UHID No:</label>
                  </div>
                  <div class="col-md-6" v-if="patientData.uhid_no!=''" >
                    <label>{{patientData.uhid_no}}</label>
                  </div>  
                </div>
            </div>
			       <div class="row form-group">
            		<div class="col-md-6">
	            		 <div class="col-md-6">
	                		<label for="date">Weight:</label>
	              		</div>
	              		<div class="col-md-6">
	                		<input type="text" name="weight" id="weight" class="form-control" v-model="patientData.weight"  placeholder="In kgs"   v-validate="'decimal:1|required|min_value:1||max_value:999'" :disabled="non_editable_vitals == 'true'">
	                  		<i v-show="errors.has('weight')" class="fa fa-warning"></i> 
	                  		<span class="help is-danger" v-show="errors.has('weight')"> Please enter valid weight.</span>
	               		 </div>
            		</div>
            		 <div class="col-md-6">
                		<div class="col-md-6">
                  			<label for="date">Height:</label>
                		</div>
                		<div class="col-md-6" v-if="(patientData.age > 18)">
                  			<input type="text" name="height" id="height" class="form-control" placeholder="In cms" v-model="patientData.height"  v-validate="'required|numeric|min_value:1'" :disabled="non_editable_vitals=='true'">
                  			<i v-show="errors.has('height')" class="fa fa-warning"></i> 
                    		<span class="help is-danger" v-show="errors.has('height')"> Please enter valid height. </span>
                  		</div>
                      <div class="col-md-6" v-if="(patientData.age <= 18)">
                        <input type="text" name="height" id="height" class="form-control" placeholder="In cms" v-model="patientData.height"  v-validate="'numeric|min_value:1'" :disabled="non_editable_vitals=='true'">
                        <i v-show="errors.has('height')" class="fa fa-warning"></i> 
                        <span class="help is-danger" v-show="errors.has('height')"> Please enter valid height. </span>
                      </div>
               		</div>
            </div>
            <div class="row form-group">
            		 <div class="col-md-6">
                  <div class="col-md-6">
                    <label for="date">BMI:</label>
                  </div>
                  <div class="col-md-6">
                    <input type="text" name="bmi" id="bmi" class="form-control" readonly="" v-model="bmi_mod" :disabled="non_editable_vitals=='true'">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-6">
                      <label for="date">RESP/SPO2:</label>
                    </div>
                    <div class="col-md-6">
                    	 <div class=" input-group">
                      <input type="text" name="vitals" id="vitals" class="form-control" v-model="patientData.vitals"  v-validate="'required|numeric'" :disabled="non_editable_vitals=='true'">
                      	  <div class="input-group-append">
                            <span class="input-group-text ">%</span>
                        </div>
                      </div>
                       <i v-show="errors.has('vitals')" class="fa fa-warning"></i> 
                      <span class="help is-danger" v-show="errors.has('vitals')"> Please enter valid vitals. </span>

                    </div>
                  </div>
            </div>
              <div class="row form-group">
                	 <div class="col-md-6">
                    <div class="col-md-6">
                      <label for="date">Pulse:</label>
                    </div>
                    <div class="col-md-6" >
                      <div class=" input-group">
                        <input type="text" name="pulse" id="pulse" class="form-control" v-model="patientData.pulse"  v-validate="'required|numeric|min_value:1'" :disabled="non_editable_vitals=='true'"> 
                       <!--  <div class="input-group-append">
                            <span class="input-group-text ">/mm</span>
                        </div> -->
                      </div>
                      <i v-show="errors.has('pulse')" class="fa fa-warning"></i>

                       <div class="help is-danger" v-show="errors.has('pulse')"> 
                       	Please enter valid pulse.</div>


                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-6">
                      <label for="date">BP:</label>
                    </div>
                    <div class="col-md-6">
                      <div class=" input-group" v-if="(patientData.age > 18)">

                      <input type="text" name="bp_systolic" id="bp_systolic" class="form-control"  v-model="patientData.bp_systolic"  v-validate="'required|numeric|min_value:1'" maxlength="3" :disabled="non_editable_vitals=='true'"> 
                        <div class="input-group-append">
                            <span class="input-group-text ">/</span>
                        </div>
                        <input type="text" name="bp_diastolic" id="bp_diastolic" class="form-control"  v-model="patientData.bp_diastolic"  v-validate="'required|numeric|min_value:1'" maxlength="3" :disabled="non_editable_vitals=='true'">
                      
                      </div>
                      <div class=" input-group" v-if="(patientData.age  <= 18)">

                      <input type="text" name="bp_systolic" id="bp_systolic" class="form-control"  v-model="patientData.bp_systolic"  v-validate="'numeric|min_value:1'" maxlength="3" :disabled="non_editable_vitals=='true'"> 
                        <div class="input-group-append">
                            <span class="input-group-text ">/</span>
                        </div>
                        <input type="text" name="bp_diastolic" id="bp_diastolic" class="form-control"  v-model="patientData.bp_diastolic"  v-validate="'numeric|min_value:1'" maxlength="3" :disabled="non_editable_vitals=='true'">
                      
                      </div>
                      
                      <i v-show="errors.has('bp_systolic')" class="fa fa-warning"></i>
                      <span class="help is-danger" v-show="errors.has('bp_systolic') || errors.has('bp_diastolic')">

                        Please enter valid BP.

                      </span>
                    </div>
            </div>
                </div>
            <div class="row form-group">
              		 <div class="col-md-6">
                    <div class="col-md-6">
                      <label for="date">Temp:</label>
                    </div>
                    <div class="col-md-6">
                      <div class=" input-group">
                      <input type="text" name="temp" id="temp" class="form-control number-with-validation"  v-model="patientData.temp" v-validate="'decimal:1|required|min_value:1||max_value:999'"  :disabled="non_editable_vitals=='true'">
                        <div class="input-group-append">
                            <span class="input-group-text ">°F</span>
                        </div><br>
                     </div>
                     <div class="help is-danger" v-show="errors.has('temp')"> 
                        Please enter valid temp.</div>
                      </div>
              	</div>
            </div>
             <div class="row">
      <div class="col-md-6">
        <h3>Pain Assessment</h3>

      </div>
    </div>
    <div class="row">
      <div class="col-md-2" @click="pain_value(0)"><img src="/assets/img/pain/P1.png" class="test"  v-bind:class="[patientData.pain_value==0 ? 'pain_select': '', 'pain_img'  ]"></div>
      <div class="col-md-2" @click="pain_value(2)"><img src="/assets/img/pain/P2.png"  v-bind:class="[patientData.pain_value==2 ? 'pain_select': '' , 'pain_img' ]"> </div>
      <div class="col-md-2" @click="pain_value(4)"><img src="/assets/img/pain/P3.png"   v-bind:class="[patientData.pain_value==4 ? 'pain_select': '', 'pain_img'  ]"></div>
      <div class="col-md-2" @click="pain_value(6)"><img src="/assets/img/pain/P4.png"   v-bind:class="[patientData.pain_value==6 ? 'pain_select': '', 'pain_img'  ]"></div>
      <div class="col-md-2" @click="pain_value(8)"><img src="/assets/img/pain/P5.png"   v-bind:class="[patientData.pain_value==8 ? 'pain_select': '', 'pain_img'  ]"></div>
      <div class="col-md-2" @click="pain_value(10)"><img src="/assets/img/pain/P6.png"   v-bind:class="[patientData.pain_value==10 ? 'pain_select': '', 'pain_img'  ]"></div>
    </div>


     <div class="form-group text-center">
				<button class="btn btn-success" type="button" @click="savePatientCheckup()">Submit</button>
			</div>
		</form>
	</div>
</template>
<script >
	import User from '../../../api/users.js';
	import patientSearch from './patientSearchData.vue';
	let list=[];
	 export default {
        data() {
            return {
              'currentYear': (new Date()).getFullYear(),
              'vitals_id':'',
              'non_editable_vitals':'false',
              'vitals_data_org':[],
            	 'user_id':this.$store.state.Users.userDetails.id,
               'user_type':this.$store.state.Users.userDetails.user_type,
             	 'patient_select_enable':true,
               'isPatientSearch':true,
               'patient_copy_vitals_enable':false,
            	 'patientData' : {
                  'pain_value':0,
                  'patient_id':'',
                  'patient_option':[],
                  'case_id':'',
                  'opd_option':[],
                  'weight':'',
                  'height': '',
                  'bmi':'',
                  'vitals':'',
                  'pulse':'',
                  'bp_systolic':'',
                  'bp_diastolic':'',
                  'temp':'',
                  'select_type':'',
                  'select_value':'',
                  'uhid_no' : '',
                  'last_vist' : '',
                  'age' : ''
            	 }
            }
        },
      components: {
         patientSearch,
       },
         mounted(){
            let vm =this;
              if(vm.$store.state.Users.userDetails.user_type != '2'){
                vm.$root.$emit('logout','You are not authorise to access this page'); 
              }
         	  	 let opd_list_new=[];
         	  	 $('.ls-select2').select2({
		            placeholder: "Select",
		            tags:false 
		          });
               vm.initData();
               vm.getResults();
              vm.newPatient(); 
             
         	 	 setTimeout(function(){
                $('#patient').select2({
                  placeholder: "Select",
                  tags:false 
                });
              },500);

	        $(document).on("select2:select",'#patient', function (e) {
              let patientId = $(this).val();
              vm.patientData.patient_id=patientId;
              vm.patientEmpty();
              vm.enable_vitals();
               vm.getAgeOfPatient(patientId);
          });
	         
	          
         	},
         computed: {
          bmi_mod() {
            if(this.patientData.weight!='' && this.patientData.height!=''){
              var height_met = this.patientData.height / 100;
              var bmiVal = (this.patientData.weight )/(height_met * height_met);
              var bmi_final_val=bmiVal.toFixed(1);
              this.patientData.bmi=bmi_final_val;
              return bmi_final_val;
            } else {
              return 0;
            }
          }
       },
        created: function() {
        	  this.$root.$on('SetUhidNo', this.updateUhidNo);
        	  this.$root.$on('patientData',this.setPatientData);
            this.$root.$on('patientEmpty',this.patientEmpty);
        },
       methods: {
        initData()
        {
            let vm=this;
            let pId=vm.$store.state.Patient.patientId;
            if(vm.$store.state.Patient.setPage=='VITALS')
            {
                if(pId)
                {
                    vm.patientData.patient_id=pId;
                    setTimeout(function(){
                      $('#patient').val(pId).trigger('change.select2');
                    },10);
                    vm.patientEmpty();
                    vm.enable_vitals();
                    vm.getAgeOfPatient(pId);
                }
            }
            
        },
        getAgeOfPatient(patientId){
           var vm =this;
           var getpatientId = patientId;
          
           User.getAgeOfPatient(getpatientId).then(
            (response) => {
               
               var patientAge = '';
               if(response.data.data.age > 999){
                 patientAge = vm.currentYear - patientAge ; 
                 if(patientAge == 0){
                   vm.patientData.age =  1  
                 }else
                 vm.patientData.age = patientAge;
               }else{
                patientAge = response.data.data.age;
               }
                vm.patientData.age = patientAge;  
              
                 },
            
            );

         },
        newPatient()
          {
              var vm =this;
              setInterval(function() {
                 vm.getResults();
                  $('#patient').select2('destroy');
                  $('#patient').select2({
                    placeholder: "Select",
                    tags:false 
                  });
              }, 8000);
          },
        non_editable()
        {
            var vm =this;
            vm.non_editable_vitals='true';
        },
        getResults(page_url) {
            var vm =this;
            let patient_list_new=[];
            let section = 'OPD';
            let user_id=0;
            //vm.patientData.patient_option = [];
             User.getAllPatientName(vm.user_type,user_id).then(
                   (response) => {
                      let patien_data ;
                      patien_data = response.data;
                      $.each(response.data.data, function(key, value) {
                      let name = value.first_name +' '+value.last_name;
                      let pid  = value.id ;
                      let age  = value.age ;
                      let uhid_no  = value.uhid_no ;
                      patient_list_new.push({
                          name:name,
                          id:pid,
                          uhid_no:uhid_no,
                          age:age
                        });
                      });
                    
                     vm.patientData.patient_option = patient_list_new;
                     },
                      (error) => {
                  },
                   );
          },
          enable_vitals()
          {
              let vm=this;
              User.generatePatientDetailsByID(vm.patientData.patient_id).then(
              (response) => {
                let patient_data=response.data.data;
                vm.patientData.uhid_no =patient_data.uhid_no;
                },
                (error) => {
                },
              );
             
             
              User.getPatientCaseDetailsByPatientId(vm.patientData.patient_id).then(
                (response) => {
                    let caseID ;
                    
                    caseID = response.data.data.id;
                    vm.patientData.case_id=caseID;
                    vm.getPatientLastVisit(vm.patientData.patient_id);
                  },
                  (error) => {
                  },
                );
             vm.get_vitals();
          },
          getPatientLastVisit(p_id)
          {
              let vm=this;
              User.getPatientLastVisitById(p_id).then(
                (response) => {
                  if(response.data.code==200)
                  {
                      let lastVist;
                      lastVist = response.data.data;
                      vm.patientData.last_vist=lastVist;
                  }
                   
                  },
                  (error) => {
                  },
              );
          },
          get_vitals()
          {
             let vm=this;
              User.getVitalsInfoByPatientId(vm.patientData.patient_id).then(
              (response) => {
                let vitals_data=response.data.data;
                  if(vitals_data.code==200)
                  {
                      vm.vitals_data_org=vitals_data.data;
                      vm.vitals_id=vm.vitals_data_org.vital_id;
                      vm.patient_copy_vitals_enable=true;
                  }
                  else if(vitals_data.code==300)
                  {
                    vm.patient_copy_vitals_enable=false;
                  }
                  else
                  {
                     vm.patient_copy_vitals_enable=false;
                  }
                },
                (error) => {
                },
            );
          },
          copy_vitals_func()
          {
            let vm=this;
              User.getVitalsValidity(vm.vitals_id).then(
                (response2) => {
                    let validity=response2.data.data;
                    if(validity.code==200)
                    {
                          //vm.non_editable();
                          vm.patientData.height=vm.vitals_data_org.height;
                          vm.patientData.weight=vm.vitals_data_org.weight;
                          vm.patientData.vitals=vm.vitals_data_org.vitals;
                          vm.patientData.temp=vm.vitals_data_org.temp;
                          vm.patientData.pulse=vm.vitals_data_org.pulse;
                          vm.patientData.pain_value=vm.vitals_data_org.pain;
                          vm.patientData.bmi=vm.vitals_data_org.bmi;
                          //vm.patientData.last_vist=vm.vitals_data_org.created_at;
                          if(vm.vitals_data_org.bp!='')
                          {
                              let bp_opg=vm.vitals_data_org.bp.split("/");
                              vm.patientData.bp_systolic=bp_opg[0];
                              vm.patientData.bp_diastolic=bp_opg[1];
                          } 
                          
                    }
                    else if(validity.code==300)
                    {
                      toastr.error('6 month validity of vitals is expired for this patient. Please fill up new vitals.', 'Error', {timeOut: 5000});
                      
                    }
                    else
                    {
                      toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
                      vm.patientEmpty();
                    }
                },
                (error) => {
                },
              );
          },
         patientEmpty()
          {
              var vm =this;
                vm.patientData.uhid_no="";
                vm.patientData.last_vist="";
                vm.patientData.weight="";
                vm.patientData.height="";
                vm.patientData.bmi="";
                vm.patientData.vitals="";
                vm.patientData.pulse="";
                vm.patientData.bp_systolic="";
                vm.patientData.bp_diastolic="";
                vm.patientData.temp="";
                vm.patientData.opd_id="";
                vm.patientData.pain_value="";
                vm.patient_copy_vitals_enable=false;
          },
       	 setPatientData(patientData) {
            let vm =this;
            vm.patientEmpty();
            if(patientData.code==200)
            {
              let pDetails=patientData.searchdata;
              vm.patientData.patient_id=pDetails.id;
              vm.enable_vitals();
            }
            else if(patientData.code==300)
            {
              toastr.error('Vitals not found', 'Error', {timeOut: 5000});
              vm.patientEmpty();
            }
            else
            {
              toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
              vm.patientEmpty();
            }
          },
	       	 patient_select_change(val)
	          {
              let vm =this;
	              vm.userlistData={};
	             
                 $('#patient').val('').trigger('change.select2');
                 vm.patientData.patient_id="";
	               vm.patientEmpty();
	              if(val==true)
	              {
	                vm.patient_select_enable=false;
	              }
	              else
	              {
                  vm.isPatientSearch =false;
                  setTimeout(function(){
                    vm.isPatientSearch  =true;
                  },500);
	                vm.patient_select_enable=true;
	              }
	          },
	       	 pain_value(pain){
	            this.patientData.pain_value = pain;
	          },

	           updateUhidNo(uhid) {
	            let vm = this;
	            vm.patientData.uhid_no = uhid;
	          },
       		savePatientCheckup :function(e){ 
       			var vm =this;

       			this.$validator.validateAll().then(
	            	(response) => { 	
                  
	            		if (!this.errors.any()) { 
	            		 $("body .js-loader").removeClass('d-none');
	            		 var pData = {'patientData':this.patientData,'userId':this.user_id};
					    	    User.savePatientCheckup(pData).then(
  					    		  (response) => {
                          $("body .js-loader").addClass('d-none');
  			                 	if(response.data.code == 200) {
                            vm.$store.dispatch('SetPage', ''); 
  			                 		toastr.success('Patient vital details have been saved', 'Vitals', {timeOut: 5000});
                            vm.$router.push({'name':'nurse_dashbord'});

  			                 	}else if(response.data.code == 300) {
  			                		 toastr.error('Record not found.Please enter valid search value.', 'Error', {timeOut: 5000});
  			                	} else{
  			                	    toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
  			                	 }	
                           
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