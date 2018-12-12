<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h2>Lng Suppliy By Truck List</h2>
				</div>
			</div>
			<div class="row">
        <div class="col-md-12">
          <previousNextDate></previousNextDate></div>
        </div>
		</div>
            <lngSupplyBytruckListForSeller  :selectedDate='selectedDate'  v-if="(loadList == true)"></lngSupplyBytruckListForSeller>
            <form method="post" enctype="multipart/form-data">
              
                <div  class="text-right">
                  <button type="button" value="Approve" class="btn btn-success" name="btnApprove" @click="approveQuantity()">Approve</button>
                  <button type="button" value="Edit" class="btn btn-default" name="btnEdit" @click="editQuantity()">Edit</button>
                  <button type="button" value="Request" class="btn btn-danger" name="btnReject" @click="rejectQuantity()">Reject</button>
              </div>
              
		</form>
	</div>
</template>

<script>

	import User from '../../../api/users.js';
  	import moment from 'moment';
  	import previousNextDate from './previousNextDate.vue';
    import lngSupplyBytruckListForSeller from './lngSupplyBytruckListForSeller.vue'; 

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
                   
                    'loadList' : true,
                    'selectedDate' : moment().format('DD-MM-YYYY'),
                    'buyer_id': '',
                }
        },
        components: {
          lngSupplyBytruckListForSeller,
          previousNextDate
        },
        mounted() {
            var vm = this;
             if(vm.$store.state.Users.userDetails.user_type != '3'){
              vm.$root.$emit('logout','You are not authorise to access this page'); 
          }
             vm.loadList = true; 
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
          });
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
            editQuantity(){


            },
            approveQuantity(){

            },
            rejectQuantity(){

            },
            initialState() {
                this.$data.invoiceData.date = '',
                this.$data.invoiceData.buyer_id=''
            },
            
            validateBeforeSubmit() {
               
                this.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {
                   
                    }
                })
            }
        }
    }
</script>