<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h2>Laboratory Add</h2>
				</div>
			</div>
		</div>
		<form method="post"> 
            <div class="row">
                <div class="col-md-12">
                        <div class="card-body">
                                <div class="row form-group"  >
                                    <div class="col-md-3">
                                        <label for="type " class="control-label float-right txt_media1">Type :</label>
                                    </div>
                                    <div class="col-md-9">
                                         <select class="form-control ls-select2" id="type" name="type" v-model="laboratoryData.type" v-validate="'required'">
                                            <option :value="typ.id" v-for="typ in laboratoryData.typeOption">{{typ.text}}</option>
                                        </select> 
                                        <i v-show="errors.has('type')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('type')">Please select Type.</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    <label for="name" class="control-label float-right txt_media1">Name :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="name"
                                               placeholder="Name" v-validate="'required'" v-model="laboratoryData.name" name="name">
                                        <i v-show="errors.has('name')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('name')">Please enter valid Name.</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-9">
                                        <span v-if="laboratoryData.pageName=='EDIT'">
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
                    'laboratoryData' : {
                    	'name':'',
                        'typeOption':[{id: 1 ,text:'Blood'},
                                      {id: 2 ,text:'Urine'},
                                      {id: 3 ,text:'CSF'},
                                      {id: 4 ,text:'BFA'},
                                    ],
                        'type':'',
                        'laboratoryId':'',
                        'pageName':'',
                    },
                   
                }
        },
        mounted() {
            var vm = this;
            vm.initData();
            $('.ls-select2').select2({
                placeholder: "Select"
            });
             $('#type').on('select2:selecting', function(e) {
                
                vm.laboratoryData.type =  e.params.args.data.id;
            });
        },
        methods: {
            initData()
            {
                let vm=this;
                let laboratory_page=vm.$store.state.Laboratory.laboratoryPage;
                
                if(laboratory_page=='EDIT')
                {
                    vm.laboratoryData.pageName=laboratory_page;
                    let pID=vm.$store.state.Laboratory.laboratoryId;
                    if(pID!=0 || pID!=null)
                    {
                        vm.laboratoryData.laboratoryId=pID;
                        vm.setLaboratoryData(pID);

                    }
                }
            },
            setLaboratoryData(id)
            {
                let vm=this;
                User.getLaboratoryDetailsById(id).then(
                  (response)=> {
                   
                    if(response.data.code == 200){
                        let presp_data=response.data.data;
                        vm.laboratoryData.type =presp_data.type;
                        vm.laboratoryData.name =presp_data.name;
                        console.log(presp_data.type);
                        $('#type').val(presp_data.type).trigger('change');
                    } else if (response.data.code == 300) {
                        toastr.error('No Laboratory Found.', 'Add Laboratory', {timeOut: 5000});
                        //this.initialState(); 
                    }
                    else
                    {
                        toastr.error('Something Went wrong.', 'Add Laboratory', {timeOut: 5000});
                    }
                    
                  },
                  (error)=>{
                  }

                )

            },
             initialState() {
                this.$data.laboratoryData.name = '',
                this.$data.laboratoryData.type =''
                
            },
            validateBeforeSubmit() {
               let vm=this;
                vm.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {

                        User.createLaboratory(vm.laboratoryData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success('Laboratory added successfully', 'Add Laboratory', {timeOut: 5000});
                                vm.$router.push('laboratory_list');
                                //this.initialState();
                                
                            } else if (response.data.code == 300) {
                                toastr.error('Something Went wrong.', 'Add Laboratory', {timeOut: 5000});
                                //this.initialState(); 
                            }
                            else
                            {
                                toastr.error('Something Went wrong.', 'Add Laboratory', {timeOut: 5000});
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
                        User.editLaboratory(vm.laboratoryData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success('Laboratory edited successfully', 'Add Laboratory', {timeOut: 5000});
                                vm.$router.push('laboratory_list');
                                //this.initialState();
                                
                            } else if (response.data.code == 300) {
                                toastr.error('Something Went wrong.', 'Add Laboratory', {timeOut: 5000});
                                //this.initialState(); 
                            }
                            else
                            {
                                toastr.error('Something Went wrong.', 'Add Laboratory', {timeOut: 5000});
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