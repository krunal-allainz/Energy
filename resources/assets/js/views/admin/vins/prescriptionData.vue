<template>
  <div class="container">
     <div class="row form-group">
              <div class="col-md-3">
                <div class="col-md-12">
                  <label for="prescription">Prescription:</label>
                </div>
                <div class="col-md-12">
                  <select class="form-control ls-select2"  name="prescription" id="prescription" v-validate="'required'"  v-model="prescriptFinalData.prescription">
                    <option value="">Select</option>
                    <option v-for="pres in prescriptionOption"  :value="pres.id">{{pres.name}}</option>
                    <option value="other">Others</option>
                  </select>
                 
                </div>
              </div>
              <input type="hidden" name="prescription_quantity" id="prescription_quantity" class="form-control" v-model="prescriptFinalData.prescription_quantity" v-validate="'required|numeric'" readonly="">
              <div class="col-md-3" v-if="prescriptFinalData.prescription_id=='other'">
                <div class="col-md-12">
                  <label for="other_prescription">Other Prescription:</label>
                </div>
                <div class="col-md-12">
                    <input type="text" name="other_prescription" id="other_prescription_text" class="form-control" v-model="prescriptFinalData.other_prescription">
                </div>
              </div>
              <div class="col-md-3">
                <div class="col-md-12">
                  <label for="quantity">Total Prescription Days:</label>
                </div>
                <div class="col-md-12">
                  <div class=" input-group">
                    <input type="text" name="total_prescription_days" id="total_prescription_days" class="form-control" v-model="prescriptFinalData.total_prescription_days" v-validate="'required|numeric'">
                      <div class="input-group-append">
                          <span class="input-group-text ">Day</span>
                      </div>
                    
                    </div>
                   
                </div>
              </div>
               <div class="col-md-3">
                <div class="col-md-12">
                  <label for="how_many_times">How many times:</label>
                </div>
                <div class="col-md-12">
                  <select class="form-control ls-select2"  name="how_many_times" id="how_many_times" v-validate="'required'"  v-model="prescriptFinalData.how_many_times">
                    <option value="">Select</option>
                    <option v-for="hmt in HMTOption"  :value="hmt.id">{{hmt.text}}</option>
                  </select>
                  
                </div>
              </div>
          </div>
          <div class="row form-group">
              <div class="col-md-3" v-if="prescriptFinalData.how_many_times=='Q-Hrs'">
                <div class="col-md-12">
                  <label for="qhrs">Q-Hrs:</label>
                </div>
                <div class="col-md-12">
                  <select class="form-control ls-select2"  name="qhrs" id="qhrs" v-validate="'required'"  v-model="prescriptFinalData.qhrs">
                    <option value="">Select</option>
                    <option v-for="qhrsop in qhrsOption"  :value="qhrsop.id">{{qhrsop.text}}</option>
                  </select>
                </div> 
              </div>
               <div class="col-md-6">
                  <div class="col-md-12">
                    <label for="prescription">Suggetion:</label>
                  </div>
                  <div class="col-md-12">
                      <label class="col-md-6">
                        <input type="radio" class="form-check-input clock_suggest" id="clock_suggest" name="clock_suggest" v-model="prescriptFinalData.clock_suggest" value="ES">Empty Stomach
                      </label>
                      <label class="col-md-5">
                        <input type="radio" class="form-check-input clock_suggest" id="clock_suggest"  name="clock_suggest" v-model="prescriptFinalData.clock_suggest" value="FS">Full Stomach
                      </label> 
                  </div>
                </div>
          </div>

          <div v-if="prespFinalRes.length>0" :id="'presp_div_'+index" v-for="(presp, index) in prespFinalRes">
           <div class="row form-group" >
                <div class="col-md-3">
                  <div class="col-md-12">
                    <label for="prescription">Clock:</label>
                  </div>
                  <div class="col-md-12">
                   <div class="input-group clockpicker">
                      <input type="text" class="form-control clock_time" :name="'presp_clock_time'+index" :id="'presp_clock_'+index" v-model="presp.clock_time">
                      <span class="input-group-addon">
                          <span class="fa fa-clock-o"></span>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="col-md-12">
                    <label for="prescription">Quantity:</label>
                  </div>
                  <div class="col-md-12">
                    <input type="text"  v-validate="'required|numeric'" v-model="presp.clock_quantity" :name="'presp_clock_quantity'+index" id="presp_clock_quantity_id" class="form-control clock_quantity">
                  </div>
                </div>

            </div>
          </div>
         <div class="row form-group">
           <div class="col-md-9">
                 <div class="col-md-12">
                   <label for="prescription">Notes:</label>
                 </div>
                 <div class="col-md-12">
                   <textarea v-model="prescriptFinalData.details" name="details" id="details" class="form-control"></textarea>
                 </div>
               </div>
         </div> 
            <div class="row">
                  <div class="col-md-1">
                      <button type="button" v-if="class_type=='ADD'" class="btn btn-primary"  @click="saveClockResult()">Add</button>
                      <button type="button" v-if="class_type=='EDIT'" class="btn btn-primary"  @click="editClockResult('edit')">Edit</button>
                  </div>
                  <div class="col-md-3" v-if="class_type=='EDIT'">
                     <button type="button" class="btn btn-danger"  @click="editClockResult('cancel')">Cancel</button>
                  </div>
            </div>
            <br/>
            <div class="row form-group" v-if="presp_length>0">
              <div class="col-md-3">
                  <div class="col-md-12">
                     <label for="prescription">Prescription Name</label>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="col-md-12">
                     <label for="prescription">Quantity</label>
                  </div>
              </div>
              <div class="col-md-3">
                  <div class="col-md-12">
                     <label for="prescription">Clock Time</label>
                  </div>
              </div>
              <div class="col-md-2">
                  <div class="col-md-12">
                     <label for="prescription">Suggetion</label>
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="col-md-12">
                     <label for="prescription">HMT</label>
                  </div>
              </div>
              <div class="col-md-1">
                  <div class="col-md-12">
                     <label for="prescription">TD</label>
                  </div>
              </div>

            </div>
            <div v-for="pres_clock in prescriptFinalData.prescriptionNameList">
              <div :id="'presct_table_'+pres_clock.id" v-if="pres_clock.remove=='false'" class="clock_result">
                 <div class="row form-group">
                    <div class="col-md-3">
                        <div class="col-md-12">
                          <div class=" input-group">
                          <div class="input-group-append">
                              <span class="input-group-text text-uppercase">{{(pres_clock.name==''?'Prescription Name':pres_clock.name)}}</span>
                          </div>
                        </div>
                      </div>
                    </div>

                    <span v-if="pres_clock.type=='Q-Hrs'">
                      <div class="col-md-2">
                        <div class="col-md-12" >
                          <div class=" input-group">
                            <div class="input-group-append" v-for="(item,index) in parseInt(pres_clock.total_qhrs)">
                                <span class="input-group-text" >{{pres_clock['clock_quantity_'+(index+1)]}}</span>
                            </div>
                          </div>  
                        </div>
                      </div>
                    </span>
                    <span v-else>
                        <div class="col-md-2">
                          <div class="col-md-12" >
                            <div class=" input-group">
                              <div class="input-group-append" >
                                  <span class="input-group-text" >{{pres_clock.clock_quantity_1}}</span>
                              </div>
                              <div class="input-group-append" >
                                  <span class="input-group-text" >{{pres_clock.clock_quantity_2}}</span>
                              </div>
                              <div class="input-group-append" >
                                  <span class="input-group-text" >{{pres_clock.clock_quantity_3}}</span>
                              </div>
                                <div class="input-group-append" >
                                  <span class="input-group-text" >{{pres_clock.clock_quantity_4}}</span>
                              </div>
                            </div>  
                          </div>
                        </div>
                    </span>
                     <span v-if="pres_clock.type=='Q-Hrs'">
                      <div class="col-md-3">
                        <div class="col-md-12" >
                          <div class=" input-group">
                              <div class="input-group-append" v-for="(item2,index2) in parseInt(pres_clock.total_qhrs)">
                                  <span class="input-group-text point" @click="editPrescriptionResult(pres_clock.id,pres_clock['clock_time_'+(index2+1)],pres_clock['clock_quantity_'+(index2+1)],(index2+1))" v-if="">{{pres_clock['clock_time_'+(index2+1)]}}</span>
                              </div>
                          </div>  
                        </div>
                      </div>
                    </span>
                    <span v-else>
                        <div class="col-md-3">
                          <div class="col-md-12">
                            <div class=" input-group">
                              <div class="input-group-append">
                                  <span class="input-group-text point" @click="editPrescriptionResult(pres_clock.id,pres_clock.clock_time_1,pres_clock.clock_quantity_1,1)" v-if="">{{pres_clock.clock_time_1}}</span>
                              </div>
                              <div class="input-group-append">
                                  <span class="input-group-text point" @click="editPrescriptionResult(pres_clock.id,pres_clock.clock_time_2,pres_clock.clock_quantity_2,2)" v-if="">{{pres_clock.clock_time_2}}</span>
                              </div>
                              <div class="input-group-append">
                                  <span class="input-group-text point" @click="editPrescriptionResult(pres_clock.id,pres_clock.clock_time_3,pres_clock.clock_quantity_3,3)" v-if="">{{pres_clock.clock_time_3}}</span>
                              </div>
                              <div class="input-group-append">
                                  <span class="input-group-text point" @click="editPrescriptionResult(pres_clock.id,pres_clock.clock_time_4,pres_clock.clock_quantity_4,4)" v-if="">{{pres_clock.clock_time_4}}</span>
                              </div>
                              </div>  
                          </div>
                        </div>
                    </span>
                  <div class="col-md-2">
                    <div class="col-md-12">
                       <div class=" input-group">
                          <div class="input-group-append">
                              <span class="input-group-text ">{{(pres_clock.clock_suggest==''?'--':pres_clock.clock_suggest)}}</span>
                          </div>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-1">
                    <div class="col-md-12">
                       <div class=" input-group">
                          <div class="input-group-append">
                              <span class="input-group-text ">{{pres_clock.type}}<span v-if="pres_clock.qhrs!=''">[{{pres_clock.qhrs}}]</span></span>
                          </div>
                      </div>
                  </div>
                  </div>
                  <div class="col-md-1">
                    <div class="col-md-12">
                       <div class=" input-group">
                          <div class="input-group-append">
                              <span class="input-group-text ">{{pres_clock.total_prescription_days}}</span>
                          </div>
                      </div>
                  </div>
                  </div>
                </div>
                  <div class="row" v-if="pres_clock.details!='' && pres_clock.details!=null">
                     <div class="col-md-12">
                        <div class="col-md-12">
                              <label><b>Notes:-</b></label>
                              <div class="form-group prescription_details" >
                                  <span>{{pres_clock.details}}</span>
                              </div>
                         
                        </div>
                    </div>
                  </div>
              </div>
          </div>

            <div class="row form-group">
                <div class="col-md-3">
                    <div class="col-md-12"><br></div>
                     <div class="col-md-12">
                           <button type="button" class="btn btn-primary btn-lg " :disabled="(priscription_add_disabled==false)" @click="savePrescription()">Add</button>
                    </div>
            </div>
          </div>
     <div class="row" v-if="show_prescription_result_data_enable==true">
        <prescriptionPrint :prescriptData="prescriptFinalData.finalPrescriptionAllData" :removeBtn="1"> </prescriptionPrint>
    </div>  
      
  </div>
