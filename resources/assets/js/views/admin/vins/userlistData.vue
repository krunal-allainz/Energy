<template>
	<div class="container">
		<h4>Patient List</h4>
		   <div class="table-responsive" v-if="userlistData.length>0">
	        <table class="table table-striped table-bordered" id="user_list">
	            <thead>
	            <tr>
	                <th>#</th>
	                <th>UHID No.</th>
	                <th>First Name</th>
	                <th>Last Name</th>
	                <th>DOB</th>
	                <th>Mobile No.</th>
	                <th>Action</th>
	            </tr>
	            </thead>
	            <tbody>
	            	
	             <tr  v-for="(res,index) in userlistData[0].searchdata">
	                <td>{{++index}}</td>
	                <td>{{res.uhid_no }}</td>
	                <td>{{res.first_name}}</td>
	                <td>{{res.last_name}}</td>
	                <td>{{res.dob}}</td>
	                <td>{{res.mob_no}}</td>
	                <td><button  type="button" class="btn btn-primary" name="search_btn" id="search_btn" @click="getUserDetails(res.id)">Select</button></td>
	              </tr>
	            </tbody>
	        </table>
	      </div>
	</div>
</template>
<script >
	import User from '../../../api/users.js';
	import _ from 'lodash';
    export default {
    	computed:{

    	},
    	props:['userlistData','copyVitals'],
        data() {
            return {
                'userData': {

                	'userlist':this.userlistData,
                },
            }
        },
        mounted() {
        },
        methods: {
         initData() {
          },
           getUserDetails(id)
		    {
		    	$("body .js-loader").removeClass('d-none');
		    	if(id!=0 && id!="")
		    	{
		    		User.generatePatientDetailsByID(id).then(
		                (response) => {
		                	let vm = this;
		                	//let pData = response.data;
		                	let pData = {'searchdata':response.data.data,'code':response.data.code};
		                	this.$root.$emit('patientData',pData);
		                	 $("body .js-loader").addClass('d-none');
		                },
		                (error) => {
		                	 $("body .js-loader").addClass('d-none');
		                	 toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
		        	});
		    	}
		    	else
		    	{
		    		toastr.error('Record not found', 'Error', {timeOut: 5000});
		    		vm.initData();
		    	}
		    },
		  GetSelectComponent(componentName) {
		    this.$router.push({name: componentName})
		  },
		    
		  }
    }
</script>
