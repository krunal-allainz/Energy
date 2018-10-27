<template>
<section>
    <div class="col-lg-12 mb-3">
   
		<div class="card bg-success-card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-12"><h4 class="mt-2">Nomination Add</h4></div>
          </div>
        </div>
        <div class="card-body">
            <form method="post"> 
            <div class="row">
                <div class="col-md-12">
                        <div class="card-body">
                                <div class="row form-group"  >
                                    <div class="col-md-3">
                                        <label for="quantity " class="control-label float-right txt_media1">Quantity :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="quantity"  v-validate="'required'" v-model="nominationData.quantity" name="quantity">
                                        <i v-show="errors.has('quantity')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('quantity')">Please enter valid quantity.</span>
                                    </div>
                                </div>
                                 <div class="row form-group"  v-if="nominationData.pageName=='EDIT' && user_type==7">
                                    <div class="col-md-3">
                                        <label for="approved_quantity " class="control-label float-right txt_media1">Approved Quantity :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="approved_quantity"  v-validate="'required'" v-model="nominationData.approved_quantity" name="approved_quantity">
                                        <i v-show="errors.has('approved_quantity')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('approved_quantity')">Please enter valid approved quantity.</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label class="control-label float-right" >Date: </label>
                                    </div>
                                    <div class="col-md-6">
                                        <date-picker  :date.sync="nominationData.date" :option="option" id = "date" class="" type="date" name="date" :limit="limit" v-model="nominationData.date.time" v-validate="'required'"></date-picker> 
                                        <i v-show="errors.has('date')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('date')">
                                            Please enter valid date.
                                        </span>
                                    </div>
                                </div>
                                <div class="row form-group" v-if="nominationData.pageName=='EDIT' && user_type==7">
                                    <div class="col-md-3">
                                        <label class="control-label float-right" >Status: </label>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-control ls-select2"  id="request" name="request">
                                            <option value="">Select</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Approved">Approve</option>
                                        </select>
                                        
                                    </div>
                                </div>

                                <div class="row form-group mt-5">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-9">
                                        <span v-if="nominationData.pageName=='EDIT'">
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
		</div>
    </div>
	
    </section>
</template>

<script>

	import User from '../../../api/users.js';
    import myDatepicker from 'vue-datepicker';
    export default {
        data() {
            return {
                    'currentYear': new Date().getFullYear(),
                    'user_type':this.$store.state.Users.userDetails.user_type,
                    'nominationData' : {
                        'buyer_id':this.$store.state.Users.userDetails.id,
                    	'date': {
                            time:moment().add(1,'days').format('DD-MM-YYYY')
                        },
                        'quantity': '',
                        'approved_quantity':'',
                        'nominationId':'',
                        'pageName':'',
                        'request':'',
                    },
                    'option': {
                        type: 'day',
                        week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
                        month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        format: 'DD-MM-YYYY',
                        placeholder: 'Select Date',
                        inputStyle: {
                            'display': 'inline-block',
                            'padding': '6px',
                            'line-height': '22px',
                            'font-size': '16px',
                            'border': '2px solid #fff',
                            'box-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.2)',
                            'border-radius': '2px',
                            'color': '#5F5F5F',
                            'width':'100%',
                        },

                    },
                    limit: [
                    {
                        type: 'fromto',
                        to: new Date()
                    }],
                   
                }
        },
        components: {
            'date-picker': myDatepicker,
        },
        mounted() {
            var vm = this;
           
            $('.ls-select2').select2({
                placeholder: "Select"
            });
           
            //if(vm.nominationData.pageName=='EDIT')
            //{
                 setTimeout(function(){
                  $('#request').select2({
                    placeholder: "Select",
                    tags:false 
                  });
                  $('#request').on('select2:select', function(e) {
                    console.log($(this).val());
                        vm.nominationData.request = $(this).val();
                    }); 
                },100)
            //}
             vm.initData();
        },
        methods: {
            initData()
            {
                let vm=this;
                let nomination_page=vm.$store.state.Nomination.nominationPage;
                
                if(nomination_page=='EDIT')
                {

                    vm.nominationData.pageName=nomination_page;
                    let pID=vm.$store.state.Nomination.nominationId;
                    if(pID!=0 || pID!=null)
                    {
                        vm.nominationData.nominationId=pID;
                        vm.setNominationData(pID);

                    }
                }
            },
            setNominationData(id)
            {
                let vm=this;
                User.getNominationDetailsById(id).then(
                  (response)=> {
                   
                    if(response.data.code == 200){
                        let presp_data=response.data.data;
                        vm.nominationData.quantity =presp_data.quantity_required;
                        vm.nominationData.approved_quantity =presp_data.approved_quantity;
                        vm.nominationData.date.time =presp_data.date;
                        vm.nominationData.request =presp_data.request;
                        setTimeout(function(){
                            $('#supplier').val(presp_data.seller_id).trigger('change');
                        },200);
                        $('#request').val(presp_data.request).trigger('change');
                    } else if (response.data.code == 300) {
                        toastr.error('No Nomination Found.', 'Add Nomination', {timeOut: 5000});
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
            initialState() {
                this.$data.nominationData.quantity ='',
                this.$data.nominationData.date ='',
                this.$data.nominationData.request ='',
                this.$data.nominationData.approved_quantity =''
                
            },
            validateBeforeSubmit() {
               let vm=this;
                vm.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {

                        User.createNomination(vm.nominationData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success('Nomination added successfully', 'Add Nomination', {timeOut: 5000});
                                vm.$router.push('nomination_list');
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
                       
                    }
                })
            },
            editValidateBeforeSubmit() {
               let vm=this;
                vm.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {
                        User.editNomination(vm.nominationData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success('Nomination edited successfully', 'Edit Nomination', {timeOut: 5000});
                                vm.$router.push('nomination_list');
                                //this.initialState();
                                
                            } 
                            else if (response.data.code == 301) {
                                toastr.error('MDCQ is higher.', 'Edit Nomination', {timeOut: 5000});
                                //this.initialState(); 
                            }
                            else if (response.data.code == 302) {
                                toastr.error('Approved quantity limit exceed.', 'Edit Nomination', {timeOut: 5000});
                                //this.initialState(); 
                            }
                            else if (response.data.code == 300) {
                                toastr.error('Something Went wrong.', 'Edit Nomination', {timeOut: 5000});
                                //this.initialState(); 
                            }
                            else
                            {
                                toastr.error('Something Went wrong.', 'Edit Nomination', {timeOut: 5000});
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