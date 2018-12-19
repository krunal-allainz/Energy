<template>
  <div class="col-lg-12 mb-3">
  	<div class="card bg-success-card">
  		
  			<div class="card-header  mb-3">
          <div class="row"><div class="col-md-6">
            <h4>Lng Supply By Truck List</h4>
          </div> <!---->
        </div>
      </div>
  			<div class="row">
          <div class="col-md-12">
            <previousNextDate></previousNextDate>
          </div>
        </div>
  		

              <lngSupplyBytruckListForSeller  :selectedDate='selectedDate'  v-if="(loadList == true)"  :getNominationLngData='getNominationLngData'  :gerDataForPaggination='gerDataForPaggination' :edit='edit' :displayApprove="displayApprove" :availableQty='availableQty' ></lngSupplyBytruckListForSeller>

                 <div  class="text-right">
                    <button type="button" value="Approve" class="btn btn-success" name="btnApprove" @click="approveQuantity()"  v-show="(displayApprove == false)">Approve</button>
                    <button type="button" value="Edit" class="btn btn-default" name="btnEdit" @click="editQuantity()" v-if="(edit == false && displayApprove == false)">Edit</button >
                    <button type="button" value="Edit" class="btn btn-default" name="btnEdit" @click="cancleQuantity()" v-if="(edit == true && displayApprove == false)">cancle</button>
                </div>

  	</div>
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
                    'totalRequestedQty' : 0,
                    'totalApproveQty' : 0,
                    'availableQty' : 0,
                    'canApprove' : 0,

                }
        },
        components: {
          lngSupplyBytruckListForSeller,
          previousNextDate
        },
        created: function() {
       
          this.$root.$on('changeDashbordDate',this.changeDashbordDate);
          this.$root.$on('getNominationLngList',this.getNominationLngListData);
          this.$root.$on('perPageLngNomination',this.perPageLngNomination);
          this.$root.$on('getTotalQty',this.getTotalQty);
          this.$root.$on('totalRequestedQuantity',this.totalRequestedQuantity);
          this.$root.$on('totalApproveQty',this.totalApprovedQuantity);
          this.$root.$on('checkApprovalStatus',this.checkApprovalStatus);
         },
        mounted() {
          
            var vm = this;
             if(vm.$store.state.Users.userDetails.user_type != '3'){
              vm.$root.$emit('logout','You are not authorise to access this page'); 
          }
          if(vm.totalApproveQty > 0){
            vm.displayApprove = true;
          }
            vm.getAvailableQty('lng_supply_daily_limit','numeric');
             
             vm.getNominationLngList('/nominationLng/getNominationLngList',vm.selectedDate);
          
        },
        methods: {
          totalApprovedQuantity(qty) {
            let vm =this;
            vm.totalApproveQty = qty;
          },
          totalRequestedQuantity(qty) {
           let vm =this;
            vm.totalRequestedQty = qty;
          },
           changeDashbordDate(selectDate)
           {  
            let vm=this;
            vm.loadList = false;
            vm.selectedDate=selectDate;
           
            vm.getNominationLngList('/nominationLng/getNominationLngList',vm.selectedDate);
            },
            setDate(date){
             vm.selectedDate=date;
            },
            checkApprovalStatus(){
              let vm = this;
              if(vm.totalRequestedQty > 0 && vm.totalRequestedQty > vm.availableQty){
                  vm.$parent.displayApprove == false;
                  vm.canApprove = 0;
              }else{
                vm.$parent.displayApprove == true;
                vm.canApprove = 1;
              }
            },
          getAvailableQty($fieldName,$fieldType){
            let vm= this;
            let data = {
                      'fieldName':$fieldName,
                      'fieldType':$fieldType
                      }
            User.getAvailableQty(data).then(

                 (response) => {
                  
                    if(response.data.code == 200){
                       vm.availableQty =parseInt((response.data.data)*450) ;
                    }else{
                        toastr.error(response.message, 'Availabel quantity not define ', {timeOut: 5000});
                    }
                  },
                  (error) => {
                      toastr.error(response.message, 'some thing Wrong', {timeOut: 5000});
                  }
              );


          },
          getTotalQty(data){
            let vm=this;
            let totalRequest = 0;
            let totalApprove = 0;
            vm.totalRequestedQty = 0;
            vm.totalApproveQty = 0;
            $.each(data,function(key,value){
                if(value.status != 'rejected'){
                    totalRequest = parseInt(totalRequest) + parseInt(value.quantity);
                    if(value.approve_quantity != null && value.approve_quantity != 0){
                        totalApprove = parseInt(totalApprove) + parseInt(value.approve_quantity);
                      }
                  }

            });

            vm.totalRequestedQty = totalRequest;
            vm.totalApproveQty = totalApprove;

           return true;

          },
          setLngDate(ldate)
        {
           return moment(String(ldate)).format('DD-MM-YYYY');
        },
        nominationLngSuccess()
      {
          let vm=this;
          
          vm.selectedDate=vm.today_date;
          vm.page_add_enabled=false;
          vm.$store.dispatch('SetNominationLngId', ''); 
          vm.$store.dispatch('SetNominationLngPage','');
          vm.getNominationLngList('/nominationLng/getNominationLngList',vm.selectedDate);

      },
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
                vm.getTotalQty(vm.getNominationLngData);
                if(vm.totalApproveQty > 0){
                  vm.displayApprove = true;
                }
                vm.loadList = true;
                
               // vm.displayApprove = false;
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
                vm.checkApprovalStatus();
                
            if(vm.canApprove == 1){ 

                
              if(confirm("After Approve quantity can't change, do you want to approve")){
                  User.approveQuatityForTruckLoad(data).then(

                    (response) => {
                      if(response.data.code == 200){
                         vm.displayApprove = false;
                          vm.edit = false;
                          toastr.success('Nomination Approved successfully', 'Nomination', {timeOut: 5000});
                         
                          vm.getNominationLngList('/nominationLng/getNominationLngList',vm.selectedDate);
                           vm.getTotalQty(vm.getNominationLngData);

                      }
                      if(response.data.code == 250){

                         toastr.error(response.message, 'Nomination', {timeOut: 5000});
                      }
                          
                    },
                    (error) => {
                       toastr.error('Something Went wrong.', 'Approve Nomination', {timeOut: 5000});
                    },


                );
                }
            }else{
               toastr.error('Total quantity must less than available quantity.', 'Nomination', {timeOut: 5000});
            }

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