<template>

<section>
    <div class="col-lg-12 mb-3">
		<div class="card bg-success-card nomination_class">
      <div class="card-header">
        <div class="row">
          <div class="col-md-12"><h4 class="mt-2" v-if="nominationLngData.pageName=='EDIT'">Nomination Update</h4><h4 class="mt-2" v-else>Nomination LNG Add</h4></div>
          </div>
          <div class="col-md-12 text-right">
                    <strong>Notice:</strong> <strong>Disable selection Of truck Suggest the truck is already added for {{selected_date}} Date List.</strong> 
                </div>
        </div>
        <div class="card-body">
            <form method="post"> 

            <div class="row">
                <div class="col-md-12">
                        <div class="card-body">
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label class="control-label float-right" >Truck: </label>
                                    </div>
                                    <div class="col-md-6">
                                        <select name="truck_details_id" id="truck_details_id" class="form-control ls-select2" v-model="nominationLngData.truck_details_id" v-validate="'required'">
                                            <option value="">Select</option>
                                            <option :disabled="truckDetails.available>0" v-for="truckDetails in truckDetailsOption" :value="truckDetails.id" v-if="">
                                               {{truckDetails.text}}</option>
                                        </select>
                                        <i v-show="errors.has('truck_details_id')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('truck_details_id')">
                                            Please select truck.
                                        </span>
                                    </div>
                                </div>
                                 <div class="row form-group">
                                    <div class="col-md-3">
                                        <label class="control-label float-right" >Time: </label>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <input type="text" id = "lngTime" class="form-control timepicker1" name="lngTime" v-model="nominationLngData.lngTime" v-validate="'required'" > -->
                                        <select id="lngTime" class="form-control ls-select2" name="lngTime" v-model="nominationLngData.lngTime" v-validate="'required'">
                                            <option v-for="time in times">{{ time }}</option>
                                        </select>
                                        <i v-show="errors.has('lngTime')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('lngTime')">
                                            Please enter time.
                                        </span>
                                        <span class="help is-danger right">
                                            *Request will generate for {{ nextRequestDate }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row form-group"  >
                                    <div class="col-md-3">
                                        <label for="quantity " class="control-label float-right txt_media1">Quantity :</label>
                                    </div>
                                    <div class="col-md-6">
                                        <div class=" input-group">
                                            <input type="text" class="form-control" id="quantity"  v-validate="'required|decimal:2'" v-model="nominationLngData.quantity" name="quantity" >

                                 
                                             <div class="input-group-append">
                                                <span class="input-group-text ">Kg</span>
                                            </div>
                                        </div>

                                            <span class="help is-danger" v-show="errors.has('quantity')">Please enter valid quantity.</span>
                                    </div>
                                </div>
                                <!-- <div class="row form-group">

                                    <div class="col-md-3">
                                        <label class="control-label float-right" >Date: </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id = "date" class="form-control" name="date" v-model="nominationLngData.date.time"  readonly>
                                        <i v-show="errors.has('date')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('date')">
                                            Please enter valid date.
                                        </span>
                                    </div> 
                                </div> -->
                           


                                <div class="row form-group mt-5">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-1">
                                        <span v-if="nominationLngData.pageName=='EDIT'">
                                            <button class="btn btn-success" type="button" @click="editValidateBeforeSubmit()">Update</button>
                                        </span>
                                        <span v-else>
                                             <button class="btn btn-success" type="button" @click="validateBeforeSubmit()">Add</button>
                                        </span>
                                    </div>
                                     <div class="col-md-3">
                                         <button class="btn btn-danger" type="button" @click="cancelPage()">Cancel</button>
                                     </div>
                                </div>
                                <label class="text-danger right">Maximum allowed quantity {{ totalAllowedQuantity ? totalAllowedQuantity : 0 }}</label> 
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
                    'disabledTime': '',
                    'mdcq':'',
                    'currentYear': new Date().getFullYear(),
                    'today_date':moment().format('DD-MM-YYYY'),
                    'selected_date':this.$store.state.selected_date,
                    'user_id':this.$store.state.Users.userDetails.id,
                    'buyer_id':'',
                    'user_type':this.$store.state.Users.userDetails.user_type,
                    'nominationLngData' : {
                        'nominationLngId':'',
                        'buyer_id':this.$store.state.Users.userDetails.id,
                        'truck_details_id':'',
                    	'date': {
                            time:moment().add(1,'days').format('DD-MM-YYYY')
                        },
                        'quantity': '',
                        'lngDate': moment(this.$store.state.selected_date, "DD-MM-YYYY").add(1, 'days').format('DD-MM-YYYY'),
                        'lngTime':'',
                        'pageName':'',
                        //'request':'',
                    },
                    'truckDetailsOption':{},
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
                    'quantity': 0,
                    'times':['12:00 AM','1:00 AM','2:00 AM','3:00 AM','4:00 AM','5:00 AM','6:00 AM','7:00 AM','8:00 AM','9:00 AM','10:00 AM','11:00 AM','12:00 PM','1:00 PM','2:00 PM','3:00 PM','4:00 PM','5:00 PM','6:00 PM','7:00 PM','8:00 PM','9:00 PM','10:00 PM','11:00 PM'],
                    'nextRequestDate': moment(this.$store.state.selected_date, "DD-MM-YYYY").add(1, 'days').format('DD-MM-YYYY'),
                    'totalUsedQuantity': 0,
                    'totalAllowedQuantity': 0
                }
        },
        components: {
            'date-picker': myDatepicker,
        },
        mounted() {
            var vm = this;
            vm.selected_date = vm.nextRequestDate;

            $('.ls-select2').select2({
                placeholder: "Select"
            });
            vm.initData();
            User.getBuyerAllowedQuantity(vm.nominationLngData.buyer_id).then(
                (response) => {
                    vm.quantity = response.data.data.allowed_quantity;
                    vm.totalAllowedQuantity = vm.quantity*1.20;
                },
                (error) => {

                }
            );

            User.getBuyerUsedQuantity(vm.selected_date,vm.nominationLngData.buyer_id).then(
                (response) => {
                    vm.totalUsedQuantity = response.data.data;
                },
                (error) => {

                }
            );
            $('#lngTime').on('select2:select', function (e) {
                //
                vm.nominationLngData.lngTime = e.params.data.text;
                
            });
        },
        methods: {
            initData()
            {
                $('.timepicker1').timepicker({
                    minuteStep: 1,
                    step:60,
                });
                let vm=this;
                vm.getTruckDetailsList();
                vm.getSelectedValueSelect2();
                let nomination_page=vm.$store.state.NominationLng.nominationLngPage;
                
                if(nomination_page=='EDIT')
                {

                    vm.nominationLngData.pageName=nomination_page;
                    let pID=vm.$store.state.NominationLng.nominationLngId;
                    if(pID!=0 || pID!=null)
                    {
                        vm.nominationLngData.nominationLngId=pID;

                        vm.setNominationLngData(pID);

                    }
                }
                else  if(nomination_page=='ADD')
                {
                    /*let nDate=vm.$store.state.Nomination.nominationLngDate;
                      if(nDate!="" && nDate!=null)
                      {
                          vm.nominationLngData.lngDate=nDate;
                      }*/
                }
            },
            cancelPage()
            {
                let vm=this;
                vm.$root.$emit('cancelPage',1);
            },
            getSelectedValueSelect2()
            {
                let vm=this;
                $('#truck_details_id').on("select2:select", function (e) {
                    vm.nominationLngData.truck_details_id =$(this).val();
                });
                $('.timepicker1').on('changeTime.timepicker', function(e) {
                    vm.nominationLngData.lngTime =$('.timepicker1').val();
                });
            },
            getTruckDetailsList()
            {
                let vm=this;
                let truckDetailsList=[];
                let data={'lngDate':vm.selected_date,'buyer_id':vm.nominationLngData.buyer_id};

                User.getDisabledDates(data).then(
                    (response) => {
                    },
                    (error) => {

                    } 
                );

                User.getTruckDetailsList(data).then(
                     (response) => {
                    $.each(response.data.data, function(key,value) {

                       truckDetailsList.push({
                         'id' : value.id,
                         'text' : value.truck_name,
                         'available':value.available
                      });
                    });

                    vm.truckDetailsOption=truckDetailsList;
                    
                  },
                      (error) => {
                  },
                );
            },
            setNominationLngData(id)
            {
                let vm=this;
                User.getNominationLngDetailsById(id).then(
                  (response)=> {
                   
                    if(response.data.code == 200){
                        let presp_data=response.data.data;
                        vm.nominationLngData.quantity =presp_data.quantity;
                        vm.nominationLngData.lngDate =presp_data.lngDate;
                        vm.nominationLngData.lngTime =presp_data.lngTime;
                        vm.nominationLngData.truck_details_id =presp_data.truck_details_id;
                        vm.user_id =presp_data.buyer_id;

                         setTimeout(function(){
                            $('#truck_details_id').val(presp_data.truck_details_id).trigger('change');
                        },100);
                    
                    } else if (response.data.code == 300) {
                        toastr.error('No Nomination LNG Found.', 'Update Nomination LNG', {timeOut: 5000});
                    }
                    else
                    {
                        toastr.error('Something Went wrong.', 'Update Nomination LNG', {timeOut: 5000});
                    }
                    
                  },
                  (error)=>{
                  }

                )

            },
            initialState() {
                this.$data.nominationLngData.quantity ='',
                this.$data.nominationLngData.lngDate ='',
                this.$data.nominationLngData.lngTime ='',
                this.$data.nominationLngData.truck_details_id =''
            },
            validateBeforeSubmit() {
               
               let vm=this;
               let currentRequestQuantity = parseFloat(vm.nominationLngData.quantity) + parseFloat( vm.totalUsedQuantity);
               let remainingQuantity = parseFloat( vm.totalAllowedQuantity) -parseFloat(vm.totalUsedQuantity);
               
               if(parseFloat(currentRequestQuantity) > parseFloat(vm.totalAllowedQuantity)){
                    toastr.error('You have only '+remainingQuantity+' quantity remains to request', 'Nomination', {timeOut: 5000});
                    return false;
               }

                vm.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {
                        vm.nominationLngData.da
                        User.createNominationLng(vm.nominationLngData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success(response.data.message, 'Add Nomination LNG', {timeOut: 5000});
                                vm.$root.$emit('nominationLngSuccess',1);
                                //this.initialState();
                                
                            }
                            else if (response.data.code == 300) {
                                toastr.error(response.data.message, 'Add Nomination', {timeOut: 5000});
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
                        User.editNominationLng(vm.nominationLngData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                toastr.success(response.data.message, 'Update Nomination', {timeOut: 5000});
                                vm.$root.$emit('nominationLngSuccess',1);
                                //this.initialState();
                                
                            }
                            else if (response.data.code == 300) {
                                toastr.error(response.data.message, 'Update Nomination', {timeOut: 5000});
                                //this.initialState(); 
                            }
                            else
                            {
                                toastr.error('Something Went wrong.', 'Update Nomination', {timeOut: 5000});
                            }
                            
                          },
                          (error)=>{
                          }

                        )
                       
                    }
                })
            },
        }
    }
</script>
<style>
    .nomination_class
    {
        min-height:0px !important;
    }
    .text-danger
    {
        color: #00ff00;
    }
    .right
    {
        float: right;
        font-weight: bold;
    }
</style>
