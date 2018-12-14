<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h2>Lng Supply By Truck List</h2>
				</div>
			</div>
			<div class="row">
        <div class="col-md-12">
          <previousNextDate></previousNextDate></div>
        </div>
		</div>
            <lngSupplyBytruckListForSeller  :selectedDate='selectedDate'  v-if="(loadList == true)"  :getNominationLngData='getNominationLngData'  :gerDataForPaggination='gerDataForPaggination' :edit='edit'></lngSupplyBytruckListForSeller>
            <form method="post" enctype="multipart/form-data">
              
              <div  class="text-right">
                  <button type="button" value="Approve" class="btn btn-success" name="btnApprove" @click="approveQuantity()" :disabled="displayApprove">Approve</button>
                  <button type="button" value="Edit" class="btn btn-default" name="btnEdit" @click="editQuantity()" v-if="(edit == false)">Edit</button>
                  <button type="button" value="Edit" class="btn btn-default" name="btnEdit" @click="cancleQuantity()" v-if="(edit == true)">cancle</button>
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
                    'page_add_enabled':false,
                    'loadList' : false,
                    'selectedDate' : moment().format('DD-MM-YYYY'),
                    'buyer_id': '',
                    'getNominationLngData' : '',
                    'gerDataForPaggination':'',
                    'edit' : false,
                    'displayApprove' : false,
                }
        },
        components: {
          lngSupplyBytruckListForSeller,
          previousNextDate
        },
        created: function() {
          this.$root.$on('getNominationLngList',this.getNominationLngListData);
           this.$root.$on('perPageLngNomination',this.perPageLngNomination);
         },
        mounted() {
            var vm = this;
             if(vm.$store.state.Users.userDetails.user_type != '3'){
              vm.$root.$emit('logout','You are not authorise to access this page'); 
          }
            
             vm.getNominationLngList('/nominationLng/getNominationLngList',vm.selectedDate);
        },
        methods: {
          getNominationLngListData(pageData) {
            let vm =this;
            vm.getNominationLngList(pageData.page_url,pageData.curDate);
          },
          getNominationLngList(page_url,select_date){ 
             let vm = this;
              let userId = vm.userData.userId;
              let userType = vm.userData.userType;
            
              let no_of_page = '';
              vm.getNominationLngData = '';
              vm.gerDataForPaggination = '';


              no_of_page = vm.perPageLngNomination;

              User.getNominationLngList(page_url,userType,no_of_page,userId,select_date).then(
              (response) => {
                vm.getNominationLngData = response.data.data.data;
                vm.gerDataForPaggination = response.data.data;
                vm.loadList = true;
                vm.displayApprove = false;
              },
              (error) => {
                     },
             );
            },
            editQuantity(){
                
              let vm = this;
              vm.edit = true;
            },
            cancleQuantity(){

               let vm = this;
                vm.edit = false;
               vm.getNominationLngList('/nominationLng/getNominationLngList',vm.selectedDate);
            },
            approveQuantity(){

              let vm=this;
               let data = {
                  'data': vm.getNominationLngData
                };

              User.approveQuatityForTruckLoad(data).then(

                (response) => {
                    toastr.success('Nomination Approve successfully', 'approve Nomination', {timeOut: 5000});
                    vm.displayApprove = true;
                    vm.edit = false;
                    vm.getNominationLngList('/nominationLng/getNominationLngList',vm.selectedDate);
                      
                },
                (error) => {
                   toastr.error('Something Went wrong.', 'Approve Nomination', {timeOut: 5000});
                },

                );

            },
            rejectQuantity(){

               let vm=this;
               let data = {
                  'data': vm.getNominationLngData
                };

              User.rejectQuatityForTruckLoad(data).then(

                (response) => {

                },
                (error) => {

                },

                );

            },
            initialState() {
               
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