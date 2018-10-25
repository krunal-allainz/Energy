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
       
	</div>
</template>
<script >
	import User from '../../../api/users.js';
	import myDatepicker from 'vue-datepicker';
   
	import _ from 'lodash';
    export default {
    	computed:{
    	},
    	components: {
    		'date-picker': myDatepicker,
    	},
    	props:['searchType','noOfPage','page_url'],
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
            let vm =this;
            vm.initSearchData();
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
                $("body .js-loader").removeClass('d-none');

                let patData = {'search_data':vm.patientSearchData,'search_by':vm.searchType,'noOfPage':vm.noOfPage};
                this.$root.$emit('searchPatientData',patData,vm.page_url);
             },
              GetSelectComponent(componentName) {
                this.$router.push({name: componentName})
          },
        	
		  }
    }
</script>
