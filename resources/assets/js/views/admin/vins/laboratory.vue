<template>
    <div class="container">
        <div class="page-header">

            <div class=" row text-center">
            <h3>Investigation</h3>
            </div>

        </div>
        <h4>Lab Report</h4>
        <form method = "post" >
            <div class="row form-group">
                <div class="col-md-12">
                    <div class = "row">
                    <div class="col-md-3">
                        <label class="control-label" for="label_1">Laboratory </label>
                    </div>
                    <div class="col-md-9">
                            <select class="form-control ls-select2"  id="laboratory_report" name="laboratory_report[]" multiple="multiple">
                            </select>
                    </div>
                </div>
                </div>
            </div>
            <div id="TextBoxContainer">
                    <!--Textboxes will be added here -->
                    <div v-if="laboratoryData.laboratory_report.length>0" :id="'lab_div_'+index" v-for="(lab, index) in laboratoryData.laboratory_report">
                         <div class="row form-group">
                            <div class="col-md-5"> 
                                <div class="col-md-12"> 
                                    <label class="control-label" for="label_1" >Name </label> 
                                </div> 
                                <div class="col-md-12"> 
                                    <input type="text"  :name="'lab_name'+index" :id="'lab_name_id'+index" :value="lab.text" class="form-control lab_name" readonly="readonly"> 
                                </div> 
                            </div> 
                            <div class="col-md-3"> 
                                <div class="col-md-12"> 
                                    <label class="control-label" for="label_1">Date </label> 
                                </div> 
                                <div class="col-md-12"> 
                                     <date-picker :date.sync="lab.lab_date"  :option="option" id = "lab_date_id" class="lab_date" type="text" :name="'lab_date'+index"  :limit="limit" v-model="lab.lab_date.time" :value="lab.lab_date.time"   ></date-picker>
                                       
                                </div>  
                            </div>  
                            <div class="col-md-4"> 
                                <div class="col-md-12"> 
                                    <label class="control-label" for="label_1">Result </label> 
                                </div> 
                                <div class="col-md-12"> 
                                    <input type="text"   :name="'lab_result'+index" id="lab_result_id" v-model="lab.result" class="form-control lab_result"  v-validate="'required'" > 
                                    <span class="help is-danger" v-show="errors.has('lab_result'+index)">
                                        Field is required
                                    </span>
                                </div> 
                            </div> 

                        </div>
                    </div>

            </div>
            <div >
                <div class="row form-group">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <input type="button" name="add_lab" class="btn btn-primary" value="Add" @click="saveLaboratoryTable()">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group" v-if="finalLaboratoryData.length>0">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="laboratory_table_list">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Date</th>
                            <th>Result</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-if="res.removed == false" :id="res.tr_id" v-for="(res,index) in finalLaboratoryData">
                                <td>{{++index}}</td> 
                                <td>{{res.text }}</td>
                                <td>{{res.lab_date.time}}</td>
                                <td>{{res.result}}</td>
                            </tr>

                        </tbody>
                    </table>
                  </div>
                  
                </div>
              </div>
            
        </form>

        <br>
        <br>

        <radiology></radiology>
        <div class="row form-group">
        <div class="col-md-6">
          <button type="button" class="btn btn-primary btn-submit text-right " @click="prev()" >Previous</button>
          <button type="button" class="btn btn-primary btn-submit text-right ml-10" @click="next()" >Next</button>
         </div>
      </div>
    </div>
