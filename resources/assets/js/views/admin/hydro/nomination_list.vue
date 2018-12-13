<template>
	<div class="col-lg-12 mb-3">
    <section v-if="page_add_enabled">
      <nominationAdd></nominationAdd>
  </section>
		<div class="card bg-success-card">
      <div class="card-header  mb-3" >
        <div class="row">
          <div class="col-md-6"><h4 class="mt-2">Nomination List</h4></div>
          <div   v-if="user_type==2 && add_nomination_count==0 && today_date<selectedDashbordDate" class="col-md-6  text-right"><button type="button" class="btn btn-primary" @click="setAddNomination()">Add</button></div>
        </div>
      </div>
        <div class="row">
            <div class="col-md-12"><previousNextDate></previousNextDate></div>
          </div>
            <div class="card-body">
            	<div data-v-744e717e="" class="px-3"  v-if="(nominationPagination.total > 0)">
              		<div data-v-744e717e="" class="table-header">
                  		    <!-- <h4 data-v-744e717e="" class="table-title text-center mt-3"></h4> -->
                            <div data-v-744e717e="" class="datatable-length mb-4">
                            <span data-v-744e717e="">Rows per page:</span>
                                <select data-v-744e717e="" class="custom-select" id="perPageNoNomination"  @change="setPerPageNomination" v-model="perPageNomination">
                                    <option data-v-744e717e="" value="2">2</option>
                                    <option data-v-744e717e="" value="5">5</option>
                                    <option data-v-744e717e="" value="10">10</option>
                                    <option data-v-744e717e="" value="20">20</option>
                                    <option data-v-744e717e="" value="50">50</option>
                                    <!--     <option data-v-744e717e="" value="-1">All</option> -->
                                </select>

                            <!-- <div data-v-744e717e="" class="datatable-info  pb-2 mt-3" v-show="(nominationPagination.total > 0)">
                                <span data-v-744e717e="">Showing </span> {{nominationPagination.current_page}} - {{nominationPagination.to}} of {{nominationPagination.total}}
                                <span data-v-744e717e="">records</span>
                            </div> -->
                        </div>
              		</div>
              		<div data-v-744e717e="" class="table-responsive">
              			<table data-v-744e717e="" class="table">
                  			<thead data-v-744e717e="">
                    			<tr data-v-744e717e="">
                    				 <th data-v-744e717e="" class="sortable sorting-asc " style="" v-if="user_type==3">
                                		Buyer
                        			 </th>
                        			
                                <th style="width: auto;">
                                  Requested Quantity
                                  <i data-v-744e717e="" class="fa float-right"></i> 
                                </th>
                                 <th style="width: auto;">
                                  Scheduled Quantity 
                                  <i data-v-744e717e="" class="fa float-right"></i> 
                                </th>
                                 <th style="width: auto;">
                                  Allocated Quantity 
                                  <i data-v-744e717e="" class="fa float-right"></i> 
                                </th>
                                 <th style="width: auto;">
                                  DCQ
                                  <i data-v-744e717e="" class="fa float-right"></i> 
                                </th>
                                 <th style="width: auto;">
                                  MDCQ 
                                  <i data-v-744e717e="" class="fa float-right"></i> 
                                </th>
                                <th style="width: auto;">
                                  Date
                                  <i data-v-744e717e="" class="fa float-right"></i> 
                                </th>
                               <th style="width: auto;">
                                  Status
                                  <i data-v-744e717e="" class="fa float-right"></i> 
                                </th>
                        			 <th data-v-744e717e="" class="sortable" style="width: auto;">
                           				 Action
                            			<i data-v-744e717e="" class="fa float-right"></i>
                        			 </th>
                        		</tr>
                  			</thead>
                  			<tbody data-v-744e717e=""  v-for="nominationData in getNominationData">
                  				 <tr data-v-744e717e="" :id="'presp_'+nominationData.nId">
                  				 	<td data-v-744e717e="" class="text-uppercase"  v-if="user_type==3">
                       					{{ nominationData.buyer_name}}
                      			</td>
                      			
                            <td data-v-744e717e="" class="text-uppercase" v-text="setQty(nominationData.quantity_required)">
                               
                            </td>
                             <td data-v-744e717e="" class="text-uppercase" v-text="setQty(nominationData.approved_quantity)">
                               
                            </td>
                            <td data-v-744e717e="" class="text-uppercase" v-text="setQty(nominationData.supplied_quantity)">
                               
                            </td>
                            <td data-v-744e717e="" class="text-uppercase" v-text="setQty(nominationData.dcqValue)">
                               
                            </td>
                             <td data-v-744e717e="" class="text-uppercase" v-text="getMDCQValue(nominationData.dcqValue)">
                               
                            </td>
                             <td data-v-744e717e="" class="text-uppercase">
                                {{ nominationData.date}}
                            </td>
                            <td data-v-744e717e="" class="text-uppercase">
                              <span v-if="nominationData.request=='Pending'">
                                Pending
                              </span>
                              <span v-else>
                                  Scheduled
                              </span>
                               
                            </td>
                      				<td data-v-744e717e="" class="">
                      					<a v-if="today_date<=nominationData.date"> <i class="fa fa-remove text-danger mr-3 text-info mr-3" @click="removeNomination(nominationData.nId)" title="Nomination Delete"></i></a>
                                <a  v-if="today_date<=nominationData.date" @click="setNominationId(nominationData.nId)" title="Nomination Update"> <i class="fa fa-pencil text-info mr-3 text-info mr-3" ></i></a>
                      				</td>
                  				 </tr>
                  			</tbody>
                		</table>
              		</div>
              		<div data-v-744e717e="" class="table-footer">
                		<div data-v-744e717e="" class="datatable-length float-left pl-3">
                  			<!-- <span data-v-744e717e="">Rows per page:</span> -->
                    			<!-- <select data-v-744e717e="" class="custom-select" id="perPageNoNomination"  @change="setPerPageNomination" v-model="perPageNomination">
                    				<option data-v-744e717e="" value="2">2</option>
                     				<option data-v-744e717e="" value="5">5</option>
                      				<option data-v-744e717e="" value="10">10</option>
                      				<option data-v-744e717e="" value="20">20</option>
                      				<option data-v-744e717e="" value="50">50</option>
      
                    			</select> -->

                     		<div data-v-744e717e="" class="datatable-info  pb-2 mt-3" v-show="(nominationPagination.total > 0)">
                        		<span data-v-744e717e="">Showing </span> {{nominationPagination.current_page}} - {{nominationPagination.to}} of {{nominationPagination.total}}
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
		</div>
	</div>
