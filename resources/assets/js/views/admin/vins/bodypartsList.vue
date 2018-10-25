<template>
	<div class="col-lg-12 mb-3">
   
		<div class="card bg-success-card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-6"><h4>Bodyparts List</h4></div>
          <div  class="col-md-6 text-right"><button type="button" class="btn btn-primary" @click="setAddBodyparts()">Add</button></div></div>
        </div>
		
            <div class="card-body">
            	<div data-v-744e717e="" class="card p-3"  v-if="(bodypartsPagination.total > 0)">
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
                        			 <th style="width: auto;">
                            			Name
                             			<i data-v-744e717e="" class="fa float-right"></i> 
                             		</th>
                               
                        			 <th data-v-744e717e="" class="sortable" style="width: auto;">
                           				 Action
                            			<i data-v-744e717e="" class="fa float-right"></i>
                        			 </th>
                        		</tr>
                  			</thead>
                  			<tbody data-v-744e717e=""  v-for="bodypartsData in getBodypartsData">
                  				 <tr data-v-744e717e="" :id="'presp_'+bodypartsData.bodypart_id">
                  				 	<td data-v-744e717e="" class="text-uppercase">
                       					{{ bodypartsData.radio_name}}
                      				</td>
                      				<td data-v-744e717e="" class="text-uppercase">
                                {{ bodypartsData.bodypart_name}}
                      				</td>
                      				<td data-v-744e717e="" class="">
                      					<a> <i class="fa fa-remove text-danger mr-3 text-info mr-3" @click="removeBodyparts(bodypartsData.bodypart_id)" title="Bodyparts Delete"></i></a>
                                <a  @click="setBodypartsId(bodypartsData.bodypart_id)" title="Bodyparts Edit"> <i class="fa fa-pencil text-info mr-3 text-info mr-3" ></i></a>
                      				</td>
                  				 </tr>
                  			</tbody>
                		</table>
              		</div>
              		<div data-v-744e717e="" class="table-footer">
                		<div data-v-744e717e="" class="datatable-length float-left pl-3">
                  			<span data-v-744e717e="">Rows per page:</span>
                    			<select data-v-744e717e="" class="custom-select" id="perPageNoBodyparts"  @change="setPerPageBodyparts" v-model="perPageBodyparts">
                    				<option data-v-744e717e="" value="2">2</option>
                     				<option data-v-744e717e="" value="5">5</option>
                      				<option data-v-744e717e="" value="10">10</option>
                      				<option data-v-744e717e="" value="20">20</option>
                      				<option data-v-744e717e="" value="50">50</option>
                   					<!--     <option data-v-744e717e="" value="-1">All</option> -->
                    			</select>

                     		<div data-v-744e717e="" class="datatable-info  pb-2 mt-3" v-show="(bodypartsPagination.total > 0)">
                        		<span data-v-744e717e="">Showing </span> {{bodypartsPagination.current_page}} - {{bodypartsPagination.to}} of {{bodypartsPagination.total}}
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
        'getBodypartsData' : '',
        'pagination': {},
        'perPage' : 5,
        'perPageBodyparts' : 5,
        'bodypartsPagination': {},
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
		
       vm.getBodypartsList('/bodyparts/getBodypartsList');
      
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
            toastr.error('Please Add Files.', 'Add Bodyparts', {timeOut: 5000});
            event.preventDefault();
          }
           
      },
      removeBodyparts(id)
      {
          let vm=this;
            User.deleteBodyparts(id).then(
                (response)=> {
                 
                  if(response.data.code == 200){
                    //$('#presp_'+id).remove();
                    vm.getBodypartsList('/bodyparts/getBodypartsList');
                    toastr.success('Bodyparts deleted successfully', 'Add Bodyparts', {timeOut: 5000});
                      //this.initialState();
                      
                  } else if (response.data.code == 300) {
                      toastr.error('Something Went wrong.', 'Add Bodyparts', {timeOut: 5000});
                      //this.initialState(); 
                  }
                  else
                  {
                      toastr.error('Something Went wrong.', 'Add Bodyparts', {timeOut: 5000});
                  }
                  
                },
                (error)=>{
                }

              )
      },
      setBodypartsId(id)
      {
        let vm=this;
          vm.$store.dispatch('SetBodypartsId', id); 
          vm.$store.dispatch('SetBodypartsPage','EDIT');
          vm.$router.push({'name':'bodyparts_add'});
      },
      setAddBodyparts()
      {
          let vm=this;
          vm.$store.dispatch('SetBodypartsId', ''); 
          vm.$store.dispatch('SetBodypartsPage','ADD');
          vm.$router.push({'name':'bodyparts_add'});
      },
		 	getBodypartsList(page_url){
		 		let vm = this;
		 		let userId = vm.user_id;
		 		let userType = vm.user_type;
		 	
        let no_of_page = '';
        no_of_page = vm.perPageBodyparts;

		 		User.getBodypartsList(page_url,userType,no_of_page,userId).then(
		 			 (response) => {
              vm.getBodypartsData = response.data.data.data;
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
          this.bodypartsPagination = pagination;
      },
          
    setPerPage(e){
      let vm =this;
      vm.getBodypartsList('/bodyparts/getBodypartsList');
    },
    setPerPageBodyparts(e){
      let vm =this;
      vm.getBodypartsList('/bodyparts/getBodypartsList');
    },
	},
		
}
</script>