<template>
  <div class="col-lg-12 mb-3">
  	<div class="card">
      <div class="card-header  mb-3">
        <div class="row">
          <div class="col-md-6">
            <h4>Lng Invoice Generate</h4>
          </div> <!---->
        </div>
      </div>
      <div class="card-body">
    		<form method="post" enctype="multipart/form-data">
    			
                <div class="row form-group align-items-center">
                	<div class="col-md-3">
    		      		<label class="control-label float-right mb-0" for="buyer" > Select Buyer: </label>
    				</div>
    				<div class="col-md-6">
    		      		<select class="form-control ls-select2"  id="buyer" name="buyer" v-validate="'required'">
    		      			<option value="">Select</option>
    						 <option :value="buyer.id" v-for="buyer in invoiceData.buyer_option">{{buyer.name}}</option>
    		      		</select>
    		      		<i v-show="errors.has('buyer')" class="fa fa-warning"></i>
    		      		<span class="help is-danger" v-show="errors.has('buyer')">
    	                	Please select buyer.
    	                </span>
    				</div>
    				
                </div>
                <lngInvoiceListBuyer  :buyerId='buyer_id'   v-if="(loadList == true)"></lngInvoiceListBuyer>


               
               <!--  <div class="row form-group">
                    <div class="col-md-3">
                    </div>
                    <div class="col-md-9">
                        <button class="btn btn-success" type="button" @click="validateBeforeSubmit()">Add</button>
                    </div>
                </div> -->
    		</form>
      </div>
  	</div>
  </div>
</template>

<script>

	import User from '../../../api/users.js';
  	import moment from 'moment';
    import lngInvoiceListBuyer from './lngInvoiceListBuyer.vue' ; 

    export default {
        data() {
            return {
                    'invoiceData' : {
                    	'buyer_option'  : '',
                    	'buyer_id': '',
                    	'date':moment().format('DD-MMM-YYYY'),
                    },
                    'userData' : {
                    'userType' : this.$store.state.Users.userDetails.user_type,
                    'userId' : this.$store.state.Users.userDetails.id,
                },
                   
                    'loadList' : false,
                }
        },
        components: {
            lngInvoiceListBuyer
        },
        mounted() {
            var vm = this;
             if(vm.$store.state.Users.userDetails.user_type != '3'){
              vm.$root.$emit('logout','You are not authorize to access this page'); 
          }
             vm.loadList = false; 
            let user_type = [] ;
            $('.ls-select2').select2({
                placeholder: "Select"
            });
             $('#buyer').change("select2:select", function (e) {
               
           		let selectedBuyerId = $(this).val();
              	vm.invoiceData.buyer_id=selectedBuyerId;
             	let requestType = vm.invoiceData.noIncludeType;
             	let typeInclude = 'no';
                vm.buyer_id = $(this).val();
                 vm.loadList = false;     
                
                setTimeout(function(){
                 if(vm.buyer_id != ''){
                     vm.loadList = true;  
                }
                },1000) ;
               
                
              	//
                // vm.$buyerRequestList.$emit('getInvoiceDataByBuyerId',vm.buyer_id);
          });

            
            vm.getBuyeList();
        },
        methods: {
            getBuyeList()
            {
            	 var vm = this;
                var consult_list=[];
                User.generateUserDetailsByType(2,'Active').then(
                     (response) => {
                        let consult_data  = response.data.data;
                        $.each(consult_data, function(key, value) {
                            let name =  value.first_name ;
                            let id  = value.id ;
                            consult_list.push({name:name, id:id});
                        });
                        vm.invoiceData.buyer_option=consult_list;
                    },
                    (error) => {
                    },
                );
            },
            initialState() {
                this.$data.invoiceData.date = '',
                this.$data.invoiceData.buyer_id=''
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
                                        toastr.success('User added successfully', 'User', {timeOut: 5000});
                                        this.initialState();
                                        //localStorage.setItem("user_add",1)
                                       // window.location.reload();
                                    } else if (response.data.status_code == 301) {
                                        //this.initialState();
                                        toastr.error('User already exist.', 'User', {timeOut: 5000});

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