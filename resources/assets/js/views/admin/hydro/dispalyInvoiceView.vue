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
                    <span v-html="invoiceHtml"></span>
                   
                </div>
                 <div class="modal-footer">
                        <button type="button" class="btn btn-danger"  @click="hideModal()">close</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script >
    export default {

        props:['invoiceHtml'],
        data() {
            return {
                }
        },
         mounted() {
         },
         methods: {
            hideModal() {
                $('#invoiceViewDisaply').modal('hide')
                    return false
            },
        }
    }
</script>