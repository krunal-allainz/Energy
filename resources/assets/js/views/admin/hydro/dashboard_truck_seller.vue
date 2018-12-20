<template>

	<section class="content">

		<section class="content-header mb-3">
            <div class="row">
                <div class="col-md-4 col-sm-5">
                    <h1><i class="fas fa-chart-bar"></i>  Dashboard</h1> 
                </div>
                <div class="col-md-8 col-sm-7 text-left text-sm-right">
                    <ol class="breadcrumb">
                        <li role="presentation" class="breadcrumb-item active">
                            <span aria-current="location">Dashboard</span>
                        </li>
                    </ol>
                </div>
            </div>
        </section>
         <section>
            <previousNextDate></previousNextDate>
        </section>

        <div class="row">
               
                <div class="col-sm-6 col-md-6 col-xl-3">
                    <div class="flip">

                        <a href="#" @click="nomination_page()" title="Add Nomination">

                       
                            <!--  <router-link to="/nomination_list" title="Add Nomination"> -->

                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon float-left">
                                <i class="fas fa-charging-station"></i>
                            </div>
                            <div class="text-right">
                                <h3><b>LNG Nomination</b></h3>
                                <h3 class="text-dark"><b>{{sellerDashboadData.LngTotal}}</b></h3>
                                <p>For Date:{{selectedDashbordDate}}</p>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    <!-- </router-link> -->
                       </a> 
                    </div>
                </div>
               <div class="col-sm-6 col-md-6 col-xl-3">
                    <div class="flip">
                         <router-link to="/lng_supply_bytruck_list">
                        <!-- <a href="/generate_invoice"> -->
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon float-left">
                           <i class="fa fa-calendar-plus-o"></i>
                            </div>
                            <div class="text-right">
                                <h3><b><a href="/lng_supply_bytruck_list">Scheduled Quantity</a></b></h3>
                                <h3 class="text-dark"><b>{{sellerDashboadData.ApprovedLngTotal}}</b></h3>
                                 <p>For Date:{{selectedDashbordDate}}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- </a> -->
                        </router-link>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6 col-xl-3">
                    <div class="flip">
                        <a href="#" @click="supplied_quantity()" title="Add Allocated">
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon float-left">
                            <i class="fas fa-truck"></i>
                            </div>
                            <div class="text-right">
                                <h3><b>Truck Loading</b></h3>
                                <h3 class="text-dark"><b>{{sellerDashboadData.SuppliedQuantity}}</b></h3>
                                <p>For Date:{{selectedDashbordDate}}</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        </a>
                        </div>
                    </div>
                <div class="col-sm-6 col-md-6 col-xl-3">
                    <div class="flip">
                         <router-link to="/generate_invoice_lng">
                        <!-- <a href="/generate_invoice"> -->
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon float-left">
                           <i class="fas fa-money-check"></i>
                            </div>
                            <div class="text-right">
                                <h3><b><a href="/generate_invoice">Invoice</a></b></h3>
                                <h3 class="text-dark"><b>0</b></h3>
                                <p>Generate Invoice</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <!-- </a> -->
                        </router-link>
                        </div>
                    </div>
                
            </div>        
               

                <div class="row">
                    <div class="col-xl-6 col-12">
                        <div class="row">
                            <!-- <div class="col-sm-6">
                                <div class="card main-chart">
                                    <div class="card-header panel-tabs">
                                        
                                                <a > Buyer Allocation</a>
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <div class="tab-pane  active" id="allocation">
                                                <div style="width: 100%;">
                                                    <canvas id="myChart" width="100px" height="100px"></canvas>
                                                </div>
                                            </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-sm-12">
                                <div class="card main-chart">
                                    <div class="card-header panel-tabs">
                                        <!-- <ul class="nav nav-tabs nav-float" role="tablist"> -->
                                            
                                            <!-- <li class="text-center nav-item"> -->
                                                <a><span class="d-none d-sm-block">LNG Allocation</span>
                                                    </a>
                                            <!-- </li> -->
                                        <!-- </ul> -->
                                    </div>
                                    <div class="card-body">
                                        <!-- <div class="tab-content"> -->
                                            
                                            <div class="tab-pane fade" id="supply">
                                                <div style="width: 80%; margin: 20px auto 0 auto;">
                                                    <canvas id="cSupply" width="100px" height="100px"></canvas>
                                                </div>
                                            </div>
                                        <!-- </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-xl-6 col-12"> -->
                        <timelineLng :userData=userData> </timelineLng>
                    <!-- </div> -->

                </div>

                <!-- /#right -->
                <div class="background-overlay"></div>
              <div  v-if="open_supplied_modal">
                    <suppliedModal  :tableData="supplied_table_data"></suppliedModal>
                </div>  
                 <div  v-if="open_gcv_modal">
                    <gcvAddModel></gcvAddModel>
                 </div>
        </section>
