<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h2>Nomination request form</h2>
				</div>
			</div>
		</div>
		<form method="post" enctype="multipart/form-data">
			<div class="row form-group">
                <div class="col-md-3">
                <label for="Quantity" class="control-label float-right txt_media1">Quantity:</label>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" id="quantity"  v-validate="'required'" v-model="nominationData.quantity" name="quantity">
                    <i v-show="errors.has('quantity')" class="fa fa-warning"></i>
                    <span class="help is-danger" v-show="errors.has('quantity')">Please enter valid quantity.</span>
                </div>
            </div>
            <div class="row form-group">
            	<div class="col-md-3">
		      		<label class="control-label float-right" >Supplier: </label>
				</div>
				<div class="col-md-6">
		      		<select class="form-control ls-select2"  id="supplier" name="supplier" v-validate="'required'" >
		      			<option value="">Select</option>
						 <option :value="supplier.id" v-for="supplier in nominationData.seller_option">{{supplier.text}}</option>
		      		</select>
		      		<i v-show="errors.has('supplier')" class="fa fa-warning"></i>
		      		<span class="help is-danger" v-show="errors.has('supplier')">
	                	Please select supplier.
	                </span>
				</div>
				
            </div>
            <div class="row form-group">
            	<div class="col-md-3">
		      		<label class="control-label float-right" >Date: </label>
				</div>
				<div class="col-md-6">
		      		<input type="text" class="form-control" id="quantity"  v-model="nominationData.date" name="quantity" readonly="readonly">
				</div>
				
            </div>
            <div class="row form-group">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <button class="btn btn-success" type="button" @click="validateBeforeSubmit()">Add</button>
                </div>
            </div>
		</form>
	</div>
</template>

<script>
/*if(localStorage.getItem("user_add"))
    {
        toastr.success('User has been added successfully', 'Add User', {timeOut: 5000});
        localStorage.removeItem("user_add");
        //localStorage.clear();
    }*/
	import User from '../../../api/users.js';
  	import moment from 'moment';

    export default {
        data() {
            return {
                    'nominationData' : {
                            	'date':moment().format('DD-MMM-YYYY'),
                            	'quantity': '',
                            	'seller_id': '',
                            	'buyer_id': '',
                            	'seller_option':{},
                                
                           // 	'userIamge': ''
                    },
                    
                }
        },
        mounted() {
            var vm = this;
            let user_type = [] ;
            //setTimeout(function(){
                $('.ls-select2').select2({
                    placeholder: "Select"
                });

                var consult_list=[];
			    User.generateUserDetailsByType(7,'Active').then(
			    	 (response) => {
	           	 		let consult_data  = response.data.data;
	           	 		$.each(consult_data, function(key, value) {
	               	 		let name =  value.first_name ;
	               	 		let id  = value.id ;
	               	 		consult_list.push({text:name, id:id});
	           	 		});
	           	 		vm.nominationData.seller_option=consult_list;
	           	 	},
	           	 	(error) => {
	        	 	},
				);
 
                  
            //},200);

        },
        methods: {

             initialState() {
                this.$data.data.date = '',
                this.$data.data.quantity =  '',
                this.$data.data.seller_id ='',
                this.$data.data.buyer_id=''
            },
            
            validateBeforeSubmit() {
               
                this.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {
                    // if(this.$data.userData.id=="") {
                                // here we add code for Mobile user for create user
                                User.createNomination(this.nominationData).then(
                                  (response)=> {
                                    //console.log(response);
                                    if(response.data.status_code == 200){
                                        toastr.success('User added successfully', 'Create User', {timeOut: 5000});
                                        this.initialState();
                                        //localStorage.setItem("user_add",1)
                                       // window.location.reload();
                                    } else if (response.data.status_code == 301) {
                                        //this.initialState();
                                        toastr.error('User already exist.', 'Add User', {timeOut: 5000});

                                    }
                                    // this.$router.push('dashboard');
                                  },
                                  (error)=>{
                                  }

                                )
                        // }
                    }
                })
            }
        }
    }
</script>