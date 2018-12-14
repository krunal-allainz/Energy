<template>
    <!-- Modal -->
    <div class="modal fade" id="gcvAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document" >
          <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="gcvModalLabel"> Add Factor</h4>
                <button type="button" class="close text-right" data-dismiss="modal" aria-label="Close" @click="getClose()">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                  <div id="accordion">
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-md-3">
                                <label for="quantity " class="control-label float-right txt_media1">Factor :</label>
                            </div>
                            <div class="col-md-6">
                               <div class=" input-group">
                                <input type="text" class="form-control" id="quantity"  v-validate="'required|decimal:2'" v-model="gcv.quantity" name="quantity" >
                                 <div class="input-group-append">
                                    <span class="input-group-text ">MMBTU/Kg</span>
                                </div>

                              </div>
                               <span class="help is-danger" v-show="errors.has('quantity')">Please enter valid quantity.</span>
                          </div>
                        </div>
                    </div>
                  </div>
            </div>  
              <div class="modal-footer">
                  <button type="button" class="btn btn-primary" @click="saveGcv()">Save</button>
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
    data() {
        return {
          'gcv': {
            quantity:'',
          }  
                
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
        saveGcv(){
          var vm =this;
            vm.$validator.validateAll().then(() => {
              if (!this.errors.any()) {
                vm.$root.$emit('saveGcv',vm.gcv.quantity);
              }
            });
        }
    }
}

</script>