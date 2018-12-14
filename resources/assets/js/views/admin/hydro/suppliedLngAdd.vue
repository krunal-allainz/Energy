<template>

<section>
    <div class="col-lg-12 mb-3">
		<div class="card bg-success-card nomination_class">
      <div class="card-header">
        <div class="row">
            <div class="col-md-12"><h4 class="mt-2">Truck loading</h4>
            </div>
          </div>
          <div class="col-md-6 text-right">
                    <!-- <strong>Notice:</strong> <strong>Disable selection Of truck Suggest the truck is already added for {{today_date}} Date List.</strong>  -->
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
                                        <label class="control-label float-left" ><strong>{{nominationLngData.truck_details.truck_company}}({{nominationLngData.truck_details.truck_no}})</strong> </label>
                                       
                                    </div> 
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                        <label class="control-label float-right" >Tare Weight: </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" id = "tare_weight" class="form-control " name="tare_weight" v-model="nominationLngData.tare_weight" v-validate="'required|decimal:2'"  :readonly="(updateType == 'gross_weight') ? true : false">
                                        <i v-show="errors.has('tare_weight')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('tare_weight')">
                                            Please enter proper tare weight quantity.
                                        </span>
                                    </div>
                                </div>
                                    <div class="row form-group" v-if="updateType == 'gross_weight'" >
                                        <div class="col-md-3">
                                            <label for="quantity " class="control-label float-right txt_media1">Gross Weight :</label>
                                        </div>
                                        <div class="col-md-6">
                                            <div class=" input-group">
                                                <input type="text" class="form-control" id="gross_weight"  v-validate="'required|decimal:2'" v-model="nominationLngData.gross_weight" name="gross_weight" >

                                     
                                                 <div class="input-group-append">
                                                    <span class="input-group-text ">MMBTU</span>
                                                </div>
                                            </div>

                                                <span class="help is-danger" v-show="errors.has('gross_weight')">Please enter valid gross weight quantity.</span>
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
                                            <span >
                                                <button class="btn btn-success" type="button" @click="editValidateBeforeSubmit()">Save</button>
                                            </span>
                                           
                                        </div>
                                         <div class="col-md-3">
                                             <button class="btn btn-danger" type="button" @click="cancelPage()">Cancel</button>
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
                    'mdcq':'',
                    'currentYear': new Date().getFullYear(),
                    'today_date':moment().format('DD-MM-YYYY'),
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
                        'lngDate':moment().format('DD-MM-YYYY'),
                        'lngTime':'',
                        'pageName':'',
                        'tare_weight':'',
                        'gross_weight':'',
                        'truck_details':{}, 
                        //'request':'',
                    },
                    'truckDetailsOption':{},
                }
        },
        props:['updateType'],
        components: {
            'date-picker': myDatepicker,
        },
        mounted() {
            var vm = this;
            $('.ls-select2').select2({
                placeholder: "Select"
            });
            vm.initData();
        },
        methods: {
            initData()
            {
                $('.timepicker1').timepicker({
                    minuteStep: 1,
                    step:60
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
                $('.timepicker1').timepicker().on('changeTime.timepicker', function(e) {
                    vm.nominationLngData.lngTime =$('.timepicker1').val();
                });
            },
            getTruckDetailsList()
            {
                let vm=this;
                let truckDetailsList=[];
                let data={'lngDate':vm.today_date,'buyer_id':vm.nominationLngData.buyer_id};
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
                        vm.nominationLngData.truck_details =presp_data.truck_detaild;
                        vm.user_id =presp_data.buyer_id;
                        vm.nominationLngData.truck_details = presp_data.truck_detail[0];
                        vm.nominationLngData.tare_weight = presp_data.tare_weight;

                        vm.nominationLngData.gross_weight = presp_data.gross_weight
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
            // validateBeforeSubmit() {
                

            //    let vm=this;
            //     vm.$validator.validateAll().then(() => {
                    
            //         if (!this.errors.any()) {

            //             User.createNominationLng(vm.nominationLngData).then(
            //               (response)=> {
                           
            //                 if(response.data.code == 200){
            //                     toastr.success(response.data.message, 'Add Nomination LNG', {timeOut: 5000});
            //                     vm.$root.$emit('nominationLngSuccess',1);
            //                     //this.initialState();
                                
            //                 }
            //                 else if (response.data.code == 300) {
            //                     toastr.error(response.data.message, 'Add Nomination', {timeOut: 5000});
            //                     //this.initialState(); 
            //                 }
            //                 else
            //                 {
            //                     toastr.error('Something Went wrong.', 'Add Nomination', {timeOut: 5000});
            //                 }
                            
            //               },
            //               (error)=>{
            //               }

            //             )
                       
            //         }
            //     })
            // },
            editValidateBeforeSubmit() {
                
               let vm=this;
                vm.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {
                        User.saveTruckLoading(vm.nominationLngData).then(
                          (response)=> {
                           
                            if(response.data.code == 200){
                                if(vm.updateType == 'tare_weight'){
                                    toastr.success('Tare weight value has been saved', 'Success ', {timeOut: 5000});
                                } else {
                                    toastr.success('Gross weight value has been saved', 'Success ', {timeOut: 5000});               
                                }
                                 vm.$root.$emit('suppliedLngSuccess');
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
            }
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
</style>
