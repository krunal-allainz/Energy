<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h2>Prescription Add</h2>
				</div>
			</div>
		</div>
		<form method="post"> 
            <div class="row">
                <div class="col-md-12">
                        <div class="card-body">
                                <div class="row form-group"  >
                                    <div class="col-md-3">
                                        <label for="department " class="control-label float-right txt_media1">Type :</label>
                                    </div>
                                    <div class="col-md-9">
                                         <select class="form-control ls-select2" id="department" name="department" v-model="prescriptionData.department" v-validate="'required'">
                                            <option :value="dept.text" v-for="dept in prescriptionData.departmentOption">{{dept.text}}</option>
                                        </select> 
                                        <i v-show="errors.has('department')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('department')">Please select Department.</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    <label for="doctor" class="control-label float-right txt_media1">Doctor Name :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="doctor"
                                               placeholder="Doctor Name" v-model="prescriptionData.doctor" name="doctor">
                                       
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    <label for="name" class="control-label float-right txt_media1">Name :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="name"
                                               placeholder="Name" v-validate="'required'" v-model="prescriptionData.name" name="name">
                                        <i v-show="errors.has('name')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('name')">Please enter valid Name.</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-9">
                                        <span v-if="prescriptionData.pageName=='EDIT'">
                                            <button class="btn btn-success" type="button" @click="editValidateBeforeSubmit()">Edit</button>
                                        </span>
                                        <span v-else>
                                             <button class="btn btn-success" type="button" @click="validateBeforeSubmit()">Add</button>
                                        </span>
                                    </div>
                                </div>
                        </div>
                </div>
            </div>
      
        </form>
	</div>
</template>

<script>

	import User from '../../../api/users.js';

    export default {
        data() {
            return {
                    'prescriptionData' : {
                    	'name':'',
                        'departmentOption':[{text:'Neurology'},
                                      {text:'Neurosurgery'},
                                      {text:'Cardiology'},
                                      {text:'Vascular'},
                                      {text:'ONCO'},
                                      {text:'Ortho'},
                                      {text:'Others'}
                                    ],
                        'department':'',
                        'prescriptionId':'',
                        'pageName':'',
                        'doctor':'',
                          
                    },
                   
                }
        },
        mounted() {
            var vm = this;
            vm.initData();
            $('.ls-select2').select2({
                placeholder: "Select"
            });
             $('#department').on('select2:selecting', function(e) {
                vm.prescriptionData.department =  e.params.args.data.text;
            });
        },
        methods: {
            initData()
            {
                let vm=this;
                let prescription_page=vm.$store.state.Prescription.prescriptionPage;
                
                if(prescription_page=='EDIT')
                {
                    vm.prescriptionData.pageName=prescription_page;
                    let pID=vm.$store.state.Prescription.prescriptionId;
                    if(pID!=0 || pID!=null)
                    {
                        vm.prescriptionData.prescriptionId=pID;
                        vm.setPrescriptionData(pID);

                    }
                }
            },
            setPrescriptionData(id)
            {
                let vm=this;
                User.getPrescriptionDetailsById(id).then(
                  (response)=> {
                   
                    if(response.data.code == 200){
                        let presp_data=response.data.data;
                        vm.prescriptionData.department =presp_data.type;
                        vm.prescriptionData.name =presp_data.name;
                        vm.prescriptionData.doctor =presp_data.doctor;
                        console.log(presp_data.type);
                        $('#department').val(presp_data.type).trigger('change');
                    } else if (response.data.code == 300) {
                        toastr.error('No Prescription Found.', 'Add Prescription', {timeOut: 5000});
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
             initialState() {
                this.$data.prescriptionData.name = '',
                this.$data.prescriptionData.department ='',
                this.$data.prescriptionData.doctor =''
            },
            validateBeforeSubmit() {
               let vm=this;
                vm.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {
                        User.createPrescription(vm.prescriptionData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success('Prescription added successfully', 'Add Prescription', {timeOut: 5000});
                                vm.$router.push('prescription_list');
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
                       
                    }
                })
            },
            editValidateBeforeSubmit() {
               let vm=this;
                vm.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {
                        User.editPrescription(vm.prescriptionData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success('Prescription edited successfully', 'Add Prescription', {timeOut: 5000});
                                vm.$router.push('prescription_list');
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
                       
                    }
                })
            }
        }
    }
</script>