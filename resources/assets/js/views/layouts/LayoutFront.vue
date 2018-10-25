<template>
  <body class="skin-default fixed-header">
    <div class="template-container">
        <header class="header">

              <nav class="navbar navbar-expand-lg navbar-light">

                <router-link :to="dashboardLink()" class="brand-main">
                      <img src="/assets/img/logo.png" id="logo-desk" alt="Hydrocarbon Accounting" class="hidden-sm-down">
                      <img src="/assets/img/logo.png" id="logo-mobile" alt="Hydrocarbon Accounting" class="hidden-md-up">
                  </router-link>
                    <H1 class="text-white bg-dark text-center mt-50">  Hydrocarbon Accounting</H1>
                  <!-- Sidebar toggle button -->
              </nav>
                <a href="#" class="logout-text text-right" @click.prevent="logout()"><i class="fa fa-sign-out"></i>Logout</a>

                <ul class="action-list">
                  <li>
                   <!-- <router-link to="/login">Login</router-link> -->
                    </li>
                </ul>

        </header>
    </div>

        <div class="dashboard">
          <div class="wrapper">
            <aside class="left-aside" >
              <left_side></left_side>
            </aside>
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
        },
        methods:{
          dashboardLink(){
            if(this.userType == '1'){
              return '/';
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
              },3000);
            })
          },
        }
  }
</script>
