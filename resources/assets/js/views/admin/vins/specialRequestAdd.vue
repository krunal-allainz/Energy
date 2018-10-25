<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h2>SpecialRequest Add</h2>
				</div>
			</div>
		</div>
		<form method="post"> 
            <div class="row">
                <div class="col-md-12">
                        <div class="card-body">
                                <div class="row form-group"  >
                                    <div class="col-md-3">
                                        <label for="radiology_id " class="control-label float-right txt_media1">Radiology :</label>
                                    </div>
                                    <div class="col-md-9">
                                         <select class="form-control ls-select2" id="radiology_id" name="radiology_id" v-model="specialRequestData.radiology_id" v-validate="'required'">
                                            <option value="">Select</option>
                                            <option :value="radio.id" v-for="radio in specialRequestData.radiologyOption">{{radio.text}}</option>
                                        </select> 
                                        <i v-show="errors.has('radiology_id')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('radiology_id')">Please select Radiology.</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    <label for="name" class="control-label float-right txt_media1">Name :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="name"
                                               placeholder="Name" v-validate="'required'" v-model="specialRequestData.name" name="name">
                                        <i v-show="errors.has('name')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('name')">Please enter valid Name.</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-9">
                                        <span v-if="specialRequestData.pageName=='EDIT'">
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
                    'specialRequestData' : {
                    	'name':'',
                        'radiologyOption':[],
                        'radiology_id':'',
                        'specialRequestId':'',
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
            vm.getRadiology();
            $('#radiology_id').on('select2:selecting', function(e) {
                   vm.specialRequestData.radiology_id =  e.params.args.data.id;
            });
        },
        methods: {
            getRadiology()
            {
                let vm=this;
                var radiology_list_new=[];
                User.getRadiologyList().then(
                   (response) => {
                        let radio_data=response.data.data;

                        $.each(radio_data, function(key, value) {
                            let id_radio=value.id;
                            let name=value.name;
                            radiology_list_new.push({
                                text:name,
                                id:id_radio
                            });
                        });
                        vm.specialRequestData.radiologyOption=_.cloneDeep(radiology_list_new);

                    },
                    (error) => {
                    },
                );
            },
            initData()
            {
                let vm=this;
                let specialRequest_page=vm.$store.state.SpecialRequest.specialRequestPage;
                
                if(specialRequest_page=='EDIT')
                {
                    vm.specialRequestData.pageName=specialRequest_page;
                    let pID=vm.$store.state.SpecialRequest.specialRequestId;
                    if(pID!=0 || pID!=null)
                    {
                        vm.specialRequestData.specialRequestId=pID;
                        vm.setSpecialRequestData(pID);

                    }
                }
            },
            setSpecialRequestData(id)
            {
                let vm=this;
                User.getSpecialRequestDetailsById(id).then(
                  (response)=> {
                   
                    if(response.data.code == 200){
                        let bodypart_data=response.data.data;
                        vm.specialRequestData.radiology_id =bodypart_data.radiology_id;
                        vm.specialRequestData.name =bodypart_data.name;
                        setTimeout(function(){
                            $('#radiology_id').val(bodypart_data.radiology_id).trigger('change');
                        },300);
                    } else if (response.data.code == 300) {
                        toastr.error('No Special Request Found.', 'Add Special Request', {timeOut: 5000});
                        //this.initialState(); 
                    }
                    else
                    {
                        toastr.error('Something Went wrong.', 'Add Special Request', {timeOut: 5000});
                    }
                    
                  },
                  (error)=>{
                  }

                )

            },
             initialState() {
                this.$data.specialRequestData.name = '',
                this.$data.specialRequestData.radiology_id =''
                
            },
            validateBeforeSubmit() {
               let vm=this;
                vm.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {

                        User.createSpecialRequest(vm.specialRequestData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success('SpecialRequest added successfully', 'Add Special Request', {timeOut: 5000});
                                vm.$router.push('specialRequest_list');
                                //this.initialState();
                                
                            } else if (response.data.code == 300) {
                                toastr.error('Something Went wrong.', 'Add Special Request', {timeOut: 5000});
                                //this.initialState(); 
                            }
                            else
                            {
                                toastr.error('Something Went wrong.', 'Add Special Request', {timeOut: 5000});
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
                        User.editSpecialRequest(vm.specialRequestData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success('Special Request edited successfully', 'Add Special Request', {timeOut: 5000});
                                vm.$router.push('specialRequest_list');
                                //this.initialState();
                                
                            } else if (response.data.code == 300) {
                                toastr.error('Something Went wrong.', 'Add Special Request', {timeOut: 5000});
                                //this.initialState(); 
                            }
                            else
                            {
                                toastr.error('Something Went wrong.', 'Add Special Request', {timeOut: 5000});
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