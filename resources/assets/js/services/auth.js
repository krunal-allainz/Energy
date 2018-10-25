import Ls from './ls'

export default {

    login(loginData){
        var vm =this;
        return axios.post('/api/auth/login', loginData).then(response =>  {
            Ls.set('auth.token',response.data.token)
            // We set Email Over here
            Ls.set('email',loginData.email);
            return "success";

        }).catch(error => {
            if (error.response.status == 401) {
                toastr['error']('Invalid credentials', 'Error');
                Ls.remove('auth.token')
                Ls.remove('email');
                return "error";
            }
            else {
                return "error";
                
                // Something happened in setting up the request that triggered an Error
            }
        });

    },

    logout(){
        return axios.get('/api/auth/logout').then(response =>  {
            Ls.remove('auth.token')
            Ls.remove('email')
            Ls.remove('vuex')
            Ls.remove('userData')
            // here we have to reload the page
        }).catch(error => {
        });
        // Reload
    },
    check(){
         $("body .js-loader").removeClass('d-none');
        return axios.get('/api/auth/check').then(response =>  {
             $("body .js-loader").addClass('d-none');
            if(response.data.authenticated == false) {

              if(response.data.message != undefined) {
                toastr['error'](response.data.message, 'Error');
              }
            } else {
                Ls.set('userId',response.data.userData.id);
                 // this.$store.dispatch('SetUserDetailsData',response.data.userData.id);
            }

            return !!response.data.authenticated;
        }).catch(error => {
             $("body .js-loader").addClass('d-none');
            
        });
    },

}
