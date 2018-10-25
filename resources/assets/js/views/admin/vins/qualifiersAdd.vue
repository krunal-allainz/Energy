<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h2>Qualifiers Add</h2>
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
                                         <select class="form-control ls-select2" id="radiology_id" name="radiology_id" v-model="qualifiersData.radiology_id" v-validate="'required'">
                                            <option value="">Select</option>
                                            <option :value="radio.id" v-for="radio in qualifiersData.radiologyOption">{{radio.text}}</option>
                                        </select> 
                                        <i v-show="errors.has('radiology_id')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('radiology_id')">Please select Radiology.</span>
                                    </div>
                                </div>
                                 <div class="row form-group"  >
                                    <div class="col-md-3">
                                        <label for="radiology_id " class="control-label float-right txt_media1">Bodyparts :</label>
                                    </div>
                                    <div class="col-md-9">
                                         <select class="form-control ls-select2" id="bodyparts_id" name="bodyparts_id" v-model="qualifiersData.bodyparts_id" v-validate="'required'">
                                            <option value="">Select</option>
                                            <option :value="bodyparts.id" v-for="bodyparts in qualifiersData.bodypartsOption">{{bodyparts.text}}</option>
                                        </select> 
                                        <i v-show="errors.has('bodyparts_id')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('bodyparts_id')">Please select Bodyparts.</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    <label for="name" class="control-label float-right txt_media1">Name :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="name"
                                               placeholder="Name" v-validate="'required'" v-model="qualifiersData.name" name="name">
                                        <i v-show="errors.has('name')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('name')">Please enter valid Name.</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-9">
                                        <span v-if="qualifiersData.pageName=='EDIT'">
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
                    'qualifiersData' : {
                    	'name':'',
                        'radiologyOption':[],
                        'radiology_id':'',
                        'bodypartsOption':[],
                        'bodyparts_id':'',
                        'qualifiersId':'',
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
                $('#bodyparts_id').select2("destroy");
                vm.qualifiersData.bodyparts_id ="";
                 $('#bodyparts_id').val('').trigger('change');
                let r_id=e.params.args.data.id;
                vm.qualifiersData.radiology_id =  e.params.args.data.id;
                if(r_id)
                {
                     //setTimeout(function(){
                          $('#bodyparts_id').select2({
                            placeholder: "Select",
                            tags:false 
                          });
                    //},50);
                   vm.getBodypartsByRadiology(r_id); 
                }
            });
            $('#bodyparts_id').on('select2:selecting', function(e) {
                   vm.qualifiersData.bodyparts_id =  e.params.args.data.id;
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
                        vm.qualifiersData.radiologyOption=_.cloneDeep(radiology_list_new);

                    },
                    (error) => {
                    },
                );
            },
            getBodypartsByRadiology(r_id)
            {

                let vm=this;
                var bodyparts_list_new=[];
                User.getBodypartsByRadiologyId(r_id).then(
                   (response) => {
                        let bodypart_data=response.data.data;

                        $.each(bodypart_data, function(key, value) {
                            let id_body=value.id;
                            let name=value.name;
                            bodyparts_list_new.push({
                                text:name,
                                id:id_body
                            });
                        });
                        vm.qualifiersData.bodypartsOption=_.cloneDeep(bodyparts_list_new);

                    },
                    (error) => {
                    },
                );
            },
            initData()
            {
                let vm=this;
                let qualifiers_page=vm.$store.state.Qualifiers.qualifiersPage;
                
                if(qualifiers_page=='EDIT')
                {
                    vm.qualifiersData.pageName=qualifiers_page;
                    let pID=vm.$store.state.Qualifiers.qualifiersId;
                    if(pID!=0 || pID!=null)
                    {
                        vm.qualifiersData.qualifiersId=pID;
                        vm.setQualifiersData(pID);

                    }
                }
            },
            setQualifiersData(id)
            {
                let vm=this;
                
                User.getQualifiersDetailsById(id).then(
                  (response)=> {
                   
                    if(response.data.code == 200){
                        let bodypart_data=response.data.data;
                        vm.qualifiersData.radiology_id =bodypart_data.radiology_id;

                        vm.getBodypartsByRadiology(bodypart_data.radiology_id); 
                        vm.qualifiersData.name =bodypart_data.name;
                        vm.qualifiersData.bodyparts_id =bodypart_data.bodyparts_id;
                        setTimeout(function(){
                            $('#radiology_id').val(bodypart_data.radiology_id).trigger('change');
                            $('#bodyparts_id').val(bodypart_data.bodyparts_id).trigger('change');
                        },500);
                    } else if (response.data.code == 300) {
                        toastr.error('No Qualifiers Found.', 'Add Qualifiers', {timeOut: 5000});
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
             initialState() {
                this.$data.qualifiersData.name = '',
                this.$data.qualifiersData.radiology_id ='',
                this.$data.qualifiersData.bodyparts_id =''
                
            },
            validateBeforeSubmit() {
               let vm=this;
                vm.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {

                        User.createQualifiers(vm.qualifiersData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success('Qualifiers added successfully', 'Add Qualifiers', {timeOut: 5000});
                                vm.$router.push('qualifiers_list');
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
                       
                    }
                })
            },
            editValidateBeforeSubmit() {
               let vm=this;
                vm.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {
                        User.editQualifiers(vm.qualifiersData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success('Qualifiers edited successfully', 'Add Qualifiers', {timeOut: 5000});
                                vm.$router.push('qualifiers_list');
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
                       
                    }
                })
            }
        }
    }
</script>