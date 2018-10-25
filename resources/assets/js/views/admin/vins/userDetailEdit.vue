<template>
	<div class="container">
		<div class="page-header">
			<div class="row">
				<div class="col-md-6">
				<h2>New User Form</h2>
				</div>
			</div>
		</div>
		<form method="post"> 
            <div class="row">
                <div class="col-md-12">
                        <div class="card-body">
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    <label for="firstName" class="control-label float-right txt_media1">First Name :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="firstName"
                                               placeholder="First Name" v-validate="'required|alpha_spaces'" v-model="userData.fName" name="firstName">
                                        <i v-show="errors.has('firstName')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('firstName')">Please enter valid first name.</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    <label for="lastName" class="control-label float-right txt_media1">Last Name :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="lastName" name="lastName" v-validate="'required|alpha_spaces'" placeholder="Last Name" v-model="userData.lName">
                                        <i v-show="errors.has('lastName')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('lastName')">Please enter valid last name.</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    <label for="userType" class="control-label float-right txt_media1">User Type :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <select class="form-control ls-select2" id="userType" v-model="userData.userType" name="userType" v-validate="'required'">
                                            <option :value="type.id" v-for="type in userData.userTypeOption">{{type.name}}</option>
                                        </select> 
                                        <i v-show="errors.has('userType')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('userType')">Please select User type.</span>
                                    </div>
                                </div>
                                <div class="row form-group" v-if="userData.userType == 1" >
                                    <div class="col-md-3">
                                    <label for="department " class="control-label float-right txt_media1">Department :</label>
                                    </div>
                                    <div class="col-md-9">
                                         <select class="form-control ls-select2" id="department" name="department" v-model="userData.department" v-validate="'required'">
                                            <option :value="dept.text" v-for="dept in userData.departmentOption">{{dept.text}}</option>
                                        </select> 
                                        <i v-show="errors.has('department')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('department')">Please select Department.</span>
                                    </div>
                                </div>
                                 <div class="row form-group" v-if="userData.userType == 1">
                                    <div class="col-md-3">
                                    <label for="dagree" class="control-label float-right txt_media1">Dagree:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="dagree" name="dagree" v-validate="'required'" placeholder="Dagree" v-model="userData.dagree">
                                        <i v-show="errors.has('dagree')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('dagree')">Please enter valid dagree.</span>
                                    </div>
                                </div>
                                <div class="row form-group" v-if="userData.userType == 1">
                                    <div class="col-md-3">
                                    <label for="ragNo" class="control-label float-right txt_media1">Reg no:</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="regNo" name="regNo" v-validate="'required'" placeholder="RegNo" v-model="userData.regNo">
                                        <i v-show="errors.has('regNo')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('regNo')">Please enter valid Register No.</span>
                                    </div>
                                </div>
                                <div class="row form-group" v-if="userData.userType == 1">
                                    <div class="col-md-3">
                                     <label for="signature" class="control-label float-right txt_media1">Signature:</label>
                                    </div>
                                    <div class="col-md-9"  v-if="!userData.signaturefile">
                                       
                                    <input id="signature" name="signature" type="file" multiple class="btn btn-info  "  @change="previewFile" accept="image/*" > 
                                        <i v-show="errors.has('signature')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('signature')">Please enter valid Signature.</span>
                                    </div>
                                    <div v-else>
                                          <img :src="userData.signaturefile" />
                                            <i class="fa fa-trash" @click="removeImage">Remove image</i>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    <label for="email" class="control-label float-right txt_media1">Email Id :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" v-model="userData.email" v-validate="'required|email'" @input="checkExistUser('email')" disabled="" >
                                        <i v-show="errors.has('email')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('email')">Please enter valid email.</span>
                                         <span class="help is-danger" v-show="userEmailExist != ''">{{userEmailExist}}</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    <label for="mobileNo" class="control-label float-right txt_media1">Mobile No :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" id="mobileNo" placeholder="Mobile Number" v-model="userData.mobileNo" v-validate="'numeric|min:10|max:10'" name="mobileNo" maxlength="10" @input="checkExistUser('mobile_no')">
                                        <i v-show="errors.has('mobileNo')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('mobileNo')">Please enter valid mobile number.</span>
                                         <span class="help is-danger" v-show="userMobileExist != ''">{{userMobileExist}}</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    <label for="address" class="control-label float-right txt_media1">Address :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea rows="3" class="form-control" id="address" v-model="userData.address">
                                        </textarea>
                                    </div>
                                </div>
                                 <div class="row form-group" v-if="(user_type != 4)">
                                    <div class="col-md-3">
                                    <label for="password" class="control-label float-right txt_media1">Password :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" v-validate="'min:6'" v-model="userData.password">
                                       <!--  <i v-show="errors.has('password')" class="fa fa-warning"></i>
                                         <span class="help is-danger" v-show="errors.has('password')">Please enter valid password.</span> -->
                                    </div>
                                </div>
                                <div class="row form-group" v-if="(user_type != 4)">
                                    <div class="col-md-3">
                                    <label for="confirmPassword" class="control-label float-right txt_media1">Confirm Password :</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control" id="confirmPassword" placeholder="Confirm Password" v-validate="'confirmed:password'" name="confirmPassword" v-model="userData.confirmPassword">
                                        <i v-show="errors.has('confirmPassword')" class="fa fa-warning"></i>
                                        <span class="help is-danger" v-show="errors.has('confirmPassword')">Confirm password didn't match.</span>
                                    </div>
                                </div>
                               <!-- <div class="row form-group">
				                    <div class="col-md-3">
				                        <label class="control-label float-right txt_media1" for="uploadImage">
				                            Select File :</label>
				                    </div>
				                    <div class="col-md-9">
				                        <input id="uploadImage" type="file" accept="image/*" class="file-loading">
				                    </div>
				         	  </div> -->
                                <div class="row form-group">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-9">
                                        <button class="btn btn-success" type="button" @click="validateBeforeSubmit()">Update</button>
                                    </div>
                                </div>
                        </div>
                </div>
            </div>
      
        </form>
	</div>
