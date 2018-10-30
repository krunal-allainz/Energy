<template>
	<div class="container">
	
		<form method="post" enctype="multipart/form-data">
            <invoiceListBuyer  :buyerId='buyer_id'></invoiceListBuyer>
		</form>
	</div>
</template>

<script>

	import User from '../../../api/users.js';
  	import moment from 'moment';
    import invoiceListBuyer from './invoiceListBuyer.vue' ; 

    export default {
        data() {
            return {
                   'buyer_id': this.$store.state.Users.userDetails.id,
                }
        },
        components: {
            invoiceListBuyer
        },
        mounted() {
            var vm = this;
        },
        methods: {
        }
    }
</script>