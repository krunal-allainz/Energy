<template>
	<div class="modal fade bg-modal-color refdel" id="invoiceViewDisaply" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    	<div class="modal-dialog delete-modal" role="document">
        	<div class="modal-content">
              <!--   <div class="modal-header">
                    <h5 class="modal-title text-left" id="">
                    	Invoice
                    </h5>
                </div> -->
                <div class="modal-body" >
                    <div v-html="invoiceHtml"></div>
                   
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
            console.log(this.invoiceHtml,'tt');
             // setTimeout(function(){
             //     if(vm.buyer_id != ''){
             //         vm.loadList = true;  
             //    }
             //    },1000) ;
         },
         methods: {
            hideModal() {
                $('#invoiceViewDisaply').modal('hide')
                    return false
            },
        }
    }
</script>