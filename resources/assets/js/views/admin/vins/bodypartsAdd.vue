<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h2>Bodyparts Add</h2>
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
                                         <select class="form-control ls-select2" id="radiology_id" name="radiology_id" v-model="bodypartsData.radiology_id" v-validate="'required'">
                                            <option value="">Select</option>
                                            <option :value="radio.id" v-for="radio in bodypartsData.radiologyOption">{{radio.text}}</option>
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
                                               placeholder="Name" v-validate="'required'" v-model="bodypartsData.name" name="name">
                                        <i v-show="errors.has('name')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('name')">Please enter valid Name.</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-9">
                                        <span v-if="bodypartsData.pageName=='EDIT'">
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
                    'bodypartsData' : {
                    	'name':'',
                        'radiologyOption':[],
                        'radiology_id':'',
                        'bodypartsId':'',
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
                   vm.bodypartsData.radiology_id =  e.params.args.data.id;
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
                        vm.bodypartsData.radiologyOption=_.cloneDeep(radiology_list_new);

                    },
                    (error) => {
                    },
                );
            },
            initData()
            {
                let vm=this;
                let bodyparts_page=vm.$store.state.Bodyparts.bodypartsPage;
                
                if(bodyparts_page=='EDIT')
                {
                    vm.bodypartsData.pageName=bodyparts_page;
                    let pID=vm.$store.state.Bodyparts.bodypartsId;
                    if(pID!=0 || pID!=null)
                    {
                        vm.bodypartsData.bodypartsId=pID;
                        vm.setBodypartsData(pID);

                    }
                }
            },
            setBodypartsData(id)
            {
                let vm=this;
                User.getBodypartsDetailsById(id).then(
                  (response)=> {
                   
                    if(response.data.code == 200){
                        let bodypart_data=response.data.data;
                        vm.bodypartsData.radiology_id =bodypart_data.radiology_id;
                        vm.bodypartsData.name =bodypart_data.name;
                        setTimeout(function(){
                            $('#radiology_id').val(bodypart_data.radiology_id).trigger('change');
                        },300);
                    } else if (response.data.code == 300) {
                        toastr.error('No Bodyparts Found.', 'Add Bodyparts', {timeOut: 5000});
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
             initialState() {
                this.$data.bodypartsData.name = '',
                this.$data.bodypartsData.radiology_id =''
                
            },
            validateBeforeSubmit() {
               let vm=this;
                vm.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {

                        User.createBodyparts(vm.bodypartsData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success('Bodyparts added successfully', 'Add Bodyparts', {timeOut: 5000});
                                vm.$router.push('bodyparts_list');
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
                       
                    }
                })
            },
            editValidateBeforeSubmit() {
               let vm=this;
                vm.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {
                        User.editBodyparts(vm.bodypartsData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success('Bodyparts edited successfully', 'Add Bodyparts', {timeOut: 5000});
                                vm.$router.push('bodyparts_list');
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
                       
                    }
                })
            }
        }
    }
</script>