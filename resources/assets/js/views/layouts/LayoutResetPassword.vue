<template>
    <div class="container-fluid login">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-10 col-sm-8 mx-auto login-form">

                    <h2 class="text-center logo_h2">
                    
                      <img src="/assets/img/nabh_vins_logo.png" id="logo-desk" alt="NABH Logo" class="hidden-sm-down" height="80px" >

                    </h2>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form method="post">


                                    <div class="row">
                                        <div class="col-sm-12 mt-3 ">
                                            <div class="form-group">
                                                    <span id="responceMessage"></span>
                                                    <input v-model="forgotpwd.email" name="email" id="email" type="email" required autofocus placeholder="E-mail" v-validate="'required|email'"  class="form-control" />
                                                   <i v-show="errors.has('email')" class="fa fa-warning"></i>
                            <span class="help is-danger" v-show="errors.has('email')">{{ errors.first('email') }}</span>
                                                
                                            </div>
                                        </div>
                                      
                                       <div class="col-sm-12">
                                            <div class="form-group">
                                                    <input name="password" v-model="loginData.password" id="password" type="password" required placeholder="Password" v-validate="'required'"  class="form-control" minlength="6" maxlength="10" />
                                                    <span class="help is-danger" v-show="errors.has('password')">
                                                        Field is required
                                                    </span>
                                                
                                            </div>
                                        </div>
                                         <div class="col-sm-12">
                                            <div class="form-group">
                                                    <input name="cpassword" v-model="loginData.cpassword" id="cpassword" type="password" required placeholder="Conformation Password" v-validate="'required'"  class="form-control" minlength="6" maxlength="10" />
                                                    <span class="help is-danger" v-show="errors.has('cpassword')">
                                                        Field is required
                                                    </span>
                                                
                                            </div>
                                        </div>
                                        <div class="col text-center">
                                          <button class="btn btn-success text-center" type="button" @click="resetPassword()">Reset Password</button>
                                             
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

<script>

    import Auth from '../../services/auth';
    import User from '../../api/users.js';
    import Ls from '../../services/ls'
    
export default{
    
    name : "fongotpassword",
     data() {
        return {
            formstate : {},
            resetPassword : {

                    email : '',
                    password : '',
                    cpassword : ''
            }
        }
     },
     methods:{
        resetPassword(){ 
            var vm = this;
            this.$validator.validateAll().then(
                (response) => {
                    if (!this.errors.any()) {
                      
                      
                    }
                    
                })
 
        }
     }
}
</script>