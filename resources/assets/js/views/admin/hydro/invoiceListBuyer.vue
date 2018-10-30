<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h2>Invoice List</h2>
				</div>
			</div>
		</div>
		 <div class="card-body">
            <div data-v-744e717e="" class="card p-3" v-if="invoiceList != '' || invoiceList.length > 0">
              <div data-v-744e717e="" class="table-header">
                  <h4 data-v-744e717e="" class="table-title text-center mt-3"></h4>
              </div>
              <div data-v-744e717e="" class="table-responsive">
                <table data-v-744e717e="" class="table">
                  <thead data-v-744e717e="">
                    <tr data-v-744e717e="">
                        <th data-v-744e717e="" class="sortable" style="width: auto;">
                            #
                        </th>
                        <th data-v-744e717e="" class="sortable sorting-asc" style="width: 200px;">
                                Buyer Name 
                        </th>
                        <th style="width: auto;">
                            Invoice Date
                             <i data-v-744e717e="" class="fa float-right"></i>
                         </th>
                         <th data-v-744e717e="" class="sortable" style="width: auto;">
                           Invoice No
                            <i data-v-744e717e="" class="fa float-right"></i>
                        </th>
                        <th data-v-744e717e="" class="sortable" style="width: auto;">
                           Total Amount
                            <i data-v-744e717e="" class="fa float-right"></i>
                        </th>
                        <th data-v-744e717e="" class="sortable" style="width: auto;">
                            Status
                            <i data-v-744e717e="" class="fa float-right"></i>
                        </th>
                        
                      
                        <th data-v-744e717e="" class="sortable" style="width: auto;" >
                            Action
                            <i data-v-744e717e="" class="fa float-right"></i>
                        </th>
                    </tr>
                  </thead>
                  <tbody data-v-744e717e="">
                    <tr data-v-744e717e="" v-for="invoice,index in invoiceList">
                      <td data-v-744e717e="" class="">
                        {{++index}}
                      </td>
                      <td data-v-744e717e="" class="">
                        {{invoice.name }}
                      </td> <!---->
                      <td data-v-744e717e="" class="">
                       {{invoice.date }}
                      </td>
                      <td data-v-744e717e="" class="numeric">
                       {{invoice.invoice_no }}
                      </td> 
                      <td data-v-744e717e="" class="">
                        {{ invoice.total_amount }}
                      </td>
                      <td data-v-744e717e="" class="text-uppercase">
                       <span v-if="invoice.status == 1"> Paid</span>
                       <span v-if="invoice.status == 0"> Pending</span>
                      </td>
                      <td data-v-744e717e="" class="">
                      	 <i data-v-744e717e="" class="fa fa-eye"></i>
                       <!--  <a  :href="'/user/edit/'+user.id"> <i class="fa fa-pencil"  title="User edit"></i></a>
                                      <a > <i class="fa fa-trash"  title="request delete" @click="deleteUser(buyer.id)"  ></i></a> -->                    
                      </td>
                    </tr>
                    <tr v-show="generateInvoice == true">
                      <td data-v-744e717e="" class="">
                        #
                      </td>
                      <td data-v-744e717e="" class="text-right" colspan="5">
                      	Pending
                      </td>
                      <td >
                      	<a v-if="user_type==7" :href="'/invoice/'+buyerId" class="btn btn-info">Generate Invoice</a>
                      </td>
                    </tr>
                  </tbody>
                </table>	
              </div>
              <div data-v-744e717e="" class="table-footer">
                <div data-v-744e717e="" class="datatable-length float-left pl-3">
                  <span data-v-744e717e="">Rows per page:</span>
                    <select data-v-744e717e="" class="custom-select" id="perPageNo"  @change="setPerPage" v-model="perPage">
                    <option data-v-744e717e="" value="2">2</option>
                      <option data-v-744e717e="" value="5">5</option>
                      <option data-v-744e717e="" value="10">10</option>
                      <option data-v-744e717e="" value="20">20</option>
                      <option data-v-744e717e="" value="50">50</option>
                   <!--     <option data-v-744e717e="" value="-1">All</option> -->
                    </select> 
                     <div data-v-744e717e="" class="datatable-info  pb-2 mt-3" v-show="(pagination.total>0)">
                        <span data-v-744e717e="">Showing </span> {{pagination.current_page}} - {{pagination.to}} of {{pagination.total}}
                        <span data-v-744e717e="">records</span>
                    </div>
                </div>
               </div>
            </div>
            <div v-else>
              <h6 class="card-header">
               <div>No records available</div>
            </h6>
            </div>
          </div>
        </div>
	</div>
