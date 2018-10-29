<template>
<section>
    <section class="content-header mb-3">
            <div class="row">
                <div class="col-md-4 col-sm-5">
                    <h1>Dashboard</h1> 
                </div>
                <div class="col-md-8 col-sm-7 text-right">
                     <ol class="breadcrumb">
                        <li role="presentation" class="breadcrumb-item active">
                            <span aria-current="location"><i class="ti-home"></i> Dashboard</span>
                        </li>
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
                     <a href="/nomination_list" title="Add Nomination">
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon float-left">
                                <i class="fa fa-share-square-o text-blue"></i>
                            
                            </div>
                            <div class="text-right">
                            <h3><b>Nomination</b></h3>
                            <h3 class="text-dark"><b>{{total_request}}</b></h3>
                                <!-- <p>Requested Quantity</p> -->
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
                           <i class="fa fa-certificate text-success"></i> 
                        </div>
                        <div class="text-right">
                            <h3><b>Approved Quantity</b></h3>
                            <h3 class="text-dark"><b id="widget_count3">{{total_approved}}</b></h3>
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
                           <i class="fa fa-shopping-cart text-warning"></i>
                        </div>
                        <div class="text-right">
                            <h3><b>Supplied Quantity</b></h3>
                            <h3 class="text-dark"><b id="widget_count3">{{total_supplied}}</b></h3>

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
                        <i class="fa fa-credit-card text-blue"></i>
                    </div>
                	<div class="text-right">

                		<h3><b><a href="/buyer_invoice_list">Invoice</a></b></h3>

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
                                    <ul class="nav nav-tabs nav-float" role="tablist">
                                        <li class=" text-center nav-item">
                                            <a href="#allocation" class="nav-link active" role="tab" data-toggle="tab">Nomination</a>
                                        </li>
                                        <!-- <li class="text-center nav-item">
                                            <a href="#profile" role="tab" data-toggle="tab" class="nav-link"><span class="d-none d-sm-block">Annual Revenue</span>
                                                </a>
                                        </li> -->
                                    </ul>
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
            <!--rightside bar -->
            <div id="right">
                <div id="right-slim">
                    <div class="rightsidebar-right">
                        <div class="rightsidebar-right-content">
                            <div class="panel-tabs">
                                <ul class="nav nav-tabs nav-float" role="tablist">
                                    <li class="nav-item text-center">
                                        <a href="#r_tab1" role="tab" data-toggle="tab" class="nav-link active "><i
                                                class="fa fa-fw ti-comments"></i></a>
                                    </li>
                                    <li class="text-center nav-item">
                                        <a href="#r_tab2" role="tab" data-toggle="tab" class="nav-link"><i class="fa fa-fw ti-bell"></i></a>
                                    </li>
                                    <li class="text-center nav-item">
                                        <a href="#r_tab3" role="tab" data-toggle="tab" class="nav-link"><i
                                                class="fa fa-fw ti-settings"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="r_tab1">
                                    <div id="slim_t1">
                                        <h5 class="rightsidebar-right-heading text-uppercase text-xs">
                                            <i class="menu-icon  fa fa-fw ti-user"></i>
                                            Contacts
                                        </h5>
                                        <ul class="list-unstyled margin-none">
                                            <li class="rightsidebar-contact-wrapper">
                                                <a class="rightsidebar-contact" href="#">
                                                    <img src="img/authors/avatar6.jpg"
                                                         class="rounded-circle float-right" alt="avatar-image">
                                                    <i class="fa fa-circle text-xs text-primary"></i>
                                                    Annette
                                                </a>
                                            </li>
                                            <li class="rightsidebar-contact-wrapper">
                                                <a class="rightsidebar-contact" href="#">
                                                    <img src="img/authors/avatar.jpg"
                                                         class="rounded-circle float-right" alt="avatar-image">
                                                    <i class="fa fa-circle text-xs text-primary"></i>
                                                    Jordan
                                                </a>
                                            </li>
                                            <li class="rightsidebar-contact-wrapper">
                                                <a class="rightsidebar-contact" href="#">
                                                    <img src="img/authors/avatar2.jpg"
                                                         class="rounded-circle float-right" alt="avatar-image">
                                                    <i class="fa fa-circle text-xs text-primary"></i>
                                                    Stewart
                                                </a>
                                            </li>
                                            <li class="rightsidebar-contact-wrapper">
                                                <a class="rightsidebar-contact" href="#">
                                                    <img src="img/authors/avatar3.jpg"
                                                         class="rounded-circle float-right" alt="avatar-image">
                                                    <i class="fa fa-circle text-xs text-warning"></i>
                                                    Alfred
                                                </a>
                                            </li>
                                            <li class="rightsidebar-contact-wrapper">
                                                <a class="rightsidebar-contact" href="#">
                                                    <img src="img/authors/avatar4.jpg"
                                                         class="rounded-circle float-right" alt="avatar-image">
                                                    <i class="fa fa-circle text-xs text-danger"></i>
                                                    Eileen
                                                </a>
                                            </li>
                                            <li class="rightsidebar-contact-wrapper">
                                                <a class="rightsidebar-contact" href="#">
                                                    <img src="img/authors/avatar5.jpg"
                                                         class="rounded-circle float-right" alt="avatar-image">
                                                    <i class="fa fa-circle text-xs text-muted"></i>
                                                    Robert
                                                </a>
                                            </li>
                                            <li class="rightsidebar-contact-wrapper">
                                                <a class="rightsidebar-contact" href="#">
                                                    <img src="img/authors/avatar7.jpg"
                                                         class="rounded-circle float-right" alt="avatar-image">
                                                    <i class="fa fa-circle text-xs text-muted"></i>
                                                    Cassandra
                                                </a>
                                            </li>
                                        </ul>

                                        <h5 class="rightsidebar-right-heading text-uppercase text-xs">
                                            <i class="fa fa-fw ti-export"></i>
                                            Recent Updates
                                        </h5>
                                        <div>
                                            <ul class="list-unstyled">
                                                <li class="rightsidebar-notification">
                                                    <a href="#">
                                                        <i class="fa ti-comments-smiley fa-fw text-primary"></i>
                                                        New Comment
                                                    </a>
                                                </li>
                                                <li class="rightsidebar-notification">
                                                    <a href="#">
                                                        <i class="fa ti-twitter-alt fa-fw text-success"></i>
                                                        3 New Followers
                                                    </a>
                                                </li>
                                                <li class="rightsidebar-notification">
                                                    <a href="#">
                                                        <i class="fa ti-email fa-fw text-info"></i>
                                                        Message Sent
                                                    </a>
                                                </li>
                                                <li class="rightsidebar-notification">
                                                    <a href="#">
                                                        <i class="fa ti-write fa-fw text-warning"></i>
                                                        New Task
                                                    </a>
                                                </li>
                                                <li class="rightsidebar-notification">
                                                    <a href="#">
                                                        <i class="fa ti-export fa-fw text-danger"></i>
                                                        Server Rebooted
                                                    </a>
                                                </li>
                                                <li class="rightsidebar-notification">
                                                    <a href="#">
                                                        <i class="fa ti-info-alt fa-fw text-primary"></i>
                                                        Server Not Responding
                                                    </a>
                                                </li>
                                                <li class="rightsidebar-notification">
                                                    <a href="#">
                                                        <i class="fa ti-shopping-cart fa-fw text-success"></i>
                                                        New Order Placed
                                                    </a>
                                                </li>
                                                <li class="rightsidebar-notification">
                                                    <a href="#">
                                                        <i class="fa ti-money fa-fw text-info"></i>
                                                        Payment Received
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="r_tab2">
                                    <div id="slim_t2">
                                        <h5 class="rightsidebar-right-heading text-uppercase text-xs">
                                            <i class="fa fa-fw ti-bell"></i>
                                            Notifications
                                        </h5>
                                        <ul class="list-unstyled m-t-15 notifications">
                                            <li>
                                                <a href="" class="message icon-not striped-col">
                                                    <img class="message-image rounded-circle"
                                                         src="img/authors/avatar3.jpg" alt="avatar-image">

                                                    <div class="message-body">
                                                        <strong>John Doe</strong>
                                                        <br>
                                                        5 members joined today
                                                        <br>
                                                        <small class="noti-date">Just now</small>
                                                    </div>

                                                </a>
                                            </li>
                                            <li>
                                                <a href="" class="message icon-not">
                                                    <img class="message-image rounded-circle"
                                                         src="img/authors/avatar.jpg" alt="avatar-image">
                                                    <div class="message-body">
                                                        <strong>Tony</strong>
                                                        <br>
                                                        likes a photo of you
                                                        <br>
                                                        <small class="noti-date">5 min</small>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" class="message icon-not striped-col">
                                                    <img class="message-image rounded-circle"
                                                         src="img/authors/avatar6.jpg" alt="avatar-image">

                                                    <div class="message-body">
                                                        <strong>John</strong>
                                                        <br>
                                                        Dont forgot to call...
                                                        <br>
                                                        <small class="noti-date">11 min</small>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" class="message icon-not">
                                                    <img class="message-image rounded-circle"
                                                         src="img/authors/avatar1.jpg" alt="avatar-image">
                                                    <div class="message-body">
                                                        <strong>Jenny Kerry</strong>
                                                        <br>
                                                        Done with it...
                                                        <br>
                                                        <small class="noti-date">1 Hour</small>
                                                    </div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" class="message icon-not striped-col">
                                                    <img class="message-image rounded-circle"
                                                         src="img/authors/avatar7.jpg" alt="avatar-image">

                                                    <div class="message-body">
                                                        <strong>Ernest Kerry</strong>
                                                        <br>
                                                        2 members joined today
                                                        <br>
                                                        <small class="noti-date">3 Days</small>
                                                    </div>
                                                </a>
                                            </li>
                                            <li class="text-right noti-footer"><a href="#">View All Notifications <i
                                                    class="ti-arrow-right"></i></a></li>
                                        </ul>
                                        <h5 class="rightsidebar-right-heading text-uppercase text-xs">
                                            <i class="fa fa-fw ti-check-box"></i>
                                            Tasks
                                        </h5>
                                        <ul class="list-unstyled m-t-15">
                                            <li>
                                                <div>
                                                    <p>
                                                        <span>Button Design</span>
                                                        <small class="float-right text-muted">40%</small>
                                                    </p>
                                                    <div class="progress progress-xs  active">
                                                        <div class="progress-bar bg-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                                             style="width: 40%">
                                                            <span class="sr-only">40% Complete (success)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <p>
                                                        <span>Theme Creation</span>
                                                        <small class="float-right text-muted">20%</small>
                                                    </p>
                                                    <div class="progress progress-xs  active">
                                                        <div class="progress-bar bg-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"
                                                             style="width: 20%">
                                                            <span class="sr-only">20% Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <p>
                                                        <span>XYZ Task To Do</span>
                                                        <small class="float-right text-muted">60%</small>
                                                    </p>
                                                    <div class="progress progress-xs  active">
                                                        <div class="progress-bar bg-warning progress-bar-striped" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                                             style="width: 60%">
                                                            <span class="sr-only">60% Complete (warning)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <p>
                                                        <span>Transitions Creation</span>
                                                        <small class="float-right text-muted">80%</small>
                                                    </p>
                                                    <div class="progress progress-xs active">
                                                        <div class="progress-bar bg-danger progress-bar-striped" role="progressbar"
                                                             aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"
                                                             style="width: 80%">
                                                            <span class="sr-only">80% Complete (danger)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="text-right"><a href="#">View All Tasks <i
                                                    class="ti-arrow-right"></i></a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="r_tab3">
                                    <div id="slim_t3">

                                        <h5 class="rightsidebar-right-heading text-uppercase gen-sett-m-t text-xs">
                                            <i class="fa fa-fw ti-settings"></i>
                                            General
                                        </h5>
                                        <ul class="list-unstyled settings-list m-t-10">
                                            <li>
                                                <label for="status">Available</label>
                                                <span class="float-right">
                                            <input type="checkbox" id="status" name="my-checkbox" checked>
                                        </span>
                                            </li>
                                            <li>
                                                <label for="email-auth">Login with Email</label>
                                                <span class="float-right">
                                            <input type="checkbox" id="email-auth" name="my-checkbox">
                                        </span>
                                            </li>
                                            <li>
                                                <label for="update">Auto Update</label>
                                                <span class="float-right">
                                            <input type="checkbox" id="update" name="my-checkbox">
                                        </span>
                                            </li>

                                        </ul>
                                        <h5 class="rightsidebar-right-heading text-uppercase text-xs">
                                            <i class="fa fa-fw ti-volume"></i>
                                            Sound & Notification
                                        </h5>
                                        <ul class="list-unstyled settings-list m-t-10">
                                            <li>
                                                <label for="chat-sound">Chat Sound</label>
                                                <span class="float-right">
                                            <input type="checkbox" id="chat-sound" name="my-checkbox" checked>
                                        </span>
                                            </li>
                                            <li>
                                                <label for="noti-sound">Notification Sound</label>
                                                <span class="float-right">
                                            <input type="checkbox" id="noti-sound" name="my-checkbox">
                                        </span>
                                            </li>
                                            <li>
                                                <label for="remain">Remainder </label>
                                                <span class="float-right">
                                            <input type="checkbox" id="remain" name="my-checkbox" checked>
                                        </span>

                                            </li>
                                            <li>
                                                <label for="vol">Volume</label>
                                                <input type="range" id="vol" min="0" max="100" value="15">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
       
        vm.chartData();
    },
    methods: {
        changeDashbordDate(selectDate)
        {
            let vm=this;
            vm.selectedDashbordDate=selectDate;
            console.log('fdsfds');
            vm.getTotalSuppliedQuantityByBuyer(vm.selectedDashbordDate,vm.userData.userId);
            vm.getTotalRequestedQuantity(vm.selectedDashbordDate,vm.userData.userId);
            vm.getTotalApprovedQuantityByBuyer(vm.selectedDashbordDate,vm.userData.userId);
            vm.getBuyerDetailsById(vm.selectedDashbordDate,vm.userData.userId);
            vm.chartData();
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
                        
                   // });
                        vm.nominationData = nominationData;
                     }
                      if(response.data.code == 300){
                        toastr.error('No data available.', 'Live Feed', {timeOut: 5000});
                      }
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
                                'Approved Quantity',
                                'Supplied Quantity',
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
    destroyed: function() {

    }
}

</script>