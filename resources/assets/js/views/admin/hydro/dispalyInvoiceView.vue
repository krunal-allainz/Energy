<template>
	<div class="modal fade bg-modal-color refdel" id="invoiceViewDisaply" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    	<div class="modal-dialog delete-modal" role="document">
        	<div class="modal-content">
                <!-- <div class="modal-header">
                     <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-credit-card"></i> Invoice
                            </h3>
                            <span class="float-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removecard"></i>
                            </span> 
                         </div>
                </div> -->
                <div class="modal-body" >
                    <span v-html="invoicehtml"></span>
                   
                </div>
                 <div class="modal-footer">
                        <button type="button" class="btn btn-danger"  @click="hideModal()">close</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script >
    import User from '../../../api/users.js';
    export default {

        props:['invoicehtml'],
        data() {
            return {
                'html' : '',
                }
        },
         mounted() {
            let vm  =this;
           
         },
         filters:{
            dateFormate: function(date) {
            return moment(date).format('Y, MMM DD');
            }
        },
         methods: {
           
            hideModal() {
                 let vm  =this;
               
                $('#invoiceViewDisaply').modal('hide')
                    return false
            },
        }
    }
</script>