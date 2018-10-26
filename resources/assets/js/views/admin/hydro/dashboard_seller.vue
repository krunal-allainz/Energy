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
                    <div class="widget-bg-color-icon card-box back">
                        <div class="text-center">
                    	    <span id="loadspark-chart"></span>
                        		<hr><p>Check summary</p>
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
                    <div class="widget-bg-color-icon card-box back">
                        <div class="text-center">
                        <span class="linechart" id="salesspark-chart"></span>
                    		<hr><p>Check summary</p>
                        </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-xl-3">
            <div class="flip">
                <div class="widget-bg-color-icon card-box front">
            	    <div class="bg-icon float-left">
                        <i class="ti-thumb-up text-danger"></i>
                    </div>
                	<div class="text-right">
                		<h3 class="text-dark"><b>1532</b></h3>
                		<p>Hits</p>
                	</div>
                    <div class="clearfix"></div>
                </div>
                <div class="widget-bg-color-icon card-box back">
                    <div class="text-center">
                	    <span id="visitsspark-chart"></span>
                        <hr><p>Check summary</p>
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
                    <div class="widget-bg-color-icon card-box back">
                        <div class="text-center">
                            <span id="subscribers-chart"></span>
                            <hr>
                            <p>Check summary</p>
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
                    <div class="row">
                        <div class="col-xl-12 col-lg-6 col-sm-6">
                            <div class="card personal-chat">
                                <div class="card-header">
                                    <div class="card-title"><img class="chat-image rounded-circle float-left" height="36"
                                                                  width="36"
                                                                  src="img/authors/avatar5.jpg" alt="avatar-image">
                                        <div class="header-elements">Wilton zeph
                                            <br>
                                            <small class="status"><b>Online</b></small>

                                            <div class="float-right options">
                                                <div class="btn-group">
                                                <span class="toggle-dropdown" data-toggle="dropdown"
                                                      aria-expanded="false" aria-haspopup="true" role="menu">
                                                    <i class="ti-clip attachment"></i>
                                                </span>
                                                    <ul class="dropdown-menu dropdown-menu-right position_dropdown">
                                                        <li class="dropdown-item"><a href="#"><i class="ti-file text-primary"></i>Document</a>
                                                        </li>
                                                        <li class="dropdown-item"><a href="#"><i
                                                                class="ti-gallery text-primary"></i>Gallery</a>
                                                        </li>
                                                        <li class="dropdown-item"><a href="#"><i class="ti-location-arrow text-primary"></i>Location</a>
                                                        </li>
                                                        <li class="dropdown-item"><a href="#"><i class="ti-camera text-primary"></i>Camera</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="btn-group">
                                                <span class="toggle-dropdown" data-toggle="dropdown"
                                                      aria-expanded="false" aria-haspopup="true" role="menu">
                                                    <i class="ti-more-alt more"></i>
                                                </span>
                                                    <ul class="dropdown-menu dropdown-menu-right">
                                                        <li><a href="#">Profile</a>
                                                        </li>
                                                        <li><a href="#">Media</a>
                                                        </li>
                                                        <li><a href="#">Mute</a>
                                                        </li>
                                                        <li><a href="#">More</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!--</div>-->
                                    <div class="chat-conversation">
                                        <ul class="conversation-list">
                                            <li class="clearfix odd conversers1">

                                                <div class="conversation-text">
                                                    <div class="ctext-wrap m-t-10">
                                                        <p class="text-left">
                                                            Hello Wilton, are the review papers ready?
                                                            <i class="text-right">8:31 pm</i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix  m-t-10 conversers2">
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <p>
                                                            Not yet, it will take a bit of time for you to get them.
                                                            <br><i class="text-right">8:31 pm</i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix odd m-t-10 conversers1">
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <p class="text-left">
                                                            Treat this on urgent Basis.
                                                            <i class="text-right">8:33 pm</i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix  m-t-10 conversers2">
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <p>
                                                            I will make it as early as possible.
                                                            <br><i class="text-right">8:34 pm</i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix odd m-t-10 conversers1">
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <p class="text-left">
                                                            Okay.
                                                            <i class="text-right">8:35 pm</i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="clearfix m-t-10 conversers2">
                                                <div class="conversation-text">
                                                    <div class="ctext-wrap">
                                                        <p>
                                                            If there is anything else..
                                                            <br><i class="text-right">8:35 pm</i>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <form id="main_input_box">
                                            <div class="row">
                                                <div class="col-12 m-b-15">
                                                    <div class="input-group text-field">
                                                        <input type="search"
                                                               class="form-control chat-input custom_textbox"
                                                               id="custom_textbox" placeholder="Type a message"
                                                               required>
                                                        <span class="input-group-btn">
                                                    <button class="btn btn-success send-btn"
                                                            type="submit"><i
                                                            class="menu-icon ti-location-arrow text-white"></i></button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
