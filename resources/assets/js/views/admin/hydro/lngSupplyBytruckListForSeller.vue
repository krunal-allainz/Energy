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
                      <th style="width: auto;" v-show="(totalApproveQty > 0 )">
                        Appove Quantity (KG) 
                      <i data-v-744e717e="" class="fa float-right"></i> 
                    </th>
                      <th style="width: auto;">
                        Action
                      <i data-v-744e717e="" class="fa float-right"></i> 
                    </th>
                  </tr>
                  </thead>
                  <tbody data-v-744e717e="" >
                  	<tr data-v-744e717e="" :id="'presp_'+nominationLngData.nId"  v-for="nominationLngData in getNominationLngData">
                  	<td data-v-744e717e="" class="text-uppercase"  v-text="nominationLngData.first_name">
                    </td>
                    <td data-v-744e717e="" class="text-uppercase" v-text="nominationLngData.truck_no">
                    </td>
                    <td data-v-744e717e="" class="text-uppercase" v-text="nominationLngData.lngTime">
                    </td>
                    <td data-v-744e717e="" class="text-uppercase" v-text="nominationLngData.quantity" v-show="(edit==false)">
                    <td data-v-744e717e="" class="text-uppercase"  v-show="(edit==true)">
                      <form>
                      <input type="text" v-model="nominationLngData.quantity" name="quantity" id="quantityId" @keydown="changeQtyValue()" v-validate="'required|decimal:2'"    />
                       <i v-show="errors.has('quantityId')" class="fa fa-warning"></i>
                      <span class="help is-danger" v-show="errors.has('quantityId')">Please enter valid Quantity number.</span>
                       </form>                 
                    </td>
                     <td data-v-744e717e="" class="text-uppercase" v-text="nominationLngData.approve_quantity"  v-show="(totalApproveQty > 0)">
                     </td>
                     <td>
                      <form method="post">
                        <button type="button" value="Request" class="btn btn-danger" name="btnReject" @click="rejectedQuantity(nominationLngData.nId)">Reject</button>
                      </form>
                     </td>
                  </tr>
                 <tr style="border:none !important;"><td>&nbsp;</td><td>&nbsp;</td><td><strong>Total</strong></td>
                  <td ><strong>{{totalRequestedQty}}</strong></td>
                  <td v-show="(totalApproveQty > 0 )" ><strong>{{totalApproveQty}}</strong></td>
                  <td>&nbsp;</td></tr>
                </tbody>
              </table>
              <div> <table class="tabel" data-v-744e717e=""></table></div>
            </div>
            <div data-v-744e717e="" class="table-footer">
            	<div data-v-744e717e="" class="datatable-length float-left pl-3">
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
        <div class="text-right">
        <span class="red">* Available quantity for LNG supply is {{availableQty}}</span>
       </div>
		</div>
	</div>
</div>
</template>
<script>
	import User from '../../../api/users.js';
  import previousNextDate from './previousNextDate.vue';
	export default {
     props : ['gerDataForPaggination','getNominationLngData','selectedDate','edit','availableQty','totalRequestedQty','totalApproveQty'],
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
        'selectedDashbordDate':moment().format('DD-MM-YYYY')
		 	}
		 },
    created: function() {
         this.$root.$on('loadList',false);
    },
		mounted(){
		 	let vm = this;
      vm.availableQty = this.$parent.availableQty;
      vm.changeQtyValue();
      vm.makePagination( vm.getNominationLngData);
		 },
     components: {
        previousNextDate
    },
		methods:{
            changeQtyValue(){ 

                let vm = this;
                this.$root.$emit('getTotalQty',vm.getNominationLngData);
               // vm.totalRequestedQty =  this.$parent.totalRequestedQty;
                //vm.totalApproveQty = this.$parent.totalApproveQty;
          
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
            setPerPageNomination(e){ 
             let vm =this;
             let data = {
              'page_url': '/nominationLng/getNominationLngList',
              'curDate':this.selectedDate
            }
              this.$root.$emit('perPageLngNomination',vm.setPerPageNomination);
              this.$root.$emit('getNominationLngList',data);
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
             rejectedQuantity(rid){

               let vm=this;
               let data = {
                  'data': vm.getNominationLngData,
                  'rid' : rid
              };
              User.rejectQuatityForTruckLoad(data).then(

                 (response) => {
                    toastr.success('Nomination Rejected successfully', 'Rejected Nomination', {timeOut: 5000});
                   
                    let data = {
                      'page_url': '/nominationLng/getNominationLngList',
                      'curDate':this.selectedDate
                      }
                      this.$root.$emit('getTotalQty',vm.getNominationLngData);
                      this.$root.$emit('getNominationLngList',data);
                      // vm.totalRequestedQty =  this.$parent.totalRequestedQty;
                    //vm.totalApproveQty = this.$parent.totalApproveQty;
                },
                (error) => {
                   toastr.error('Something Went wrong.', 'rejected Nomination', {timeOut: 5000});
                },

                );

            },
	},
		
}
</script>