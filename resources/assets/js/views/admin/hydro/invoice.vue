<template>
	<div class="container invoice_page">
		<section class="content p-l-r-15" id="invoice-stmt">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-credit-card"></i> Invoice
                    </h3>
                    <span class="float-right">
                        <i class="fa fa-fw ti-angle-up clickable"></i>
                        <i class="fa fa-fw ti-close removecard"></i>
                    </span> 
                </div>

                <div class="card-body">
                    <div class="row">

                            <div class="col-md-6 col-sm-12 col-12 col-lg-6 col-xl-6 invoice_bg">
                                <h4><img src="assets/img/h_energylogo.png" alt="clear"/></h4>
                                <h4><strong>Billing Details:</strong></h4>
                                <address>
                                    Lewis Doe
                                    <br/> 6889 Lunette Street
                                    <br/> Melbourne,Austria
                                    <br/> <strong>Phone:</strong>12-345-678
                                    <br/> <strong>Mail Id:</strong> Adelle_Champlin@yahoo.com
                                </address>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12 col-lg-6 col-xl-6 invoice_bg text-right">
                                <div class="float-right">
                                    <h4><strong>#678956 / 25 Sep 2016</strong></h4>
                                    <h4><strong>Invoice Info:</strong></h4>
                                    <address>
                                        {{user}}
                                        <br/> 3946 Penn Street
                                        <br/> Ohio,USA
                                        <br/> <strong>Phone:</strong> 32-666-756
                                        <br/> <strong>Mail Id:</strong> {{email}}
                                    </address>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-condensed" id="customtable">
                                <thead>
                                <tr class="bg-primary">
                                    <th>
                                        <strong>Date</strong>
                                    </th>
                                    <th class="text-center">
                                        <strong>
                                           Supplied Quantity
                                        </strong>
                                    </th>
                                    <th>
                                        <strong>Rate</strong>
                                    </th>
                                     <th>
                                        <strong>Tax</strong>
                                    </th>
                                    <th></th>
                                    <th class="text-right">
                                        <strong>Total</strong>
                                    </th>
                                    <th class="text-center" id="add_row"><i class="fa fa-fw ti-plus"></i></th>
                                </tr>
                                </thead>
                                <tbody>

                                    <tr v-for="inv1 in invoice1">
                                        <td>{{inv1.date}}</td>
                                        <td class="text-center">{{inv1.supplied_quantity}}</td>
                                        <td>{{inv1.rate}}</td>
                                        <td>{{inv1.tax}}</td>
                                        <td></td>
                                        <td class="text-right">{{inv1.total_amount}}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="highrow text-center"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-right">
                                        <strong>
                                            Sub Total: &nbsp;
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable><span class="top tipso_style" title="Adjust" data-tipso="Here amount is deducted.">${{invoice1_subdata.sub_total}}</span></strong>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-right">
                                        <strong>
                                            Vat: &nbsp;
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable>${{invoice1_subdata.rate}}</strong>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow">
                                        <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                    </td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-right">
                                        <strong>
                                            Total: &nbsp;
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable>${{invoice1_subdata.total_all}}</strong>
                                    </td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </section>
    <section class="content p-l-r-15" id="invoice-stmt">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-credit-card"></i> Invoice
                    </h3>
                    <span class="float-right">
                        <i class="fa fa-fw ti-angle-up clickable"></i>
                        <i class="fa fa-fw ti-close removecard"></i>
                    </span> 
                </div>
                <div class="card-body">
                     <div class="row">

                            <div class="col-md-6 col-sm-12 col-12 col-lg-6 col-xl-6 invoice_bg">
                                <h4><img src="assets/img/h_energylogo.png" alt="clear"/></h4>
                                <h4><strong>Billing Details:</strong></h4>
                                <address>
                                    Lewis Doe
                                    <br/> 6889 Lunette Street
                                    <br/> Melbourne,Austria
                                    <br/> <strong>Phone:</strong>12-345-678
                                    <br/> <strong>Mail Id:</strong> Adelle_Champlin@yahoo.com
                                </address>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12 col-lg-6 col-xl-6 invoice_bg text-right">
                                <div class="float-right">
                                    <h4><strong>#678956 / 25 Sep 2016</strong></h4>
                                    <h4><strong>Invoice Info:</strong></h4>
                                    <address>
                                        {{user}}
                                        <br/> 3946 Penn Street
                                        <br/> Ohio,USA
                                        <br/> <strong>Phone:</strong> 32-666-756
                                        <br/> <strong>Mail Id:</strong> {{email}}
                                    </address>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-condensed" id="customtable">
                                <thead>
                                <tr class="bg-primary">
                                    <th>
                                        <strong>Date</strong>
                                    </th>
                                    <th class="text-center">
                                        <strong>
                                           Supplied Quantity
                                        </strong>
                                    </th>
                                    <th>
                                        <strong>Rate</strong>
                                    </th>
                                     <th>
                                        <strong>Tax</strong>
                                    </th>
                                    <th></th>
                                    <th class="text-right">
                                        <strong>Total</strong>
                                    </th>
                                    <th class="text-center" id="add_row"><i class="fa fa-fw ti-plus"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="inv2 in invoice2">
                                        <td>{{inv2.date}}</td>
                                        <td class="text-center">{{inv2.supplied_quantity}}</td>
                                        <td>{{inv2.rate}}</td>
                                        <td>{{inv2.tax}}</td>
                                        <td></td>
                                        <td class="text-right">{{inv2.total_amount}}</td>
                                        <td></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"></td>
                                    <td class="highrow text-right">
                                        <strong>
                                            Sub Total: &nbsp;
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable><span class="top tipso_style" data-tipso="Here amount is deducted.">${{invoice2_subdata.sub_total}}</span></strong>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-right">
                                        <strong>
                                            Vat: &nbsp;
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable>${{invoice2_subdata.rate}}</strong>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow">
                                        <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                    </td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-right">
                                        <strong>
                                            Total: &nbsp;
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable>${{invoice2_subdata.total_all}}</strong>
                                    </td>
                                    <td></td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </section>
	</div>

