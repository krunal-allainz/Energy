<template>
    <div>
        <!--First Table-->
        <div class="row">
            <div class="col-lg-12">
                 <div class="card bg-success-card">
            <h4 class="card-header">
               <div> User list {{getUserData.length}}</div>
            </h4>
          <div class="card-body">
            <div data-v-744e717e="" class="card p-3" v-if="getUserData.length>0">
              <div data-v-744e717e="" class="table-header">
                  <h4 data-v-744e717e="" class="table-title text-center mt-3"></h4>
              </div>

              <div data-v-744e717e="" class="table-responsive">
                <table data-v-744e717e="" class="table">
                  <thead data-v-744e717e="">
                    <tr data-v-744e717e="">
                        <th data-v-744e717e="" class="sortable" style="width: auto;">
                            #
                        </th>
                        <th data-v-744e717e="" class="sortable sorting-asc" style="width: 200px;">
                                First Name 
                        </th>
                        <th style="width: auto;">
                            Last Name
                             <i data-v-744e717e="" class="fa float-right"></i>
                         </th>
                         <th data-v-744e717e="" class="sortable" style="width: auto;">
                           Department
                            <i data-v-744e717e="" class="fa float-right"></i>
                        </th>
                        <th data-v-744e717e="" class="sortable" style="width: auto;">
                           Email Id
                            <i data-v-744e717e="" class="fa float-right"></i>
                        </th>
                        <th data-v-744e717e="" class="sortable" style="width: auto;">
                            Address
                            <i data-v-744e717e="" class="fa float-right"></i>
                        </th>
                        
                        <th data-v-744e717e="" class="sortable" style="width: auto;" >
                           Mobile No
                        </th>
                        <th data-v-744e717e="" class="sortable" style="width: auto;" >
                            Action
                            <i data-v-744e717e="" class="fa float-right"></i>
                        </th>
                    </tr>
                  </thead>
                  <tbody data-v-744e717e="">
                    <tr data-v-744e717e="" v-for="user in getUserData">
                      <td data-v-744e717e="" class="">
                        {{user.id}}
                      </td>
                      <td data-v-744e717e="" class="">
                        {{user.first_name }}
                      </td> <!---->
                      <td data-v-744e717e="" class="">
                       {{user.last_name }}
                      </td>
                      <td data-v-744e717e="" class="numeric">
                       {{user.department }}
                      </td> 
                      <td data-v-744e717e="" class="">
                        {{ user.email }}
                      </td>
                      <td data-v-744e717e="" class="text-uppercase">
                        {{ user.address}}
                      </td>
                      
                      <td data-v-744e717e="" class="" >
                       {{user.mobile_no}}
                      </td>
                      <td data-v-744e717e="" class="">
                        <a  :href="'/user/edit/'+user.id"> <i class="fa fa-pencil"  title="User edit"></i></a>
                                      <a > <i class="fa fa-trash"  title="User delete" @click="deleteUser(user.id)"  ></i></a>                    
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div data-v-744e717e="" class="table-footer">
                <div data-v-744e717e="" class="datatable-length float-left pl-3">
                  <span data-v-744e717e="">Rows per page:</span>
                    <select data-v-744e717e="" class="custom-select" id="perPageNo"  @change="setPerPage" v-model="perPage">
                    <option data-v-744e717e="" value="2">2</option>
                      <option data-v-744e717e="" value="5">5</option>
                      <option data-v-744e717e="" value="10">10</option>
                      <option data-v-744e717e="" value="20">20</option>
                      <option data-v-744e717e="" value="50">50</option>
                   <!--     <option data-v-744e717e="" value="-1">All</option> -->
                    </select> 
                     <div data-v-744e717e="" class="datatable-info  pb-2 mt-3" v-show="(pagination.total>0)">
                        <span data-v-744e717e="">Showing </span> {{pagination.current_page}} - {{pagination.to}} of {{pagination.total}}
                        <span data-v-744e717e="">records</span>
                    </div>
                </div>
               </div>
            </div>
            <div v-else>
              <h6 class="card-header">
               <div>No records available</div>
            </h6>
            </div>
          </div>
        </div>
            </div>
        </div>
    </div>
     </template>
<script>
    import User from '../../../api/users.js';
    import userDetailEdit from './userDetailEdit.vue'

    export default {
        data() {
            return {
                  'deleteConfirmMsg':'Are you sure you want to delete this user?',
                  'getUserData':{},
                  'pagination': {},
                   'perPage' : 5,
            }
        },
        mounted() {
            var vm = this;
            let pageUrl = 'user/getUserDetails/';
            let noOfPage = vm.perPage;
            vm.getAllUsers(pageUrl,noOfPage);
        },
        methods: {
            getAllUsers(pageUrl,noOfPage){
                var vm = this;
                var userData;
                  User.getAllUsersDetails(pageUrl,noOfPage).then(
                     (response)=>{
                            userData=response.data.data.data;
                            vm.getUserData = userData;
                            vm.makePagination(response.data.data);
                        },
                    (error)=>{
                     }
                );
            },
            deleteUser(userId){
                let vm = this;
                if(confirm(vm.deleteConfirmMsg))
                {
                    User.deleteUserById(userId).then(
                     (response) => {
                        if(response.data.code == 200){
                              toastr.success('User Delete successfully', 'Delete User', {timeOut: 5000});
                               let vm =this;
                               let pageUrl = 'user/getUserDetails/';
                               let noOfPage = vm.perPage;
                               vm.getAllUsers(pageUrl,noOfPage);
                        }
                     },
                     (error) => {

                     }
                );
                }
            },
            makePagination: function(data){
                     let pagination = {
                        current_page: data.current_page,
                        last_page: data.last_page,
                        next_page_url: data.next_page_url,
                        prev_page_url: data.prev_page_url,
                        total : data.total,
                        from : data.from,
                        to : data.to
                    }
                      this.pagination = pagination;
                 },
            setPerPage(e){
            let vm =this;
            let pageUrl = 'user/getUserDetails/';
            let noOfPage = vm.perPage;
            vm.getAllUsers(pageUrl,noOfPage);
            }
        }
    }
</script>
