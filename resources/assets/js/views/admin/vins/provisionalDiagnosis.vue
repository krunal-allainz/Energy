<template>
<div class="container">
	<h4>Provisional Diagnosis:</h4>
    <div id="prov_div">
        <div class="row form-group" v-if="department == 'Neurosurgery'">
            <div class="col-md-4">
                <label>Etiopathology Category:</label><br>
                <select class = "form-control ls-select2" id = "prov_cat" name = "prov_cat" >
                    <option value="">Select</option>
                  <option v-for="cat in DiagnosisCategoryList" :value="cat.id" v-if="cat.parent_id==1">{{cat.name}}</option>
                </select>
            </div>

            <div class="col-md-4" >
                <label>Diagnosis:</label><br>
                <select class = "form-control ls-select2" id = "prov_diagnosis" name = "prov_diagnosis" >
                    <option value="">Select</option>
                  <option v-for="dia in DiagnosisList" :value="dia.id" v-if="chkDiagnosis(dia)">{{dia.name}}</option>
                </select>
            </div>

            <div class="col-md-4" >
                <label>Side</label>   
                <select class = "form-control ls-select2" id = "prov_side" name = "prov_side" >
                    <option :value="side.value" v-for="(side) in sideOption">{{ side.text}}</option>
                  
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6">
                <label>Site:</label><br>

                <textarea class = "form-control " id = "prov_site" name = "prov_site" v-model="provisionalDiagnosis.site"></textarea>
            </div>

            <div class="col-md-6" >
                <label>Qualifier</label>   
                <textarea class = "form-control " id = "prov_qualifier" name = "prov_qualifier" v-model="provisionalDiagnosis.qualifier">
                </textarea>
            </div>
        </div>
    </div>
    <div class="row">
       <div class="row form-group">
            <div class="col-md-12">
                 <button type="button" class="btn btn-primary btn-lg " @click="addDiagnosis()">Add</button>
            </div>
        </div>
    </div>
        <div class="row">
        <div class="col-md-12">
             <card title="<i class='ti-layout-cta-left'></i> Reports">
                <div class="table-responsive">
                    <table class="table" id="radio_list">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Body parts</th>
                            <th>Qualifier</th>
                            <th>Special request</th>
                            <!-- <th>Image</th> -->
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <tr v-if="res.removed == false" v-for="(res,index) in finalProvisionalDiagnosis">
                            <td>{{++index}}</td>
                            <td>{{res.provCategory.value}}</td>
                            <td>{{res.provDiagnosis.value}}</td>
                            <td>{{res.site}}</td>
                            <td>{{res.qualifier}}</td>
                            <td> <i class="fa fa-remove" @click="removeDiagno(res.id)"></i></td>

                            
                        </tr>
                        
                        </tbody>
                    </table>
                </div>
            </card>
        </div>
    </div>
</div>
</template>
<script >
     var resData=[];
	import User from '../../../api/users.js';
	import _ from 'lodash';
    import card from "./card.vue"
    export default {
    	computed:{

    	},
        components: {
            card,
        },
        data() {
            return {
            	'notValid':false,
                'department' : this.$store.state.Users.userDetails.department ,
                'DiagnosisList':'',
                'DiagnosisCategoryList':'',
                'finalProvisionalDiagnosis':{
                    
                },
                'provisionalDiagnosis': {
                    'id':'',
                    'provCategory':'',
                    'provDiagnosis':'',
                    'site':'',
                    'qualifier':'',
                    'removed':false,
                },
                'sideOption': [

                    {'text':'','value':''},
                    {'text':'Left','value':'Left'},
                    {'text':'Right','value':'Right'},
                    {'text':'Medial','value':'Medial'},
                    {'text':'Lateral','value':'Lateral'},
                    {'text':'Superior (Supra)','value':'Superior (Supra)'},
                    {'text':'Inferior (Infra)','value':'Inferior (Infra)'},
                    {'text':'Median / Midline','value':'Median / Midline'},
                ],

            }
        },
        mounted() {

            let vm =this;
				$('.ls-select2').select2({
					 placeholder: "Select",
			    });
                $('#prov_div').on("select2:select", '.ls-select2',function (e) {
                if(this.id == 'prov_cat') {
                jQuery('.js-loader').removeClass('d-none');

                     $('#prov_diagnosis').select2("destroy");
                     // console.log(typeData);
                    vm.provisionalDiagnosis.provCategory = {'id':$("#prov_cat").select2().val(),'value':$("#prov_cat").select2('data')[0].text};
                    setTimeout(function(){
                    jQuery('.js-loader').addClass('d-none');

                        $('#prov_diagnosis').select2({
                             placeholder: "Select",
                        });  
                    },1000) 
                } 

                if(this.id == 'prov_diagnosis') {
                    vm.provisionalDiagnosis.provDiagnosis = {'id':$("#prov_diagnosis").select2().val(),'value':$("#prov_diagnosis").select2('data')[0].text};
                }
                // console.log(vm.resultData,$("#radiology_subtype").select2().val());
             });
            
                this.getDiagnosis();
        },
        filters:{
        	reportDisplay: function (value,index){	
        		if (!value) 	return '';
        		if(index > 0){
	        		return "," + value ;
	        	} else {
	        		return value;
	        	}
        	}
        },
        methods: {

            removeDiagno(rid) {
                let vm =this;
                _.find(vm.finalProvisionalDiagnosis, function(res) {
                    if(res.id == rid) {
                         res.removed = true;
                    }
                });
            
            },

            chkDiagnosis(res) {
                let vm =this;
                var cat = vm.provisionalDiagnosis.provCategory.id;
                if(cat == ''){
                    return false;
                } 
                var resCat =res.category_id;
                var resArr = resCat.split(',');
                if( $.inArray(cat, resArr) != -1){
                     return true;
                } else {
                    return false;
                }
            },
            addDiagnosis() {
                   let vm =this;
                 // resData.push= vm.finalResultData;
                
                if(vm.provisionalDiagnosis.provCategory == '' || vm.provisionalDiagnosis.provDiagnosis == '' ){
                    toastr.error('Please select provisional diagnosis.', 'Diagnosis error', {timeOut: 5000});
                    return false;
                }
                // console.log();
                vm.provisionalDiagnosis.id = resData.length;
                resData.push(vm.provisionalDiagnosis);
                
                vm.finalProvisionalDiagnosis = resData;

                vm.initDiagnosis(); 
            },
            initDiagnosis(){
                let vm =this;
                vm.provisionalDiagnosis =  {
                    'id':'',
                    'provCategory':'',
                    'provDiagnosis':'',
                    'site':'',
                    'qualifier':'',
                    'removed':false,
                };
                 $('.ls-select2').val(null).trigger('change');
            },
            getDiagnosis(){
                let vm =this;
                User.getDiagnosis('test').then(
                  (response)=> {
                    console.log(response.status);
                    if(response.status == 200) {
                        vm.DiagnosisCategoryList = response.data.data.DiagnosisCategoryList;
                        vm.DiagnosisList = response.data.data.DiagnosisList;
                    }
                  },
                  (error)=>{
                  }

                )
            },
                        
		}
    }
</script>
