<template>
    <div class="container">
       <div class="row form-group">
      <div class="col-md-6">
        <div class="col-md-12">
          <label for="referral">Referral:</label>
        </div>
        <div class="col-md-12">
          <select class="form-control ls-select2" name="referral" id="referral" v-model="reffData.referral">
            <option value="" selected>Select </option>
            <option value="cross">Cross</option>
            <option value="radiology">Radiology</option>
            <option value="laboratory">Laboratory</option>
            <option value="physiotherapy">Physiotherapy</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row form-group">
      <div class="col-md-6" v-if="reffData.referral == 'cross'">
        <div class="col-md-12">
          <label for="internal">Cross Reference:</label>
        </div>
        <div class="col-md-12">
          <select class="form-control ls-select2" name="cross" id="cross">
            <option value="">Select</option>
            <option value="internal">Internal</option>
            <option value="external">External</option>
          </select>
        </div>
      </div>
    </div>
      <div class="row form-group">
        <div class="col-md-6" v-show="cross_internal=='true'">
          <div class="col-md-12">
            <label for="internal">Internal Reference:</label>
          </div>
          <div class="col-md-12">
            <select class="form-control ls-select2" name="internal" id="internal" >
              <option value="">Select</option>
              <option :value="doctor.id" v-for="doctor in doctorOption">{{doctor.text}}</option>
            </select>
          </div>
        </div>
        <div class="col-md-6" v-show="cross_external=='true'">
          <div class="col-md-12">
            <label for="external">External Reference:</label>
          </div>
          <div class="col-md-12">
            <input type="text" name="external" id="external" class="form-control" v-model="reffData.cross_type_ext">
            </div>
          </div>
        </div>
    <div >
      <div class=" form-group" id="radio_div1" v-show="reffData.referral == 'radiology'">
        <div class="">
            <div class="row form-group">
               <div class="col-md-6"> 
                <div class="col-md-12">
                  <label>Select Radiology:</label>
                  <br>
                  <select class="form-control ls-select2" id="radiology_type_opd" name="radiology_type_opd">
                     <option value="">Select</option>
                    <option v-for="type in investigationData.radiologyType" :value="type.id">{{type.text}}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6" v-if="resultData.type_name=='Other'">
                <div class="col-md-12">
                  <label> Other Parts</label>
                  <input type="text" name="radiology_other_text" id="radiology_other_text" class="form-control" v-model="resultData.radiologyOther">
                </div>
              </div>
            </div>

             <div class="row form-group">
                <div class="col-md-6">
                  <div class="col-md-12">
                      <label>Body Part Side:</label><br>
                      <select class = "form-control ls-select2" id = "body_part_side" name = "body_part_side">
                         <option value="">Select</option>
                          <option v-for="bps in investigationData.bodyPartSide" :value="bps.id">{{bps.text}}</option>
                      </select>
                  </div>
                </div>
            </div>
              
             <div class="row form-group" v-if="resultData.body_part_side_text=='Others'">
                <div class="col-md-6">
                    <div class="col-md-12">
                      <label for="history">Others type:</label>
                      <button type="button" class="btn btn-submit" @click="setHistoryType('advice','text')">Text</button>
                      <button type="button" class="btn btn-warning" @click="setHistoryType('advice','scribble')">Scribble</button>
                    </div>

                </div>
            </div>
           <div class="row form-group" v-if="resultData.body_part_side_text=='Others'">
              <div class="col-md-6">
                  <div class="col-md-6">
                      <label for="others">Others:</label>
                  </div>
                  <div class="col-md-12" v-show="resultData.body_part_others_type == 'text'">
                      <textarea class="form-control" type="text" name="body_part_others" id="body_part_others" v-model="resultData.body_part_others"></textarea>         
                  </div>
                  <div class="col-md-12" v-show="resultData.body_part_others_type == 'scribble'">
                      <div id="signature-pad3" class="signature-pad">
                          <div class="signature-pad--body">
                              <canvas class="can-img" id="body_part_scribble" height="200px" width="500px" ></canvas> 
                          </div>
                          <div>
                              <button type="button" id="clear_body_part_scribble" class="btn btn-md btn-danger">Clear</button>
                              <button type="button" id="save_body_part_scribble" class="btn btn-md btn-primary">Save</button>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-6" v-if="resultData.signaturePad3_src!='' && resultData.body_part_others_type != 'text' && resultData.signaturePad3_src!== null">
                <div class="col-md-12">
                    <label for="history">Others Preview:  <i class="fa fa-download fa-lg red" @click="download(resultData.signaturePad3_src,'Others')" aria-hidden="true"></i></label>
                  </div>
                  <div>
                    <img :src="resultData.signaturePad3_src" title="Others">
                  </div>  
              </div>
          </div>
            <div class="row form-group">
              <div class="col-md-6">
                <div class="col-md-12" v-if="resultData.body_part_text==false">
                  <label>Body Parts:</label>
                  <br>
                  <select class="form-control ls-select2" id="radiology_subtype_opd" name="radiology_subtype_opd" v-model="resultData.subType">
                     <option value="">Select</option>
                    <option v-for="obj in investigationData.radiologySubType" :value="obj.id">{{obj.text}}</option>
                  </select>
                </div>
                <div class="col-md-12" v-if="(resultData.body_part_text)">
                    <label>Body Parts:</label><br>
                    <input type="text" name="radiology_subtype_opd" id="radiology_subtype_opd" class="form-control" v-model="resultData.bodyPart" >
                    <span class="help is-danger" v-show="errors.has('radiology_subtype_opd')">
                        Field is required
                    </span>     
                  </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12" v-if="resultData.subtype_text_enable">
                  <label> Other Parts</label>
                  <input type="text" name="subType_text_opd" id="subType_text_opd" class="form-control"  v-model="resultData.bodyPart_others">
                </div>
                <div class="col-md-12" v-if="resultData.bodyPart_text === 'Spine'">
                  <label> Spine option:</label>
                  <select class="form-control ls-select2" id="radiology_spine_opd" name="radiology_spine_opd"  v-model="resultData.spine_option_value">
                     <option value="">Select</option>
                    <option :value="obj.id" v-for="obj in investigationData.Spine_option" >{{obj.text}}</option>
                  </select>
                </div>
              </div>
                
            </div>
            <div class="row form-group">
              <div class="col-md-6">
                 <div class="col-md-12">
                    <label>Select Qualifires:</label>
                    <br>  
                      <select class="form-control ls-select2" id="radiology_qualifier_opd" name="radiology_qualifier_opd" v-if="!(resultData.radiology_qualifier_text_enable)" v-model="resultData.qualifier">
                         <option value="">Select</option>
                        <option v-for="obj in investigationData.radiologyQualifier" :value="obj.id">{{obj.text}}</option>
                      </select>
                      <input type="text" name="qualifier_opd" id="qualifier_opd" class="form-control" v-model="resultData.qualifier_text" v-else>
                </div>
                <div class="col-md-12" v-if="!(resultData.radiology_special_request_text_enable)">
                    <label>Select Special request:</label>
                    <br>
                      <select class="form-control ls-select2" id="radiology_special_request_opd" name="radiology_special_request_opd" v-model="resultData.special_request">
                         <option value="">Select</option>
                        <option v-for="obj in investigationData.radiologySpecialRequest" :value="obj.id">{{obj.text}}</option>
                      </select>
              </div>
              <div class="col-md-12" v-else>
                <label>Select Special request:</label>
                <br>
                  <input type="text" name="special_request_opd" id="special_request_opd" class="form-control" v-model="resultData.special_request_text">
              </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12" v-if="resultData.qualifier_radio_text_enable">
                  <label> Other Parts</label>
                  <input type="text" name="qualifier_text_opd" id="qualifier_text_opd" class="form-control" v-model="resultData.qualifierOtherPart">
                </div>
              </div>
            </div>
            <div class="row form-group">
                <div class="col-md-6" >
                   <div class="col-md-12">
                      <label>Report details:</label><br>
                      <textarea class="form-control" cols="50" rows="5" v-model="resultData.textData"></textarea>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    
    
        <!-- for laboratory -->
        <div class="row form-group" v-show="reffData.referral == 'laboratory' ">
          <div class="col-md-6">
          <div class="col-md-12">
            <label class="control-label" for="label_1">Laboratory </label>
          </div>
          <div class="col-md-12">
             <select class="form-control ls-select2"  id="laboratory_report_opd" name="laboratory_report_opd[]" multiple="multiple">
              </select>
          </div>
        </div>
      </div>
      <!-- for laboratory -->

        <!-- for physiotherapy -->
        <div class="row form-group" v-show="reffData.referral == 'physiotherapy' || reffData.physio_details!=''">
          <div class="col-md-6">
          <div class="col-md-12">
            <label class="control-label" for="label_1">Details </label>
          </div>
          <div class="col-md-12">
            <textarea class="form-control" name="physio_details" id="physio_details" v-model="reffData.physio_details"></textarea>
          </div>
        </div>
      </div>
      <!-- for physiotherapy -->
       
         <div class="row form-group">
          <div class="col-md-12">
               <button type="button" class="btn btn-primary btn-lg " v-if="reffData.referral!='physiotherapy'" @click="saveReport()">Add</button>
          </div>
       </div> 
      <!-- for cross table -->  
      <div class="col-md-12" v-if="reffData.reffreal_cross_array.length>0">
         <card title="<i class='ti-layout-cta-left'></i> Cross"  class="filterable">
           <div class="table-responsive">
              <table class="table table-striped table-bordered" id="">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Type</th>
                      <th>Sub Type</th>
                      <th>Value</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(cross_arr, index) in reffData.reffreal_cross_array">
                        <td>{{cross_arr.id}}</td>
                        <td>{{cross_arr.type}}</td>
                        <td>{{cross_arr.subtype}}</td>
                        <td>{{cross_arr.text}}</td>
                        <td><i class="fa fa-remove" @click="removeCrossRef(cross_arr.id)"></i></td>
                    </tr>
                  </tbody>
              </table>
            </div>
          </card>
      </div>
      <!-- for cross table -->
      <!-- for radiology table -->  
      <div class="col-md-12" v-if="reffData.reffreal_radiology_array.length>0">
          <card title="<i class='ti-layout-cta-left'></i> Radiology"  class="filterable">
           <div class="table-responsive">
              <table class="table table-striped table-bordered" id="radio_list">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Type</th>
                      <th>Body parts</th>
                      <th>Qualifier</th>
                      <th>Special request</th>
                      <th>Details</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-for="(radio_arr, index) in reffData.reffreal_radiology_array">
                      <td>{{radio_arr.id}}</td>
                      <td>{{radio_arr.type_name}}</td>
                      <td>{{radio_arr.bodyPart_text}}</td>
                      <td>{{radio_arr.qualifier_text}}</td>
                      <td>{{radio_arr.special_request_text}}</td>
                      <td>{{radio_arr.textData | strLimit}}</td>
                      <td><i class="fa fa-remove" @click="removeRadioRef(radio_arr.id)"></i></td>
                  </tr>
                  
                  </tbody>
              </table>
            </div>
          </card>
          </div>
      <!-- for radiology table -->
       <!-- for laboratory table -->  
      <div class="col-md-12" v-if="reffData.reffreal_laboratory_array.length>0">
        <card title="<i class='ti-layout-cta-left'></i> Laboratory"  class="filterable">
           <div class="table-responsive">
              <table class="table table-striped table-bordered" id="">
                  <thead>
                  <tr>
                      <th>#</th>
                      <th>Name</th>
                      <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(lab_arr, index) in reffData.reffreal_laboratory_array">
                        <td>{{lab_arr.id}}</td>
                        <td>{{lab_arr.name}}</td>
                        <td><i class="fa fa-remove" @click="removeLabRef(lab_arr.id)"></i></td>
                    </tr>
                  </tbody>
              </table>
            </div>
            </card>
      </div>
      <!-- for laboratory table -->
    </div>
