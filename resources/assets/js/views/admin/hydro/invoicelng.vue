<template>
	<div class="container invoice_page">
		<section class="content p-l-r-15" id="invoice-stmt"  v-for="invData,index in invoiceData">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-credit-card"></i> Lng Invoice
                    </h3>
                    <span class="float-right">
                        <i class="fa fa-fw ti-angle-up clickable"></i>
                        <i class="fa fa-fw ti-close removecard"></i>
                    </span> 
                </div>
                <div class="card-body" id="invoiceLngViewGet">
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
                                    <h4><strong>{{invData.invoice_no}} / <span id="dateFeildId">{{invData.date | dateFormate}}</span></strong></h4>
                                    <h4 class="mt-5"><strong>Invoice Info:</strong></h4>
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
                    <div class="">
                        <div class="table-responsive">
                            <table class="invoice-table table table-striped table-condensed" id="customtable"  width="100%">

                                <thead>
                                <tr class="bg-primary">
                                    <th class="text-center w-8">
                                        <strong>#</strong>
                                    </th>
                                    <th class="text-center w-65" colspan="4">
                                        <strong>
                                           PARTICULARS
                                        </strong>
                                    </th>
                                    <!--  <th colspan="2" class="text-center" style="width: 100px;">
                                        <strong>Gcv </strong>
                                    </th> -->
                                   <!--  <th>
                                        <strong>Rate</strong>
                                    </th>
                                     <th>
                                        <strong>Tax</strong>
                                    </th> -->
                                   
                                    <th class="text-right w-27">
                                        <strong>TOTAL</strong>
                                    </th>
                                    <!-- <th class="text-center" id="add_row"><i class="fa fa-fw ti-plus"></i></th> -->
                                </tr>
                                </thead>
                                <tbody>
                                    <tr  v-for="request,indexsr in requestList[index + 1]">
                                        <td class="text-center">{{++indexsr}}</td>

                                        <td class="text-left" colspan="4">Quantity Of Lng Supplied On {{request.date|dateFormate}}
                                        <br><small><strong> </strong> Net Weight {{request.total_date_supplied_Qty}} Kg X (M.F.){{request.gcv_value}}</small></td>
                                       
                                         <!-- <td colspan="2" class="text-center">{{request.gcv_value}}</td> -->
                                        <td class="text-right">{{request.total_date_supplied_Qty * request.gcv_value}} MMBTU</td>

                                    </tr>
                                    <tr><td class="text-center"><strong>Total</strong></td>
                                        <td class="text-left" colspan="4"><strong>Net Quantity</strong> &nbsp;&nbsp;&nbsp;<span v-text="setNumberFormat(invData.supplied_quantity)"></span> </td>
                                       
                                         <!-- <td colspan="2" class="text-center"></td> -->
                                        <td class="text-right">
                                        {{invData.total_supply_qty_with_gcv}} MMBTU</td></tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                      
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-right" colspan="2">
                                        <strong>
                                            <span >Price Per MMBTU</span>: &nbsp;

                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable> <i class="fa fa-usd"></i> {{ agreementData.perMMbtu}}</strong>
                                    </td>
                                  
                                </tr>
                                <tr>
                                    <td class="highrow text-center"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                     
                                    <td class="highrow text-right" colspan="2">
                                        <strong>
                                           SubTotal: &nbsp;
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable><span class="top tipso_style" title="Total Price to customer" data-tipso=""><i class="fa fa-usd"></i> {{invData.sub_amount}}</span></strong>
                                    </td>
                                   
                                </tr>
                                 
                                 <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                      
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-right" colspan="2">
                                        <strong>
                                            <span >Exchange Rate</span>: &nbsp;

                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable>  INR {{ agreementData.convertRate}}/USD </strong>
                                    </td>
                                  
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-right">
                                        <strong>
                                            <span>Total</span>: &nbsp;

                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable>
                                        <i class="fa fa-rupee"></i>{{invData.afterConvertCurrencty}}  </strong>
                                    </td>
                                  
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"></td>
                                    <td class="emptyrow text-right" width="50px" >
                                        <strong>
                                            {{agreementData.taxType}}( %{{agreementData.taxRate}}):
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable>  +  <i class="fa fa-rupee"></i> {{invData.tax_rate_amount_cal}}</strong>
                                    </td>
                                 
                                </tr>
                                <tr>
                                    <td class="emptyrow">
                                        <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                    </td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    
                                    <td class="emptyrow text-right" colspan="2">
                                        <strong>
                                            <b>Total Price To Custome: &nbsp;</b>
                                        </strong>
                                    </td>
                                    <td class="highrow text-right">
                                        <strong contenteditable><b><i class="fa fa-rupee"></i> {{invData.total_amount}}</b></strong>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    
            </div>
            <div class="card-body">
              <form class="col-md-12"><div class="text-right"><button type="button" class="btn btn-info" @click="generateLngInvoice(index,buyerId)">Approve</button></div></form>
            </div>
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
                'updaterequestList':[],
                'buyerData' : {
                    'name' : '',
                    'address' : '',
                    'mobileno' : '',
                    'email' : '',
                },
                'agreementData' : {
                    'taxType' : '',
                    'taxRate'  : '',
                    'perMMbtu' : '',
                    'convertRate' : '',
                },
                'invoice1':{},
                'invoice1_subdata':{},
                'invoice2':{},
                'invoice2_subdata':{},
                } 
        },
        filters:{
            dateFormate: function(date) {
            return moment(date).format('DD-MM-YYYY');
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
            vm.genrateLngInvoiceView(vm.buyerId);
           //vm.getInvoice1();
           //vm.getInvoice2();
        },
        methods: {
            genrateLngInvoiceView(buyerId){
                var vm = this;
               
                User.generateLngInvoiceViewByBuyerId(buyerId).then(
                    (response) => {
                        if(response.data.code == 200){
                            let request_data  = response.data.data;
                            // return false;
                             var invoice_list = [];
                             // console.log(request_data,'sdfsdf');
                            $.each(request_data.generateInvociedata, function(key, value) {
                                let invoice_no =  value.invoice_no ;
                                let sub_amount  = value.sub_amount ;
                                let supplied_quantity  = value.supplied_quantity ;
                                let total_amount  = value.total_amount ;
                                let afterConvertCurrencty = value.afterConvertCurrentcy;
                                let date  = value.date ;
                                let tax_rate_amount_cal = value.tax_rate_amount_cal;
                                let total_supply_qty_with_gcv = value.supply_qty_with_gcv;
                               invoice_list.push({
                                 'invoice_no':invoice_no,
                                 'sub_amount':sub_amount,
                                 'supplied_quantity':supplied_quantity,
                                 'total_amount': total_amount,
                                 'date' : date,
                                 'afterConvertCurrencty' : afterConvertCurrencty,
                                 'tax_rate_amount_cal' : tax_rate_amount_cal,
                                 'total_supply_qty_with_gcv' : total_supply_qty_with_gcv,
                                });
                            }); 
                            var update_request_list = [];
                            $.each(request_data.updateList, function(key,value) {
                                  
                                  // $.each(value, function(index,data) {
                                    let uNID = value.nid ;
                                    update_request_list.push({
                                     'nid':uNID,
                                    
                                   //});
                                
                                 });
                               vm.updaterequestList= update_request_list;

                                 });
                            $.each(request_data.requestList, function(key,value) {
                            // console.log(value,'data');

                                var request_list = [];
                                $.each(value, function(index,data) {
                                    
                                    let supplied_Qty =  data.supplied_Qty ;
                                    let date  = data.date ;
                                    let gcvValue  = data.GcvValue ;
                                    let supply_Qty_with_Gcv  = data.supplu_qty_with_GcvValue ;
                                    let nid  = data.nid ;
                                    let total_date_supplied_Qty  = data.total_date_supplied_Qty ;

                                    
                                   request_list.push({
                                     'supplied_Qty':supplied_Qty,
                                     'date':date,
                                     'gcv_value' :gcvValue ,
                                     'supply_qty_with_gcv' : supply_Qty_with_Gcv,
                                     'total_date_supplied_Qty':total_date_supplied_Qty,
                                    
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
                            vm.agreementData.perMMbtu = request_data.buyerData.permmbtu;
                            vm.agreementData.convertRate = request_data.buyerData.convertRate;
                            // vm.agreementData.paneltyType = request_data.buyerData.paneltyType;
                            // vm.agreementData.panelty = request_data.buyerData.panelty;
                            // vm.agreementData.price = request_data.buyerData.price;
                            
                        }
                    },
                    (error) => {
                    },
                );
            },
            setNumberFormat(data){
                return data.toFixed(2);
            },
            generateLngInvoice(invoiceDataIndex,buyerId){
                 let vm=this;
                 var invoiceHtml = $("#invoiceLngViewGet").html();
                 User.generateLngInvoiceByBuyerId(vm.buyerId,vm.user_id,vm.invoiceData,invoiceDataIndex,invoiceHtml,vm.requestList,vm.agreementData,vm.updaterequestList).then(
                     (response) => {
                        if(response.data.code == 200){
                            if(response.data.data == true){
                                 toastr.success('Invoice has been generated successfully', 'Invoice', {timeOut: 5000});
                                  this.$router.push({name: 'generate_invoice_lng'})
                            }
                        }else{
                             toastr.error('Something Went wrong.', 'Invoice', {timeOut: 5000});
                        }
                    },
                    (error) => {
                          toastr.error('Something Went wrong.', 'Invoice', {timeOut: 5000});
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