</template>
	
<script >
    import User from '../../../api/users.js';
    import moment from 'moment';
    import Chart from 'chart.js';
    import timeline from './timeline.vue';

export default {
    name: "dashboardSeller",
    data() {
        return {
            formstate: {},
                'userData' : {
                    'userType' : this.$store.state.Users.userDetails.user_type,
                    'userId' : this.$store.state.Users.userDetails.id,
                }
        }
    },
    methods: {
       getBuyerDetails(){
            let curDate = moment().format('DD-MM-YYYY');
            let nData = {'date':curDate};
            User.getNominationDetailsByDate(curDate).then(
                 (response) => {
                    console.log('response',response);
                    return false;
                    let consult_data  = response.data.data;
                    $.each(consult_data, function(key, value) {
                        let name =  value.first_name ;
                        let id  = value.id ;
                        consult_list.push({text:name, id:id});
                    });
                    vm.nominationData.seller_option=consult_list;
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

    },
    components: {
            timeline
    },
    mounted: function() {
        this.getBuyerDetails();
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };                    
        var ctx1 = document.getElementById("myChart").getContext('2d');
        var ctx2 = document.getElementById("cSupply").getContext('2d');
        var config1 = {
            type: 'bar',
            data: {
                datasets: [
                {
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                    ],
                    backgroundColor: [
                        '#ff0000',
                        '#00ff40',
                        '#0040ff',
                        '#ff6600',
                        '#ffff00',
                    ],
                    label: 'Dataset 1'
                },
                {
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                    ],
                    backgroundColor: [
                        '#ff0000',
                        '#00ff40',
                        '#0040ff',
                        '#ff6600',
                        '#ffff00',
                    ],
                    label: 'Dataset 2'
                },
                {
                    data: [
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                        randomScalingFactor(),
                    ],
                    backgroundColor: [
                        '#ff0000',
                        '#00ff40',
                        '#0040ff',
                        '#ff6600',
                        '#ffff00',
                    ],
                    label: 'Dataset 3'
                },
                ],
                labels: [
                    'Red',
                    'Green',
                    'Blue',
                    'Orange',
                    'Yellow'
                ]
            },
            options: {
                responsive: true
            }
        };
       
        var config2 = {
            type: 'pie',
            data: {
                datasets: [{
                    data: [0,100],
                    backgroundColor: [
                        '#ff0000',
                        '#00ff40',
                        
                    ],
                    label: 'Dataset 1'
                }],
                labels: [
                    'Supplied',
                    'Remaining',
                ]
            },
            options: {
                responsive: true
            }
        };
        window.myPie1 = new Chart(ctx1, config1);
        window.myPie2 = new Chart(ctx2, config2);
        setInterval(function(){
            config1.data.datasets.forEach(function(dataset) {
                dataset.data = dataset.data.map(function() {
                    return randomScalingFactor();
                });
            });
            //  config2.data.datasets.forEach(function(dataset) {
            //     dataset.data = dataset.data.map(function() {
            //         return randomScalingFactor();
            //     });   
            // });
            console.log(config2.data.datasets[0].data[0]);
            if(config2.data.datasets[0].data[0] <100){

             config2.data.datasets[0].data[0] = config2.data.datasets[0].data[0] +1;
             config2.data.datasets[0].data[1] = 100 -config2.data.datasets[0].data[0]; 
            }
            window.myPie1.update();
            window.myPie2.update();
        },2000)



    },
       
    destroyed: function() {

    }
}

</script>