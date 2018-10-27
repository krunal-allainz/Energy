<template>
	<div class="col-lg-12 mb-3">
   
		<div class="card bg-success-card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6"><h4>Nomination List</h4></div>
          
          <div v-if="user_type==6" class="col-md-6 text-right"><button type="button" class="btn btn-primary" @click="setAddNomination()">Add</button></div></div>
        </div>
            <div class="card-body">
            	<div data-v-744e717e="" class="card p-3"  v-if="(nominationPagination.total > 0)">
              		<div data-v-744e717e="" class="table-header">
                  		<h4 data-v-744e717e="" class="table-title text-center mt-3"></h4>
              		</div>
              		<div data-v-744e717e="" class="table-responsive">
              			<table data-v-744e717e="" class="table">
                  			<thead data-v-744e717e="">
                    			<tr data-v-744e717e="">
                    				 <th data-v-744e717e="" class="sortable sorting-asc " style="" v-if="user_type==7">
                                		Buyer
                        			 </th>
                        			
                                <th style="width: auto;">
                                  Quantity Request
                                  <i data-v-744e717e="" class="fa float-right"></i> 
                                </th>
                                 <th style="width: auto;">
                                  Approved Quantity 
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
                  				 	<td data-v-744e717e="" class="text-uppercase"  v-if="user_type==7">
                       					{{ nominationData.buyer_name}}
                      			</td>
                      			
                            <td data-v-744e717e="" class="text-uppercase">
                                {{ nominationData.quantity_required}}
                            </td>
                            <td data-v-744e717e="" class="text-uppercase">
                                {{ nominationData.approved_quantity}}
                            </td>
                             <td data-v-744e717e="" class="text-uppercase">
                                {{ nominationData.date}}
                            </td>
                            <td data-v-744e717e="" class="text-uppercase">
                                {{ nominationData.request}}
                            </td>
                      				<td data-v-744e717e="" class="">
                      					<a v-if="today_date==nominationData.date || tomorrow_date==nominationData.date"> <i class="fa fa-remove text-danger mr-3 text-info mr-3" @click="removeNomination(nominationData.nId)" title="Nomination Delete"></i></a>
                                <a  v-if="today_date==nominationData.date || tomorrow_date==nominationData.date" @click="setNominationId(nominationData.nId)" title="Nomination Edit"> <i class="fa fa-pencil text-info mr-3 text-info mr-3" ></i></a>
                      				</td>
                  				 </tr>
                  			</tbody>
                		</table>
              		</div>
              		<div data-v-744e717e="" class="table-footer">
                		<div data-v-744e717e="" class="datatable-length float-left pl-3">
                  			<span data-v-744e717e="">Rows per page:</span>
                    			<select data-v-744e717e="" class="custom-select" id="perPageNoNomination"  @change="setPerPageNomination" v-model="perPageNomination">
                    				<option data-v-744e717e="" value="2">2</option>
                     				<option data-v-744e717e="" value="5">5</option>
                      				<option data-v-744e717e="" value="10">10</option>
                      				<option data-v-744e717e="" value="20">20</option>
                      				<option data-v-744e717e="" value="50">50</option>
                   					<!--     <option data-v-744e717e="" value="-1">All</option> -->
                    			</select>

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
  
	export default {
		 data() {
		 	return {
        'today_date':moment().format('DD-MM-YYYY'),
        'tomorrow_date':moment().add(1,'days').format('DD-MM-YYYY'),
		 	  'currentYear': (new Date()).getFullYear(),
		 	  'user':this.$store.state.Users.userDetails.first_name + " "+ this.$store.state.Users.userDetails.last_name ,
        'user_id':this.$store.state.Users.userDetails.id,
        'user_type':this.$store.state.Users.userDetails.user_type,
        'getNominationData' : '',
        'pagination': {},
        'perPage' : 5,
        'perPageNomination' : 5,
        'nominationPagination': {},
        'import_file':''
		 	}
		 },
       created: function() {
            
        },
		  mounted(){
		 	let vm = this;
		 	/* if(vm.$store.state.Users.userDetails.user_type != '6' || vm.$store.state.Users.userDetails.user_type != '7'){
          vm.$root.$emit('logout','You are not authorise to access this page'); 
        }*/
		 
       vm.getNominationList('/nomination/getNominationList');
      
		 },
     components: {
      
    },
		 methods:{
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
            User.deleteNomination(id).then(
                (response)=> {
                 
                  if(response.data.code == 200){
                    //$('#presp_'+id).remove();
                    vm.getNominationList('/nomination/getNominationList');
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
          vm.$router.push({'name':'nomination_add'});
      },
      setAddNomination()
      {
          let vm=this;
          vm.$store.dispatch('SetNominationId', ''); 
          vm.$store.dispatch('SetNominationPage','ADD');
          vm.$router.push({'name':'nomination_add'});
      },
		 	getNominationList(page_url){
		 		let vm = this;
		 		let userId = vm.user_id;
		 		let userType = vm.user_type;
		 	
        let no_of_page = '';
        no_of_page = vm.perPageNomination;

		 		User.getNominationList(page_url,userType,no_of_page,userId).then(
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
      vm.getNominationList('/nomination/getNominationList');
    },
    setPerPageNomination(e){
      let vm =this;
      vm.getNominationList('/nomination/getNominationList');
    },
	},
		
}
</script>