</template>
<script>
	import User from '../../../api/users.js';

	export default{
        props :['buyerId'],
        data(){
           
            return {
                'pagination': {},
                 'perPage' : 5,
                 'invoiceList' : '',
                 'buyerRequestList' : '',
                 'generateInvoice' : false,
                 'noIncludeType': 'Invoice',
                 'user_type':this.$store.state.Users.userDetails.user_type,
            }
        },
         mounted() {
            var vm = this;
            let pageUrl = 'invoice/invoicelistbybuyerid/';
            let noOfPage = vm.perPage;
            let requestType = vm.noIncludeType;
            let typeInclude = 'no';
            vm.getInvoiceDataByBuyerId(vm.buyerId,noOfPage,pageUrl);
            vm.getBuyerRequestList(vm.buyerId,requestType,typeInclude);
            vm.checkGenerateInvoiceRequest();
        },
        methods: {
        	checkGenerateInvoiceRequest(status){
 				var vm = this;
        		vm.generateInvoice = status;

        	},
        	getBuyerRequestList(buyerId,requestType,typeInclude)
            {  
                var vm = this;
            	var request_list = [];
            	var request_data = '';
            	User.getBuyerRequestList(buyerId,requestType,typeInclude).then(
                     (response) => {
                     var coundListForInvoice = response.data.data.length;  
            	        if(coundListForInvoice >= 5){
            	        	vm.checkGenerateInvoiceRequest(true);
            	        }else{
            	        	vm.checkGenerateInvoiceRequest(false);
            	        }
                        // let  request_data  = response.data.data;
                        // $.each(request_data, function(key, value) {
                        //     let name =  value.first_name ;
                        //     let id  = value.id ;
                        //      let date  = value.date ;
                        //     let quantity_required  = value.quantity_required ;
                        //     let request  = value.request ;
                        //     let supplied_quantity  = value.supplied_quantity ;
                        //     let approved_quantity  = value.approved_quantity ;
                        //     request_list.push({
                        //         name:name,
                        //         id:id,
                        //         quantity_required:quantity_required,
                        //         request : request,
                        //         supplied_quantity : supplied_quantity,
                        //         approved_quantity : approved_quantity,
                        // });
                        //      });
                        // vm.buyerRequestList=request_list;
                    },
                    (error) => {
                    },
                );
            },
        	 getInvoiceDataByBuyerId(buyerId,noOfPage,pageUrl){ 
        	  var vm = this;
                User.getInvoiceDataByBuyerId(buyerId,noOfPage,pageUrl).then(
                     (response) => {
                        let data  = response.data.data.inv_arr;
                        let invoice_list = [];
                         let total_amount  = response.data.data.total_all ;
                         let sub_total  = response.data.data.sub_total ;
                        $.each(data, function(key, value) {
                        	let invoice_no = value.invoice_no;
                            let name =  value.buyer_name ;
                            let date  = value.date ;
                            let status  = value.status ;
                            invoice_list.push({
                            	name:name,
                            	date:date,
                            	invoice_no:invoice_no,
                            	total_amount:total_amount,
                            	sub_total : sub_total,
                            	status: status,
                            });
                        });
                        vm.invoiceList=invoice_list;
                         vm.makePagination(response.data.data);
                    },
                    (error) => {
                    },
                );
            },
         makePagination: function(data){
                     let pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                        next_page_url: data.next_page_url,
                        prev_page_url: data.prev_page_url,
                        total : data.total,
                        from : data.from,
                        to : data.to
                    }
                      this.pagination = pagination;
                 },
            setPerPage(e){
            let vm =this;
            let pageUrl = 'invoice/invoicelistbybuyerid/';
            let noOfPage = vm.perPage;
             vm.getInvoiceDataByBuyerId(vm.buyerId,vm.perPage,pageUrl);
            
            }
        }
    }
</script>