</template>
<script>
	import User from '../../../api/users.js';
  import nominationAdd from './nomination_add';
  import previousNextDate from './previousNextDate.vue';
	export default {
		 data() {
		 	return {
        'add_nomination_count':0,
        'today_date':moment().format('DD-MM-YYYY'),
        'tomorrow_date':moment().add(1,'days').format('DD-MM-YYYY'),
		 	  'currentYear': (new Date()).getFullYear(),
		 	  'user':this.$store.state.Users.userDetails.first_name + " "+ this.$store.state.Users.userDetails.last_name ,
        'user_id':this.$store.state.Users.userDetails.id,
        'user_type':this.$store.state.Users.userDetails.user_type,
        'getNominationData' : '',
        'pagination': {},
        'perPage' : 20,
        'perPageNomination' : 5,
        'nominationPagination': {},
        'import_file':'',
        'page_add_enabled':false,
        'selectedDashbordDate':moment().format('DD-MM-YYYY'),
        
		 	}
		 },
    created: function() {
        this.$root.$on('nominationSuccess',this.nominationSuccess);
        this.$root.$on('changeDashbordDate',this.changeDashbordDate);
    },
		mounted(){
		 	let vm = this;
      //vm.initData();
      vm.getNominationCountForBuyer();
      vm.getNominationList('/nomination/getNominationList',vm.selectedDashbordDate);
		 },
     components: {
        nominationAdd,
        previousNextDate
    },
		 methods:{
       changeDashbordDate(selectDate)
        {
            let vm=this;
            vm.selectedDashbordDate=selectDate;
            vm.getNominationCountForBuyer();
            vm.getNominationList('/nomination/getNominationList',vm.selectedDashbordDate);
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
      nominationSuccess()
      {
          let vm=this;
          
          vm.selectedDashbordDate=vm.tomorrow_date;
          vm.page_add_enabled=false;
          vm.$store.dispatch('SetNominationId', ''); 
          vm.$store.dispatch('SetNominationPage','');
          vm.getNominationCountForBuyer();
          vm.getNominationList('/nomination/getNominationList',vm.selectedDashbordDate);

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
      verifyImportFile: function(event)
      {
          let files=this.$refs.file.files[0];
          if(files)
          {
              return true;
          }
          else
          {
            toastr.error('Please Add Files.', 'Add Nomination', {timeOut: 5000});
            event.preventDefault();
          }
           
      },
      removeNomination(id)
      {
          let vm=this;
          vm.page_add_enabled=false;
            User.deleteNomination(id).then(
                (response)=> {
                 
                  if(response.data.code == 200){
                    //$('#presp_'+id).remove();
                     vm.getNominationCountForBuyer();
                     vm.getNominationList('/nomination/getNominationList',vm.selectedDashbordDate);
                    toastr.success('Nomination deleted successfully', 'Add Nomination', {timeOut: 5000});
                      //this.initialState();
                      
                  } else if (response.data.code == 300) {
                      toastr.error('Something Went wrong.', 'Add Nomination', {timeOut: 5000});
                      //this.initialState(); 
                  }
                  else
                  {
                      toastr.error('Something Went wrong.', 'Add Nomination', {timeOut: 5000});
                  }
                  
                },
                (error)=>{
                }

              )
      },
      setNominationId(id)
      {
        let vm=this;
          vm.$store.dispatch('SetNominationId', id); 
          vm.$store.dispatch('SetNominationPage','EDIT');
          vm.page_add_enabled=true;
      },
      setAddNomination()
      {
          let vm=this;
          vm.$store.dispatch('SetNominationId', ''); 
          vm.$store.dispatch('SetNominationPage','ADD');
          vm.$store.dispatch('SetNominationDate',vm.selectedDashbordDate);
          vm.page_add_enabled=true;
      },
		 	getNominationList(page_url,select_date){
		 		let vm = this;
		 		let userId = vm.user_id;
		 		let userType = vm.user_type;
		 	
        let no_of_page = '';
        no_of_page = vm.perPageNomination;

		 		User.getNominationList(page_url,userType,no_of_page,userId,select_date).then(
		 			 (response) => {
              vm.getNominationData = response.data.data.data;
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
          this.nominationPagination = pagination;
      },
          
    setPerPage(e){
      let vm =this;
       vm.getNominationList('/nomination/getNominationList',vm.selectedDashbordDate);
    },
    setPerPageNomination(e){
      let vm =this;
       vm.getNominationList('/nomination/getNominationList',vm.selectedDashbordDate);
    },
	},
		
}
</script>