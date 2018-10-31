<template>
	<div class="container invoice_page">
		<section class="content p-l-r-15" id="invoice-stmt"  v-for="invData,index in invoiceData">
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

                <div class="card-body" id="invoiceViewGet">
                    <div class="row">

                            <div class="col-md-6 col-sm-12 col-12 col-lg-6 col-xl-6 invoice_bg">
                                <h4><img src="/assets/img/h_energylogo.png" alt="clear"/></h4>
                                <h4><strong>Billing Details:</strong></h4>
                                 <address>
                                        {{user}}
                                        <br/> {{address}}
                                        <br/> <strong>Phone:</strong> {{phoneno}}
                                        <br/> <strong>Mail Id:</strong> {{email}}
                                    </address>
                            </div>
                            <div class="col-md-6 col-sm-12 col-12 col-lg-6 col-xl-6 invoice_bg text-right">
                                <div class="float-right">
                                    <h4><strong>{{invData.invoice_no}} / {{invData.date | dateFormate}}</strong></h4>
                                    <h4><strong>Invoice Info:</strong></h4>
                                    <address>
                                        {{buyerData.name}}
                                        <br/>  {{buyerData.address}}
                                        <br/> <strong>Phone:</strong> <span v-if="(buyerData.mobileno != '')">{{buyerData.mobileno}}</span>
                                        <br/> <strong>Mail Id:</strong> <span v-if="(buyerData.email != '')">{{buyerData.email}}</span>
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
                                    <th class="text-center">
                                        <strong>Date</strong>
                                    </th>
                                    <th class="text-center" colspan="3" >
                                        <strong>
                                           Supplied Quantity
                                        </strong>
                                    </th>
                                     <th colspan="2" class="text-right">
                                        <strong>Price</strong>
                                    </th>
                                   <!--  <th>
                                        <strong>Rate</strong>
                                    </th>
                                     <th>
                                        <strong>Tax</strong>
                                    </th> -->
                                   
                                    <th class="text-right">
                                        <strong>Total</strong>
                                    </th>
                                    <!-- <th class="text-center" id="add_row"><i class="fa fa-fw ti-plus"></i></th> -->
                                </tr>
                                </thead>
                                <tbody>

                                    <tr  v-for="request in requestList[index + 1]">
                                        <td class="text-center">{{request.date}}</td>
                                        <td class="text-center" colspan="3">{{request.supplied_Qty}}</td>
                                       
                                         <td colspan="2" class="text-right">{{agreementData.price}}</td>
                                        <td class="text-right">{{request.supplied_Qty * agreementData.price}}</td>
                                        

                                    </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td class="highrow text-center"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                     <td></td>
                                    <td class="highrow text-right">
                                        <strong>
                                            Sub Total: &nbsp;
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable><span class="top tipso_style" title="Sub Total" data-tipso="Here amount total charge.">${{invData.sub_amount}}</span></strong>
                                    </td>
                                   
                                </tr>
                                 <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                      <td></td>
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-right">
                                        <strong>
                                            <span v-if="(agreementData.paneltyType == 'fuel')">Fuel</span><span v-if="(agreementData.paneltyType == 'company_work_loas')">Less Working Hours</span>: &nbsp;
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable>  - <span class="top tipso_style" title="Panelty Define In Agreement" data-tipso="Here amount is deducted."> ${{ agreementData.panelty}}</span></strong>
                                    </td>
                                  
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                       <td></td>
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-right">
                                        <strong>
                                            {{agreementData.taxType}} : &nbsp; ( %{{agreementData.taxRate}})  &nbsp;
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable>  +  ${{invData.tax_rate_amount_cal}}</strong>
                                    </td>
                                 
                                </tr>
                                <tr>
                                    <td class="emptyrow">
                                        <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                    </td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td></td>
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-right">
                                        <strong>
                                            Total: &nbsp;
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable>${{invData.total_amount}}</strong>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
            </div>
              <form><div class="text-right"><button type="button" class="btn btn-info" @click="generateInvoice(index,buyerId)">Approve</button></div></form>
        </div>

    </section>


	</div>
</template>

