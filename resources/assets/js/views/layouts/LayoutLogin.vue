<template>
    <div class="container-fluid login">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-10 col-sm-8 mx-auto login-form">

                    <h2 class="text-center logo_h2">
                    
                        <img src="/assets/img/h_energylogo.png" id="logo-desk" alt="Hydrocarbon Accounting" class="hidden-sm-down" >
                    </h2>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-sm-12 mt-3">
                                            <div class="form-group">
                                                    <input v-model="loginData.email" name="email" id="email" type="email" required autofocus placeholder="E-mail" v-validate="'required'"  class="form-control"  @keyup.enter="signInUser"/>
                                                   <span class="help is-danger" v-show="errors.has('email')">
                                                        Field is required
                                                    </span>
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                    <input name="password" v-model="loginData.password" id="password" type="password" required placeholder="Password" v-validate="'required'"  class="form-control" minlength="6" maxlength="10" @keyup.enter="signInUser" />
                                                    <span class="help is-danger" v-show="errors.has('password')">
                                                        Field is required
                                                    </span>
                                                
                                            <div class="col-sm-12 mt-3">
                                                    <input name="landing_page" v-model="loginData.landing_page" id="rlng_dashboard"  value="rlng_dashboard" type="radio" :checked="loginData.landing_page == 'rlng_dashboard'"   />&nbsp; R-Lng 
                                                    <input name="landing_page" v-model="loginData.landing_page" id="truck_dashboard"  value="truck_dashboard"  :checked="loginData.landing_page == 'truck_dashboard'"   type="radio"  />&nbsp; Truck loading 
                                            </div>        
                                                
                                            </div>
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-success text-center" type="button" @click="signInUser()">Sign in</button>
                                            
                                        </div>

                                            
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script >
    import Auth from '../../services/auth';
    import User from '../../api/users.js';
    import Ls from '../../services/ls'
export default {
    name: "login",
    data() {
        return {
            formstate: {},
           loginData: {
                    email: '',
                    password: '',
                    remember: '',
                    forgotpassword: 0,
                    landing_page:'truck_dashboard'
                }
        }
    },
    methods: {
        signInUser() {
            var vm = this;
            this.$validator.validateAll().then(
                (response) => {
                    jQuery('.js-loader').removeClass('d-none');
                // this.$validator.validateAll();
                if (!this.errors.any()) {(
                    Auth.login(this.loginData).then((response) => {
                        //console.log(response,'response');
                        // return false;
                        if(response == 'success'){
                            Auth.check().then((res) => {
                                var userId = Ls.get('userId');
                                vm.$store.dispatch('SetUserDetailsData',userId);
                                vm.$store.dispatch('setDashboardType',vm.loginData.landing_page);
                                
                            })
                            setTimeout(function(){
                                jQuery('.js-loader').addClass('d-none');
                                if(vm.$store.state.Users.userDetails.user_type == '3'){
                                    if(vm.loginData.landing_page = 'truck_dashboard'){
                                        vm.$router.push({'name':'seller-v2-dashboard'});

                                    } else {

                                        vm.$router.push({'name':'seller-dashboard'});
                                    }
                                }else if(vm.$store.state.Users.userDetails.user_type ==  '2') {
                                     if(vm.loginData.landing_page = 'truck_dashboard'){
                                        vm.$router.push({'name':'buyer-v2-dashboard'});

                                    } else {
                                        vm.$router.push({'name':'buyer-dashboard'});
                                    }
                                }
                                else
                                {
                                    if(vm.loginData.landing_page = 'truck_dashboard'){
                                        vm.$router.push({'name':'buyer-v2-dashboard'});
                                    } else {
                                        vm.$router.push({'name':'buyer-dashboard'});
                                    }
                                   
                                }

                            },2000)    
                        }else {
                            jQuery('.js-loader').addClass('d-none');

                        }
                    })
                )}
                else {
                    jQuery('.js-loader').addClass('d-none');
                    toastr.error('Please enter email and password.', 'Login error', {timeOut: 5000});
                }
            });
        },
        GetSelectComponent(comp) {
         this.$router.push({name: comp})

        }

    },
    mounted: function() {
        Auth.logout().then(() => {
            this.$router.replace('/login')
        })
        

    },
       
    destroyed: function() {

    }
}
</script>