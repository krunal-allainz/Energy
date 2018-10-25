<template>
    <div class="modal fade bg-modal-color refdel" id="confirm_modal" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog confirm-modal" role="document">
        <div class="modal-content">
            <form method="confirm" class="js-confirm-modal-form">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Patient Receipt</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body js-delete-confirmation-msg">{{deleteConfirmMsg}}</div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"  @click="confirmReceipt()">Cancel</button>
                    <button type="submit" class="btn btn-primary" @click.prevent="hideModal()">Confirm</button>
                </div>
                <input name="_method" value="DELETE" type="hidden" />
            </form>
        </div>
      </div>
    </div>
</template>
<script>
    export default  {
        data() {
            return {

                
            }
        },
        mounted(){
            var vm = this;
            $('.close').click(function(){
                $('#confirm_modal').modal('hide');
                vm.$router.push({'name':'opdreport'});
                return false;
            });
        },
        props: {
            deleteConfirmMsg: String
        },
        created() {
            
        },
        methods: {
            confirmReceipt() {
                let vm=this;
                vm.$root.$emit('confirmed',1);
            },
            hideModal() {
                let vm=this;
                $('#confirm_modal').modal('hide');
                vm.$router.push({'name':'opdreport'});
                return false;
            }
        }
    }
</script>