</template>

<script>
/*if(localStorage.getItem("user_add"))
    {
        toastr.success('User has been added successfully', 'Add User', {timeOut: 5000});
        localStorage.removeItem("user_add");
        //localStorage.clear();
    }*/
	import User from '../../../api/users.js';

    export default {
        data() {
            return {
                    'login_user_id' :this.$store.state.Users.userDetails.id,
                    'user_type' :this.$store.state.Users.userDetails.user_type,
            		'edituserId' : this.$route.params.id,
                    'userData' : {
                            	'fName':'',
                            	'lName': '',
                            	'email': '',
                            	'password': '',
                                'confirmPassword':'',
                            	'mobileNo': '',
                            	'address': '',
                                'userTypeOption':'',
                                'userType': '',
                                'departmentOption':[{text:'Neurology'},
                                              {text:'Neurosurgery'},
                                              {text:'Cardiology'},
                                              {text:'Vascular'},
                                              {text:'ONCO'},
                                              {text:'Ortho'},
                                              {text:'Others'}
                                            ],
                                'department':'',
                                'dagree':'',
                                'regNo':'',
                                'signaturefile' : {},
                           // 	'userIamge': ''
                    },
                    'userEmailExist' : '',
                    'userMobileExist' : ''
                }
        },
        mounted() {
            var vm = this;
            let user_type = [] ;
             if(vm.$store.state.Users.userDetails.user_type != '4'){
                if(vm.edituserId != vm.login_user_id)
                {
                    vm.$root.$emit('logout','You are not authorise to access this page'); 
                }
             }
            //setTimeout(function(){
                $('.ls-select2').select2({
                    placeholder: "Select"
                });
                vm.getUserDetail(vm.edituserId);
                User.getUserTypesList().then(
                     (response) => {
                    $.each(response.data.data, function(key,value) {

                       user_type.push({
                         'id' : value.id,
                         'name' : value.name,
                      });
                    });

                    vm.userData.userTypeOption=user_type;
                    
                  },
                      (error) => {
                  },
                );
                  $('#userType').on('select2:selecting', function(e) {
                    vm.userData.userType =  e.params.args.data.id;
                    if(e.params.args.data.id==1)
                    {
                        setTimeout(function(){
                            $('#department').select2({
                              placeholder: "Select",
                              tags:false 
                            }); 
                            $('#department').on('select2:selecting', function(e) {
                                vm.userData.department =  e.params.args.data.text;
                            });
                         },500);
                    }
                  });
                  
            //},200);

        },
        methods: {
           previewFile(e){
                 let vm =this;
                var imgData = [];
                var files = e.target.files || e.dataTransfer.files;
                    if (files.length > 0)
                    { 
                          this.createImage(files[0]);
                    }else{

                    return;
                    }
                    
            },
            createImage(file) {

                  var image = new Image();
                  var reader = new FileReader();
                  var vm = this;

                  reader.onload = (e) => {
                    vm.userData.signaturefile = e.target.result;
                  };
                  reader.readAsDataURL(file);
            },
             removeImage: function (e) {
                 this.userData.signaturefile = '';
             },
           getUserDetail(userId){
           	let vm = this;
           		User.getUserDetailByUserId(userId).then(
           			 (responce) => {

           			 	if(responce.data.code == 200){
           			 		 vm.userData.fName = responce.data.data.first_name;
               				 vm.userData.lName = responce.data.data.last_name;
                			 vm.userData.email =responce.data.data.email;
                			 vm.userData.password='';
                			 vm.userData.confirmPassword='';
                			 vm.userData.mobileNo =responce.data.data.mobile_no;
                            vm.userData.address =responce.data.data.address;
                            vm.userData.department =responce.data.data.department;
                            setTimeout(function(){
                                $('#department').select2({
                                  placeholder: "Select",
                                  tags:false 
                                });
                            },200);
                        $('#department').val(responce.data.data.department).trigger('change.select2');
                        vm.userData.userType = responce.data.data.user_type;
                        vm.$data.userData.dagree =responce.data.data.dagree;
                        vm.$data.userData.regNo =responce.data.data.RegNo;
                        vm.$data.userData.signaturefile =responce.data.data.signature_path;
                         setTimeout(function(){
                            $('#userType').val(responce.data.data.user_type).trigger('change');
                         },500);
                             
           			 	}
           			 },
           			 (error) => {

           			 }    

           			);
           },
            checkExistUser(type){ 
                let vm = this;
                if(type == 'email'){
                    var value = vm.userData.email;
                }else{
                    var value = vm.userData.mobileNo;
                }

                 User.checkExistUser(type,value).then(
                    (responce) => {
                        if(responce.data > 0){
                              if(type == 'email'){
                                 vm.userEmailExist = 'Email already exist';
                                }else{
                                    vm.userMobileExist = 'Mobile no already exist';
                                }
                              
                             }else{
                                    vm.userEmailExist ='';
                                    vm.userMobileExist = '';
                                    
                             }
                    },
                    (error) => {

                    }

                 );

             
            },
            validateBeforeSubmit() {
               
                this.$validator.validateAll().then(() => {
                    
                    if (!this.errors.any()) {
                    // if(this.$data.userData.id=="") {
                                // here we add code for Mobile user for create user
                                User.editUser(this.userData,this.edituserId).then(
                                  (response)=> {
                                    //console.log(response);
                                    if(response.data.code == 200){
                                      
                                       //  window.location.href = 'userList';
                                           toastr.success('User update successfully', 'Update User', {timeOut: 5000});
                                       //  router.push('userList');
                                      //  this.initialState();
                                        //localStorage.setItem("user_add",1)
                                       // window.location.reload();
                                    } else if (response.data.code == 301) {
                                        //this.initialState();
                                        toastr.error('User already exist.', 'edit User', {timeOut: 5000});

                                    }
                                    // this.$router.push('dashboard');
                                  },
                                  (error)=>{
                                  }

                                )
                        // }
                    }
                })
            }
        }
    }
</script>