<script>

	import User from '../../../api/users.js';
    import myDatepicker from 'vue-datepicker';
    import moment from 'moment';
    

    export default {

        data() {
            return {
                'buyerId' : this.$route.params.id,
                'email':this.$store.state.Users.userDetails.email,
                'user':this.$store.state.Users.userDetails.first_name,
                'address':this.$store.state.Users.userDetails.address,
                'phoneno':this.$store.state.Users.userDetails.mobile_no,
                'user_id':this.$store.state.Users.userDetails.id,
                'currentYear': new Date().getFullYear(),
                'user_type':this.$store.state.Users.userDetails.user_type,
                'invoiceData' : '',
                'requestList' : [],
                'buyerData' : {
                    'name' : '',
                    'address' : '',
                    'mobileno' : '',
                    'email' : '',
                },
                'agreementData' : {
                    'taxType' : '',
                    'taxRate'  : '',
                    'paneltyType' : '',
                    'panelty' : '',
                    'price' : '',
                },
                'invoice1':{},
                'invoice1_subdata':{},
                'invoice2':{},
                'invoice2_subdata':{},
                } 
        },
        filters:{
            dateFormate: function(date) {
            return moment(date).format('Y, MMM DD');
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
            vm.genrateInvoiceView(vm.buyerId);
           //vm.getInvoice1();
           //vm.getInvoice2();
        },
        methods: {
            genrateInvoiceView(buyerId){
                var vm = this;
               
                User.generateInvoiceViewByBuyerId(buyerId).then(
                    (response) => {
                        if(response.data.code == 200){
                            let  request_data  = response.data.data;
                            // return false;
                             var invoice_list = [];
                             
                            $.each(request_data.generateInvociedata, function(key, value) {
                                let invoice_no =  value.invoice_no ;
                                let sub_amount  = value.sub_amount ;
                                let supplied_quantity  = value.supplied_quantity ;
                                let total_amount  = value.total_amount ;
                                let date  = value.date ;
                                let tax_rate_amount_cal = value.tax_rate_amount_cal;
                               invoice_list.push({
                                 'invoice_no':invoice_no,
                                 'sub_amount':sub_amount,
                                 'supplied_quantity':supplied_quantity,
                                 'total_amount': total_amount,
                                 'date' : date,
                                 'tax_rate_amount_cal' : tax_rate_amount_cal
                                });
                            });
                            $.each(request_data.requestList, function(key,value) {
                                var request_list = [];
                                $.each(value, function(index,data) {
                                    let supplied_Qty =  data.supplied_Qty ;
                                    let date  = data.date ;
                                    let nid  = data.nid ;
                                    let quantityRequired  = data.quantityRequired ;
                                    let approveQuntity  = data.approveQuntity ;
                                    
                                   request_list.push({
                                     'supplied_Qty':supplied_Qty,
                                     'date':date,
                                     'quantityRequired':quantityRequired,
                                     'approveQuntity': approveQuntity,
                                     'nid':nid,
                                    });
                                });
                               vm.requestList[key] = request_list;
                            });
                            
                            vm.invoiceData = invoice_list;
                            if(request_data.buyerData.last_name != null){
                                vm.buyerData.name = request_data.buyerData.first_name + '' +  request_data.buyerData.last_name ; 
                            }else{
                                 vm.buyerData.name = request_data.buyerData.first_name; 
                            }
                            vm.buyerData.address = request_data.buyerData.address;
                            vm.buyerData.mobileno = request_data.buyerData.mobile_no;
                            vm.buyerData.email = request_data.buyerData.email;
                            vm.agreementData.taxType = request_data.buyerData.tax;
                            vm.agreementData.taxRate = request_data.buyerData.rate;
                            vm.agreementData.paneltyType = request_data.buyerData.paneltyType;
                            vm.agreementData.panelty = request_data.buyerData.panelty;
                            vm.agreementData.price = request_data.buyerData.price;
                            
                        }
                    },
                    (error) => {
                    },
                );
            },
            generateInvoice(invoiceDataIndex,buyerId){
                 let vm=this;
                 var invoiceHtml = $("#invoiceViewGet").html();
                 User.generateInvoiceByBuyerId(vm.buyerId,vm.user_id,vm.invoiceData,invoiceDataIndex,invoiceHtml,vm.requestList,vm.agreementData).then(
                     (response) => {
                        if(response.data.code == 200){
                            if(response.data.data == true){
                                  this.$router.push({name: 'generate_invoice'})
                            }
                        }
                    },
                    (error) => {
                    },
                );
                 
            },
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