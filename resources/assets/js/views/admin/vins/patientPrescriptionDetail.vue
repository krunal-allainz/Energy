<template>
	<div class="container">
      <!--   <span class="report_title">Prescription Print:-</span> -->
            <div class="form-group">
                <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table report_table"  v-if="setPresPrint" id="">
                        <tbody v-if="presp_count(prescriptData)>0">
                         <tr v-for="(res,index) in prescriptData" v-if="res.remove=='false'" :id="res.pid">
                                    
                                <td>  {{++index}}] {{res.name}} :ORAL
                                    
                                    <span v-if="res.how_many_times=='Q-Hrs'">
                                        <span v-for="(item,index) in parseInt(res.total_qhrs)">
                                           <!--  <span v-if="index!=0 && res['clock_quantity_'+(index+1)]!='0'"> -->
                                            <span v-if="index!=0 && clockinfo.clock_quantity !='0'">
                                               <span v-if="(index != parseInt(res.total_qhrs)-1)"> ______</span>
                                            </span>
                                           <!--  <span v-if="res['clock_quantity_'+(index+1)]!='0'"> --> 
                                            <span v-if="clockinfo.clock_quantity!='0'">
                                           {{clockinfo.clock_quantity}} </span>
                                        </span>
                                    </span>
                                    <span v-else>
                                        <span v-for="(clockinfo,index) in prescriptionclockDetail[res.preId]" v-if="clockinfo.clock_quantity !='0'">
                                          <span  v-if="index>0">______</span>{{clockinfo.clock_quantity}}</span>
                                       <!--  <span v-if="res.clock_quantity_1!='0'"> {{res.clock_quantity_1}}</span>
                                        <span v-if="res.clock_quantity_2!='0'"> <span v-if="res.clock_quantity_1!='0'"> ______</span>{{res.clock_quantity_2}}</span><span v-if="res.clock_quantity_3!='0'"> <span v-if="res.clock_quantity_1!='0' || res.clock_quantity_2!='0'"> ______</span>{{res.clock_quantity_3}}</span><span v-if="res.clock_quantity_4!='0'"><span v-if="res.clock_quantity_1!='0' || res.clock_quantity_2!='0' || res.clock_quantity_3!='0'">  ______</span>{{res.clock_quantity_4}}</span> -->
                                    </span>
                                    <span v-if="res.how_many_times=='Q-Hrs'">
                                        [
                                         <span v-for="(item,index) in parseInt(res.total_qhrs)">
                                          <!--   <span v-if="index!=0 && res['clock_time_'+(index+1)]!='0' && res['clock_time_'+(index+1)]!='--:--'"> -->
                                            <span v-if="index!=0 && clockinfo.clock_time !='0' && clockinfo.clock_time !='--:--'">
                                            </span>
                                           <!--  <span v-if="res['clock_time_'+(index+1)]!='0' && res['clock_time_'+(index+1)]!='--:--'">  -->
                                            <span v-if="clockinfo.clock_time !='0' && clockinfo.clock_time !='--:--'">
                                            <span v-if="index !=0">______</span>
                                            {{clockinfo.clock_time}}</span>
                                        </span>
                                        ]
                                    </span>
                                    <span v-else>
                                      [
                                       <span v-for="(clockinfo,index) in prescriptionclockDetail[res.preId]" v-if="clockinfo.clock_quantity !='0'">

                                      <span v-if="index !=0">______</span>
                                        {{clockinfo.clock_time}}</span>
                                        ]
                                                                               <!--  <span v-if="res.clock_quantity_1!='0' || res.clock_quantity_2!='0' || res.clock_quantity_3!='0' || res.clock_quantity_4!='0'">
                                         [ <span v-if="res.clock_quantity_1!='0'"> {{res.clock_time_1}}</span><span v-if="res.clock_quantity_2!='0'"><span v-if="res.clock_quantity_1!='0'"> ______</span> {{res.clock_time_2}}</span><span v-if="res.clock_quantity_3!='0'"><span v-if="res.clock_quantity_1!='0' || res.clock_quantity_2!='0'"> ______</span> {{res.clock_time_3}}</span><span v-if="res.clock_quantity_4!='0'"><span v-if="res.clock_quantity_1!='0' || res.clock_quantity_2!='0' || res.clock_quantity_3!='0'"> ______</span>{{res.clock_time_4}}</span> ] 
                                    </span> -->
                                    </span>
                                    
                                    <span v-if="(res.clock_suggest!='' && res.clock_suggest!='--')">
                                        [ <span>{{res.clock_suggest}}</span> ]
                                    </span>
                                    <span v-if="(res.qhrs!='' && res.qhrs!= null)">[{{res.qhrs}}]</span>
                                     <i class="fa fa-close"></i>
                                    <span v-if="res.total_prescription_days!=''">{{res.total_prescription_days}} DAYS </span>
                                    <span v-else>TO BE CONTINUE</span>
                            </td>
                            <!-- <td v-if="removeBtn==1"><i class="fa fa-remove point" @click="removePrescript(res.pid)"></i></td>  -->
                            
                          </tr>
                        </tbody>
                        <tbody v-else>
                        
                          <tr >
                            <td>No Reord found.</td>
                          </tr>
                        </tbody>
                    </table>
                  </div>
                     </div>
              </div>
    </div>
</template>
<script>
	export default {
		props:['prescriptData','prescriptionclockDetail'],
     data() {
            return {
               'notValid':false,
                'footer' : 'footer',
                'currentYear': new Date().getFullYear(),
                'lab_val_size':0,
                'prescriptDataPage': [],
                'count_false':0,
                'counter':0,
                'hide':0,
                'setPresPrint':true,
            }
          },
    methods: {
            presp_count(array)
            {
                var vm=this;
                var array_presp=_.filter(array, ['remove', 'false']);
                vm.count_false=array_presp.length;
                return  vm.count_false;

            },
          }
	}
</script>