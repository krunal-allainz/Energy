<template>
  <div class="container">
    <div class="page-header">
      <div class="row">
        <div class="col-md-6">
        <h1>OPD Receipt List</h1>
        </div>
        
      </div>
    </div>
    <!-- jnmbnmb -->

    
      <div class="row">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Receipt No.</th>
              <th>Case No.</th>
              <th>Patient Name</th>
              <th>Doctor Name</th>
              <th>Admit Date</th>
              <th>Discharge Date</th>
              <th>Action</th>
              
            </tr>
          </thead>
          <tbody>
            <tr>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td></td>
               <td><button type="button" class="btn btn-success">Print</button>
                <button type="button" class="btn btn-danger">Delete</button></td>
              
            </tr>

          </tbody>
        </table>
      </div>
    
  </div>
</template>

<script >
  import User from '../../../api/users.js';
  import moment from 'moment';


</script>
