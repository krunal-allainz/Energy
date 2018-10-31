<template>
  <body class="skin-default fixed-header">
    <div class="template-container">
        <header class="header">

              <nav class="navbar navbar-expand-lg navbar-light bg-white">

                <router-link :to="dashboardLink()" class="brand-main">
                      <img src="/assets/img/h_energylogo.png" id="logo-desk" alt="Hydrocarbon Accounting" class="hidden-sm-down">
                      <img src="/assets/img/h_energylogo.png" id="logo-mobile" alt="Hydrocarbon Accounting" class="hidden-md-up">
                  </router-link>
                  
                 
                  
                    <H1 class="text-blue bg-dark text-center mt-50">  Hydrocarbon Accounting<span style="float:right;margin-left:15px;margin-top: -10px;margin-bottom: 5px;">{{curDateTime}}</span></H1>
                  <!-- Sidebar toggle button -->
              </nav>
              <div>
               <a  href="#"  class="logout-text text-left back_nav" @click=backNavigate()><i class="fas fa-step-backward"></i>Back</a>
                <a href="#" class="logout-text text-right" @click.prevent="logout()"><i class="fa fa-sign-out"></i>Logout</a>
                  </div>
 
        </header>
    </div>

        <div class="dashboard">
          <div class="wrapper">
            <!-- <aside class="left-aside" >
              <left_side></left_side>
            </aside> -->
            <aside class="right-aside">
              <transition name="fade" mode="out-in">
                  <router-view></router-view>
              </transition>
            </aside>
          </div>
        </div>
        <site-footer></site-footer>
    </div>
  </body>
</template>

<script >

import SiteFooter from './partials/SiteFooter.vue';
import Auth from '../../services/auth';
import left_side from './left-side/default/left-side';
export default {
        components : {
             SiteFooter,
             left_side,

        },
        data(){
          return {
            // 'userType': '',
            curDateTime: '',
            'user_id' : this.$store.state.Users.userDetails.id,

          }
        },
        created: function() {
          this.$root.$on('logout',this.logout);
        },
        computed:{
          userType(){
            return  this.$store.state.Users.userDetails.user_type;
          }
        },
        mounted() {
          let vm = this;
          // setTimeout(function(){
          //   vm.userType = vm.$store.state.Users.userDetails.user_type;
          // },3000)
          //this.$store.dispatch('SetIpdId',0);
             
              var t = setInterval(function(){
               
               var today = new Date();
                var h = today.getHours();
                var m = today.getMinutes();
                var s = today.getSeconds();
                m = vm.checkTime(m);
                s = vm.checkTime(s);

                vm.curDateTime = h + ":" + m + ":" + s;
              }, 500);

        },
        methods:{
          checkTime(i){
            if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
              return i;
          },
          backNavigate(){
                // console.log(this.$router.currentRoute.name);
                if(this.$router.currentRoute.name != 'buyer-dashboard' && this.$router.currentRoute.name != 'seller-dashboard') {

                      this.$router.go(-1);
                }
          },
          dashboardLink(){
            if(this.userType == '7'){
              return '/seller-dashboard';
            } 
            else if(this.userType == '6') {
              return '/buyer-dashboard';
            }
          },
          logout(msg=''){
            let vm =this;
            Auth.logout().then(() => {
              if(msg!=''){
                toastr['error'](msg, 'Error');
                toastr['error']('You are redirected to login page', 'Error');
              } else{
                toastr['success']('Logged out!', 'Success');
              }
              $("body .js-loader").removeClass('d-none');

              setTimeout(function(){
                $("body .js-loader").addClass('d-none');
                vm.$router.replace('/login')
              },1000);
            })
          },
        }
  }
</script>
<style type="text/css" scoped>
.back_nav {
  float: left;
  margin: auto;
}
  
</style>