</template>
<script >
    import User from '../../../api/users.js';
    import myDatepicker from 'vue-datepicker';
    import card from "./card.vue";
    import SignaturePad from 'signature_pad';
    import _ from 'lodash';
    export default {
        name:'referral',
        computed:{

        },
        components: {
           card
        },
       
        props:[],
        data() {
            return {
              'doctor_id':this.$store.state.Users.userDetails.id,
              'prescriptionunique' : 0,
              'cross_internal':'false',
              'cross_external':'false',
              'cross_array':{},
              'cross':{},
              'id':this._uid,
              'internal_array':{},
              'internal_text_array':{},
              'laboratory_array':{},
              'ref_cross_array':[],
              'ref_lab_array':[],
              'ref_radio_array':[],
              'doctorOption':{},
              'investigationData':{
                    'radiologyType':[],
                    'bodyPartSide':[],
                    'radiologySubType':[],
                    'radiologyQualifier':[],
                    'brain_options':[],
                    'X-Rays_options':[],
                    'CT_options':[],
                    'MRI_options':[],
                    'Spine_option':[],
                    'radiologySpecialRequest':[],

                },
              'resultData': {
                    'id':'',
                    'uploadType':'image',
                    'bodyPart':'',
                    'bodyPart_text':'',
                    'bodyPart_others':'',
                    'type': '',
                    'type_text':'',
                    'spine_option_value':'',
                    'subType': '',
                    'qualifier':'',
                    'qualifier_text':'',
                    'imgData': '',
                    'textData': '',
                    'subtype_text_enable':false,
                    'qualifier_radio_text_enable':false,
                    'special_request':'',
                    'special_request_text':'',
                    'removed':false,
                    'qualifierOtherPart':'',
                    'body_part_side':'',
                    'body_part_side_text':'',
                    'radiologyOther':'',
                    'body_part_text':false,
                    'type_name':'',
                    'body_part_others_type':'scribble',
                    'body_part_others':'',
                    'signaturePad':{},
                    'signaturePad3_src':'',
                    'radiology_qualifier_text_enable':true,
                    'radiology_special_request_text_enable':true,
                },
              'reffData': {
                'reffreal_cross_array':[],
                'reffreal_laboratory_array':[],
                'reffreal_radiology_array':[],
                'laboratoryALLData':[],
                'laboratory_report_opd_data':{},
                'referral':'',
                'laboratory':'',
                'physio_details':'',
              }
            }
               
        },
        mounted() {
          let vm =this;
          $('.ls-select2').select2({
                  placeholder: "Select",
          });

          /*for consulting dr */
          let doctor_list=[];
          User.generateCrossRefferalUserList(vm.doctor_id).then(
             (response) => {
                  let consult_data  = response.data.data;
                  $.each(consult_data, function(key, value) {
                      let name =  value.first_name +' '+value.last_name;
                      let id  = value.id ;
                      doctor_list.push({text:name, id:id});
                  });
                  vm.doctorOption=doctor_list;
                },
                (error) => {
              },
        );


          vm.$root.$emit('setReferralId',this._uid)
               /*for laboratory data*/
            let labpratory_all_data=[];
            User.generateAllLaboratoryListByChild().then(
              (response) => {
                let lab_data = response.data.data;
                vm.reffData.laboratoryALLData = lab_data;
                $('#laboratory_report_opd').select2({
                  placeholder: 'Select',
                  data:lab_data
                });
              },
              (error) => 
              {
              },
            );

           $('#laboratory_report_opd').on("select2:select", function (e) {
              let selections = $(this).val();
              vm.reffData.laboratory_report_opd_data=selections;
              //vm.setLabData();
            });

         
          
          $(document).on("select2:select",'.ls-select2', function (e) { 
            if(this.id == 'referral'){
               vm.setRadioReferral();
               let ref=$(this).val();
              vm.reffData.referral=_.cloneDeep(ref);
              //vm.finalResultData = '';
              if($(this).val() != 'physiotherapy') {
                vm.reffData.physio_details = "";
              }
              if($(this).val() == 'cross') {
                setTimeout(function(){
                  $('#cross').select2({
                    placeholder: "Select",
                    tags:false 
                  }); 
                },20)  
              }
              if(vm.reffData.referral=='radiology')
              {
                vm.getRadiologySelectList();
                vm.getBodypartSideSelectList();
                vm.resultData.radiology_qualifier_text_enable=true;
                vm.resultData.radiology_special_request_text_enable=true;
              }
            }
            else if(this.id == 'radiology'){
              vm.reffData.radiology=$(this).val();
               
            }
            else if(this.id == 'laboratory'){
              vm.reffData.laboratory=$(this).val();
            }
            else if(this.id == 'cross'){
              var cross_array=$(this).val();
              vm.cross=cross_array;
               if(cross_array.includes("internal"))
              {
                  vm.cross_internal='true';
                  vm.cross_external='false';
              }
              if(cross_array.includes("external"))
              {
                  vm.cross_external='true';
                  vm.cross_internal='false';
              }
              
              // vm.reffData.reffreal_cross_array =  vm.cross;

            }
            else if(this.id == 'internal'){
              var val_cross_array=$('#internal').select2('data')[0].id;
              var text_cross_array=$('#internal').select2('data')[0].text;
              vm.internal_array=val_cross_array;
              vm.internal_text_array=text_cross_array;
            }
            else if(this.id == 'laboratory_report_opd'){
              var val_lab_array=$(this).val();
              vm.laboratory_array=val_lab_array;
            }
            else if(this.id == 'case_type'){
              vm.reffData.case_type = $(this).val(); 
            }
             else if(this.id == 'xray_type_opd'){
              vm.resultData.x_ray_type = $(this).val(); 
            }

              if(this.id == 'radiology_type_opd') 
              {
                  vm.resultData.type =$('#radiology_type_opd').select2('data')[0].id;
                  vm.resultData.type_name = $('#radiology_type_opd').select2('data')[0].text;
                  let r_name=vm.resultData.type_name;
                  vm.initializeRadio(r_name);
                  vm.radioSubType();
              }
              if(this.id == 'body_part_side') 
              {
                  vm.resultData.body_part_side=$('#body_part_side').select2('data')[0].id;
                  vm.resultData.body_part_side_text=$('#body_part_side').select2('data')[0].text;
                  if(vm.resultData.body_part_side_text=='Others')
                  {
                      //for signature pad
                      setTimeout(function(){
                        vm.examinationChangeImage();
                      },500);
                  }
              }
              if(this.id == 'radiology_subtype_opd') 
              {
                  vm.resultData.radiology_subtype=$('#radiology_subtype_opd').select2('data')[0].id;
                  let b_id=$('#radiology_subtype_opd').select2('data')[0].id;
                  let b_text=$('#radiology_subtype_opd').select2('data')[0].text;
                  vm.resultData.bodyPart_text=b_text;
                  vm.getQualifierList(b_id);
                  vm.initializeRadioSubtype(b_text,b_id);
              }
              if(this.id == 'radiology_qualifier_opd') 
              {
                  
                  vm.resultData.qualifier =$('#radiology_qualifier_opd').select2('data')[0].id;
                  vm.resultData.qualifier_text =$('#radiology_qualifier_opd').select2('data')[0].text;
                  let q_id=$('#radiology_qualifier_opd').select2('data')[0].text;
                  vm.initializeQualifier(q_id);
              }
              if(this.id == 'radiology_special_request_opd') 
              {
                   vm.resultData.special_request=$('#radiology_special_request_opd').select2('data')[0].id;
                   vm.resultData.special_request_text =$('#radiology_special_request_opd').select2('data')[0].text;
              }
              if(this.id == 'radiology_spine_opd') 
              {
                  vm.resultData.spine_option_value=$('#radiology_spine_opd').select2('data')[0].id;
              }
        
          });
          $(document).on("select2:unselect",'.ls-select2', function (e) {
              if(this.id == 'cross')
              {
                  if(e.params.data.id=='external')
                  {
                      vm.cross_external='false';
                  }
                  if(e.params.data.id=='internal')
                  {
                      vm.cross_internal='false';
                  }
              }
          });

           /*for intialize data end*/
            setTimeout(function(){
                vm.initData();
            },1000)
            
            
        },
        filters:{
             removeReport(did) {
                let vm =this;
                // _.pullAt(resData, 0);
                _.find(vm.finalResultData, function(res) {
                    if(res.id == did) {
                         res.removed = true;
                    }
                });
          },
           strLimit: function (value) {
            if(value.length > 50){
                var str50 = value.substr(0,50);
                return str50+'...'; 
            } else {
                return value; 

            }
          }
        },
        methods: {
          getBodypartsByRadiology(r_id)
            {

                let vm=this;
                var bodyparts_list_new=[];
                User.getBodypartsByRadiologyId(r_id).then(
                   (response) => {
                        let bodypart_data=response.data.data;

                        $.each(bodypart_data, function(key, value) {
                            let id_body=value.id;
                            let name=value.name;
                            bodyparts_list_new.push({
                                text:name,
                                id:id_body
                            });
                        });
                       
                        let radio_subtype= bodyparts_list_new;
                        
                        if(radio_subtype.length==0)
                        {
                            if ($('#radiology_subtype_opd').hasClass("select2-hidden-accessible")) {
                                $('#radiology_subtype_opd').select2("destroy");
                            }
                             
                            vm.resultData.body_part_text=true;
                        }
                        else
                        {

                            setTimeout(function(){
                                  $('#radiology_subtype_opd').select2({
                                    placeholder: "Select",
                                    tags:false 
                                  });
                                },50);
                             vm.investigationData.radiologySubType=_.cloneDeep(bodyparts_list_new);
                            vm.resultData.body_part_text=false;
                        }
                    },
                    (error) => {
                    },
                );
            },
           getBodypartSideSelectList()
            {
                let vm=this;
                var bodypartSide_list_new=[];
                User.getBodypartSideList().then(
                   (response) => {
                        let bps_data=response.data.data;

                        $.each(bps_data, function(key, value) {
                            let id_bps=value.id;
                            let name=value.name;
                            bodypartSide_list_new.push({
                                text:name,
                                id:id_bps
                            });
                        });
                        vm.investigationData.bodyPartSide=_.cloneDeep(bodypartSide_list_new);

                    },
                    (error) => {
                    },
                );
            },
            getRadiologySelectList()
              {
                  let vm=this;
                  var radiology_list_new=[];
                  User.getRadiologyList().then(
                     (response) => {
                          let radio_data=response.data.data;

                          $.each(radio_data, function(key, value) {
                              let id_radio=value.id;
                              let name=value.name;
                              radiology_list_new.push({
                                  text:name,
                                  id:id_radio
                              });
                          });
                          vm.investigationData.radiologyType=_.cloneDeep(radiology_list_new);

                      },
                      (error) => {
                      },
                  );
              },
            setHistoryType(res,type){
                var vm =this;
                vm.resultData.body_part_others_type = type;
            },
            examinationChangeImage() {
                var vm =this;
                var canvas3 = document.getElementById("body_part_scribble");
                var clear_body_part_scribble = document.getElementById("clear_body_part_scribble");
                var save_body_part_scribble = document.getElementById("save_body_part_scribble");
                vm.resultData.signaturePad3 = new SignaturePad(canvas3, {
                backgroundColor: 'rgb(255, 255, 255)',
                });
                window.onresize = vm.resizeCanvas;
                vm.resizeCanvas(canvas3);
                clear_body_part_scribble.addEventListener("click", function (event) {
                    vm.resultData.signaturePad3.clear();
                    vm.resultData.signaturePad3_src='';
                });
                ;
                save_body_part_scribble.addEventListener("click", function (event) {
                    vm.resultData.signaturePad3_src = vm.resultData.signaturePad3.toDataURL();
                });
            },
             resizeCanvas(canvas) {
                var ratio =  Math.max(window.devicePixelRatio || 1, 1);
                canvas.width = canvas.offsetWidth * ratio;
                canvas.height = canvas.offsetHeight * ratio;
                canvas.getContext("2d").scale(ratio, ratio);
            },
             download(dataURL, filename) {
                var vm =this;
                var blob = vm.dataURLToBlob(dataURL);
                var url = window.URL.createObjectURL(blob);
                var a = document.createElement("a");
                a.style = "display: none";
                a.href = url;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                window.URL.revokeObjectURL(url);
            }, 
            dataURLToBlob(dataURL) {
                // Code taken from https://github.com/ebidel/filer.js
                var parts = dataURL.split(';base64,');
                var contentType = parts[0].split(":")[1];
                var raw = window.atob(parts[1]);
                var rawLength = raw.length;
                var uInt8Array = new Uint8Array(rawLength);
                for (var i = 0; i < rawLength; ++i) {
                uInt8Array[i] = raw.charCodeAt(i);
                }
                return new Blob([uInt8Array], { type: contentType });
            }, 
          initData() {
              let vm =this;
              var reffData = _.cloneDeep(vm.$store.state.Patient.refferelReportData);
              if(!(jQuery.isEmptyObject(reffData)))
              {
                  vm.reffData=reffData;
                  if(reffData.reffreal_cross_array)
                  {
                      vm.ref_cross_array=_.cloneDeep(reffData.reffreal_cross_array);
                  }
                  if(reffData.reffreal_laboratory_array)
                  {
                      vm.ref_lab_array=_.cloneDeep(reffData.reffreal_laboratory_array);

                  }
                  if(reffData.reffreal_radiology_array)
                  {
                      vm.ref_radio_array=_.cloneDeep(reffData.reffreal_radiology_array);
                  }
                  
              }
            },
            saveReport() {
                
                // var resData1=[];
                let vm =this;
                if(vm.reffData.referral=='cross')
                {
                   vm.saveCrossReport();
                }
                if(vm.reffData.referral=='laboratory')
                {
                    vm.saveLabReport();
                }
                if(vm.reffData.referral=='radiology')
                {
                    vm.saveRadiologyReport();
                }

                vm.$store.dispatch('saveReferralReportData',vm.reffData);
                 
                return false;
                 
          },
          radioSubType(){
                let vm =this;
                let resType = vm.resultData.type;
                let resTypeName = vm.resultData.type_name;
                //for radio subtype
                vm.getBodypartsByRadiology(resType);
            },
            initializeQualifier(q_id)
            {
                let vm=this;
                if(q_id=='Other'  )
                {
                    vm.resultData.qualifier_radio_text_enable = true;
                    vm.resultData.qualifierOtherPart = '';
                }
                else
                {
                    vm.resultData.qualifier_radio_text_enable = false;
                    vm.resultData.qualifierOtherPart = '';
                }
            },
            getQualifierList(b_id)
            {
                let vm=this;
                var qualifier_list_new=[];
                User.getQualifierByBodypartsId(b_id).then(
                   (response) => {
                        let qual_data=response.data.data;

                        $.each(qual_data, function(key, value) {
                            let id_body=value.id;
                            let name=value.name;
                            qualifier_list_new.push({
                                text:name,
                                id:id_body
                            });
                        });
                         let qualifier_list=qualifier_list_new;
                         if(qualifier_list.length==0)
                        {
                            if ($('#radiology_qualifier_opd').hasClass("select2-hidden-accessible")) {
                                $('#radiology_qualifier_opd').select2("destroy");
                            }
                             
                            vm.resultData.radiology_qualifier_text_enable=true;
                        }
                        else
                        {
                          
                            vm.resultData.radiology_qualifier_text_enable=false;
                            setTimeout(function(){
                                  $('#radiology_qualifier_opd').select2({
                                    placeholder: "Select",
                                    tags:false 
                                  });
                                },200);
                            vm.investigationData.radiologyQualifier=_.cloneDeep(qualifier_list_new);
                             
                        }

                        

                    },
                    (error) => {
                    },
                );
            },
            getSpecialRequestList(r_id)
            {
                let vm=this;
                var special_request_list_new=[];
                User.getSpecialRequestByRadiologyId(r_id).then(
                   (response) => {
                        let special_data=response.data.data;

                        $.each(special_data, function(key, value) {
                            let id_body=value.id;
                            let name=value.name;
                            special_request_list_new.push({
                                text:name,
                                id:id_body
                            });
                        });
                        let special_request_list=special_request_list_new;
                        
                         if(special_request_list.length==0)
                        {
                            if ($('#radiology_special_request_opd').hasClass("select2-hidden-accessible")) {
                                $('#radiology_special_request_opd').select2("destroy");
                            }
                             
                            vm.resultData.radiology_special_request_text_enable=true;
                        }
                        else
                        {
                            
                             vm.resultData.radiology_special_request_text_enable=false;
                            setTimeout(function(){
                                  $('#radiology_special_request_opd').select2({
                                    placeholder: "Select",
                                    tags:false 
                                  });
                                },300);
                            vm.investigationData.radiologySpecialRequest=_.cloneDeep(special_request_list_new);
                           
                        }

                    },
                    (error) => {
                    },
                );
            },
             getSpineList(b_id)
            {
                let vm=this;
                var spine_list_new=[];
                User.getSpineList().then(
                   (response) => {
                        let spine_data=response.data.data;

                        $.each(spine_data, function(key, value) {
                            let id_body=value.id;
                            let name=value.name;
                            spine_list_new.push({
                                text:name,
                                id:id_body
                            });
                        });
                        vm.investigationData.Spine_option=_.cloneDeep(spine_list_new);

                    },
                    (error) => {
                    },
                );
            },
            initializeRadioSubtype(b_text,b_id)
            {
                let vm=this;
                vm.resultData.spine_option_value="";
                vm.resultData.qualifier_radio_text_enable = false;
                vm.resultData.subtype_text_enable = false;
                let radiologySubType_val=b_text;
                vm.resultData.bodyPart = b_id;  
                if(vm.resultData.type_name=='MRI')
                {
                    setTimeout(function(){
                        $('#radiology_qualifier_opd').select2({
                                placeholder: "Select",
                                tags:false 
                              }); 
                    },500);
                }
                if(radiologySubType_val=='Spine')
                {
                    vm.resultData.qualifier="";
                    vm.resultData.qualifier_text="";

                    $('#radiology_qualifier_opd').select2("destroy");
                    setTimeout(function(){
                        $('#radiology_spine_opd').select2({
                          placeholder: "Select",
                          tags:false 
                        }); 
                    },500);
                    vm.getSpineList();
                    vm.resultData.subtype_text_enable = false;
                    vm.resultData.bodyPart_others="";
                }
                else if(radiologySubType_val=='Brain')
                {
                    vm.resultData.subtype_text_enable = false;
                }
                else if(radiologySubType_val == 'Other' || radiologySubType_val =='Joint' ){
                    $('#radiology_spine_opd').select2("destroy");
                    vm.resultData.subtype_text_enable = true;
                } 
                
            },
            initializeRadio(resType)
            {
                let vm=this;
                //for radio subtype
                
                vm.resultData.radiology_subtype="";
                $('#radiology_subtype_opd').val('').trigger('change');
                
                //for radio qualifier
                
                vm.resultData.radiology_qualifier_text_enable=true;
                vm.resultData.qualifier="";
                vm.resultData.qualifier_text="";
                $('#radiology_qualifier_opd').val('').trigger('change');
                //for special request
                vm.resultData.radiology_special_request_text_enable=true;
                vm.resultData.special_request="";
                vm.resultData.special_request_text="";
                $('#radiology_special_request_opd').val('').trigger('change');
                vm.resultData.bodyPart ="";
                vm.resultData.bodyPart_text ="";
                vm.resultData.subtype_text_enable = false;
                
                
                if(resType=='MRI')
                {
                    if($('#radiology_special_request_opd').hasClass("select2-hidden-accessible")) {
                        $('#radiology_special_request_opd').select2("destroy");
                    } 
                    vm.resultData.radiology_qualifier_text_enable=false;
                    setTimeout(function(){
                        $('#radiology_qualifier_opd').select2({
                            placeholder: "Select",
                            tags:false 
                        }); 
                        $('#radiology_special_request_opd').select2({
                            placeholder: "Select",
                            tags:false 
                        });
                    },500);
                }
                else
                {
                    if($('#radiology_qualifier_opd').hasClass("select2-hidden-accessible")) {
                        $('#radiology_qualifier_opd').select2("destroy");
                    }
                    if($('#radiology_special_request_opd').hasClass("select2-hidden-accessible")) {
                        $('#radiology_special_request_opd').select2("destroy");
                    } 
                   
                }
                vm.getSpecialRequestList(vm.resultData.type);
            },
           saveRadiologyReport()
          {
              let vm =this;
              if(vm.resultData.type == '' ){
                  toastr.error('Please select report data.', 'Report error', {timeOut: 5000});
                  return false;
              }
              
               let matches=_.some(vm.ref_radio_array,{'type':vm.resultData.type,'bodyPart':vm.resultData.bodyPart,'qualifier':vm.resultData.qualifier,'special_request':vm.resultData.special_request});
              if(matches)
              {
                  $('#referral').val('').trigger('change.select2');
                  vm.setRadioReferral();
                  toastr.error('This record already exist', 'Error', {timeOut: 5000});
                  return false;
              }
              vm.resultData.id = vm.ref_radio_array.length+1;
              vm.ref_radio_array.push(vm.resultData);
              vm.reffData.reffreal_radiology_array = _.cloneDeep(vm.ref_radio_array);
              $('#referral').val('').trigger('change.select2');
              vm.setRadioReferral();
              return false;
          },
           setRadioReferral()
          {
              let vm =this;
              vm.cross_internal='false';
              vm.cross_external='false';
              if($('#radiology_qualifier_opd').hasClass("select2-hidden-accessible")){
                $('#radiology_qualifier_opd').select2("destroy");
              }
              if($('#radiology_special_request_opd').hasClass("select2-hidden-accessible")){
                $('#radiology_special_request_opd').select2("destroy");
              }
              if($('#radiology_spine_opd').hasClass("select2-hidden-accessible")){
                $('#radiology_spine_opd').select2("destroy");
              }
              $('#radiology_type_opd').val('').trigger('change.select2');
              $('#radiology_subtype_opd').val('').trigger('change.select2');
              
              vm.resultData = {
                   'id':'',
                    'uploadType':'image',
                    'bodyPart':'',
                    'bodyPart_text':'',
                    'bodyPart_others':'',
                    'type': '',
                    'type_text':'',
                    'spine_option_value':'',
                    'subType': '',
                    'qualifier':'',
                    'qualifier_text':'',
                    'imgData': '',
                    'textData': '',
                    'subtype_text_enable':false,
                    'qualifier_radio_text_enable':false,
                    'special_request':'',
                    'special_request_text':'',
                    'removed':false,
                    'qualifierOtherPart':'',
                    'body_part_side':'',
                    'body_part_side_text':'',
                    'radiologyOther':'',
                    'body_part_text':false,
                    'type_name':'',
                    'body_part_others_type':'scribble',
                    'body_part_others':'',
                    'signaturePad':{},
                    'signaturePad3_src':'',
                };
                $('#radio_div1 .ls-select2').val(null).trigger('change');
                vm.reffData.referral="";
          },
          removeRadioRef(rid)
          {
              let vm =this;
              _.remove(vm.ref_radio_array, function(o) {
                  return o.id==rid;
                });
              vm.reffData.reffreal_radiology_array= _.cloneDeep(vm.ref_radio_array);
          },
          saveLabReport()
          {
              let vm =this;
              if(vm.laboratory_array.length>0)
              {
                
                 _.forEach(vm.laboratory_array, function(value, key) {
                    
                    let objArray=vm.ref_lab_array;
                    let matches={};
                    if(vm.ref_lab_array)
                    {
                        matches=objArray.find(function (obj) { return obj.lab_id == value; });
                    }
                    if(matches)
                    {
                        vm.setLabReferral();
                        toastr.error('This record already exist', 'Error', {timeOut: 5000});
                        return false;
                    }
                    else
                    {
                      var lab_name= $("#laboratory_report_opd option[value='"+value+"']").text();
                      vm.ref_lab_array.push({'id':vm.ref_lab_array.length+1,'name':lab_name,'lab_id':value});
                    }
                    
                  });
              }
              vm.reffData.reffreal_laboratory_array= _.cloneDeep(vm.ref_lab_array);
              vm.setLabReferral();
              return false;
          },
          setLabReferral()
          {
               let vm =this;
              $('#referral').val('').trigger('change.select2');
              $('#laboratory_report_opd').val('').trigger('change.select2');
              vm.reffData.referral="";
              vm.laboratory_array=[];
          },
          removeLabRef(lid)
          {
              let vm =this;
              _.remove(vm.ref_lab_array, function(o) {
                  return o.id==lid;
                });
              vm.reffData.reffreal_laboratory_array= _.cloneDeep(vm.ref_lab_array);
          },
          saveCrossReport()
          {
                let vm =this;
                let matches2={};
                let objArray=vm.ref_cross_array;
                if(vm.cross_internal=='true')
                {
                    
                    if(vm.ref_cross_array)
                    {
                        matches2=objArray.find(function (obj) { return obj.value == vm.internal_array; });
                    }
                }
                else
                {
                    if(vm.ref_cross_array)
                    {
                        matches2=objArray.find(function (obj) { return obj.value == vm.reffData.cross_type_ext; });
                    }
                }
                
                
                if(matches2)
                {
                    vm.setCrossReferral();
                    toastr.error('This record already exist', 'Error', {timeOut: 5000});
                    return false;
                }
                if(vm.internal_array.length>0)
                {
                  vm.ref_cross_array.push({'id':vm.ref_cross_array.length+1,'type':vm.reffData.referral,'subtype':'Internal','value':vm.internal_array,'text':vm.internal_text_array});
                }
                if(vm.reffData.cross_type_ext)
                {
                    vm.ref_cross_array.push({'id':vm.ref_cross_array.length+1,'type':vm.reffData.referral,'subtype':'External','value':vm.reffData.cross_type_ext,'text':vm.reffData.cross_type_ext});
                }
                vm.reffData.reffreal_cross_array= _.cloneDeep(vm.ref_cross_array);
                vm.setCrossReferral();
                return false;

          },
          setCrossReferral()
          {
               let vm =this;
              $('#referral').val('').trigger('change.select2');
              $('#cross').val('').trigger('change.select2');
              $('#internal').val('').trigger('change.select2');
              vm.reffData.referral="";
              vm.reffData.cross_type_ext="";
              vm.internal_array=[];
              vm.cross_internal='false';
              vm.cross_external='false';
          },
          removeCrossRef(cid)
          {
              let vm =this;
              _.remove(vm.ref_cross_array, function(o) {
                  return o.id==cid;
                });
              vm.reffData.reffreal_cross_array= _.cloneDeep(vm.ref_cross_array);
          },
            
        }
           
    }
</script>
