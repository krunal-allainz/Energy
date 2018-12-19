<template>
	<div class="container">
	
		<form method="post" enctype="multipart/form-data">
            <lngInvoiceListBuyer  :buyerId='buyer_id'></lngInvoiceListBuyer>
		</form>
	</div>
</template>

<script>

	import User from '../../../api/users.js';
  	import moment from 'moment';
    import lngInvoiceListBuyer from './lngInvoiceListBuyer.vue' ; 

    export default {
        data() {
            return {
                   'buyer_id': this.$store.state.Users.userDetails.id,
                }
        },
        components: {
            lngInvoiceListBuyer
        },
        mounted() {
            var vm = this;
        },
        methods: {
        }
    }
</script>