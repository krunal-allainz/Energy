<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h2>Invoice Data</h2>
				</div>
			</div>
		</div>
		 <div class="card-body">
            <div data-v-744e717e="" class="card p-3" v-if="buyerRequestList.length>0">
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
                            Last Name
                             <i data-v-744e717e="" class="fa float-right"></i>
                         </th>
                         <th data-v-744e717e="" class="sortable" style="width: auto;">
                           Department
                            <i data-v-744e717e="" class="fa float-right"></i>
                        </th>
                        <th data-v-744e717e="" class="sortable" style="width: auto;">
                           Email Id
                            <i data-v-744e717e="" class="fa float-right"></i>
                        </th>
                        <th data-v-744e717e="" class="sortable" style="width: auto;">
                            Address
                            <i data-v-744e717e="" class="fa float-right"></i>
                        </th>
                        
                        <th data-v-744e717e="" class="sortable" style="width: auto;" >
                           Mobile No
                        </th>
                        <th data-v-744e717e="" class="sortable" style="width: auto;" >
                            Action
                            <i data-v-744e717e="" class="fa float-right"></i>
                        </th>
                    </tr>
                  </thead>
                  <tbody data-v-744e717e="">
                    <tr data-v-744e717e="" v-for="buyer in buyerRequestList">
                      <td data-v-744e717e="" class="">
                        {{buyer.id}}
                      </td>
                      <td data-v-744e717e="" class="">
                        {{buyer.name }}
                      </td> <!---->
                      <td data-v-744e717e="" class="">
                       {{buyer.date }}
                      </td>
                      <td data-v-744e717e="" class="numeric">
                       {{buyer.quantity_required }}
                      </td> 
                      <td data-v-744e717e="" class="">
                        {{ buyer.approved_quantity }}
                      </td>
                      <td data-v-744e717e="" class="text-uppercase">
                        {{ buyer.supplied_quantity}}
                      </td>
                      <td data-v-744e717e="" class="" >
                       {{buyer.request}}
                      </td>
                      <td data-v-744e717e="" class="">
                       <!--  <a  :href="'/user/edit/'+user.id"> <i class="fa fa-pencil"  title="User edit"></i></a>
                                      <a > <i class="fa fa-trash"  title="request delete" @click="deleteUser(buyer.id)"  ></i></a> -->                    
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
        props :['buyerRequestList'],
        data(){
           
            return {
                
            }
        },
    }
</script>