</template>

<script>

	import User from '../../../api/users.js';
    import myDatepicker from 'vue-datepicker';
    export default {
        data() {
            return {
                'email':this.$store.state.Users.userDetails.email,
                'user':this.$store.state.Users.userDetails.first_name,
                'user_id':this.$store.state.Users.userDetails.id,
                'currentYear': new Date().getFullYear(),
                'user_type':this.$store.state.Users.userDetails.user_type,
                'invoice1':{},
                'invoice1_subdata':{},
                'invoice2':{},
                'invoice2_subdata':{},
                } 
        },
        components: {
            'date-picker': myDatepicker,
        },
        mounted() {
            var vm = this;
           
           jQuery('.tipso_style').tipso({
                position: 'top',
                background: '#2574A9',
                useTitle: false,
            });
            $('.ls-select2').select2({
                placeholder: "Select"
            });
           vm.getInvoice1();
           vm.getInvoice2();
            
        },
        methods: {
            getInvoice1()
            {
                let vm=this;
                let userId=vm.user_id;
                User.getInvoiceList1(userId).then(
                     (response) => {
                    let inv1_arr = response.data.data.inv_arr;
                    vm.invoice1=inv1_arr;
                    vm.invoice1_subdata=response.data.data;
                    
                    },
                    (error) => {
                    },
                );
            },
            getInvoice2()
            {
                let vm=this;
                let userId=vm.user_id;
                 User.getInvoiceList2(userId).then(
                     (response) => {
                        let inv2_arr= response.data.data.inv_arr;
                        vm.invoice2=inv2_arr;
                        vm.invoice2_subdata=response.data.data;
                    },
                    (error) => {
                    },
                );
            },
           
        }
    }
</script>
<style>
.invoice_page .card-header{
    padding: 10px 15px;
}
.invoice_page .bg-primary {
    background-color: #6699cc !important;
}
</style>