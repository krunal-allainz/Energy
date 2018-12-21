<template>
	<div class="col-lg-12 mb-3">

		<div class="card bg-success-card">
      <div class="card-header  mb-3" >
        <div class="row">
          <div class="col-md-6"><h4 class="mt-2">LNG supply List</h4></div>
          
        </div>
      </div>
        <div class="row">
            <div class="col-md-12"><previousNextDate></previousNextDate></div>
          </div>
            <div class="card-body">
            	<div data-v-744e717e="" class="px-3"  v-if="(nominationLngPagination.total > 0)">
              		<div data-v-744e717e="" class="table-header">
                  		   
                            <div data-v-744e717e="" class="datatable-length mb-4">
                            <span data-v-744e717e="">Rows per page:</span>
                                <select data-v-744e717e="" class="custom-select" id="perPageNoNomination"  @change="setPerPageNomination" v-model="perPageLngNomination">
                                    <option data-v-744e717e="" value="2">2</option>
                                    <option data-v-744e717e="" value="5">5</option>
                                    <option data-v-744e717e="" value="10">10</option>
                                    <option data-v-744e717e="" value="20">20</option>
                                    <option data-v-744e717e="" value="50">50</option>
                                </select>
                           
                        </div>
              		</div>
              		<div data-v-744e717e="" class="table-responsive">
              			<table data-v-744e717e="" class="table">
                  			<thead data-v-744e717e="">
                    			<tr data-v-744e717e="">
                                <th style="width: auto;">
                                 Truck Number
                                  <i data-v-744e717e="" class="fa float-right"></i> 
                                </th>
                                 <th style="width: auto;">
                                  Buyer Name
                                  <i data-v-744e717e="" class="fa float-right"></i> 
                                </th>
                                 <th style="width: auto;">
                                  Time
                                  <i data-v-744e717e="" class="fa float-right"></i> 
                                </th>
                                 <th style="width: auto;">
                                  Approved Quantity
                                  <i data-v-744e717e="" class="fa float-right"></i> 
                                </th>
                                
                               
                        			 <th data-v-744e717e="" class="sortable" style="width: auto;" >
                           				 Tare weight
                            			<i data-v-744e717e="" class="fa float-right"></i>
                        			 </th>
                               <th data-v-744e717e="" class="sortable" style="width: auto;" >
                                   Gross weight
                                  <i data-v-744e717e="" class="fa float-right"></i>
                               </th>
                               <th data-v-744e717e="" class="sortable" style="width: auto;" >
                                   Net Weight
                                  <i data-v-744e717e="" class="fa float-right"></i>
                               </th>
                        		</tr>
                  			</thead>
                  			<tbody data-v-744e717e=""  v-for="nominationLngData in getSuppliedLngData">
                  				 <tr data-v-744e717e="" :id="'presp_'+nominationLngData.nId" v-show="(nominationLngData.lng_status != 'rejected')">
                  				 	<td data-v-744e717e="" class="text-uppercase">
                       					{{ nominationLngData.truck_detail[0].truck_company }} ({{ nominationLngData.truck_detail[0].truck_no }})
                      			</td>
                      			
                            <td data-v-744e717e="" class="text-uppercase">
                              {{nominationLngData.buyer_detail[0].first_name}}
                            </td>
                             <td data-v-744e717e="" class="text-uppercase">
                              {{nominationLngData.lngTime}}
                            </td>
                            <td data-v-744e717e="" class="text-uppercase">
                               {{nominationLngData.approve_quantity}}
                            </td>
                            <td class="" >
                      					<!-- <a href="javascript:void(0)" v-if="today_date==setLngDate(nominationLngData.lngDate)"> <i class="fa fa-remove text-danger mr-3 text-info mr-3" @click="removeNominationLng(nominationLngData.nId)" title="Nomination Delete"></i></a> -->

                                <a  href="javascript:void(0)"v-if="nominationLngData.tare_weight == '0.00'"  @click="setNominationId(nominationLngData.id,'tare_weight')" title="Add Tare Weight"> <i class="fa fa-pencil text-info mr-3 text-info mr-3" ></i></a> 
                                <a v-else>{{nominationLngData.tare_weight}} </a>
                            </td>
                            <td >
                                <a  href="javascript:void(0)" v-if="nominationLngData.tare_weight != '0.00' && nominationLngData.gross_weight == '0.00'" @click="setNominationId(nominationLngData.id,'gross_weight')" title="Add Gross Weight"> <i class="fa fa-pencil text-info mr-3 text-info mr-3" ></i></a>
                                <a v-else v-text="setText(nominationLngData.gross_weight)"> </a>

                      			</td>
                            <td>
                                
                                <a  v-text="setText(nominationLngData.supplied_quantity)"> </a>

                            </td>
                  				 </tr>
                  			</tbody>
                		</table>
              		</div>
              		<div data-v-744e717e="" class="table-footer">
                		<div data-v-744e717e="" class="datatable-length float-left pl-3">

                     		<div data-v-744e717e="" class="datatable-info  pb-2 mt-3" v-show="(nominationLngPagination.total > 0)">
                        		<span data-v-744e717e="">Showing </span> {{nominationLngPagination.current_page}} - {{nominationLngPagination.to}} of {{nominationLngPagination.total}}
                        		<span data-v-744e717e="">records</span>
                   			</div>
               			</div>
              		 </div>
              	</div>
                  <div data-v-744e717e="" class="card p-3" v-else>
                     <div data-v-744e717e="" class="table-responsive">
                         <span> No Record Found</span>
                      </div>
                 </div>
            </div>
  <section v-if="page_add_enabled">
      <SuppliedLngAdd :updateType="updateType"></SuppliedLngAdd>
  </section>
		</div>
	</div>
