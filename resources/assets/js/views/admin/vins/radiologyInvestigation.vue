<template>
<div>
	<h4>Radiology:</h4>
    	<div class="row form-group" id="radio_div">
    		<div class="col-md-12">
    			<div class="row form-group">
    				<div class="col-md-6">
    					<label>Select Radiology:</label><br>
    					<select class = "form-control ls-select2" id = "radiology_type" name = "radiology_type" v-validate="'required'">
                            <option value="">Select</option>
    						<option v-for="type in investigationData.radiologyType" :value="type.id">{{type.text}}</option>
    					</select>
                        <span class="help is-danger" v-show="errors.has('radiology_type')">
                            Field is required
                        </span>
                    </div>
                     <div class="col-md-6">
                        <div class="col-md-12" v-if="resultData.type_name=='Other'">
                          <label> Other Parts</label>
                          <input type="text" name="radiology_other_text" id="radiology_other_text" class="form-control" v-model="resultData.radiologyOther">
                        </div>
                    </div>
                   
                 </div>
                  <div class="row form-group">
                    <div class="col-md-6">
                        <label>Body Part Side:</label><br>
                        <select class = "form-control ls-select2" id = "body_part_side" name = "body_part_side">
                            <option value="">Select</option>
                            <option v-for="bps in investigationData.bodyPartSide" :value="bps.id">{{bps.text}}</option>
                        </select>
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
    				<div class="col-md-6" v-if="resultData.body_part_text==false">
    					<label>Body Parts:</label><br>
    					<select class = "form-control ls-select2" id = "radiology_subtype" name = "radiology_subtype" v-validate="'required'">
                            <option value="">Select</option>
    						<option v-for="obj in investigationData.radiologySubType" :value="obj.id">{{obj.text}}</option>
    					</select>
                        <span class="help is-danger" v-show="errors.has('radiology_subtype')">
                            Field is required
                        </span>     
                    </div>
                    <div class="col-md-6" v-if="(resultData.body_part_text)">
                        <label>Body Parts:</label><br>
                        <input type="text" name="radiology_subtype" id="radiology_subtype" class="form-control" v-model="resultData.bodyPart_text" >
                        <span class="help is-danger" v-show="errors.has('radiology_subtype')">
                            Field is required
                        </span>     
                    </div>

                    <div class="col-md-6" v-if="resultData.subtype_text_enable" v-validate="'required'">
                        <label> Other Parts</label>   
                        <input type="text" name="subType_text" id="subType_text" class="form-control" v-model="resultData.bodyPart_others" >

    			    </div>
                    <div class="col-md-6" v-if="resultData.bodyPart_text == 'Spine'">
                        <label> Spine option</label>
                        <select class="form-control ls-select2" id="radiology_spine" name="radiology_spine" v-model="resultData.spine_option_value" v-validate="'required'">
                            <option value="">Select</option>
                            <option v-for="obj in investigationData.Spine_option" :value="obj.id">{{obj.text}}</option>
                        </select>
                          <span class="help is-danger" v-show="errors.has('radiology_spine')">
                  Field is required
                </span>    
                      </div>
                    
                </div>
                <div class="row form-group">
    				<div class="col-md-6">
    					<label>Select Qualifires:</label><br>
    					<select class = "form-control ls-select2" id = "radiology_qualifier" name = "radiology_qualifier" v-if="!(resultData.radiology_qualifier_text_enable)"  v-model="resultData.qualifier"  v-validate="'required'">
                            <option value="">Select</option>
    						<option v-for="obj in investigationData.radiologyQualifier" :value="obj.id">{{obj.text}}</option>
    					</select>
                        <input type="text" name="qualifier" id="qualifier" class="form-control" v-model="resultData.qualifier_text" v-else>
                           <span class="help is-danger" v-show="errors.has('radiology_qualifier')">
                                Field is required
                            </span>    
                        
    					
    				</div>
                     <div class="col-md-6">
                        <div class="col-md-12" v-if="resultData.qualifier_radio_text_enable">
                          <label> Other Parts</label>
                          <input type="text" name="qualifier_other_text" id="qualifier_other_text" class="form-control" v-model="resultData.qualifierOtherPart">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div v-if="!(resultData.radiology_special_request_text_enable)">
                            <label>Select Special request:</label><br>
                            <select class = "form-control ls-select2" id = "radiology_special_request" name = "radiology_special_request"   v-model="resultData.special_request"  >
                                <option value="">Select</option>
                                <option v-for="obj in investigationData.radiologySpecialRequest" :value="obj.id">{{obj.text}}</option>
                            </select>
                        </div>
                        <div v-else>
                            <label>Select Special request:</label><br>
                        
                            <input type="text" name="special_request" id="special_request" class="form-control" v-model="resultData.special_request_text" >
                            
                        </div>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6" >
                        <label>Report details:</label><br>
                        <textarea class="form-control" cols="50" rows="5" v-model="resultData.textData"></textarea>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-6"  v-if="(resultData.type != '' && resultData.bodyPart_text != '')"  >
                        <label>Select upload type:</label><br>
                        <select class="form-control ls-select2" id = "upload_type" name = "upload_type" v-model="resultData.uploadType"  >
                            <option value="image_web">Image From Web</option>
                            <option value="image">Image</option>
                            <option value="video">Video</option>
                        </select>
                    </div>
    				<div class="col-md-6" v-if="(resultData.type != '' && resultData.bodyPart_text != '')">
                        <div v-if="(resultData.uploadType == 'image' || resultData.uploadType == 'video' )">
                            
                            <label class="control-label txt_media" for="input-21">
                                Select File
                            </label>
                             <br>
                            <div tabindex="500" class="btn btn-primary " id="btn-img-file" >
                                <i class="fa fa-folder-open"></i>  
                                <span class="hidden-xs">Browse …</span>
                            </div>
                            <input type="file" name="img_upload_video[]" id="img_upload_video" multiple class="file_multi_video" @change="previewFile('video')" accept="video/*" style="display: none;">

                            <input id="img_upload_file" name="imgupload[]" type="file" multiple class="btn btn-info  "  @change="previewFile('img')"  accept="image/*" style="display: none;">                        
                        </div>
                        <div v-if="(resultData.uploadType == 'image_web')">
                              <label class="control-label txt_media" for="input-21">
                                Enter Url:
                            </label>
                             <input type="text" name="img_upload_web[]" id="img_upload_web" multiple class="form-control" @change="previewFile('image_web')" placeholder="Enter image url" />
                               <span class="help is-danger" v-if="(resultData.errorUrl != '')">
                                {{resultData.errorUrl}}
                            </span>   
                        </div>
                    </div>
                   
                    
    			</div>

                <card title="Gallery Preview" v-if="imgGallery">
                    <div class="row form-group">
                        <div class="col-6 col-lg-3 col-sm-6" v-if="img.remove==false" v-for="(img,index) in imgGallery.data" >
                            <div v-if="img.type =='image'">
                                <a class="mag img-fluid">
                                    <br/>
                                    <img data-toggle="magnify" class="mag-style img-fluid" :src="img.data" alt="image">
                                </a>
                                <br>
                            </div>
                            <div  v-else >
                                <a class="mag img-fluid">
                                <video width="200px" height="auto"    controls>
                                  <source :src="img.data" id="video_here">
                                    Your browser does not support HTML5 video.
                                </video>
                                </a>
                            </div>
                            <label v-if="imgGallery.view!=true"  @click="removeImage(img.id)">Remove</label>
                        </div>
                    </div>
                        <!--row-->
                </card>
                <div class="row form-group">
                    <div class="col-md-12">
                         <button type="button" class="btn btn-primary btn-lg " :disabled="(resultData.type == '')" @click="saveReport()">Add</button>
                    </div>
                </div>    


                 
    		</div>
    	</div>
            <div class="row">
        <div class="col-md-12">
             <card title="<i class='ti-layout-cta-left'></i> Reports">
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
                            <th>Gallery</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(res,index) in finalResultData">
                                <td>{{++index}}</td>
                                <td>{{res.type_name}}</td>
                                <td>{{res.bodyPart_text}}</td>
                                <td>{{res.qualifier_text}}</td>
                                <td>{{res.special_request_text}}</td>
                                <td>{{res.textData | strLimit}}</td>
                                <td><a href="javascript:void(0)" @click="viewGallery(res.id)" class="red">View</a></td>
                                <td> <i class="fa fa-remove" @click="removeReport(res.id)"></i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </card>
        </div>
    </div>