</template>
<script >
  import User from '../../../api/users.js';
  import myDatepicker from 'vue-datepicker';
  import _ from 'lodash';
    import prescriptionPrint from './prescriptionPrint.vue';
    let clocktimedata=[];
    var prespRes = [];
    export default {
      computed:{
      },
      components: {
        'date-picker': myDatepicker,
            prescriptionPrint
      },
      props:['department'],
        data() {
            return {
              'notValid':false,
                'footer' : 'footer',
                'currentYear': new Date().getFullYear(),
                'lab_val_size':0,
                'original_length':0,
                't_qt':0,
                'prescriptionOption':'',
                'show_prescription_result_data_enable':false,
                'priscription_add_disabled':false,
                'priscriptionAdd':{},
                'prescription_enable':true,
                'class_type':'ADD',
                'prespFinalRes':[],
                'clock_all_timing':[],
                'presp_length':0,
                'other_pid':0,
                
                'HMTOption':[
                    {'id':'OD','text':'OD'},
                    {'id':'BD','text':'BD'},
                    {'id':'TDS','text':'TDS'},
                    {'id':'QDS','text':'QDS'},
                    {'id':'HS','text':'HS'},
                    {'id':'Q-Hrs','text':'Q-Hrs'},
                ],
                'qhrsOption':[
                    {'id':'1','text':'1'},
                    {'id':'2','text':'2'},
                    {'id':'3','text':'3'},
                    {'id':'4','text':'4'},
                    {'id':'5','text':'5'},
                    {'id':'6','text':'6'},
                    {'id':'7','text':'7'},
                    {'id':'8','text':'8'},
                    {'id':'9','text':'9'},
                    {'id':'10','text':'10'},
                    {'id':'11','text':'11'},
                    {'id':'12','text':'12'},
                ],
                'prescriptFinalData' :{
                    'presp_index':'',
                    'prescriptDataPage': [],
                    'prescription_report': [],
                    'clock_quantity':'',
                    'clock_time':'',
                    'quantity_1':'0',
                    'quantity_2':'0',
                    'quantity_3':'0',
                    'clock_time_1':'00:00',
                    'clock_time_2':'00:00',
                    'clock_time_3':'00:00',
                    'medicine_qty':1,
                    'prescriptionNameList':[],
                    'total_prescription_days':0,
                    'finalPrescriptionAllData':[],
                    'prescriptiData' : '',
                    'prescription':'',
                    'prescription_id':'',
                    'prescription_quantity':'',
                    'prescription_unit':'TAB.',
                    'prescription_time':[],
                    'clock_type':'',
                    'clock_value':'',
                    'old_clock_value':'',
                    'how_many_times':'',
                    'qhrs':'',
                    'clock_suggest':'',
                    'total_qhrs':0,
                    'details':'',
                    'other_prescription':'',
                    
                }
                
            }
        },
        created: function() {
             this.$root.$on('removePrescriptionByName', this.removePrescription);
        },
        mounted() {
            let vm=this;
            $('#prescription').on("select2:select", function (e) {
                let presId = $('#prescription').select2('data')[0].id;
                if(presId=='other')
                {
                    vm.prescriptFinalData.prescription="";
                }
                else
                {
                    vm.prescriptFinalData.prescription=$('#prescription').select2('data')[0].text;
                }
                
                vm.prescriptFinalData.prescription_id=presId;
                vm.checkPrescription();
            });
            setTimeout(function(){vm.getPrescriptionList(); },500);
           
            $('#how_many_times').on("select2:select", function (e) {
                vm.prescriptFinalData.how_many_times=$(this).val();
                  
                  if(vm.prescriptFinalData.how_many_times!='Q-Hrs')
                  {
                      vm.multipleClockResult($(this).val());
                  }
                  else
                  {
                      vm.prespFinalRes=[];
                      setTimeout(function(){
                        $('#qhrs').select2({
                          placeholder: 'Select' 
                        });
                        $('#qhrs').on("select2:select", function (e) {
                            vm.prescriptFinalData.qhrs=$(this).val();
                            vm.multipleClockResult('Q-Hrs');
                        });
                    },500);
                  }
              });
            /*for lab data end*/
            setTimeout(function(){
                vm.initData();
            },1000) 
      
        },
        filters:{
          
        },
        methods: {
          prescription_index()
          {
            let vm=this;
            let presp_array=vm.prescriptFinalData.prescriptionNameList;
            let id=parseInt(presp_array.length)+1;
            vm.prescriptFinalData.presp_index=id;
          },
          checkPrescription()
          {
              let vm=this;
              let p_name=vm.prescriptFinalData.prescription;
              let p_id=vm.prescriptFinalData.prescription_id;
              vm.setPrescription();
              
          },
          setPrescription()
          {
              let vm=this;
              vm.prespFinalRes=[];
              $('#how_many_times').val(null).trigger('change');
              vm.prescriptFinalData.how_many_times="";
              $('#qhrs').val(null).trigger('change');
              vm.prescriptFinalData.qhrs="";
              vm.prescriptFinalData.prescription_unit = 'TAB.';
              vm.prescriptFinalData.prescription_time = '1';
              vm.prescriptFinalData.total_prescription_days = '1';
               vm.prescriptFinalData.details = '';
              vm.prescriptFinalData.clock_suggest = 'ES';
              _.find(vm.prescriptionOption, function(res) {
                if(res.id == vm.prescriptFinalData.prescription_id) {
                     vm.prescriptFinalData.prescription_unit=res.formulation; 
                }
              });
          },
          initData()
          {
            let vm =this;
            let all_prescription=_.cloneDeep(vm.$store.state.Patient.prescriptionData);
            if(all_prescription)
            {
                if(all_prescription.length)
                {
                  vm.prescriptFinalData.prescriptionNameList =_.cloneDeep(vm.$store.state.Patient.prescriptionData);
                  let prespPrintData=_.filter(vm.prescriptFinalData.prescriptionNameList, function(o) { return o.remove=='false'; });
                  vm.prescriptFinalData.finalPrescriptionAllData = _.cloneDeep(prespPrintData);
                  vm.priscription_add_disabled=true;
                  vm.show_prescription_result_data_enable=true;
                  let array_presp=_.filter(vm.prescriptFinalData.prescriptionNameList, ['remove', 'false']);
                  vm.presp_length=array_presp.length; 
                }
            }
          },
          clearPrespData()
          {
              let vm=this;
              vm.prespFinalRes=[];
              vm.prescriptFinalData.prescription="";
              vm.prescriptFinalData.other_prescription="";
              vm.prescriptFinalData.prescription_id="";
              vm.prescriptFinalData.prescription_quantity="";
              vm.prescriptFinalData.total_prescription_days="";
              vm.prescriptFinalData.details="";
              vm.prescriptFinalData.clock_suggest="";
              vm.prescriptFinalData.clock_time="";
              vm.prescriptFinalData.clock_quantity="";
              vm.prescriptFinalData.clock_suggest="";
              vm.prescriptFinalData.how_many_times="";
              vm.prescriptFinalData.qhrs="";
              vm.priscription_add_disabled=true;
              $('#prescription').val(null).trigger('change'); 
              $('#how_many_times').val(null).trigger('change');
              $('#qhrs').val(null).trigger('change');
          },
          multipleClockResult(how_val)
          { 
              let vm=this;
              vm.prescription_index();
              let p_id=this.prescriptFinalData.prescription_id;
              if(vm.prescriptFinalData.how_many_times=='Q-Hrs' && vm.prescriptFinalData.qhrs=='')
              {
                  toastr.error('Please select Q-Hrs.', 'Prescription error', {timeOut: 5000});
                  return false;
              }
              let p_name="";
              if(p_id=='other')
              {
                  //vm.other_pid=parseInt(vm.other_pid)+1;
                  //p_id='other_'+vm.other_pid;
                  let other_val=vm.prescriptFinalData.other_prescription;
                  p_name=other_val;
                  if(other_val=='' || other_val==null)
                  {
                    vm.clearPrespData();
                    toastr.error('Please select prescription name and must be valid.', 'Prescription error', {timeOut: 5000});
                    return false;  
                  }
              }
              else
              {
                p_name=vm.prescriptFinalData.prescription;
              }
              
              setTimeout(function(){
                  $('.clockpicker').clockpicker({donetext: 'Done',autoclose: true});
                  $('.clockpicker').clockpicker().find('input').change(function(){
                      let id_st=this.id;
                      let val=this.value;
                      let org_id=id_st.match(/\d+/g).map(Number);
                      let org_val=0,org_val2=0,org_val3=0;
                      if(how_val=='BD')
                      {
                          if(org_id[0]<1)
                          {
                             org_val=moment.utc(val,'HH:mm').add(12,'hour').format('HH:mm');
                             vm.prespFinalRes[1].clock_time=org_val;
                             
                          }
                          else
                          { 
                              org_val=moment.utc(val,'HH:mm').add(-12,'hour').format('HH:mm');
                              vm.prespFinalRes[0].clock_time=org_val;
                          }
                      }
                      if(how_val=='TDS')
                      {
                          if(org_id[0]==0)
                          {
                             org_val=moment.utc(val,'HH:mm').add(8,'hour').format('HH:mm');
                             org_val2=moment.utc(val,'HH:mm').add(16,'hour').format('HH:mm');
                             vm.prespFinalRes[1].clock_time=org_val;
                             vm.prespFinalRes[2].clock_time=org_val2;
                             
                          }
                          else if(org_id[0]==1)
                          { 
                              org_val=moment.utc(val,'HH:mm').add(-8,'hour').format('HH:mm');
                              org_val2=moment.utc(val,'HH:mm').add(8,'hour').format('HH:mm');
                              vm.prespFinalRes[0].clock_time=org_val;
                              vm.prespFinalRes[2].clock_time=org_val2;
                          }
                          else if(org_id[0]==2)
                          { 
                              org_val=moment.utc(val,'HH:mm').add(-16,'hour').format('HH:mm');
                              org_val2=moment.utc(val,'HH:mm').add(-8,'hour').format('HH:mm');
                              vm.prespFinalRes[0].clock_time=org_val;
                              vm.prespFinalRes[1].clock_time=org_val2;
                          }
                      }
                      if(how_val=='QDS')
                      {
                          if(org_id[0]==0)
                          {
                             org_val=moment.utc(val,'HH:mm').add(6,'hour').format('HH:mm');
                             org_val2=moment.utc(val,'HH:mm').add(12,'hour').format('HH:mm');
                             org_val3=moment.utc(val,'HH:mm').add(18,'hour').format('HH:mm');
                             vm.prespFinalRes[1].clock_time=org_val;
                             vm.prespFinalRes[2].clock_time=org_val2;
                             vm.prespFinalRes[3].clock_time=org_val3;
                             
                          }
                          else if(org_id[0]==1)
                          { 
                             org_val=moment.utc(val,'HH:mm').add(-6,'hour').format('HH:mm');
                             org_val2=moment.utc(val,'HH:mm').add(6,'hour').format('HH:mm');
                             org_val3=moment.utc(val,'HH:mm').add(12,'hour').format('HH:mm');
                             vm.prespFinalRes[0].clock_time=org_val;
                             vm.prespFinalRes[2].clock_time=org_val2;
                             vm.prespFinalRes[3].clock_time=org_val3;
                          }
                          else if(org_id[0]==2)
                          { 
                             org_val=moment.utc(val,'HH:mm').add(-12,'hour').format('HH:mm');
                             org_val2=moment.utc(val,'HH:mm').add(-6,'hour').format('HH:mm');
                             org_val3=moment.utc(val,'HH:mm').add(6,'hour').format('HH:mm');
                             vm.prespFinalRes[0].clock_time=org_val;
                             vm.prespFinalRes[1].clock_time=org_val2;
                             vm.prespFinalRes[3].clock_time=org_val3;
                          }
                          else if(org_id[0]==3)
                          { 
                             org_val=moment.utc(val,'HH:mm').add(-18,'hour').format('HH:mm');
                             org_val2=moment.utc(val,'HH:mm').add(-12,'hour').format('HH:mm');
                             org_val3=moment.utc(val,'HH:mm').add(-6,'hour').format('HH:mm');
                             vm.prespFinalRes[0].clock_time=org_val;
                             vm.prespFinalRes[1].clock_time=org_val2;
                             vm.prespFinalRes[2].clock_time=org_val3;
                          }
                      }
                      vm.prespFinalRes[org_id[0]].clock_time=val;
                  });
                },500);
             vm.prespFinalRes=[];
              
              if(p_id=='' || p_id==0 || vm.prescriptFinalData.total_prescription_days=="" || vm.prescriptFinalData.total_prescription_days<1)
              {
                  vm.clearPrespData();
                  toastr.error('Please select prescription data and must be valid.', 'Prescription error', {timeOut: 5000});
                  return false;  
              }
              
              if(how_val=='OD')
              {
                  vm.prespFinalRes.push({'id':vm.prescriptFinalData.presp_index,'name':p_name,'type':how_val,'pid':p_id,'clock_time':'','clock_quantity':'','clock_suggest':vm.prescriptFinalData.clock_suggest,'remove':'false','t_quantity':0,'t_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details});
              }
              if(how_val=='BD')
              {
                  vm.prespFinalRes.push({'id':vm.prescriptFinalData.presp_index,'name':p_name,'type':how_val,'pid':p_id,'clock_time':'08:00','clock_quantity':'1','clock_suggest':vm.prescriptFinalData.clock_suggest,'remove':'false','t_quantity':0,'t_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details},{'id':vm.prescriptFinalData.presp_index,'name':p_name,'type':how_val,'pid':p_id,'clock_time':'20:00','clock_quantity':'1','clock_suggest':vm.prescriptFinalData.clock_suggest,'remove':'false','t_quantity':0,'t_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details});
              }
              if(how_val=='TDS')
              {
                  vm.prespFinalRes.push({'id':vm.prescriptFinalData.presp_index,'name':p_name,'type':how_val,'pid':p_id,'clock_time':'06:00','clock_quantity':'1','clock_suggest':vm.prescriptFinalData.clock_suggest,'remove':'false','t_quantity':0,'t_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details},{'id':vm.prescriptFinalData.presp_index,'name':p_name,'type':how_val,'pid':p_id,'clock_time':'14:00','clock_quantity':'1','clock_suggest':vm.prescriptFinalData.clock_suggest,'remove':'false','t_quantity':0,'t_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details},{'id':vm.prescriptFinalData.presp_index,'name':p_name,'type':how_val,'pid':p_id,'clock_time':'22:00','clock_quantity':'1','clock_suggest':vm.prescriptFinalData.clock_suggest,'remove':'false','t_quantity':0,'t_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details});
              }
              if(how_val=='QDS')
              {
                  vm.prespFinalRes.push({'id':vm.prescriptFinalData.presp_index,'name':p_name,'type':how_val,'pid':p_id,'clock_time':'06:00','clock_quantity':'1','clock_suggest':vm.prescriptFinalData.clock_suggest,'remove':'false','t_quantity':0,'t_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details},{'id':vm.prescriptFinalData.presp_index,'name':p_name,'type':how_val,'pid':p_id,'clock_time':'12:00','clock_quantity':'1','clock_suggest':vm.prescriptFinalData.clock_suggest,'remove':'false','t_quantity':0,'t_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details},{'id':vm.prescriptFinalData.presp_index,'name':p_name,'type':how_val,'pid':p_id,'clock_time':'18:00','clock_quantity':'1','clock_suggest':vm.prescriptFinalData.clock_suggest,'remove':'false','t_quantity':0,'t_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details},{'id':vm.prescriptFinalData.presp_index,'name':p_name,'type':how_val,'pid':p_id,'clock_time':'00:00','clock_quantity':'1','clock_suggest':vm.prescriptFinalData.clock_suggest,'remove':'false','t_quantity':0,'t_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details});
              }
              if(how_val=='HS')
              {
                  vm.prespFinalRes.push({'id':vm.prescriptFinalData.presp_index,'name':p_name,'type':how_val,'pid':p_id,'clock_time':'22:00','clock_quantity':'1','clock_suggest':vm.prescriptFinalData.clock_suggest,'remove':'false','t_quantity':0,'t_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details});
              }
               if(how_val=='Q-Hrs')
              {
                  let qhrs_org=vm.prescriptFinalData.qhrs;
                  let val_qhrs=24/parseInt(qhrs_org);
                  vm.prescriptFinalData.total_qhrs=Math.floor(val_qhrs);
                  let i=0;
                  let qhrs_data=[];
                  let org_val="00:00";
                  for(i=0;i<vm.prescriptFinalData.total_qhrs;i++)
                  {
                      qhrs_data.push({'id':vm.prescriptFinalData.presp_index,'name':p_name,'type':how_val,'pid':p_id,'clock_time':org_val,'clock_quantity':'1','clock_suggest':vm.prescriptFinalData.clock_suggest,'remove':'false','t_quantity':0,'t_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details});
                      org_val=moment.utc(org_val,'HH:mm').add(vm.prescriptFinalData.qhrs,'hour').format('HH:mm');
                  }
                  vm.prespFinalRes=qhrs_data;
              }
              //console.log(vm.prespFinalRes);
              vm.prescriptFinalData.how_many_times=how_val;
              vm.prescriptFinalData.prescription_report=vm.prespFinalRes;
              return false;
          },
          saveClockResult()
          {
            let vm =this;
            let p_name=this.prescriptFinalData.prescription;
            let p_id=this.prescriptFinalData.prescription_id;
            if(p_id=='' || p_id==0 || vm.prescriptFinalData.total_prescription_days=="" || vm.prescriptFinalData.total_prescription_days<1)
            {
                vm.clearPrespData();
                toastr.error('Please select prescription data and must be valid.', 'Prescription error', {timeOut: 5000});
                return false;  
            }
            if(p_id=='other' && (vm.prescriptFinalData.other_prescription=="" || vm.prescriptFinalData.other_prescription==null))
            {
               toastr.error('Please enter prescription name.', 'Prescription error', {timeOut: 500});
                return false;
            }
            if(vm.prescriptFinalData.how_many_times=="" || vm.prescriptFinalData.prescription_report.length==0)
            {
                 toastr.error('Select How many times.', 'Prescription error', {timeOut: 500});
                  return false;
            }
            if(vm.prescriptFinalData.how_many_times=='Q-Hrs' && vm.prescriptFinalData.qhrs=='')
            {
                toastr.error('Please select Q-Hrs.', 'Prescription error', {timeOut: 5000});
                return false;
            }
            let total_days_val=_.toNumber(vm.prescriptFinalData.total_prescription_days);
            if(!(_.isInteger(total_days_val)))
            {
                toastr.error('Please enter valid total prescription days.', 'Prescription error', {timeOut: 5000});
                return false;
            }
            let q_length=0;
            _.find(vm.prescriptFinalData.prescription_report, function(res) {
                let res_q=_.toNumber(res.clock_quantity);
                if(!(_.isInteger(res_q)))
                {
                    q_length++;  
                }
            });
            if(q_length>0)
            {
                toastr.error('Please enter valid quantity.', 'Prescription error', {timeOut: 5000});
                return false;
            }
            else
            {
                let check_p=vm.checkClcokPrescription();
                let array_presp=_.filter(vm.prescriptFinalData.prescriptionNameList, ['remove', 'false']);
                vm.presp_length=array_presp.length;
                vm.clearPrespData();
                return false;
            }
            
            
          },
          checkClcokPrescription()
          {
            let vm=this;
            let message="";
            //console.log(vm.prescriptFinalData.prescription_report);
            //return false; 
            _.forEach(vm.prescriptFinalData.prescription_report, function(value, key) {
                let check_update=vm.check_duplicate(value.id,value.type,vm.prescriptFinalData.prescriptionNameList,'update');
                let quantity_val=_.toNumber(value.clock_quantity);
               
                if(check_update!=0)
                {
                    var check_clocktime=vm.checkClockTime(value.id,value.clock_time,vm.prescriptFinalData.prescription_report);
                    let check_length=vm.check_type_length(value.id,value.type,clocktimedata);
                    if(check_clocktime>1)
                    {
                        toastr.error('Clock time already exist.', 'Prescription error', {timeOut: 5000});
                        return false;
                    }
                    if(check_length=='Yes')
                    {
                        toastr.error('Prescription type - '+value.type+'  length not correct.', 'Prescription error', {timeOut: 5000});
                        return false;
                    }
                    else
                    {
                      vm.editMedicinOntime(value);
                    }
                }
                else
                {
                    
                    vm.addMedicinOntime(value);
                }
            });
            return false;
          },
          editMedicinOntime(array)
          {
              let vm =this;
              var qhrs="";
              var tot_qhrs="";
              if(array.type=='Q-Hrs')
              {
                  qhrs=vm.prescriptFinalData.qhrs;
                  tot_qhrs=vm.prescriptFinalData.total_qhrs;
              }
              
              vm.t_qt=parseInt(vm.t_qt)+parseInt(array.clock_quantity);
              clocktimedata.push({'id':array.id,'pid':array.pid,'type':array.type,'name':array.name,'timing':array.clock_time,'quantity':array.clock_quantity,'remove':'false'});
             
              clocktimedata= _.sortBy(clocktimedata, [function(o) { return o.timing; }]);
               
              let objIndex = vm.prescriptFinalData.prescriptionNameList.findIndex((obj => obj.id == array.id && obj.remove=='false'));
              vm.prescriptFinalData.prescriptionNameList[objIndex].total_quantity=vm.t_qt;
              vm.prescriptFinalData.prescriptionNameList[objIndex].total_prescription_days=vm.prescriptFinalData.total_prescription_days;
              vm.prescriptFinalData.prescriptionNameList[objIndex].details=vm.prescriptFinalData.details;
              vm.prescriptFinalData.prescriptionNameList[objIndex].clock_suggest=vm.prescriptFinalData.clock_suggest;
              vm.prescriptFinalData.prescriptionNameList[objIndex].qhrs=qhrs;
              vm.prescriptFinalData.prescriptionNameList[objIndex].total_qhrs=tot_qhrs;
              if(array.type=='Q-Hrs')
              {
                     let i=1;
                  _.forEach(clocktimedata, function(res) {
                      if(res.remove=='false')
                      {
                          if(res.id==array.id)
                          {
                              var col_name='clock_time_'+i;
                              var col_qty='clock_quantity_'+i;
                              var o_time='--:--';
                              var o_qty=0;
                              if(res.timing!="")
                              {
                                  o_time=res.timing;
                              }
                              if(res.quantity!="")
                              {
                                  o_qty=res.quantity;
                              }
                              vm.prescriptFinalData.prescriptionNameList[objIndex][col_name]= o_time; 
                              vm.prescriptFinalData.prescriptionNameList[objIndex][col_qty] = o_qty;
                              i++;
                          }
                      }
                  });
              }
              else
              {
                  let i=0;
                  _.find(clocktimedata, function(res) {
                    if(res.remove=='false')
                    {
                        if(res.id==array.id)
                        {
                            if(i==0)
                            {
                                vm.prescriptFinalData.prescriptionNameList[objIndex].clock_time_1 = res.timing; 
                                vm.prescriptFinalData.prescriptionNameList[objIndex].clock_quantity_1 = res.quantity;
                            }
                            if(i==1)
                            {
                                vm.prescriptFinalData.prescriptionNameList[objIndex].clock_time_2 = res.timing; 
                                vm.prescriptFinalData.prescriptionNameList[objIndex].clock_quantity_2 = res.quantity;
                            }
                            if(i==2)
                            {
                                vm.prescriptFinalData.prescriptionNameList[objIndex].clock_time_3 = res.timing; 
                                vm.prescriptFinalData.prescriptionNameList[objIndex].clock_quantity_3 = res.quantity;
                            }
                            if(i==3)
                            {
                                vm.prescriptFinalData.prescriptionNameList[objIndex].clock_time_4 = res.timing; 
                                vm.prescriptFinalData.prescriptionNameList[objIndex].clock_quantity_4 = res.quantity;
                            }
                            i++;
                        }
                    }
                  }); 
              }
             return 'okay'; 
          },
          addMedicinOntime(array)
          {
              let vm =this;
              vm.t_qt=array.clock_quantity;
              var clock_time_1="--:--",clock_time_2="--:--",clock_time_3="--:--",clock_time_4="--:--";
              var clock_quantity_1=0,clock_quantity_2=0,clock_quantity_3=0,clock_quantity_4=0;
              if(array.clock_time=="")
              {
                  array.clock_time=clock_time_1;
              }
              if(array.clock_quantity=="")
              {
                  array.clock_quantity=clock_quantity_1;
              }
              var qhrs="";
              var tot_qhrs="";
              if(array.type=='Q-Hrs')
              {
                  qhrs=vm.prescriptFinalData.qhrs;
                  tot_qhrs=vm.prescriptFinalData.total_qhrs;
              }

              clocktimedata.push({'id':array.id,'pid':array.pid,'type':array.type,'name':array.name,'timing':array.clock_time,'quantity':array.clock_quantity,'remove':'false'});
              var obj = {};
              
               if(array.type=='Q-Hrs')
              {
                    let i=1;
                    let new_qhrs_arr=[];
                    var new_prescript_array=[];
                    for(i=1;i<=vm.prescriptFinalData.total_qhrs;i++)  
                    {
                        var clock_val='--:--';
                        var clock_qty=0;
                        if(i==1)
                        {
                            clock_val=array.clock_time;
                            clock_qty=array.clock_quantity;
                        }
                        
                        var clock_name='clock_time_'+i;
                        var clock_quantity_name='clock_quantity_'+i;
                        obj[clock_name]=clock_val;
                        obj[clock_quantity_name]=clock_qty;
                    }
                    
                      new_prescript_array.push({'id':array.id,'pid': array.pid,'name':array.name,'type':array.type,'total_quantity':array.clock_quantity,'clock_suggest':vm.prescriptFinalData.clock_suggest,'total_prescription_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details,'qhrs':qhrs,'total_qhrs':tot_qhrs,'remove':'false'});
                     new_qhrs_arr= _.merge(new_prescript_array[0],obj);
                     vm.prescriptFinalData.prescriptionNameList.push(new_qhrs_arr);
                   
                  
              }
              else
              {
                 
                vm.prescriptFinalData.prescriptionNameList.push({'id':array.id,'pid': array.pid,'name':array.name,'type':array.type,'total_quantity':array.clock_quantity,'clock_time_1':array.clock_time,'clock_quantity_1':array.clock_quantity,'clock_time_2':clock_time_2,'clock_quantity_2':clock_quantity_2,'clock_time_3':clock_time_3,'clock_time_4':clock_time_4,'clock_quantity_3':clock_quantity_3,'clock_quantity_4':clock_quantity_4,'clock_suggest':vm.prescriptFinalData.clock_suggest,'total_prescription_days':vm.prescriptFinalData.total_prescription_days,'details':vm.prescriptFinalData.details,'qhrs':qhrs,'total_qhrs':tot_qhrs,'remove':'false'});
              }
             
                return vm.prescriptFinalData.prescriptionNameList;
          },
          check_duplicate(id,type,array,check)
          {
              var length=0;
              var i=0;
              for(i=0;i<array.length;i++)
              {
                  if(check=='update')
                  {
                      if(array[i]['id']==id && array[i]['remove']=='false' && array[i]['type']==type)
                      {
                          length++;
                      }
                  }
              }
              return length;
          },
          check_type_length(id,type,array)
          {
              var length=0;
              var i=0;
              var repeat='No';
              let vm=this;
             
              for(i=0;i<array.length;i++)
              {
                  if(array[i]['id']==id && array[i]['type']==type)
                  {
                          length++;
                  }
              }
             
              if(type=='BD' && length>1)
              {
                  repeat='Yes';
              }
              if(type=='OD' && length>0)
              {
                  repeat='Yes';
              }
              if(type=='TDS' && length>2)
              {
                  repeat='Yes';
              }
              if(type=='QDS' && length>3)
              {
                  repeat='Yes';
              }
              if(type=='HS' && length>0)
              {
                  repeat='Yes';
              }
               if(type=='Q-Hrs' && length>vm.prescriptFinalData.total_qhrs)
              {
                  repeat='Yes';
              }
              return repeat;
          },
          checkClockTime(id,time,array,type)
          {
              var length=0;
              var i=0;
              for(i=0;i<array.length;i++)
              {
                if(array[i]['id']==id &&  array[i]['clock_time']==time && time!="")
                {
                    length++;
                }
              }
              return length;
          },
          checkClockTimeEdit(time,clock1,clock2,clock3,old_clock)
          {
              if(old_clock!=time && clock1==time)
              {
                return 'yes';
              }
              else if(old_clock!=time && clock2==time)
              {
                  return 'yes';
              }
              else if(old_clock!=time && clock3==time)
              {
                  return 'yes';
              }
              return 'no';
          },
          storevueprescription()
          {
            let vm =this;
            let prespPrintData=_.filter(vm.prescriptFinalData.prescriptionNameList, function(o) { return o.remove=='false'; });
            vm.prescriptFinalData.finalPrescriptionAllData=_.cloneDeep(prespPrintData);
            let finalData = _.cloneDeep(vm.prescriptFinalData.prescriptionNameList);
            vm.$store.dispatch('setOtherPrescCount',vm.other_pid);
            vm.$store.dispatch('setPrescriptionData',finalData);
          },
          savePrescription() {
             let vm =this;
             vm.priscription_add_disabled=false;
             vm.show_prescription_result_data_enable=true;
             vm.storevueprescription();
             return false;
          },
           removePrescription(did) {
                
                let vm =this;
                let prescpt_array=_.cloneDeep(vm.prescriptFinalData.prescriptionNameList);
                let clock_data_array=clocktimedata;
                _.find(prescpt_array, function(res) {
                    if(res.pid == did) {
                      res.remove = true;
                      return false;
                    }
                });
                _.remove(clock_data_array, function (e) {
                   return e.pid ==did ;
                });
               vm.prescriptFinalData.prescriptionNameList=prescpt_array;
               clocktimedata=clock_data_array;
               let new_array=_.filter(vm.prescriptFinalData.prescriptionNameList, ['remove', 'false']);
               vm.presp_length=new_array.length;
               vm.storevueprescription();
                return false;
                
          },
           getPrescriptionList() {
            let vm =this;
            let userDepartment = vm.department;
            jQuery('.js-loader').removeClass('d-none');
            User.getPrescription(userDepartment).then( 
              (response)=> {
                  if(response.status == 200){
                    vm.prescriptionOption = response.data.data;
                    //$("#prescription").select2('destroy'); 
                     
                     setTimeout(function(){
                      $('#prescription').select2({placeholder: 'Select'});
                       jQuery('.js-loader').addClass('d-none');
                     },1000)
                  }
                },
                (error)=>{
                    jQuery('.js-loader').addClass('d-none');
                }
              )
           
          },
        editPrescriptionResult(id,clock_time,clock_qunatity,type)
        {
            let vm =this;
            vm.priscription_add_disabled=false;
            let final_result=[];
            if(clock_time=='' || clock_qunatity==0 || clock_qunatity=="")
            {
                toastr.error('Please select valid clock time.', 'Prescription error', {timeOut: 5000});
                return false;
            }
            _.find(vm.prescriptFinalData.prescriptionNameList, function(res) {
                if(res.id == id) {
                  vm.prespFinalRes=[];
                  final_result=res;
                  vm.class_type='EDIT';
                  let pid=final_result.pid;
                  $("#prescription").val(final_result.pid).trigger('change');
                  vm.prescriptFinalData.prescription_id=final_result.pid;
                   if(pid=='other')
                  {
                      vm.prescriptFinalData.other_prescription=final_result.name;
                  }
                  else
                  {
                      vm.prescriptFinalData.prescription=final_result.name;
                  }
                  vm.prescriptFinalData.how_many_times=final_result.type;
                  vm.prescriptFinalData.qhrs=final_result.qhrs;
                  setTimeout(function(){
                        $('#qhrs').select2({
                          placeholder: 'Select' 
                        });
                         $("#qhrs").prop("disabled", true);
                    },500);
                  vm.prescriptFinalData.total_qhrs=final_result.total_qhrs;
                  $("#how_many_times").val(final_result.type).trigger('change');
                  $("#qhrs").val(final_result.qhrs).trigger('change');
                  $("#prescription").prop("disabled", true);
                  $("#how_many_times").prop("disabled", true);
                 
                  vm.prescriptFinalData.prescription_quantity=final_result.total_quantity;
                  vm.prescriptFinalData.total_prescription_days=final_result.total_prescription_days;
                  vm.prescriptFinalData.details=final_result.details;
                  vm.prescriptFinalData.clock_suggest=final_result.clock_suggest;
                  vm.prescriptFinalData.clock_type=type;
                  vm.prescriptFinalData.clock_value=clock_time;
                  var c_time="";
                  if(final_result.type=='Q-Hrs')
                  {
                     
                      let i=0;
                      for(i=1;i<=final_result.total_qhrs;i++)
                      {
                          if(type==i)
                          {
                            c_time="";
                            if(final_result['clock_time_'+i]!='--:--' && final_result['clock_time_'+i]!="")
                            {
                                c_time=final_result['clock_time_'+i];
                            }
                             var final_clock_time=vm.prescriptFinalData.old_clock_value=c_time;
                             vm.prescriptFinalData.clock_time=final_result['clock_time_'+i];
                             var final_clock_quantity=vm.prescriptFinalData.clock_quantity=final_result['clock_quantity_'+i];
                          }
                         
                      }
                  }
                  else
                  {
                      if(type==1) 
                      {
                          if(res.clock_time_1==clock_time)
                          {
                              var final_clock_time=vm.prescriptFinalData.old_clock_value=final_result.clock_time_1;
                              vm.prescriptFinalData.clock_time=final_result.clock_time_1;
                              var final_clock_quantity=vm.prescriptFinalData.clock_quantity=final_result.clock_quantity_1;
                             // var final_clock_suggest=vm.prescriptFinalData.clock_suggest=final_result.clock_suggest_1;
                              //return false;
                          }
                      }
                      else if(type==2)
                      {
                          if(res.clock_time_2==clock_time)
                          {
                              var final_clock_time=vm.prescriptFinalData.old_clock_value=final_result.clock_time_2;
                              vm.prescriptFinalData.clock_time=final_result.clock_time_2;
                             var final_clock_quantity= vm.prescriptFinalData.clock_quantity=final_result.clock_quantity_2;
                               //var final_clock_suggest=vm.prescriptFinalData.clock_suggest=final_result.clock_suggest_2;
                              //return false;
                          }
                      }
                      else if(type==3)
                      {
                          if(res.clock_time_3==clock_time)
                          {
                              var final_clock_time=vm.prescriptFinalData.old_clock_value=final_result.clock_time_3;
                              vm.prescriptFinalData.clock_time=final_result.clock_time_3;
                              var final_clock_quantity=vm.prescriptFinalData.clock_quantity=final_result.clock_quantity_3;
                              //var final_clock_suggest=vm.prescriptFinalData.clock_suggest=final_result.clock_suggest_3;
                              //return false;
                          }
                      }
                      else if(type==4)
                      {
                          if(res.clock_time_4==clock_time)
                          {
                              var final_clock_time=vm.prescriptFinalData.old_clock_value=final_result.clock_time_4;
                              vm.prescriptFinalData.clock_time=final_result.clock_time_4;
                              var final_clock_quantity=vm.prescriptFinalData.clock_quantity=final_result.clock_quantity_4;
                               //var final_clock_suggest=vm.prescriptFinalData.clock_suggest=final_result.clock_suggest_4;
                              //return false;
                          }
                      }
                  }
                    
                    vm.prespFinalRes.push({'id':final_result.id,'name':final_result.name,'type':final_result.type,'pid':final_result.pid,'clock_time':final_clock_time,'clock_quantity':final_clock_quantity,'clock_suggest':final_result.clock_suggest,'remove':'false','t_quantity':final_result.total_quantity,'t_days':final_result.total_prescription_days,'old_clock_value':final_clock_time,'clock_type':type,'details':final_result.details});
                    setTimeout(function(){
                      $('.clockpicker').clockpicker({donetext: 'Done',autoclose: true});
                      $('.clockpicker').clockpicker().find('input').change(function(){
                          let id_st=this.id;
                          let val=this.value;
                          let org_id=id_st.match(/\d+/g).map(Number);
                          vm.prespFinalRes[org_id[0]].clock_time=val;
                      });
                    },500);
                    vm.prescriptFinalData.prescription_report=vm.prespFinalRes;
                }
            });
           
            return false;
        },
        editClockResult(btntype)
        {
            let vm=this;
            if(btntype=='Cancel')
            {
                vm.class_type='ADD';
                    $("#prescription").prop("disabled", false);
                    $("#how_many_times").prop("disabled", false);
                    vm.clearPrespData();
                    return false;
            }
            else
            { 
                if(vm.prescriptFinalData.prescription_report[0].pid=='other' && (vm.prescriptFinalData.other_prescription=="" || vm.prescriptFinalData.other_prescription==null))
                {
                   toastr.error('Please enter prescription name.', 'Prescription error', {timeOut: 500});
                    return false;
                }
                let total_days_val=_.toNumber(vm.prescriptFinalData.total_prescription_days);
                if(!(_.isInteger(total_days_val)))
                {
                    toastr.error('Please enter valid total prescription days.', 'Prescription error', {timeOut: 5000});
                    return false;
                }
                 let q_val=_.toNumber(vm.prescriptFinalData.prescription_report[0].clock_quantity);
                if(!(_.isInteger(q_val)))
                {
                    toastr.error('Please enter valid quantity.', 'Prescription error', {timeOut: 5000});
                    return false;
                }
                let clock_suggest='--';
                if(vm.prescriptFinalData.prescription_report[0].clock_suggest!="")
                {
                  clock_suggest=vm.prescriptFinalData.prescription_report[0].clock_suggest;
                }
                
                let objIndex = vm.prescriptFinalData.prescriptionNameList.findIndex((obj => obj.id == vm.prescriptFinalData.prescription_report[0].id && obj.remove=='false'));
                
                 var check_clocktime_edit=vm.checkClockTimeEdit(vm.prescriptFinalData.prescription_report[0].clock_time, vm.prescriptFinalData.prescriptionNameList[objIndex].clock_time_1, vm.prescriptFinalData.prescriptionNameList[objIndex].clock_time_2, vm.prescriptFinalData.prescriptionNameList[objIndex].clock_time_3,vm.prescriptFinalData.prescription_report[0].old_clock_value);
                if(check_clocktime_edit=='yes')
                {
                    toastr.error('Clock time already exist.', 'Prescription error', {timeOut: 5000});
                    return false;
                }
                else
                {
                  //for prescription name list
                    let pid=vm.prescriptFinalData.prescription_report[0].pid;
                    if(pid=='other')
                    {
                      vm.prescriptFinalData.prescriptionNameList[objIndex].name=vm.prescriptFinalData.other_prescription;
                    }
                    vm.prescriptFinalData.prescriptionNameList[objIndex].total_prescription_days=vm.prescriptFinalData.total_prescription_days;
                     vm.prescriptFinalData.prescriptionNameList[objIndex].details=vm.prescriptFinalData.details;
                     vm.prescriptFinalData.prescriptionNameList[objIndex].qhrs=vm.prescriptFinalData.qhrs;
                     vm.prescriptFinalData.prescriptionNameList[objIndex].total_qhrs=vm.prescriptFinalData.total_qhrs;
                      vm.prescriptFinalData.prescriptionNameList[objIndex].clock_suggest=vm.prescriptFinalData.clock_suggest;
                     let get_type=vm.prescriptFinalData.prescription_report[0].clock_type;
                     //for prescription clock time list 
                    let objIndex_clock = clocktimedata.findIndex((obj => obj.id == vm.prescriptFinalData.prescription_report[0].id && obj.timing == vm.prescriptFinalData.prescription_report[0].old_clock_value));

                    var c_time=vm.prescriptFinalData.prescription_report[0].clock_time;
                    var indexes=[];
                      _.find(clocktimedata, function(res, index) {
                          if(res.id==vm.prescriptFinalData.prescription_report[0].id && res.timing != vm.prescriptFinalData.prescription_report[0].old_clock_value )
                          {
                            indexes.push(index);
                          }
                      });
                      let org_val=0,org_val2=0,org_val3=0;
                      if(vm.prescriptFinalData.prescriptionNameList[objIndex].type=='BD')
                      { 
                          if(get_type==1)
                            {
                               org_val=moment.utc(c_time,'HH:mm').add(12,'hour').format('HH:mm');
                                clocktimedata[indexes[0]].timing=org_val;
                               
                            }
                            else
                            {
                                org_val=moment.utc(c_time,'HH:mm').add(-12,'hour').format('HH:mm');
                                clocktimedata[indexes[0]].timing=org_val;
                            }
                      }
                   
                    if(vm.prescriptFinalData.prescriptionNameList[objIndex].type=='TDS')
                    {
                        if(get_type==1)
                        {
                           
                            org_val=moment.utc(c_time,'HH:mm').add(8,'hour').format('HH:mm');
                            org_val2=moment.utc(c_time,'HH:mm').add(16,'hour').format('HH:mm');
                            clocktimedata[indexes[0]].timing=org_val;
                            clocktimedata[indexes[1]].timing=org_val2;
                           
                        }
                        else if(get_type==2)
                        { 
                           org_val=moment.utc(c_time,'HH:mm').add(-8,'hour').format('HH:mm');
                           org_val2=moment.utc(c_time,'HH:mm').add(8,'hour').format('HH:mm');
                           clocktimedata[indexes[0]].timing=org_val;
                           clocktimedata[indexes[1]].timing=org_val2;
                        }
                        else if(get_type==3)
                        { 
                           org_val=moment.utc(c_time,'HH:mm').add(-16,'hour').format('HH:mm');
                           org_val2=moment.utc(c_time,'HH:mm').add(-8,'hour').format('HH:mm');
                           clocktimedata[indexes[0]].timing=org_val;
                           clocktimedata[indexes[1]].timing=org_val2;
                        }
                    }
                    if(vm.prescriptFinalData.prescriptionNameList[objIndex].type=='QDS')
                    {
                        if(get_type==1)
                        {
                           org_val=moment.utc(c_time,'HH:mm').add(6,'hour').format('HH:mm');
                           org_val2=moment.utc(c_time,'HH:mm').add(12,'hour').format('HH:mm');
                           org_val3=moment.utc(c_time,'HH:mm').add(18,'hour').format('HH:mm');
                           clocktimedata[indexes[0]].timing=org_val;
                           clocktimedata[indexes[1]].timing=org_val2;
                           clocktimedata[indexes[2]].timing=org_val3;
                           
                        }
                        else if(get_type==2)
                        { 
                           org_val=moment.utc(c_time,'HH:mm').add(-6,'hour').format('HH:mm');
                           org_val2=moment.utc(c_time,'HH:mm').add(6,'hour').format('HH:mm');
                           org_val3=moment.utc(c_time,'HH:mm').add(12,'hour').format('HH:mm');
                           clocktimedata[indexes[0]].timing=org_val;
                           clocktimedata[indexes[1]].timing=org_val2;
                           clocktimedata[indexes[2]].timing=org_val3;
                        }
                        else if(get_type==3)
                        { 
                           org_val=moment.utc(c_time,'HH:mm').add(-12,'hour').format('HH:mm');
                           org_val2=moment.utc(c_time,'HH:mm').add(-6,'hour').format('HH:mm');
                           org_val3=moment.utc(c_time,'HH:mm').add(6,'hour').format('HH:mm');
                           clocktimedata[indexes[0]].timing=org_val;
                           clocktimedata[indexes[1]].timing=org_val2;
                           clocktimedata[indexes[2]].timing=org_val3;
                        }
                        else if(get_type==4)
                        { 
                           org_val=moment.utc(c_time,'HH:mm').add(-18,'hour').format('HH:mm');
                           org_val2=moment.utc(c_time,'HH:mm').add(-12,'hour').format('HH:mm');
                           org_val3=moment.utc(c_time,'HH:mm').add(-6,'hour').format('HH:mm');
                           clocktimedata[indexes[0]].timing=org_val;
                           clocktimedata[indexes[1]].timing=org_val2;
                           clocktimedata[indexes[2]].timing=org_val3;
                        }
                    }
                    clocktimedata[objIndex_clock].timing=vm.prescriptFinalData.prescription_report[0].clock_time;
                    clocktimedata[objIndex_clock].quantity=vm.prescriptFinalData.prescription_report[0].clock_quantity;
                    clocktimedata[objIndex_clock].clock_suggest=clock_suggest;
                    clocktimedata= _.sortBy(clocktimedata, [function(o) { return o.timing; }]);
                    let f_quantity=0;
                    if(vm.prescriptFinalData.prescriptionNameList[objIndex].type=='Q-Hrs')
                    {
                        let i=1;
                        _.forEach(clocktimedata, function(res) {
                            if(res.remove=='false')
                            {
                                if(res.id==vm.prescriptFinalData.prescription_report[0].id)
                                {
                                    var col_name='clock_time_'+i;
                                    var col_qty='clock_quantity_'+i;
                                    var o_time='--:--';
                                    var o_qty=0;
                                    if(res.timing!="")
                                    {
                                        o_time=res.timing;
                                    }
                                    if(res.quantity!="")
                                    {
                                        o_qty=res.quantity;
                                    }
                                    vm.prescriptFinalData.prescriptionNameList[objIndex][col_name]= o_time; 
                                    vm.prescriptFinalData.prescriptionNameList[objIndex][col_qty] = o_qty;
                                    i++;
                                    f_quantity=parseInt(f_quantity)+parseInt(vm.prescriptFinalData.prescriptionNameList[objIndex][col_qty]);
                                }
                            }
                        });
                        
                    }
                    else
                    {
                        let i=0;
                       
                         _.find(clocktimedata, function(res) {
                              if(res.id==vm.prescriptFinalData.prescription_report[0].id)
                              {
                                  if(i==0)
                                  {
                                      vm.prescriptFinalData.prescriptionNameList[objIndex].clock_time_1 = res.timing;
                                      vm.prescriptFinalData.prescriptionNameList[objIndex].clock_quantity_1 = res.quantity; 
                                  }
                                  if(i==1)
                                  {
                                      vm.prescriptFinalData.prescriptionNameList[objIndex].clock_time_2 = res.timing; 
                                      vm.prescriptFinalData.prescriptionNameList[objIndex].clock_quantity_2 = res.quantity;
                                  }
                                  if(i==2)
                                  {
                                      vm.prescriptFinalData.prescriptionNameList[objIndex].clock_time_3 = res.timing; 
                                      vm.prescriptFinalData.prescriptionNameList[objIndex].clock_quantity_3 = res.quantity;
                                  }
                                  if(i==3)
                                  {
                                      vm.prescriptFinalData.prescriptionNameList[objIndex].clock_time_4 = res.timing; 
                                      vm.prescriptFinalData.prescriptionNameList[objIndex].clock_quantity_4 = res.quantity;
                                  }
                                  i++;
                                  f_quantity=parseInt(vm.prescriptFinalData.prescriptionNameList[objIndex].clock_quantity_1)+parseInt(vm.prescriptFinalData.prescriptionNameList[objIndex].clock_quantity_2)+parseInt(vm.prescriptFinalData.prescriptionNameList[objIndex].clock_quantity_3)+parseInt(vm.prescriptFinalData.prescriptionNameList[objIndex].clock_quantity_4);
                              }
                                
                        });
                    }
                    
                    vm.prescriptFinalData.prescriptionNameList[objIndex].total_quantity=f_quantity;
                    vm.class_type='ADD';
                    $("#prescription").prop("disabled", false);
                    $("#how_many_times").prop("disabled", false);
                    $("#qhrs").prop("disabled", false);
                    vm.clearPrespData();
                    return false;   
                }
            }
           
            return false;
        },
          
      }
    }
</script>