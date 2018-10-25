<template>
	<div class="col-lg-12 mb-3">
   
		<div class="card bg-success-card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-2"><h4>Prescription List</h4></div>
          <div class="col-md-2"><a href="assets/files/PRESCRIPTION.xlsx" class="btn btn-info">Sample File</a></div>
          <div class="col-md-6"> 
              <form id="app" action="prescription/importPrescriptionFile" method="post" enctype="multipart/form-data" v-on:submit="verifyImportFile">
                 <div class="large-12 medium-12 small-12 cell">
                    <label>File
                      <input type="file" id="file" ref="file" name="file" />
                    </label>
                      <button type="submit" name="import" class="btn btn-warning">Import</button>
                  </div>
                </form>
          </div>
          <div class="col-md-2 text-right"><button type="button" class="btn btn-primary" @click="setAddPrescription()">Add</button></div></div>
        </div>
            <div class="card-body">
            	<div data-v-744e717e="" class="card p-3"  v-if="(prescriptionPagination.total > 0)">
              		<div data-v-744e717e="" class="table-header">
                  		<h4 data-v-744e717e="" class="table-title text-center mt-3"></h4>
              		</div>
              		<div data-v-744e717e="" class="table-responsive">
              			<table data-v-744e717e="" class="table">
                  			<thead data-v-744e717e="">
                    			<tr data-v-744e717e="">
                    				 <th data-v-744e717e="" class="sortable sorting-asc " style="">
                                		Name
                        			 </th>
                        			 <th style="width: auto;">
                            			Type
                             			<i data-v-744e717e="" class="fa float-right"></i> 
                             		</th>
                                <th data-v-744e717e="" class="sortable" style="width: auto;">
                            			Doctor Name
                                  <i data-v-744e717e="" class="fa float-right"></i>
                        			 </th>
                        			 <th data-v-744e717e="" class="sortable" style="width: auto;">
                           				 Action
                            			<i data-v-744e717e="" class="fa float-right"></i>
                        			 </th>
                        		</tr>
                  			</thead>
                  			<tbody data-v-744e717e=""  v-for="prescriptData in getPrescriptionData">
                  				 <tr data-v-744e717e="" :id="'presp_'+prescriptData.id" v-if="prescriptData.remove=='false'">
                  				 	<td data-v-744e717e="" class="text-uppercase">
                       					{{ prescriptData.name}}
                      				</td>
                      				<td data-v-744e717e="" class="text-uppercase">
                       					{{ prescriptData.type}}
                      				</td>
                      				<td data-v-744e717e="" class="text-uppercase">
                        				{{ prescriptData.doctor}}
                      				</td>
                      				<td data-v-744e717e="" class="">
                      					<a> <i class="fa fa-remove text-danger mr-3 text-info mr-3" @click="removePrescription(prescriptData.id)" title="Prescription Delete"></i></a>
                                <a  @click="setPrescriptionId(prescriptData.id)" title="Prescription Edit"> <i class="fa fa-pencil text-info mr-3 text-info mr-3" ></i></a>
                      				</td>
                  				 </tr>
                  			</tbody>
                		</table>
              		</div>
              		<div data-v-744e717e="" class="table-footer">
                		<div data-v-744e717e="" class="datatable-length float-left pl-3">
                  			<span data-v-744e717e="">Rows per page:</span>
                    			<select data-v-744e717e="" class="custom-select" id="perPageNoPrescription"  @change="setPerPagePrescription" v-model="perPagePrescription">
                    				<option data-v-744e717e="" value="2">2</option>
                     				<option data-v-744e717e="" value="5">5</option>
                      				<option data-v-744e717e="" value="10">10</option>
                      				<option data-v-744e717e="" value="20">20</option>
                      				<option data-v-744e717e="" value="50">50</option>
                   					<!--     <option data-v-744e717e="" value="-1">All</option> -->
                    			</select>

                     		<div data-v-744e717e="" class="datatable-info  pb-2 mt-3" v-show="(prescriptionPagination.total > 0)">
                        		<span data-v-744e717e="">Showing </span> {{prescriptionPagination.current_page}} - {{prescriptionPagination.to}} of {{prescriptionPagination.total}}
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
        'getPrescriptionData' : '',
        'pagination': {},
        'perPage' : 5,
        'perPagePrescription' : 5,
        'patientId' :'',
        'open_opd_modal':false,
        'getPatientOPDInfo ' : '',
        'prescriptionPagination': {},
        'import_file':''
		 	}
		 },
       created: function() {
             this.$root.$on('close_modal', this.close_modal);
             this.$root.$on('searchPatientData', this.searchPatientData);
             this.$root.$on('patientEmpty', this.setSearchData);
        },
		  mounted(){
		 	let vm = this;
		 	 if(vm.$store.state.Users.userDetails.user_type != '4'){
          vm.$root.$emit('logout','You are not authorise to access this page'); 
        }
		
       vm.getPrescriptionList('/prescription/getPrescriptionList');
      
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
            toastr.error('Please Add Files.', 'Add Prescription', {timeOut: 5000});
            event.preventDefault();
          }
           
      },
      removePrescription(id)
      {
          let vm=this;
            User.deletePrescription(id).then(
                (response)=> {
                 
                  if(response.data.code == 200){
                    //$('#presp_'+id).remove();
                    vm.getPrescriptionList('/prescription/getPrescriptionList');
                    toastr.success('Prescription deleted successfully', 'Add Prescription', {timeOut: 5000});
                      //this.initialState();
                      
                  } else if (response.data.code == 300) {
                      toastr.error('Something Went wrong.', 'Add Prescription', {timeOut: 5000});
                      //this.initialState(); 
                  }
                  else
                  {
                      toastr.error('Something Went wrong.', 'Add Prescription', {timeOut: 5000});
                  }
                  
                },
                (error)=>{
                }

              )
      },
      setPrescriptionId(id)
      {
        let vm=this;
          vm.$store.dispatch('SetPrescriptionId', id); 
          vm.$store.dispatch('SetPrescriptionPage','EDIT');
          vm.$router.push({'name':'prescription_add'});
      },
      setAddPrescription()
      {
          let vm=this;
          vm.$store.dispatch('SetPrescriptionId', ''); 
          vm.$store.dispatch('SetPrescriptionPage','ADD');
          vm.$router.push({'name':'prescription_add'});
      },
		 	getPrescriptionList(page_url){
		 		let vm = this;
		 		let userId = vm.user_id;
		 		let userType = vm.user_type;
		 	
        let no_of_page = '';
        no_of_page = vm.perPagePrescription;

		 		User.getPrescriptionList(page_url,userType,no_of_page,userId).then(
		 			 (response) => {
              vm.getPrescriptionData = response.data.data.data;
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
          this.prescriptionPagination = pagination;
      },
          
    setPerPage(e){
      let vm =this;
      vm.getPrescriptionList('/prescription/getPrescriptionList');
    },
    setPerPagePrescription(e){
      let vm =this;
      vm.getPrescriptionList('/prescription/getPrescriptionList');
    },
	},
		
}
</script>