</div>
</template>

<script>
  
    import User from '../../../api/users.js';
    import _ from 'lodash';
    import card from "./card.vue";
    import SignaturePad from 'signature_pad';

    // import vue2Dropzone from 'vue2-dropzone'
    // import 'vue2-dropzone/dist/vue2Dropzone.css'

    export default {
        computed:{

        },
        components: {
            card,
            // vueDropzone: vue2Dropzone
        },
        filters: {
          strLimit: function (value) {
            if(value.length > 50){
                var str50 = value.substr(0,50);
                return str50+'...'; 
            } else {
                return value; 

            }
          }
        },
        data() {
            return {
                'notValid':false,
                'footer' : 'footer',
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
                'imgGallery':'',
                'finalResultData':[],
                'radiologyData':[],
            }
        },
        mounted() {
             "use strict"
            let vm =this;
            $("body .js-loader").removeClass('d-none');
            vm.initResData();
             $("body .js-loader").addClass('d-none');
            if(vm.$store.state.Users.userDetails.user_type != '1'){
              vm.$root.$emit('logout','You are not authorise to access this page'); 
            }
            $('.ls-select2').select2({
                placeholder: "Select",
            });
                 
            $('#radio_div').on('click','#btn-img-file',function(){
                if(vm.resultData.uploadType == 'image'){

                    $('#img_upload_file').trigger('click');
                } else if(vm.resultData.uploadType == 'video') {
                    $('#img_upload_video').trigger('click');
                } 
            });
            vm.getRadiologySelectList();
            vm.getBodypartSideSelectList();

            $('#radio_div').on("select2:select", '.ls-select2',function (e) {
                if(this.id == 'radiology_type') 
                {
                    vm.imgGallery = '';
                    vm.resultData.type =$('#radiology_type').select2('data')[0].id;
                    vm.resultData.type_name = $('#radiology_type').select2('data')[0].text;
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
                if(this.id == 'radiology_subtype') 
                {
                    vm.resultData.radiology_subtype=$('#radiology_subtype').select2('data')[0].id;
                    let b_id=$('#radiology_subtype').select2('data')[0].id;
                    let b_text=$('#radiology_subtype').select2('data')[0].text;
                    vm.resultData.bodyPart_text=b_text;
                    vm.initializeRadioSubtype(b_text,b_id);
                    vm.getQualifierList(b_id);
                }
                if(this.id == 'radiology_qualifier') 
                {
                    
                    vm.resultData.qualifier =$('#radiology_qualifier').select2('data')[0].id;
                    vm.resultData.qualifier_text =$('#radiology_qualifier').select2('data')[0].text;
                    let q_id=$('#radiology_qualifier').select2('data')[0].text;
                    vm.initializeQualifier(q_id);
                }
                if(this.id == 'radiology_special_request') 
                {
                     vm.resultData.special_request=$('#radiology_special_request').select2('data')[0].id;
                     vm.resultData.special_request_text =$('#radiology_special_request').select2('data')[0].text;
                }
                if(this.id == 'radiology_spine') 
                {
                    vm.resultData.spine_option_value=$('#radiology_spine').select2('data')[0].id;
                }
                if(this.id == 'upload_type') 
                {
                    vm.resultData.uploadType=$('#upload_type').select2('data')[0].id;
                }

            });
            
        },
         methods: {
            initializeQualifier(q_id)
            {
                let vm=this;
                if(q_id=='Other')
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
                            if ($('#radiology_qualifier').hasClass("select2-hidden-accessible")) {
                                $('#radiology_qualifier').select2("destroy");
                            }
                             
                            vm.resultData.radiology_qualifier_text_enable=true;
                        }
                        else
                        {

                            setTimeout(function(){
                                  $('#radiology_qualifier').select2({
                                    placeholder: "Select",
                                    tags:false 
                                  });
                                },50);
                            vm.investigationData.radiologyQualifier=_.cloneDeep(qualifier_list_new);
                            vm.resultData.radiology_qualifier_text_enable=false;
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
                            if ($('#radiology_special_request').hasClass("select2-hidden-accessible")) {
                                $('#radiology_special_request').select2("destroy");
                            }
                             
                            vm.resultData.radiology_special_request_text_enable=true;
                        }
                        else
                        {
                           
                             vm.resultData.radiology_special_request_text_enable=false;
                            setTimeout(function(){
                                  $('#radiology_special_request').select2({
                                    placeholder: "Select",
                                    tags:false 
                                  });
                                },50);
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
                setTimeout(function(){
                    $('#upload_type').select2({
                        placeholder: "Select",
                        tags:false 
                    }); 
                },300);
                if(vm.resultData.type_name=='MRI')
                {
                    setTimeout(function(){
                        $('#radiology_qualifier').select2({
                                placeholder: "Select",
                                tags:false 
                              }); 
                    },500);
                }
                if(radiologySubType_val=='Spine')
                {
                    vm.resultData.qualifier="";
                    vm.resultData.qualifier_text="";

                    $('#radiology_qualifier').select2("destroy");
                    setTimeout(function(){
                        $('#radiology_spine').select2({
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
                    $('#radiology_spine').select2("destroy");
                    vm.resultData.subtype_text_enable = true;
                } 
                
            },
            initializeRadio(resType)
            {
                let vm=this;
                //for radio subtype
                
                vm.resultData.radiology_subtype="";
                $('#radiology_subtype').val('').trigger('change');
                
                //for radio qualifier
                vm.resultData.radiology_qualifier_text_enable=true;
                vm.resultData.qualifier="";
                vm.resultData.qualifier_text="";
                $('#radiology_qualifier').val('').trigger('change');
                //for special request
                vm.resultData.radiology_special_request_text_enable=true;
                vm.resultData.special_request="";
                vm.resultData.special_request_text="";
                $('#special_request').val('').trigger('change');
                vm.resultData.bodyPart ="";
                vm.resultData.bodyPart_text ="";
                vm.resultData.subtype_text_enable = false;
                vm.getSpecialRequestList(vm.resultData.type);

                if(resType=='MRI')
                {
                    if($('#radiology_special_request').hasClass("select2-hidden-accessible")) {
                        $('#radiology_special_request').select2("destroy");
                    } 
                    vm.resultData.radiology_qualifier_text_enable=false;
                    setTimeout(function(){
                        $('#radiology_qualifier').select2({
                            placeholder: "Select",
                            tags:false 
                        }); 
                        $('#radiology_special_request').select2({
                            placeholder: "Select",
                            tags:false 
                        });
                    },500);
                    
                }
                else
                {
                    if($('#radiology_qualifier').hasClass("select2-hidden-accessible")) {
                        $('#radiology_qualifier').select2("destroy");
                    }
                    if($('#radiology_special_request').hasClass("select2-hidden-accessible")) {
                        $('#radiology_special_request').select2("destroy");
                    } 
                }
            },
            radioSubType(){
                let vm =this;
                let resType = vm.resultData.type;
                let resTypeName = vm.resultData.type_name;
                //for radio subtype
                vm.getBodypartsByRadiology(resType);
            },
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
                            if ($('#radiology_subtype').hasClass("select2-hidden-accessible")) {
                                $('#radiology_subtype').select2("destroy");
                            }
                             
                            vm.resultData.body_part_text=true;
                        }
                        else
                        {

                            setTimeout(function(){
                                  $('#radiology_subtype').select2({
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
            initResData()
            {
                let vm=this;
                 var radio_data = _.cloneDeep(vm.$store.state.Patient.radioData);
                 if(radio_data.length)
                 {
                    vm.finalResultData = radio_data;
                    vm.radiologyData=radio_data;
                 }
                
            },
            viewGallery(gid) {

                let vm = this;
                _.find(vm.finalResultData, function(res) {
                    if(res.id == gid) {
                        vm.imgGallery = {'view':true,'data':res.imgData};
                       
                        setTimeout(function(){
                            jQuery('[data-toggle="magnify"]').magnify();    
                        },1000)
                    }
                });
            },
            removeImage(no) {
                let vm = this;
                _.find(vm.resultData.imgData, function(img) {
                    if(img.id == no) {
                        img.remove =true;
                    }
                });
            },
            removeReport(did) {

                let vm =this;
                // _.pullAt(resData, 0);
                /*_.find(vm.finalResultData, function(res) {
                    if(res.id == did) {
                         res.removed = true;
                    }
                });*/
                 _.remove(vm.finalResultData, function(o) {
                    return o.id==did;
                });
                
                vm.initData();
                vm.setRadioData();

            },
            editReport (eid) {
              _.find(vm.finalResultData, function(res) {
                    if(res.id == eid) {
                        vm.resultData = vm.finalResultData;
                         res.removed = true;
                    }
                });
                vm.setRadioData();

            },
            saveReport() {
                let vm =this;
                var resData=vm.radiologyData;
                 // resData.push= vm.finalResultData;
                 $('#radiology_special_request').select2("destroy");
                 $('#radiology_qualifier').select2("destroy");
                vm.resultData.qualifier_radio_text_enable = false;
                if(vm.resultData.type == ''){
                    toastr.error('Please select report data.', 'Report error', {timeOut: 5000});
                    return false;
                }
                vm.resultData.id = resData.length;
                resData.push(vm.resultData); 
                vm.radiologyData=resData;
                vm.finalResultData = _.cloneDeep(vm.radiologyData);

                vm.initData();
                vm.setRadioData();
            },
            setRadioData() {
                let vm =this;
                vm.$store.dispatch('saveRadioData',vm.finalResultData);
            },
            initData() {
                let vm =this;
                
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
                    'radiology_qualifier_text_enable':true,
                    'radiology_special_request_text_enable':true,
                };
                vm.imgGallery = '';

                $('#radio_div .ls-select2').val(null).trigger('change');
                // $('.ls-select2').select2().val('');

            },
            previewFile(ptype) {
                let vm =this;
                var imgData = [];
                var videoData = [];
                 jQuery('.js-loader').removeClass('d-none');

                 if(ptype == 'img') {
                    var fileList = document.querySelector('input[id=img_upload_file]').files;
                    var x= 1;var y=1; 
                    jQuery(fileList).each(function(i){
                        let file = document.querySelector('input[id=img_upload_file]').files[i];
                        var tm = 100*x;
                        setTimeout(function(){
                            var reader  = new FileReader();

                            reader.addEventListener("load", function () {
                                imgData.push({'id':y,'data':reader.result,'remove':false,'view':false,'type':'image'});
                            }, false);
                            reader.readAsDataURL(file); 
                            ++y;             
                        },tm)
                        x++;
                    })
                    
                 }else if(ptype == 'image_web') { 
                      let url = document.querySelector('input[id=img_upload_web]').value;
                      var x= 1;var y=1; 
                         
                    if(url != ''){

                            var tm = 100*x;
                            let imageData = '';
                             User.getImagefromUrl(url).then(
                             (response) => {
                                vm.resultData.errorUrl = '';
                                imageData =   response.data.data;
                                if(response.data.status == 200){
                                    setTimeout(function(){

                                        imgData.push({'id':y,'data':imageData,'remove':false,'view':false,'type':'image'});
                                        ++y;             
                                    },tm)
                                    x++;
                                }else if(response.data.status == 201){
                                     vm.resultData.errorUrl =  response.data.message;
                                }else{
                                    vm.resultData.errorUrl = 'Something wrong';
                                }
                             },
                             (error) => {

                            }
                            );
                    }else{
                         vm.resultData.errorUrl = 'Please enter url.';
                    }

                 }else {
                    var fileList = document.querySelector('input[id=img_upload_video]').files;
                    var x= 1;var y=1; 
                    jQuery(fileList).each(function(i){
                      let file = document.querySelector('input[id=img_upload_video]').files[i];
                      let video_src= URL.createObjectURL(file);
                      imgData.push({'id':y,'data':video_src,'remove':false,'view':false,'type':'video'});
                      // $source.parent()[0].load();
                      x++;
                      ++y;
                    })
                     
                 }
                setTimeout(function(){
                jQuery('.js-loader').addClass('d-none');
                    vm.resultData.imgData = imgData;
                    vm.imgGallery = {'view':false,'data':imgData};
                    setTimeout(function(){
                        jQuery('[data-toggle="magnify"]').magnify();    
                    },1000)
                },5000)
                
            },
            
            GetSelectComponent(componentName) {
               this.$router.push({name: componentName})
            },
        }
    }
</script>

<style>
/*image overlapping in magification*/

.magnify .magnify {
    z-index: 2;
}

.magnify .magnify-large {
    z-index:4;
}
</style>