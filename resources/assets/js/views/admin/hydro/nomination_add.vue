<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h2>Nomination Add </h2>
				</div>
			</div>
		</div>
		<form method="post"> 
            <div class="row">
                <div class="col-md-12">
                        <div class="card-body">
                                <div class="row form-group"  >
                                    <div class="col-md-3">
                                        <label for="buyer" class="control-label float-right txt_media1">Select Buyer :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="buyer"  v-validate="'required'" v-model="invoiceData.buyerId" name="quantity">
                                        <i v-show="errors.has('buyer')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('buyer')">Please select buyer.</span>
                                    </div>
                                </div>
                                 
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-9">
                                        <span v-else>
                                             <button class="btn btn-success" type="button" @click="validateBeforeSubmit()">Generate Invoice</button>
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
    import myDatepicker from 'vue-datepicker';
    export default {
        data() {
            return {
                    'currentYear': new Date().getFullYear(),
                    'userData' :{
                        'user_type':this.$store.state.Users.userDetails.user_type,
                        'user_id' : this.$store.state.Users.userDetails.id,
                    },
                    'invoiceData' : {
                        'buyer_id':'',
                    	'date': {
                            time:moment().add(1,'days').format('DD-MM-YYYY')
                        },
                        'pageName':'',
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
            getBuyerList(){

                let vm=this;
                User.getBuyerList().then({
                    
                });

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
                                toastr.success('Nomination edited successfully', 'Add Nomination', {timeOut: 5000});
                                vm.$router.push('nomination_list');
                                //this.initialState();
                                
                            } 
                            else if (response.data.code == 301) {
                                toastr.error('MDCQ is higher.', 'Add Nomination', {timeOut: 5000});
                                //this.initialState(); 
                            }
                            else if (response.data.code == 300) {
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
            }
        }
    }
</script>