</template>
	
<script>
    import User from '../../../api/users.js';
    import moment from 'moment';
    import Chart from 'chart.js';
    import timelineLng from './timelineLng.vue';
    import _ from 'lodash';
    import previousNextDate from './previousNextDate.vue';
    import suppliedModal from './suppliedModal.vue';
    import gcvAddModel from './gcvAddModel.vue';

export default {
    name: "dashboardSeller",
    data() {
        return {
            formstate: {},
                'userData' : {
                    'userType' : this.$store.state.Users.userDetails.user_type,
                    'userId' : this.$store.state.Users.userDetails.id,
                },
                'nominationData':[],
                'total_availability':'',
                'total_request':'',
                'total_approved':'',
                'total_supplied':'',
                'selectedDashbordDate' : moment().format('DD-MM-YYYY'),
                'today_date':moment().format('DD-MM-YYYY'),
                'open_supplied_modal':false,
                'open_gcv_modal':false,
                'supplied_table_data':{},
                'sellerDashboadData': ''
        }
    },
    components: {
            timelineLng,
            previousNextDate,
            suppliedModal,
            gcvAddModel
    },
    created: function(){
        this.$root.$on('changeDashbordDate',this.changeDashbordDate);
        this.$root.$on('close_modal', this.close_modal);
        this.$root.$on('saveGcv', this.saveGcv);

    },
    mounted: function() {
        let vm =this;
        // vm.setTotalDashboard();
                    User.getNominationLngTotals(vm.selectedDashbordDate).then(
                (response) => {
                    this.sellerDashboadData = response.data.data;
                    vm.total_request = this.sellerDashboadData.LngTotal;
                    vm.total_approved = this.sellerDashboadData.ApprovedLngTotal;
                    vm.total_supplied = this.sellerDashboadData.SuppliedQuantity;
                },
                (error) => {

                }
            );
        if(vm.$store.state.Users.userDetails.user_type != '3'){
              vm.$root.$emit('logout','You are not authorize to access this page.'); 
          }
        
        vm.chart1Data();
        vm.chart2Data();
        
    },
    methods: {
        setTotalDashboard(){


        },
        saveGcv(qty) {
            let vm =this;
            jQuery('.js-loader').removeClass('d-none')
            let factorData = {'factor':qty,'curDate': vm.selectedDashbordDate};
            User.addGcv(factorData).then(
                (response)=> {
                    jQuery('.js-loader').addClass('d-none');
                    if(response.data.code == 200){
                        $('#gcvAdd').modal('hide');
                        vm.close_modal();
                       
                        toastr.success('Factor added successfully.', 'Success', {timeOut: 5000});
                    } else {
                        toastr.error('Factor already added.', 'Error', {timeOut: 5000});

                    }

                },
                (error) => {
                    jQuery('.js-loader').addClass('d-none');

                }
                );
        },
        nomination_page()
        {
            let vm=this;
            vm.$store.dispatch('SetNominationDate',''); 
            vm.$store.dispatch('SetNominationPage','');
            vm.$store.dispatch('SetNominationId','');
            vm.$router.push({'name':'nomination_lng_list'});
        },
        close_modal()
        {
            let vm=this;
            vm.supplied_table_data={};
            vm.open_supplied_modal=false;
            vm.open_gcv_modal=false;
        },
        changeDashbordDate(selectDate)
        {
            let vm=this;
            vm.selectedDashbordDate=selectDate;
            vm.getBuyerDetails(vm.selectedDashbordDate);
            // vm.getAvailability(vm.selectedDashbordDate);
            // vm.getTotalRequestedQuantityForSeller(vm.selectedDashbordDate);
            // vm.getTotalApprovedQuantity(vm.selectedDashbordDate);
            // vm.getTotalSuppliedQuantity(vm.selectedDashbordDate);
            // if( window.myPie1) {
                
            //     window.myPie1.destroy();
            //      window.myPie2.destroy();
            // } 
            // vm.chart1Data();
            vm.chart2Data();
             User.getNominationLngTotals(vm.selectedDashbordDate).then(
                (response) => {
                    this.sellerDashboadData = response.data.data;
                    // console.log(this.sellerDashboadData);
                    vm.total_request = this.sellerDashboadData.LngTotal;
                    vm.total_approved = this.sellerDashboadData.ApprovedLngTotal;
                    vm.total_supplied = this.sellerDashboadData.SuppliedQuantity;
                },
                (error) => {

                }
            );
        },
         availibility()
        {
            let vm=this;
            if(vm.today_date<vm.selectedDashbordDate)
            {
                User.createAvailability(vm.selectedDashbordDate).then(
                  (response)=> {
                   
                    if(response.data.code == 200){
                       toastr.success('Availability  added successfully.', 'Availability', {timeOut: 5000});
                    } 
                    else if (response.data.code == 301) {
                        toastr.error('Availability has been added already.', 'Availability', {timeOut: 5000});
                    }
                    else if (response.data.code == 300) {
                        toastr.error('Something Went wrong.', 'Availability', {timeOut: 5000});
                    }
                    else
                    {
                        toastr.error('Something Went wrong.', 'Availability', {timeOut: 5000});
                    }
                    
                  },
                  (error)=>{
                  }
                )
            }
            else
            {
                toastr.error('You had selected wrong date.', 'Availability', {timeOut: 5000});
            }
            
        },
     // Add GCV for specific date
        addGcv() {
            let vm =this;
            let cur_date = vm.selectedDashbordDate;
            jQuery('.js-loader').removeClass('d-none');

             User.isGcvAdded(cur_date).then(
                (response)=> {
                    jQuery('.js-loader').addClass('d-none');
                    if(response.data.code == 200){
                        vm.open_gcv_modal=true;
                        $('#gcvAdd').modal('show');
                    } else {
                        toastr.error('Factor is already added.', 'Error', {timeOut: 5000});

                    }

                },
                (error) => {
                    jQuery('.js-loader').addClass('d-none');

                }
                );
        },   
       getAvailability(selected_date)
       {
            let vm=this;
             User.getAvailability(selected_date).then(
                 (response) => {
                    let avail=response.data.data;
                    if(avail!=null && avail!='' && avail!=0)
                    {
                        vm.total_availability=avail;

                    }
                    else
                    {
                         vm.total_availability=0;
                    }
                    vm.chart2Data();
                },
                (error) => {
                },
            );
       },
       getTotalRequestedQuantityForSeller(selected_date)
       {
            let vm=this;
             User.getTotalRequestedQuantityForSeller(selected_date).then(
                 (response) => {
                    let request=response.data.data;
                    if(request!=null && request!='' && request!=0)
                    {
                        vm.total_request=request;
                    }
                    else
                    {
                         vm.total_request=0;
                    }
                    
                },
                (error) => {
                },
            );
       },
       getTotalApprovedQuantity(selected_date)
       {
            let vm=this;
             User.getTotalApprovedQuantity(selected_date).then(
                 (response) => {
                    let approve=response.data.data;
                    if(approve!=null && approve!='' && approve!=0)
                    {
                        vm.total_approved=approve;
                    }
                    else
                    {
                         vm.total_approved=0;
                    }
                    
                },
                (error) => {
                },
            );
       },
       getTotalSuppliedQuantity(selected_date)
       {
            let vm=this;
             User.getTotalSuppliedQuantity(selected_date).then(
                 (response) => {
                    let supply=response.data.data;
                    if(supply!=null && supply!='' && supply!=0)
                    {
                        vm.total_supplied=supply;
                    }
                    else
                    {
                         vm.total_supplied=0;
                    }
                    
                },
                (error) => {
                },
            );
       },
       getBuyerDetails(selected_date){
            let curDate = selected_date;
            let nData = {'date':curDate};
            let vm =this;
            User.getNominationLngDetailsByDate(curDate).then(
                 (response) => {
                    // return false;
                    let nominationData  = [];
                    $.each(response.data.data, function(key, value) {
                        let data =  {
                            'buyer_id':value.buyer_id,
                            'buyer_name':value.first_name,
                            'quantity_required':value.quantity_required,
                            'approved_quantity':value.approved_quantity,
                            'supplied_quantity':value.supplied_quantity,
                            'date':value.date
                        }
                        nominationData.push(data);
                        
                    });
                    vm.nominationData = nominationData;
                },
                (error) => {
                },
            );
        },
        supplied_quantity()
        {
            let vm=this;
            vm.$router.push('supply-lng');
        },
        GenerateInvoice(){

             let vm=this;
             User.generateInvoice().then(

                 (response)=> {
               
                if(response.data.code == 200){
                   toastr.success('Invoice generated successfully.', 'Invoice', {timeOut: 5000});
                } else if (response.data.code == 300) {
                    toastr.error('Something went wrong.', 'Invoice', {timeOut: 5000});
                }
                elses
                {
                    toastr.error('Something went wrong.', 'Invoice', {timeOut: 5000});
                }
                
              },
              (error)=>{
              }

             );
        },
        chart1Data()
        {

            // // let vm=this;
            
            // // var ctx1 = document.getElementById("myChart").getContext('2d'); 
            // // // var color = Chart.helpers.color;

            // // var config1Data = {
            // //         datasets: [{
            // //             data: [0,100],
            // //             backgroundColor: [
            // //                 '#004696',
            // //                 '#82be00',
                            
            // //             ],
            // //             label: 'Dataset 1'
            // //         }],
            // //         labels: [
            // //             'Requested',
            // //             'Scheduled',
            // //             'Allocated',
            // //         ]
            // //     };
            // // var config1 = {
            // //     type: 'bar',
            // //     data: config1Data,
            // //     options: {
            // //         responsive: true,
            // //         legend: {
            // //                 position: 'top',
            // //             },
            // //         scales: {
            // //             yAxes: [{
            // //                 ticks: {
            // //                     beginAtZero:true
            // //                 }
            // //             }]
            // //         }
            // //     }
            // // };
            // // var newDataset = {};
            // // setTimeout(function(){
            // //     config1Data.datasets.pop();
            // //     // _.forEach(vm.nominationData,function(value,key){
                   
            // //          var letters = '0123456789ABCDEF';
            // //           var color = '#';
            // //           for (var i = 0; i < 6; i++) {
            // //             color += letters[Math.floor(Math.random() * 16)];
            // //           }
            // //         var newDataset = {
            // //             label: 'LNG',
            // //             backgroundColor: color,
            // //             borderWidth: 1,
            // //             // data: [
            // //             //     vm.sellerDashboadData.LngTotal,
            // //             //     vm.sellerDashboadData.ApprovedLngTotal,
            // //             //     vm.sellerDashboadData.SuppliedQuantity
                           
            // //             // ]
            // //             data: [
            // //                 vm.sellerDashboadData.LngTotal,
            // //                 vm.sellerDashboadData.ApprovedLngTotal,
            // //                 vm.sellerDashboadData.SuppliedQuantity
                           
            // //             ]
            // //         };
            // //         config1Data.datasets.push(newDataset);

            // //         // check_list_data.push(value.reportListId);
            // //     // });
                
            // //      // window.myPie1.update();
            // //      window.myPie1 = new Chart(ctx1, config1);
               

            // },1000)
        },
        chart2Data()
        {
            let vm=this;
            
            var randomScalingFactor = function() {
                return Math.round(Math.random() * 100);
            };                    
            var ctx2 = document.getElementById("cSupply").getContext('2d');
            
            // window.myPie1 = new Chart(ctx1, config1);
            jQuery('.js-loader').removeClass('d-none')

            setTimeout(function(){
                var config2 = {
                type: 'bar',
                data: {
                    datasets: [
                    {
                        // data: [
                        //     100,200,300
                        // ],
                        data: [
                            vm.sellerDashboadData.LngTotal,
                            vm.sellerDashboadData.ApprovedLngTotal,
                            vm.sellerDashboadData.SuppliedQuantity
                        ],
                        backgroundColor: [
                            '#82be00',
                            '#004696',
                            '#173f6d',
                            
                        ],
                        label: 'LNG Allocation'
                    }
                    ],
                    labels: [
                        'Requested',
                        'Scheduled',
                        'Supplied',
                    ]
                },
                options: {
                    responsive: true,
                    legend: {
                            position: 'top',
                        },
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            };
                window.myPie2 = new Chart(ctx2, config2);
            jQuery('.js-loader').addClass('d-none')

            },3000);
        },

    }, 

}

</script>