<template>
	<section class="content">

		<section class="content-header">
            <h1>Dashboard</h1> 
            <ol class="breadcrumb">
                <li role="presentation" class="breadcrumb-item active">
                    <span aria-current="location"><i class="ti-home"></i> Dashboard</span>
                </li>
            </ol>
        </section>
                <div class="row">
            <div class="col-md-12 text-right">
                <button class="btn btn-primary" @click="supplied_quantity()">Supplied Quantity</button>
            </div>
        </div>
        <br/>
          <div class="row">
            <div class="col-md-12 text-right">
                <button class="btn btn-primary" @click="GenerateInvoice()">Generate Invoice</button>
            </div>
        </div>
        <br/>
		<div class="row">
            <div class="col-sm-6 col-md-6 col-xl-3">
             	<div class="flip">
                    <div class="widget-bg-color-icon card-box front">
                        <div class="bg-icon float-left">
                            <i class="ti-eye text-warning"></i>
                        </div>
                        <div class="text-right">
                           <h3 class="text-dark"><b>3752</b></h3>
                            <p>Total Request</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="flip">
            	    <div class="widget-bg-color-icon card-box front">
                        <div class="bg-icon float-left">
                            <i class="ti-shopping-cart text-success"></i>
                        </div>
                        <div class="text-right">
                            <h3><b id="widget_count3">3251</b></h3>
                            <p>Sales status</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="flip">
                <div class="widget-bg-color-icon card-box front">
            	    <div class="bg-icon float-left">
                       <i class="fas fa-file-invoice"></i>
                    </div>
                	<div class="text-right">
                		<h3 class="text-dark"><b><a href="/generate_invoice">Invoice</a></b></h3>
                		<!-- <p>Hits</p> -->
                	</div>
                    <div class="clearfix"></div>
                </div>
                
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-xl-3">
                <div class="flip">
            	    <div class="widget-bg-color-icon card-box front">
                    	<div class="bg-icon float-left">
                           <i class="ti-user text-info"></i>
                        </div>
                        <div class="text-right">
                            <h3 class="text-dark"><b>1252</b></h3>
                            <p>Subscribers</p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-xl-8 col-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card main-chart">
                                <div class="card-header panel-tabs">
                                    
                                            <a > Buyer allocation</a>
                                    
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
                        </div>
                        <div class="col-sm-6">
                            <div class="card main-chart">
                                <div class="card-header panel-tabs">
                                    <!-- <ul class="nav nav-tabs nav-float" role="tablist"> -->
                                        
                                        <!-- <li class="text-center nav-item"> -->
                                            <a><span class="d-none d-sm-block">Current Supply</span>
                                                </a>
                                        <!-- </li> -->
                                    <!-- </ul> -->
                                </div>
                                <div class="card-body">
                                    <!-- <div class="tab-content"> -->
                                        
                                        <div class="tab-pane fade" id="supply">
                                             <div style="width: 50%;">
                                                 <canvas id="cSupply" width="100px" height="100px"></canvas>
                                             </div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <timeline :userData=userData> </timeline>
                <div class="col-xl-4  col-12">

                   
                </div>
            </div>

            <!-- /#right -->
            <div class="background-overlay"></div>

	</section>
</template>
	
<script >
    import User from '../../../api/users.js';
    import moment from 'moment';
    import Chart from 'chart.js';
    import timeline from './timeline.vue';
    import _ from 'lodash';

export default {
    name: "dashboardSeller",
    data() {
        return {
            formstate: {},
                'userData' : {
                    'userType' : this.$store.state.Users.userDetails.user_type,
                    'userId' : this.$store.state.Users.userDetails.id,
                },
                'nominationData':[]
        }
    },
    methods: {
       getBuyerDetails(){
            let curDate = moment().format('DD-MM-YYYY');
            let nData = {'date':curDate};
            let vm =this;
            User.getNominationDetailsByDate(curDate).then(
                 (response) => {
                    console.log('response',response);
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
            User.updateSuppliedQuantity().then(
              (response)=> {
               
                if(response.data.code == 200){
                   toastr.success('Supplied quantity changed.', 'Supplied Quantity', {timeOut: 5000});
                } else if (response.data.code == 300) {
                    toastr.error('Something Went wrong.', 'Supplied Quantity', {timeOut: 5000});
                }
                else
                {
                    toastr.error('Something Went wrong.', 'Supplied Quantity', {timeOut: 5000});
                }
                
              },
              (error)=>{
              }

            )
        },
        GenerateInvoice(){

             let vm=this;
             User.generateInvoice().then(

                 (response)=> {
               
                if(response.data.code == 200){
                   toastr.success('Generate Invoice Successfully.', 'Generate Invoice', {timeOut: 5000});
                } else if (response.data.code == 300) {
                    toastr.error('Something Went wrong.', 'Generate Invoice', {timeOut: 5000});
                }
                elses
                {
                    toastr.error('Something Went wrong.', 'Generate Invoice', {timeOut: 5000});
                }
                
              },
              (error)=>{
              }

             );
        }

    },
    components: {
            timeline
    },
    mounted: function() {
        this.getBuyerDetails();
        let vm = this;
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };                    
        var ctx1 = document.getElementById("myChart").getContext('2d');
        var ctx2 = document.getElementById("cSupply").getContext('2d');
     

        var color = Chart.helpers.color;

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
                    'Requested',
                    'Approved',
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

        var config2 = {
            type: 'pie',
            data: {
                datasets: [
                {
                    data: [0,100],
                    backgroundColor: [
                        '#ff0000',
                        '#00ff40',
                        
                    ],
                    label: 'Dataset 1'
                }
                ],
                labels: [
                    'Requested',
                    'Approved',
                ]
            },
            options: {
                responsive: true
            }
        };
        // window.myPie1 = new Chart(ctx1, config1);
        window.myPie2 = new Chart(ctx2, config2);
        setInterval(function(){

            // config1.data.datasets.forEach(function(dataset) {
            //     dataset.data = dataset.data.map(function() {
            //         return randomScalingFactor();
            //     });
            // });
            
            //  config2.data.datasets.forEach(function(dataset) {
            //     dataset.data = dataset.data.map(function() {
            //         return randomScalingFactor();
            //     });   
            // });
            if(config2.data.datasets[0].data[0] <100){

             config2.data.datasets[0].data[0] = config2.data.datasets[0].data[0] +1;
             config2.data.datasets[0].data[1] = 100 -config2.data.datasets[0].data[0]; 
            }
            // window.myPie1.update();
            window.myPie2.update();
        },2000)
        var newDataset = {};
        setTimeout(function(){
            config1Data.datasets.pop();
            _.forEach(vm.nominationData,function(value,key){
                console.log(value,'value');
                // config1.data.datasets[key].data[0] = value.quantity_required;
                // config1.data.datasets[key].data[1] = value.approved_quantity;
                // config1.data.datasets[key].label = value.buyer_name;
                // config1.data[key] = value.buyer_name;
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
                        value.approved_quantity
                    ]
                };
                config1Data.datasets.push(newDataset);

                // check_list_data.push(value.reportListId);
            });
            console.log(config1Data,'config1Data');
             // window.myPie1.update();
             window.myPie1 = new Chart(ctx1, config1);
            // config1.datasets.push(newDataset);

        },2000)

    },
       
    destroyed: function() {

    }
}

</script>