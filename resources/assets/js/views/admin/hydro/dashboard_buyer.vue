<template>
<section>
    <section class="content-header mb-3">
            <div class="row">
                <div class="col-md-4 col-sm-5">
                    <h1><i class="fas fa-chart-bar"></i>Dashboard</h1> 
                </div>
                <div class="col-md-8 col-sm-7 text-right">
                     <ol class="breadcrumb">
                        
                    </ol>
                </div>
            </div>
    </section>
    <section>
        <previousNextDate></previousNextDate>
    </section>

	<section class="content">
        <!-- <div class="row">
            <div class="col-md-12 text-right">
                <a href="/nomination_list"> <button class="btn btn-warning">Nomination Request</button></a>
            </div>
        </div>
        <br/> -->
        
	<div class="row">
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="flip">
                 <a href="#" @click="nomination_lpg()" title="Add Nomination LPGS">
                    <div class="widget-bg-color-icon card-box front">
                        <div class="bg-icon float-left">
                           <i class="fas fa-truck"></i>
                        
                        </div>
                        <div class="text-right">
                        <h3><b>Nomination LNG</b></h3>
                        <!-- <h3 class="text-dark"><b>{{total_request}}</b></h3>
                        <p>For Date:{{selectedDashbordDate}}</p> -->
                        </div>
                        <div class="clearfix"></div>
                    </div>
                 </a>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-xl-3">
         	<div class="flip">
                 <a href="#" @click="nomination_page()" title="Add Nomination">
                    <div class="widget-bg-color-icon card-box front">
                        <div class="bg-icon float-left">
                           <i class="fas fa-charging-station"></i>
                        
                        </div>
                        <div class="text-right">
                        <h3><b>Nomination</b></h3>
                        <h3 class="text-dark"><b>{{total_request}}</b></h3>
                        <p>For Date:{{selectedDashbordDate}}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                 </a>
            </div>
        </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="flip">
                    <a >
                    <div class="widget-bg-color-icon card-box front">
                        <div class="bg-icon float-left">
                           <i class="fas fa-clipboard-list"></i> 
                        </div>
                        <div class="text-right">
                            <h3><b>Scheduled Quantity</b></h3>
                            <h3 class="text-dark"><b id="widget_count3">{{total_approved}}</b></h3>
                            <p>For Date:{{selectedDashbordDate}}</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    </a>  

            </div>
        </div>
           <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="flip">
                    <a >
                    <div class="widget-bg-color-icon card-box front">
                        <div class="bg-icon float-left">
                          <i class="far fa-caret-square-right"></i>
                        </div>
                        <div class="text-right">
                            <h3><b>Allocated Quantity</b></h3>
                            <h3 class="text-dark"><b id="widget_count3">{{total_supplied}}</b></h3>
                            <p>For Date:{{selectedDashbordDate}}</p>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                    </a>
                    </div>
                </div>
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="flip">
                <a href="#">
                <div class="widget-bg-color-icon card-box front">
                    <div class="bg-icon float-left">
                        <!-- <i class="fa fa-credit-card text-blue"></i> -->
                        <i class="fas fa-money-check"></i>
                    </div>
                    <div class="text-right">

                        <h3><b><a href="/generate_buyer_invoice">Invoice</a></b></h3>
                        <!-- <p>Generate Invoice</p> -->

                    </div>
                    <div class="clearfix"></div>
                </div>
                </a>
                </div>
            </div>
         
            </div>
            <div class="row">
                <div class="col-xl-8 col-12">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card main-chart">
                                <div class="card-header panel-tabs buyer_chart1">
                                     <div class="card-header">
                                        Nomination
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div class="tab-pane  active" id="allocation">
                                            <div style="width: 50%;  margin: 20px auto 0 auto;">
                                               <!--  <canvas id="myChart" width="100px" height="100px"></canvas> -->
                                                <canvas id="myplotArea" width="100px" height="100px"></canvas>
                                               <!--  <button class="btn btn-success" @click="getPrevoiusDay()"><i class="fa fa-arrow-left fa-lg"></i></button>
                                               <button   class="btn btn-success" @click="getNextDay()"><i class="fa fa-arrow-right fa-lg"></i></button> -->

                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile">
                                            <div class="chart-container">
                                                <span class="">
                                                    <i class="ti-reload redraw-cart float-right set-animate"></i>
                                                </span>
                                                <canvas id="dashboard-chart1" width="800" height="300"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <timeline :userData=userData> </timeline>
            </div>

            <!-- /#right -->
            <div class="background-overlay"></div>
</section>
    </section>
</template>
	
<script >
    import User from '../../../api/users.js';
    import moment from 'moment';
    import Chart from 'chart.js';
    import timeline from './timeline.vue';
    import previousNextDate from './previousNextDate.vue';

