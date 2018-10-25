<template>
	<div class="border">
	  <div class="row form-group border">
        <div class="col-md-6">
                <div class="col-md-6">
                    <label for="name" class="control-label">Name : </label>
                </div>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id = "name" name="name" value=""  v-model="patientSearchData.name"/>
                   
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-6">
                    <label for="name" class="control-label">Date of Birth : </label>
                </div>
                <div class="col-md-6">
                    <date-picker  :date.sync="patientSearchData.select_type_dob" :option="option" id = "select_type_dob" class="" type="date" name="select_value" :limit="limit" v-model="patientSearchData.select_type_dob.time"></date-picker>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-6">
                <div class="col-md-6">
                    <label for="uhid_no" class="control-label">UHID No : </label>
                </div>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id = "uhid_no" name="uhid_no" value=""  v-model="patientSearchData.uhid_no"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="col-md-6">
                    <label for="uhid_no" class="control-label">Mobile No : </label>
                </div>
                <div class="col-md-6">
                    <input class="form-control" type = "text" id = "mobile_no" name="mobile_no" value=""  v-model="patientSearchData.mobile_no"/>
                </div>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-12">
                <div class="col-md-6">
                    <button type="button"  class="btn btn-primary" @click="getPatientDetailsBySearch('All')">
                         Search
                    </button>
                    <button type="button"  v-if="patientSearchData.user_type!='3'" class="btn btn-warning" @click="getPatientDetailsBySearch('last_week')">
                         Last Week
                    </button>
                </div>
            </div>
        </div>
        <div class="row form-group" v-if="userListLength>0">
            <div class="col-md-12">
                <userlist :userlistData="userlistData" :copyVitals="copyVitals"></userlist>
            </div>
        </div>
	</div>
</template>
<script >
	import User from '../../../api/users.js';
	import myDatepicker from 'vue-datepicker';
    import userlist from './userlistData.vue';
	import _ from 'lodash';
    export default {
    	computed:{
    	},
    	components: {
    		'date-picker': myDatepicker,
             userlist,
    	},
    	props:['user_id','copyVitals'],
        data() {
            return {
            	'notValid':false,
                'footer' : 'footer',
                'currentYear': new Date().getFullYear(),
                'userlistData':{},
                'userListLength':0,
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
                  'patientSearchData' : {
                    'user_type':this.$store.state.Users.userDetails.user_type,
                    'uhid_no': '',
                    'mobile_no': '',
                    'name': '',
                    'select_type_dob': {
                        time:''
                    },
                    }
            }
        },
        mounted() {
        },
        filters:{
        },
        methods: {
            initSearchData(){
                var vm =this;
                vm.patientSearchData.uhid_no="";
                vm.patientSearchData.mobile_no="";
                vm.patientSearchData.name="";
                vm.patientSearchData.select_type_dob.time="";
            },
            getPatientDetailsBySearch(search_by){
                var vm =this;
                var select_val="";
                 vm.$root.$emit('patientEmpty',1);
                  $("body .js-loader").removeClass('d-none');
                    
                 let patData = {'search_data':vm.patientSearchData,'user_id':vm.user_id,'search_by':search_by};
                User.generatePatientListBySearch(patData).then(
                        (response) => {
                            // this.initSearchData();
                            vm.userlistData={};
                            if(response.data.code == 200) {
                                var pData = [{"searchdata": response.data.data,'select_type':vm.patientSearchData.select_type,'select_value':vm.patientSearchData.select_value}];
                                vm.userListLength=_.size(pData[0].searchdata);
                                vm.userlistData=pData;
                            } else if(response.data.code == 300) {
                                toastr.error('Record not found', 'Error', {timeOut: 5000});
                                this.$root.$emit('patientEmpty',1);
                            } else{
                                toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
                                this.$root.$emit('patientEmpty',1);
                            }
                             $("body .js-loader").addClass('d-none');
                        },
                        (error) => {
                             $("body .js-loader").addClass('d-none');

                })
             },
              GetSelectComponent(componentName) {
                this.$router.push({name: componentName})
          },
        	
		  }
    }
</script>