</template>
<script>
	import User from '../../../api/users.js';
  import previousNextDate from './previousNextDate.vue';
  import SuppliedLngAdd from './suppliedLngAdd.vue';

  import moment from 'moment';
	export default {
		 data() {
		 	return {
        'today_date':moment().format('YYYY-MM-DD'),
        'tomorrow_date':moment().add(1,'days').format('DD-MM-YYYY'),
		 	  'currentYear': (new Date()).getFullYear(),
		 	  'user':this.$store.state.Users.userDetails.first_name + " "+ this.$store.state.Users.userDetails.last_name,
        'user_id':this.$store.state.Users.userDetails.id,
        'user_type':this.$store.state.Users.userDetails.user_type,
        'getSuppliedLngData' : '',
        'pagination': {},
        'perPage' : 20,
        'perPageLngNomination' : 5,
        'nominationLngPagination': {},
        'page_add_enabled':false,
        'selectedDashbordDate':moment().format('DD-MM-YYYY'),
        'updateType':'tare',
        
        
		 	}
		 },
    created: function() {

        this.$root.$on('suppliedLngSuccess',this.suppliedLng);
        this.$root.$on('changeDashbordDate',this.changeDashbordDate);
        this.$root.$on('cancelPage',this.cancelPage);
    },
		mounted(){
		 	let vm = this;
      //vm.initData();
      
      vm.getSuppliedLngList('/nominationLng/getSuppliedLngList',vm.selectedDashbordDate);
		 },
    
     components: {
        previousNextDate,
        SuppliedLngAdd
    },
		 methods:{
      setText(data){
        if(data == '0.00'){
          return 'Awaiting data';
        }
        return data;
      },
       suppliedLng() {
       let vm = this;
        //vm.initData();
        vm.getSuppliedLngList('/nominationLng/getSuppliedLngList',vm.selectedDashbordDate);
        vm.cancelPage();
        
      },
      changeDashbordDate(selectDate)
      {
            let vm=this;
            vm.selectedDashbordDate=selectDate;
           
            vm.getSuppliedLngList('/nominationLng/getSuppliedLngList',vm.selectedDashbordDate);
        },
        setLngDate(ldate)
        {
           return moment(String(ldate)).format('DD-MM-YYYY');
        },
        setQty(data){
          // let vm=this;
          if(data) {
            return data + ' MMBTU';
          } else {
            return '00.00' + ' MMBTU';

          }
        },
        getMDCQValue(data){
          if(data){
            let value = (data*120)/100 ;
            return value + ' MMBTU';
          }else{
            return '00.00' + ' MMBTU';
          }
        },
        cancelPage()
        {
            let vm=this;
            vm.page_add_enabled=false;
        },
      nominationLngSuccess()
      {
          let vm=this;
          
          vm.selectedDashbordDate=vm.today_date;
          vm.page_add_enabled=false;
          vm.$store.dispatch('SetNominationLngId', ''); 
          vm.$store.dispatch('SetNominationLngPage','');
          vm.getSuppliedLngList('/nominationLng/getSuppliedLngList',vm.selectedDashbordDate);

      },
      getNominationCountForBuyer()
      {
          let vm=this;
          User.getNominationCountForBuyer(vm.user_id,vm.selectedDashbordDate).then(
            (response)=> {
             vm.add_nomination_count=response.data.data;
            },
            (error)=>{
            }
         )
      },

      setNominationId(id,type="")
      {
        let vm=this;
          vm.$store.dispatch('SetNominationLngId', id); 
          vm.$store.dispatch('SetNominationLngPage','EDIT');
          vm.page_add_enabled=true;
          vm.updateType =type;
      },
      // setAddNomination()
      // {
      //     let vm=this;
      //     vm.$store.dispatch('SetNominationLngId', ''); 
      //     vm.$store.dispatch('SetNominationLngPage','ADD');
      //     vm.$store.dispatch('SetNominationLngDate',vm.selectedDashbordDate);
      //     vm.page_add_enabled=true;
      // },
		 	getSuppliedLngList(page_url,select_date){
		 		let vm = this;
		 		let userId = vm.user_id;
		 		let userType = vm.user_type;
		 	
        let no_of_page = '';
        no_of_page = vm.perPageLngNomination;

		 		User.getSuppliedLngList(page_url,userType,no_of_page,userId,select_date).then(
		 			 (response) => {
              vm.getSuppliedLngData = response.data.data.data;
		 			 	  vm.makePagination( response.data.data);
		 			 },
		 			 (error) => {
                  	 },
		 		);
		 	},
		 	makePagination: function(data,status){
          let pagination = {
              current_page: data.current_page,
              last_page: data.last_page,
              next_page_url: data.next_page_url,
              prev_page_url: data.prev_page_url,
              total : data.total,
              from : data.from,
              to : data.to
          }
          this.nominationLngPagination = pagination;
      },
          
    setPerPage(e){
      let vm =this;
       vm.getSuppliedLngList('/nominationLng/getSuppliedLngList',vm.selectedDashbordDate);
    },
    setPerPageNomination(e){
      let vm =this;
       vm.getSuppliedLngList('/nominationLng/getSuppliedLngList',vm.selectedDashbordDate);
    },
	},
		
}
</script>