export default {
    name: "dashboardSeller",
    data() {
        return {
            formstate: {},

            'selectedDate' : moment().format('DD-MM-YYYY'),
            'userData' : {
                    'userType' : this.$store.state.Users.userDetails.user_type,
                    'userId' : this.$store.state.Users.userDetails.id,
            },
            'total_request':'',
            'total_approved':'',
            'total_supplied':'',
            'nominationData' : [], 
            'selected_date' :'',
            'selectedDashbordDate' : moment().format('DD-MM-YYYY'),
        }
    },
    created: function(){
        this.$root.$on('changeDashbordDate',this.changeDashbordDate);
    },
    components: {
            timeline,
            previousNextDate
    },
    mounted: function() {
        let vm=this;
       if(vm.$store.state.Users.userDetails.user_type != '2'){
              vm.$root.$emit('logout','You are not authorise to access this page'); 
          }
        vm.chartData();
    },
    methods: {
        nomination_lpg()
        {
            let vm=this;
            /*vm.$store.dispatch('SetNominationDate',''); 
            vm.$store.dispatch('SetNominationPage','');
            vm.$store.dispatch('SetNominationId','');*/
            vm.$router.push({'name':'nomination_lpg_list'});
        },
        nomination_page()
        {
            let vm=this;
            vm.$store.dispatch('SetNominationDate',''); 
            vm.$store.dispatch('SetNominationPage','');
            vm.$store.dispatch('SetNominationId','');
            vm.$router.push({'name':'nomination_list'});
        },
        changeDashbordDate(selectDate)
        {
            let vm=this;
            vm.selectedDashbordDate=selectDate;
            vm.getTotalSuppliedQuantityByBuyer(vm.selectedDashbordDate,vm.userData.userId);
            vm.getTotalRequestedQuantity(vm.selectedDashbordDate,vm.userData.userId);
            vm.getTotalApprovedQuantityByBuyer(vm.selectedDashbordDate,vm.userData.userId);
            vm.getBuyerDetailsById(vm.selectedDashbordDate,vm.userData.userId);
            
        },
        getPrevoiusDay(){
            let vm=this;
            let prevoiusDay = moment(vm.selectedDate,'DD-MM-YYYY').add(-1,'days').format('DD-MM-YYYY');
             vm.selectedDate =  prevoiusDay;
            vm.getBuyerDetailsById(vm.selectedDate,vm.userData.userId);
        },
        getNextDay(){
            let vm=this;
              let nextDay = moment(vm.selectedDate,'DD-MM-YYYY').add(1,'days').format('DD-MM-YYYY');
             vm.selectedDate =  nextDay;
          
            vm.getBuyerDetailsById(vm.selectedDate,vm.userData.userId);

        },
        getTotalSuppliedQuantityByBuyer(selected_date,buyer_id)
       {
            let vm=this;
             User.getTotalSuppliedQuantityByBuyer(selected_date,buyer_id).then(
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
        getTotalRequestedQuantity(selected_date,buyer_id)
       {
            let vm=this;
             User.getTotalRequestedQuantity(selected_date,buyer_id).then(
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
        getBuyerDetailsById(date,buyerId){
            let curDate = date;
            let nData = {'date':curDate};
            let vm =this;
            User.getNominationDetailsByDateAndId(curDate,buyerId).then(
                 (response) => {
                    // return false;
                    let nominationData  = [];
                   // $.each(response.data.data, function(key, value) {
                    if(response.data.code == 200){
                        let data =  {
                            'buyer_id':response.data.data.buyer_id,
                            'buyer_name':response.data.data.first_name,
                            'quantity_required':response.data.data.quantity_required,
                            'approved_quantity':response.data.data.approved_quantity,
                            'supplied_quantity':response.data.data.supplied_quantity,
                            'date':response.data.data.date
                        }
                        nominationData.push(data);
                        vm.nominationData = nominationData;
                     }
                      if(response.data.code == 300){
                        vm.nominationData={};
                        //toastr.error('No data available.', 'Live Feed', {timeOut: 5000});
                      }
                      vm.chartData();
                },
                (error) => {
                },
            );
        },
       getTotalApprovedQuantityByBuyer(selected_date,buyer_id)
       {
            let vm=this;
             User.getTotalApprovedQuantityByBuyer(selected_date,buyer_id).then(
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
       chartData()
       {
            let vm=this;
            var randomScalingFactor = function() {
                return Math.round(Math.random() * 100);
            };
             var ctx1 = document.getElementById("myplotArea").getContext("2d");
           

              var config1Data = {
                            datasets: [{
                                data: [0,100],
                                backgroundColor: [
                                    '#ff0000',
                                    '#00ff40',
                                    

                                ],
                                label: 'Dataset 1'
                            }],
                            labels: [
                                'Request Quantity',
                                'Scheduled Quantity',
                                'Allocated Quantity',
                            ]
                        };           
                  var config1 = {
                        type: 'bar',
                        data: config1Data,
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
               var newDataset = {};
                setTimeout(function(){
                    config1Data.datasets.pop();
                    _.forEach(vm.nominationData,function(value,key){
                       
                         var letters = '0123456789ABCDEF';
                          var color = '#';
                          for (var i = 0; i < 6; i++) {
                            color += letters[Math.floor(Math.random() * 16)];
                          }
                        var newDataset = {
                            label: value.buyer_name,
                            backgroundColor: color,
                            borderWidth: 1,
                            data: [
                                value.quantity_required,
                                value.approved_quantity,
                                value.supplied_quantity,
                            ]
                        };
                        config1Data.datasets.push(newDataset);

                        // check_list_data.push(value.reportListId);
                    });
                    
                     // window.myPie1.update();
                     window.myPie1 = new Chart(ctx1, config1);
                    // config1.datasets.push(newDataset);

                },1500)
       }
    }, 
}

</script>