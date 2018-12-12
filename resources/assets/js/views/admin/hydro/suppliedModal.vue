<template>
    <!-- Modal -->
    <div class="modal fade" id="suppliedModalId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document" >
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel"> Allocated Nomination Detail</h4>
                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close" @click="getClose()">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                  <div id="accordion">
                    <div class="">
                        <div class="col-md-12" v-if="tableData.length>0">
                           <card title="<i class='ti-layout-cta-left'></i> Allocation Details"  class="filterable">
                             <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Date</th>
                                        <th>Buyer Name</th>
                                        <th>Requested Quantity</th>
                                        <th>Approved Quantity</th>
                                        <th>Allocated Quantity</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                      <tr v-for="(res, index) in tableData">
                                          <td>{{++index}}</td>
                                           <td>{{res.date}}</td>
                                          <td class="text-uppercase">{{res.buyer_name}}</td>
                                          <td class="text-uppercase">{{res.quantity_required}}</td>
                                          <td class="text-uppercase">{{res.approved_quantity}}</td>
                                          <td class="text-uppercase">{{res.supplied_quantity}}</td>
                                      </tr>
                                    </tbody>
                                </table>
                              </div>
                            </card>
                        </div>
                    </div>
                  </div>
            </div>  
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="getClose()">Close</button>
              </div>
              
          </div>
      </div>

  </div>
		
    </section>
</template>
	
<script >
    import User from '../../../api/users.js';
    import moment from 'moment';
    import card from "../vins/card.vue";
    
export default {
    name: "",
    props: ['tableData'],
    data() {
        return {
            
                
        }
    },
    components: {
          card  
    },
    created: function(){
        
    },
    mounted: function() {
        
        let vm = this;
        
        
    },
    methods: {
        getClose()
        {
          var vm =this;
          vm.$root.$emit('close_modal');
        },
    }
}

</script>