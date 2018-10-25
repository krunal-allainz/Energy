<!DOCTYPE html>
<html lang="en">
<head>
    <title>Vins Administration</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans:400,700" rel="stylesheet">
    <script src="/assets/js/core/pace.js"></script>
    <link href="{{mix('assets/css/laraspace.css')}}" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff"> 
    <style>
        #password-error {
            color: #ff3860;
        }
        #password-confirm-error{
            color: #ff3860;
        }
        #email-error{
            color: #ff3860;
        }
        #divCheckPasswordMatch{
            color: #1d771f;
        }
    </style>
</head>
<body class="login-page pace-done">

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
                                <form id="js-frm-resetpassword-activation" name="js-frm-resetpassword-activation" class="js-frm-resetpassword-activation" role="form" method="POST" action="{{ route('password.request') }}">

                                     {{ csrf_field() }}

                                    <div class="row">
                                        <div class="col-sm-12 mt-3 ">
                                            <div class="form-group">
                                                <input id="email" type="email" class="form-control" placeholder="Enter email" name="email" value="{{$_GET['email']}}" readonly="readonly">
                                            </div>
                                        </div>
                                       <div class="col-sm-12">
                                              <div class="form-group">
                                                <input id="password" type="password" class="form-control" placeholder="Password" name="password">
                                            </div>
                                       </div>
                                        <div class="col-sm-12">
                                             <div class="form-group">
                                                <input id="password-confirm" type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" onChange="checkPasswordMatch();">
                                            </div>
                                        </div>
                                         <div class="form-group" id="divCheckPasswordMatch"></div>
                                        <div class="col text-center">
                                              <button type="submit" id="addButton" class="btn btn-primary btn-success text-center">
                                            Reset password
                                             </button>
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


</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script type="text/javascript">
 function checkPasswordMatch() {
        var password = $("#password").val();
        var confirmPassword = $("#password-confirm").val();

        if (password != confirmPassword) {
            $("#divCheckPasswordMatch").html("");
            $("#addButton").html("Reset password");
        } else {
           // $("#divCheckPasswordMatch").html("Your password has been reset");
           // $("#addButton").html("Go to login page");
        }
    }

    $(document).ready(function () {
       $("#password-confirm").keyup(checkPasswordMatch);
    });

$("#js-frm-resetpassword-activation").validate({
  rules: {
        email: {
            required: true,
        },
        password: {
            required: true,
            minlength: 5
        },
        password_confirmation: {
            required: true,
            equalTo: "#password"
        },

    },
    messages: {
        password: {
            minlength: "Your password must be at least 5 characters long"
        },
        password_confirmation: {
            equalTo: "Passwords do not match"
        }
    },
      submitHandler: function(form) {
        form.submit();
      }
 });
</script>
</html>


