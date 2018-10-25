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
                                                   
                                                    <input v-model="forgotpwd.email" name="email" id="email" type="email" required autofocus placeholder="E-mail" v-validate="'required|email'"  class="form-control" />
                                                   <i v-show="errors.has('email')" class="fa fa-warning"></i>
                                                 <span class="help is-danger" v-show="errors.has('email')">{{ errors.first('email') }}</span>
                                                  <span id="responceMessage"></span>
                                                
                                            </div>
                                        </div>
                                      
                                        <div class="col text-center">
                                          <button class="btn btn-success text-center" type="button" @click="sendLink()">Send Link</button>
                                             
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
     $('#responceMessage').text('');
    import Auth from '../../services/auth';
    import User from '../../api/users.js';
    import Ls from '../../services/ls';
    import anime from 'animejs';

export default{
    
    name : "fongotpassword",
     data() {
        return {
            formstate : {},
            forgotpwd : {

                    email : ''
            }
        }
     },
     methods:{
        sendLink(){ 
         $('#responceMessage').text('');
            var vm = this;
            this.$validator.validateAll().then(
                (response) => {
                    if (!this.errors.any()) {
                        var email = this.forgotpwd.email;
                       
                        User.sendResetLinkInMail(email).then(
                            (response) => {
                             $('#responceMessage').text('');
                             var resetLink  = '';
                            if(response.data.status == 200) {
                                  var resetLink  =  response.data.link;
                                  var msg  = response.data.msg;
                                  alert('You just copied this link : ' + resetLink);
                                  toastr.success('Succesfully link send', 'Forgot password', {timeOut: 5000})
                                  $('#responceMessage').text(msg);
                            }else if(response.data.status == 404) {
                                 var msg  = 'Record not found';
                                 toastr.error('Record not found', 'Error', {timeOut: 5000});
                                 $('#responceMessage').text(msg);
                            } else{
                                var msg = '';
                                toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
                                 $('#responceMessage').text(msgs);
                            }

                        })
                    }
                    
                })
 
        }
     }
}
</script>