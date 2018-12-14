<template>
  <div>
	   <div class="col-lg-12 mb-3">
        <div class="card-body">
        	<div data-v-744e717e="" class="px-3"  v-if="(gerDataForPaggination.total > 0)">
          	<div data-v-744e717e="" class="table-responsive">
            	<table data-v-744e717e="" class="table">
              	<thead data-v-744e717e="">
                	<tr data-v-744e717e="">
                  	 <th data-v-744e717e="" class="sortable sorting-asc " style="" v-if="user_type==3">
                        Buyer
                     </th> 
                     <th style="width: auto;">
                        Truck No
                     <i data-v-744e717e="" class="fa float-right"></i> 
                     </th>
                      <th style="width: auto;">
                        Time 
                      <i data-v-744e717e="" class="fa float-right"></i> 
                    </th>
                    <th style="width: auto;">
                        Quantity (KG) 
                      <i data-v-744e717e="" class="fa float-right"></i> 
                    </th>
                      <th style="width: auto;">
                        Appove Quantity (KG) 
                      <i data-v-744e717e="" class="fa float-right"></i> 
                    </th>
                  </tr>
                  </thead>
                  <tbody data-v-744e717e=""  v-for="nominationLngData in getNominationLngData">
                  	<tr data-v-744e717e="" :id="'presp_'+nominationLngData.nId">
                  	<td data-v-744e717e="" class="text-uppercase"  v-text="nominationLngData.first_name">
                    </td>
                      			
                    <td data-v-744e717e="" class="text-uppercase" v-text="nominationLngData.truck_no">
                    </td>
                    <td data-v-744e717e="" class="text-uppercase" v-text="nominationLngData.lngTime">
                    </td>
                    <td data-v-744e717e="" class="text-uppercase" v-text="nominationLngData.quantity" v-show="(edit==false)">
                    <td data-v-744e717e="" class="text-uppercase"  v-show="(edit==true)">
                      <input type="text" v-model=nominationLngData.quantity name="quantity" id="quantityId" />
                    </td>
                     <td data-v-744e717e="" class="text-uppercase" v-text="nominationLngData.approve_quantity" >
                     </td>
                  </tr
>                </tbody>
              </table>
            </div>
            <div data-v-744e717e="" class="table-footer">
            	<div data-v-744e717e="" class="datatable-length float-left pl-3">
              <div>
              <div></div>
              </div>
              <div data-v-744e717e="" class="datatable-info  pb-2 mt-3" v-show="(nominationLngPagination.total > 0)">
                	<span data-v-744e717e="">Showing </span> {{nominationLngPagination.current_page}} - {{nominationLngPagination.to}} of {{nominationLngPagination.total}}
                  <span data-v-744e717e="">records</span>
              </div>
              </div>
            </div>
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
          </div>
          <div data-v-744e717e="" class="card p-3" v-else>
            <div data-v-744e717e="" class="table-responsive">
                         <span>No Record Found</span>
            </div>
          </div>
        </div>
		</div>
	</div>
</div>
</template>
<script>
	import User from '../../../api/users.js';
  import previousNextDate from './previousNextDate.vue';
	export default {
     props : ['gerDataForPaggination','getNominationLngData','selectedDate','edit'],
		 data() {

		 	return {
        'add_nomination_count':0,
        'today_date':moment().format('DD-MM-YYYY'),
        'tomorrow_date':moment().add(1,'days').format('DD-MM-YYYY'),
		 	  'currentYear': (new Date()).getFullYear(),
		 	  'user':this.$store.state.Users.userDetails.first_name + " "+ this.$store.state.Users.userDetails.last_name ,
        'user_id':this.$store.state.Users.userDetails.id,
        'user_type':this.$store.state.Users.userDetails.user_type,
        'pagination': {},
        'perPage' : 20,
        'perPageLngNomination' : 5,
        'nominationLngPagination': {},
        'page_add_enabled':false,
        'load' : false,
        'selectedDashbordDate':moment().format('DD-MM-YYYY'),
		 	}
		 },
    created: function() {
        this.$root.$on('nominationSuccess',this.nominationSuccess);
        // this.$root.$on('changeDashbordDate',this.changeDashbordDate);
         this.$root.$on('loadList',false);
        //this.$root.$emit('getNominationLngList','/nominationLng/getNominationLngList',this.selectedDate);
    },
		mounted(){
		 	let vm = this;
      vm.makePagination( vm.getNominationLngData);
		 },
     components: {
        previousNextDate
    },
		 methods:{
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
            setPerPageNomination(e){ 
             let vm =this;
             let data = {
              'page_url': '/nominationLng/getNominationLngList',
              'curDate':this.selectedDate
            };

              this.$root.$emit('perPageLngNomination',vm.setPerPageNomination);
              this.$root.$emit('getNominationLngList',data);
            },
            changeDashbordDate(selectDate)
            {
              let vm=this;
              vm.selectedDashbordDate=selectDate;
              vm.getNominationCountForBuyer();
              vm.getNominationLngList('/nominationLng/getNominationLngList',vm.selectedDate);
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
                vm.getNominationLngList('/nominationLng/getNominationLngList',vm.selectedDate);

            },
            getNominationCountForBuyer()
            {
                let vm=this;
                User.getNominationCountForBuyer(vm.user_id,vm.selectedDate).then(
                  (response)=> {
                   vm.add_nomination_count=response.data.data;
                  },
                  (error)=>{
                  }
               )
            },
            removeNominationLng(id)
            {
                let vm=this;
                vm.page_add_enabled=false;
                  User.deleteNomination(id).then(
                      (response)=> {
                       
                        if(response.data.code == 200){
                          //$('#presp_'+id).remove();
                           vm.getNominationCountForBuyer();
                           vm.getNominationLngList('/nominationLng/getNominationLngList',vm.selectedDashbordDate);
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
	},
		
}
</script>