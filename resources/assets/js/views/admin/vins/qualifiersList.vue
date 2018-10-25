<template>
	<div class="col-lg-12 mb-3">
   
		<div class="card bg-success-card">
			<div class="card-header">
        <div class="row">
          <div class="col-md-6"><h4>Qualifiers List</h4></div>
          <div  class="col-md-6 text-right"><button type="button" class="btn btn-primary" @click="setAddQualifiers()">Add</button></div></div>
        </div>
     
            <div class="card-body">
            	<div data-v-744e717e="" class="card p-3"  v-if="(qualifiersPagination.total > 0)">
              		<div data-v-744e717e="" class="table-header">
                  		<h4 data-v-744e717e="" class="table-title text-center mt-3"></h4>
              		</div>
              		<div data-v-744e717e="" class="table-responsive">
              			<table data-v-744e717e="" class="table">
                  			<thead data-v-744e717e="">
                    			<tr data-v-744e717e="">
                    				 <th data-v-744e717e="" class="sortable sorting-asc " style="">
                                		Radiology
                        			 </th>
                              <th data-v-744e717e="" class="sortable sorting-asc " style="">
                                    Bodyparts
                               </th>
                        			 <th style="width: auto;">
                            			Qualifier Name
                             			<i data-v-744e717e="" class="fa float-right"></i> 
                             		</th>
                               
                        			 <th data-v-744e717e="" class="sortable" style="width: auto;">
                           				 Action
                            			<i data-v-744e717e="" class="fa float-right"></i>
                        			 </th>
                        		</tr>
                  			</thead>
                  			<tbody data-v-744e717e=""  v-for="qualifiersData in getQualifiersData">
                  				 <tr data-v-744e717e="" :id="'presp_'+qualifiersData.qualifier_id">
                  				 	<td data-v-744e717e="" class="text-uppercase">
                       					{{ qualifiersData.radio_name}}
                      				</td>
                              <td data-v-744e717e="" class="text-uppercase">
                                {{ qualifiersData.bodypart_name}}
                              </td>
                      				<td data-v-744e717e="" class="text-uppercase">
                                {{ qualifiersData.qualifier_name}}
                      				</td>
                      				<td data-v-744e717e="" class="">
                      					<a> <i class="fa fa-remove text-danger mr-3 text-info mr-3" @click="removeQualifiers(qualifiersData.qualifier_id)" title="Qualifiers Delete"></i></a>
                                <a  @click="setQualifiersId(qualifiersData.qualifier_id)" title="Qualifiers Edit"> <i class="fa fa-pencil text-info mr-3 text-info mr-3" ></i></a>
                      				</td>
                  				 </tr>
                  			</tbody>
                		</table>
              		</div>
              		<div data-v-744e717e="" class="table-footer">
                		<div data-v-744e717e="" class="datatable-length float-left pl-3">
                  			<span data-v-744e717e="">Rows per page:</span>
                    			<select data-v-744e717e="" class="custom-select" id="perPageNoQualifiers"  @change="setPerPageQualifiers" v-model="perPageQualifiers">
                    				<option data-v-744e717e="" value="2">2</option>
                     				<option data-v-744e717e="" value="5">5</option>
                      				<option data-v-744e717e="" value="10">10</option>
                      				<option data-v-744e717e="" value="20">20</option>
                      				<option data-v-744e717e="" value="50">50</option>
                   					<!--     <option data-v-744e717e="" value="-1">All</option> -->
                    			</select>

                     		<div data-v-744e717e="" class="datatable-info  pb-2 mt-3" v-show="(qualifiersPagination.total > 0)">
                        		<span data-v-744e717e="">Showing </span> {{qualifiersPagination.current_page}} - {{qualifiersPagination.to}} of {{qualifiersPagination.total}}
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
		 	  'currentYear': (new Date()).getFullYear(),
		 	  'user':this.$store.state.Users.userDetails.first_name + " "+ this.$store.state.Users.userDetails.last_name ,
        'user_id':0,
        'user_type':this.$store.state.Users.userDetails.user_type,
        'getQualifiersData' : '',
        'pagination': {},
        'perPage' : 5,
        'perPageQualifiers' : 5,
        'qualifiersPagination': {},
        'import_file':''
		 	}
		 },
       created: function() {
            
        },
		  mounted(){
		 	let vm = this;
		 	 if(vm.$store.state.Users.userDetails.user_type != '4'){
          vm.$root.$emit('logout','You are not authorise to access this page'); 
        }
		
       vm.getQualifiersList('/qualifiers/getQualifiersList');
      
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
            toastr.error('Please Add Files.', 'Add Qualifiers', {timeOut: 5000});
            event.preventDefault();
          }
           
      },
      removeQualifiers(id)
      {
          let vm=this;
            User.deleteQualifiers(id).then(
                (response)=> {
                 
                  if(response.data.code == 200){
                    //$('#presp_'+id).remove();
                    vm.getQualifiersList('/qualifiers/getQualifiersList');
                    toastr.success('Qualifiers deleted successfully', 'Add Qualifiers', {timeOut: 5000});
                      //this.initialState();
                      
                  } else if (response.data.code == 300) {
                      toastr.error('Something Went wrong.', 'Add Qualifiers', {timeOut: 5000});
                      //this.initialState(); 
                  }
                  else
                  {
                      toastr.error('Something Went wrong.', 'Add Qualifiers', {timeOut: 5000});
                  }
                  
                },
                (error)=>{
                }

              )
      },
      setQualifiersId(id)
      {
        let vm=this;
          vm.$store.dispatch('SetQualifiersId', id); 
          vm.$store.dispatch('SetQualifiersPage','EDIT');
          vm.$router.push({'name':'qualifiers_add'});
      },
      setAddQualifiers()
      {
          let vm=this;
          vm.$store.dispatch('SetQualifiersId', ''); 
          vm.$store.dispatch('SetQualifiersPage','ADD');
          vm.$router.push({'name':'qualifiers_add'});
      },
		 	getQualifiersList(page_url){
		 		let vm = this;
		 		let userId = vm.user_id;
		 		let userType = vm.user_type;
		 	
        let no_of_page = '';
        no_of_page = vm.perPageQualifiers;

		 		User.getQualifiersList(page_url,userType,no_of_page,userId).then(
		 			 (response) => {
              vm.getQualifiersData = response.data.data.data;
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
          this.qualifiersPagination = pagination;
      },
          
    setPerPage(e){
      let vm =this;
      vm.getQualifiersList('/qualifiers/getQualifiersList');
    },
    setPerPageQualifiers(e){
      let vm =this;
      vm.getQualifiersList('/qualifiers/getQualifiersList');
    },
	},
		
}
</script>