</template>
<script >
    import User from '../../../api/users.js';
    import Radiology from './radiologyInvestigation.vue';
    import myDatepicker from 'vue-datepicker';
    import _ from 'lodash';
    export default {
        name:'laboratory',
        computed:{

        },
        components: {
            'date-picker': myDatepicker,
            Radiology
        },
        props:['labData'],
        data() {
            return {
                'notValid':false,
                'footer' : 'footer',
                'currentYear': new Date().getFullYear(),
                'lab_val_size':0,
                'finalLaboratoryData':{},
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
                  }
                ],
                'resultData': {
                    'type': '',
                    'subType': ''

                },
                'investigationData' : {
                    'neurology': {
                        'radiology':{
                            'x-rays': {
                                'value': '',
                                'x-rays_options' : {
                                    text:'fixed',
                                    text:'portable'
                                }
                            }
                        }
                    },
                    'ortho': {

                    },
                    'vascular': {

                    },
                    'cardio': {

                    },
                },
                'laboratoryData': {
                    'checkboxList':[],
                    'laboratory_report':{},
                    'laboratory_report_val':[],
                    'lab_date':{
                        time:''
                    },
                    'lab_name':[],
                    'lab_result':[],
                },
                'investigationData':{
                    'radiologyType':[
                        {text:'',value:''},
                        {text:'X-Rays',value:'x_rays'},
                        {text:'CT',value:'ct'},
                        {text:'MRI',value:'mri'},
                        {text:'Doppler',value:'doppler'},
                        {text:'Other',value:'other'}
                    ],
                    'radiologySubType':[
                            {text:'',value:''},
                            {text:'Fixed',value:'fixed'},
                            {text:'Portable',value:'portable'}
                        ],
                    'x_rays':'',
                    'x_rays_options':[
                         {text:'', value:''},
                         {text:'Fixed', value:'fixed'},
                         {text:'Portable', value:'portable'},
                     ],
                    'ct':'',         
                    'ct_options':[
                            {text:'',value:''},
                            {text:'Brain (Plain)', value:'brain_plain'},
                            {text:'Brain (Plain & Contrast)', value:'brain_plain_contrast'},
                            {text:'Neck', value:'neck'},
                            {text:'Chest', value:'chest'},
                            {text:'Upper Abdomen', value:'upper_abdomen'},
                            {text:'Pelvis', value:'pelvis'},
                            {text:'Whole Abdomen', value:'whole_abdomen'},
                            {text:'CT Angiography', value:'ct_angiography'},
                            {text:'Guided Procedure:Biopsy', value:'guided_procedure'},
                         ],
                    'mri':'',
                    'mri_options':[
                            {text:'',value:''},
                             {text:'Brain', value:'brain'},
                             {text:'Spine', value:'spine'},
                             {text:'Joint', value:'joint'},
                             {text:'Other', value:'other'},
                             {text:'Protocol', value:'protocol'}
                         ],
                    
                    
                }
            }
        },
        mounted() {
            let vm =this;
                $('.ls-select2').select2({
                    placeholder: "Select",

              });
            $('#laboratory_report').select2(
                {data:this.labData}
            );

            /*for lab data start*/
            
            $('#laboratory_report').on("select2:select", function (e) {
            var labDataRes = $('#laboratory_report').select2('data');
                var labRes = [];
                _.forEach( $('#laboratory_report').select2('data'), function(rep,index) {
                    let labFind = false;
                    _.find(vm.laboratoryData.laboratory_report, function(res) {
                        if(res.id == rep.id){
                            labRes.push(res);
                            labFind = true;
                            return false;
                        } 
                    });
                    if(labFind == false) {
                        labRes.push({'id':rep.id,'lab_date':rep.lab_date,'result':'','text':rep.text});
                    }
                });
                vm.laboratoryData.laboratory_report= labRes;
                vm.setLabData();
            });
            $('#laboratory_report').on("select2:unselect", function (e) {
                let lab_val_data=_.cloneDeep($('#laboratory_report').select2('data'));
                var labRes = [];
                _.forEach(lab_val_data, function(rep,index) {
                    let labFind = false;
                    _.find(vm.laboratoryData.laboratory_report, function(res) {
                        if(res.id == rep.id){
                            labRes.push(res);
                            labFind = true;
                            return false;
                        } 
                    });
                    if(labFind == false) {
                        labRes.push({'id':rep.id,'lab_date':rep.lab_date,'result':'','text':rep.text});
                    }
                });
                vm.laboratoryData.laboratory_report= labRes;
                vm.saveLaboratoryTable();
            }).trigger('change');

            /*for lab data end*/
            setTimeout(function(){
                vm.initData();
            },1000)
            
        },
        filters:{
            reportDisplay: function (value,index){  
                if (!value)     return '';
                if(index > 0){
                    return "," + value ;
                } else {
                    return value;
                }
            }
        },
        methods: {
            setLabData(){
                let vm =this;
                _.forEach(vm.laboratoryData.laboratory_report, function(rep,index) {
                  let cl = typeof  rep.lab_date;
                  //console.log(cl,'types');
                    if(typeof rep.lab_date === 'undefined' ) {
                        rep['lab_date'] ={'time':''};
                        rep['removed'] = false;
                    }
                  // vm.laboratoryData.laboratory_report[index].lab_date.time='';
                });
            },
            labDataDetails(lab_val)
            {
                let vm =this;
                if(lab_val.length>0)
                {
                    vm.lab_val_size=lab_val.length;
                    
                        let div = document.createElement('DIV');
                        let lab_final_val=lab_val[lab_val.length-1];
                        // div.innerHTML = this.getDynamicTextBox(lab_final_val);
                        // document.getElementById("TextBoxContainer").appendChild(div);
                    
                }
            },
            getDynamicTextBox(value)
            {
                var lab_name= $("#laboratory_report option[value='"+value+"']").text();
            },
             saveLaboratoryTable() {
                let vm =this;
                this.$validator.validateAll().then(
                    (response) => {
                    // vm.priscriptionAdd = vm.finalPrescriptionData.length;
                    if (!this.errors.any()) {
                        //console.log(vm.laboratoryData.laboratory_report);
                        vm.finalLaboratoryData =  _.cloneDeep(vm.laboratoryData.laboratory_report);
                        vm.setLaboratoryData();

                    }
                },
                (error) => {
                }
                )
          },
          setLaboratoryData() {
                let vm =this;
                 vm.$store.dispatch('saveLabReportData',vm.finalLaboratoryData);
            },
            prev() {
              let vm =this;
              vm.$root.$emit('prev','test');
          },
          next() {
            let vm =this;
            vm.$root.$emit('next','test');

          },
         initData() {
            let vm =this;
            let all_lab=_.cloneDeep(vm.$store.state.Patient.laboratoryData.type);
            if(all_lab)
            {
                let id_array=_.map(all_lab, 'id');
                //$('#laboratory_report').select2('val',id_array);
                $('#laboratory_report').val(id_array).trigger('change')
                
                vm.laboratoryData.laboratory_report = _.cloneDeep(vm.$store.state.Patient.laboratoryData.type);
                vm.finalLaboratoryData = _.cloneDeep(vm.$store.state.Patient.laboratoryData.type);
            }
           
          },
            GetSelectComponent(componentName) {
               this.$router.push({name: componentName})
            },
            saveLaboratory() {
                this.$validator.validateAll().then(
                (response) => {
                    if (!this.errors.any()) {
                         $("body .js-loader").removeClass('d-none');
                        User.saveLaboratory(this.laboratoryData).then(
                        (response) => {
                            if(response.data.code == 200) {
                                toastr.success('Laboratory data has been successfully saved', 'laboratory detail', {timeOut: 5000});
                            } else if(response.data.code == 300) {
                                toastr.error('Record not found', 'Error', {timeOut: 5000});
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
          }
    }
</script>
