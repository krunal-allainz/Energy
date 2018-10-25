<template id="">
  <div class="container">

    <div class="page-header">
      <div class="row text-center">
        <div class="col-md-12">
          <h1>OPD Form</h1>
        </div>
      </div>
    </div>
    <div class="row">
      <step-progress-bar :curstep="curStep"></step-progress-bar>
    </div>
    <form action="" method="post" enctype="multipart/formdata">
      <div v-if="curStep == 1">
        <div class="row form-group" v-show="patient_select_enable==true">
          <div class="col-md-6">
            <div class="col-md-6 ">
              <label for="patient">Select Patient:</label>
            </div>
            <div class="col-md-6">
              <select  class="form-control ls-select2"  id = "patient" name="patient" value="" v-model="opdData.patientlist" > 
                    <option value="">Select </option>
                   <option :value="pat.id" v-for="pat in opdData.patient_option">{{pat.name}}</option>
                </select> 
            </div>
          </div>
        </div>
          <div v-if="isPatientSearch">
            <patientSearch v-if="patient_select_enable==false" :user_id="doctor_id" ref="opd_form"></patientSearch>
          </div>
         
          <div class="row form-group">
            <div class="col-md-6" v-if="patient_select_enable==true">
              <div class="col-md-6">
                <button type="button" class="btn btn-primary" @click="patient_select_change(true)">Search Patient By Another</button>
              </div>
            </div>
            <div class="col-md-6" v-if="patient_select_enable==false">
              <div class="col-md-6">
                <button type="button" class="btn btn-primary" @click="patient_select_change(false)">Select Patient</button>
              </div>
            </div>

            <div class="col-md-6" v-show="(opdData.last_vist != '')">
              <div class="col-md-6 ">
                <label for="opd_no">Last Visit:</label>
              </div>
               <div class="col-md-6">
                {{opdData.last_vist}}
               </div>
            </div>
           <!--  <div class="col-md-6" >

              <div class="col-md-6 ">
                <label for="opd_no"last_vist>Select OPD No.:</label>
              </div>
              <div class="col-md-6">
                <select  class="form-control ls-select2" v-validate="'required'" id = "opd_no" name="opd_no" value="" v-model="opdData.opd_id" > 
                     <option value="">Select</option>
                     <option :value="opd.id" v-for="opd in opdData.opd_option">{{opd.opd_id}}</option>
                  </select> 
                  <i v-show="errors.has('opd_no')" class="fa fa-warning"></i>      
                   <span class="help is-danger" v-show="errors.has('opd_no')">
                    Please Select OPD Number.
                  </span> 
              </div>
            </div> -->
          </div>         
          <div class="row form-group">
            <div class="col-md-12">
                 <div class="col-md-6"  v-if="opdData.uhid_no!=''">
                  <div class="col-md-6 " v-if="opdData.uhid_no!=''" >
                    <label for="date">UHID No:</label>
                  </div>
                  <div class="col-md-6" v-if="opdData.uhid_no!=''" >
                   <!--  <input type="text" class="form-control"  v-model="opdData.uhid_no" readonly=""> -->
                    <label>{{opdData.uhid_no}}</label>
                  </div>  
                </div>
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-6">
              <div class="col-md-6">
                <label for="date">Weight:</label>
              </div>
              <div class="col-md-6">
                <input type="text" name="weight" id="weight" class="form-control" v-model="opdData.weight"  placeholder="In kgs"   v-validate="'decimal:1|required|min_value:1||max_value:999'">
                  <i v-show="errors.has('weight')" class="fa fa-warning"></i> 
                  <span class="help is-danger" v-show="errors.has('weight')"> 
                    Please enter valid weight.</span>
                </div>
              </div>
              <div class="col-md-4">
                <div class="col-md-6">
                  <label for="date">Height:</label>
                </div>
                <div class="col-md-9">
                  <input type="text" name="height" id="height" class="form-control" placeholder="In cms" v-model="opdData.height"  v-validate="'required|numeric|min_value:1'">
                  <i v-show="errors.has('height')" class="fa fa-warning"></i> 
                    <span class="help is-danger" v-show="errors.has('height')"> 
                      Please enter valid height . </span>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="col-md-6">
                    <label for="date">BMI:</label>
                  </div>
                  <div class="col-md-12">
                    <input type="text" name="bmi" id="bmi" class="form-control" readonly="" v-model="bmi_mod">
                    </div>
                  </div>
                </div>
                <hr>
                  <div class="row form-group">
                    <div class="col-md-6">
                      <div class="col-md-6">
                        <label for="date">Doctor:</label>
                      </div>
                      <div class="col-md-6">
                        <input type="text" name="doctor" id="doctor" class="form-control" readonly="" v-model="doctor">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="col-md-6">
                        <label for="date">Department:</label>
                      </div>
                      <div class="col-md-6">
                        <input type="text" name="department" id="department" class="form-control" readonly=""  v-model="department">
                      </div>
                    </div>
                  </div>
                  <div class="row form-group">
                  <div class="col-md-6">
                    <div class="col-md-6">
                      <label for="date">RESP/SPO2:</label>
                    </div>
                    <div class="col-md-6">
                      <input type="text" name="vitals" id="vitals" class="form-control" v-model="opdData.vitals"  v-validate="'required'">
                      <i v-show="errors.has('vitals')" class="fa fa-warning"></i> 
                      <span class="help is-danger" v-show="errors.has('vitals')">
                        Please enter valid vitals. </span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="col-md-6">
                      <label for="date">Pulse:</label>
                    </div>
                    <div class="col-md-6" >
                      <div class=" input-group">
                        <input type="text" name="pulse" id="pulse" class="form-control" v-model="opdData.pulse"  v-validate="'required|numeric|min_value:1'"> 
                        <div class="input-group-append">
                            <span class="input-group-text ">/mm</span>
                        </div>
                      
                      </div>
                      <i v-show="errors.has('pulse')" class="fa fa-warning"></i>
                       <div class="help is-danger" v-show="errors.has('pulse')"> 
                        Please enter valid pulse.</div>
                    </div>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col-md-6">
                    <div class="col-md-6">
                      <label for="date">BP:</label>
                    </div>
                    <div class="col-md-6">
                      <div class=" input-group">

                      <input type="text" name="bp_systolic" id="bp_systolic" class="form-control"  v-model="opdData.bp_systolic"  v-validate="'required|numeric|min_value:1'" maxlength="3" > 
                        <div class="input-group-append">
                            <span class="input-group-text ">/</span>
                        </div>
                        <input type="text" name="bp_diastolic" id="bp_diastolic" class="form-control"  v-model="opdData.bp_diastolic"  v-validate="'required|numeric|min_value:1'" maxlength="3">
                      
                      </div>
                     
                      <i v-show="errors.has('bp_systolic')" class="fa fa-warning"></i>
                      <span class="help is-danger" v-show="errors.has('bp_systolic') || errors.has('bp_diastolic')">
                        Please enter valid BP.
                      </span>
                    </div>
                  </div>
                 
                </div>

                <div class="row form-group">

                  <div class="col-md-6">
                    <div class="col-md-6">
                      <label for="date">Temp:</label>
                    </div>
                    <div class="col-md-6">
                      <div class=" input-group">
                      <input type="text" name="temp" id="temp" class="form-control number-with-validation"  v-model="opdData.temp"  v-validate="'decimal:1|required|min_value:1||max_value:999'"  >
                        <div class="input-group-append">
                            <span class="input-group-text ">°F</span>
                        </div>
                      
                      </div>
                      <i v-show="errors.has('temp')" class="fa fa-warning"></i>
                      <span class="help is-danger" v-show="errors.has('temp')">
                         Please enter valid temprature.
                      </span>
                    </div>
                  </div>
                </div>


    <div class="row">
      <div class="col-md-6">
        <h3>Pain Assessment</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-2" @click="pain_value(0)"><img src="/assets/img/pain/P1.png" class="test"  v-bind:class="[opdData.pain_value==0 ? 'pain_select': '', 'pain_img'  ]"></div>
      <div class="col-md-2" @click="pain_value(2)"><img src="/assets/img/pain/P2.png"  v-bind:class="[opdData.pain_value==2 ? 'pain_select': '' , 'pain_img' ]"> </div>
      <div class="col-md-2" @click="pain_value(4)"><img src="/assets/img/pain/P3.png"   v-bind:class="[opdData.pain_value==4 ? 'pain_select': '', 'pain_img'  ]"></div>
      <div class="col-md-2" @click="pain_value(6)"><img src="/assets/img/pain/P4.png"   v-bind:class="[opdData.pain_value==6 ? 'pain_select': '', 'pain_img'  ]"></div>
      <div class="col-md-2" @click="pain_value(8)"><img src="/assets/img/pain/P5.png"   v-bind:class="[opdData.pain_value==8 ? 'pain_select': '', 'pain_img'  ]"></div>
      <div class="col-md-2" @click="pain_value(10)"><img src="/assets/img/pain/P6.png"   v-bind:class="[opdData.pain_value==10 ? 'pain_select': '', 'pain_img'  ]"></div>
    </div>

      <div class="row form-group">
        <div class="col-md-6">
            <div class="col-md-12">
              <label for="history">History type:</label>
              <button type="button" class="btn btn-submit" @click="setHistoryType('present','text')">Text</button>
              <button type="button" class="btn btn-warning" @click="setHistoryType('present','scribble')">Scribble</button>
            </div>

        </div>
        
      </div>
      <div class="row form-group">
        <div class="col-md-6">
            <div class="col-md-6">
              <label for="history">History: </label>
            </div>
            <div class="col-md-12" v-show="opdData.historyType == 'text'">
              <textarea name="history"  id="history" class="form-control"  v-model="opdData.history" cols=""></textarea> 
            </div>
            <div class="col-md-12" v-show="opdData.historyType == 'scribble'">
              <div id="signature-pad" class="signature-pad">
                <div class="signature-pad--body">
                  <canvas class="can-img" id="history_scribble" height="200px" width="500px" ></canvas> 
                </div>
                <div><button type="button" id="clear_history_scribble" class="btn btn-md btn-danger">Clear</button>
                <button type="button" id="save_history_scribble" class="btn btn-md btn-primary">Save</button></div>

              </div>
            </div>
        </div>
        <div class="col-md-6" v-if="opdData.signaturePad_src!=''">
          <div class="col-md-12">
              <label for="history">History Preview:     <i class="fa fa-download fa-lg red" @click="download(opdData.signaturePad_src,'History')" aria-hidden="true"></i></label>
            </div>
            <div>
              <img :src="opdData.signaturePad_src" title="past history">
            </div>  
        </div>
      </div>

      <div class="row form-group">
        <div class="col-md-6">
            <div class="col-md-12">
              <label for="history">Past History type:</label>
              <button type="button" class="btn btn-submit" @click="setHistoryType('past','text')">Text</button>
              <button type="button" class="btn btn-warning" @click="setHistoryType('past','scribble')">Scribble</button>
            </div>

        </div>
      </div>
      <div class="row form-group">
        <div class="col-md-6">
            <div class="col-md-6">
              <label for="history">Past History:</label>
            </div>
            <div class="col-md-12" v-show="opdData.pastHistoryType == 'text'">
              <textarea name="history"  id="history" class="form-control"  v-model="opdData.past_history" cols=""></textarea> 
            </div>
            <div class="col-md-12" v-show="opdData.pastHistoryType == 'scribble'">
              <div id="signature-pad1" class="signature-pad">
                <div class="signature-pad--body">
                  <canvas class="can-img" id="past_history_scribble" height="200px" width="500px" ></canvas> 
                </div>
                <div>
                  <button type="button" id="clear_past_history_scribble" class="btn btn-md btn-danger">Clear</button>
                  <button type="button" id="save_past_history_scribble" class="btn btn-md btn-primary">Save</button>
                </div>
              </div>
            </div>
        </div>
         <div class="col-md-6" v-if="opdData.signaturePad1_src!=''">
          <div class="col-md-12">
              <label for="history">Past history Preview:  <i class="fa fa-download fa-lg red" @click="download(opdData.signaturePad1_src,'Past history')" aria-hidden="true"></i></label>
            </div>
            <div>
              <img :src="opdData.signaturePad1_src" title="past history">
            </div>  
        </div>
      </div>
       <div class="row form-group">
        <div class="col-md-6">
          <div class="col-md-6">
            <label for="date">Provisional Diagnostic:</label>
          </div>
          <div class="col-md-12">
            <textarea class="form-control" name="provisional_diagnosis" id="provisional_diagnosis" v-model="opdData.provisional_diagnosis" v-validate="'required'"></textarea>
            <i v-show="errors.has('provisional_diagnosis')" class="fa fa-warning"></i>
            <span class="help is-danger" v-show="errors.has('provisional_diagnosis')">
               Please enter provisional diagnostic.
            </span>
          </div>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-md-6">
            <div class="col-md-12">
              <label for="history">Advice type:</label>
              <button type="button" class="btn btn-submit" @click="setHistoryType('advice','text')">Text</button>
              <button type="button" class="btn btn-warning" @click="setHistoryType('advice','scribble')">Scribble</button>
            </div>

        </div>
      </div>
    <div class="row form-group">
      <div class="col-md-6">
        <div class="col-md-6">
          <label for="advice">Advice:</label>
        </div>
        <div class="col-md-12" v-show="opdData.adviceType == 'text'">
          <textarea class="form-control" type="text" name="advice" id="advice" v-model="opdData.advice"></textarea>         
        </div>
         <div class="col-md-12" v-show="opdData.adviceType == 'scribble'">
              <div id="signature-pad2" class="signature-pad">
                <div class="signature-pad--body">
                  <canvas class="can-img" id="advice_scribble" height="200px" width="500px" ></canvas> 
                </div>
                <div>
                  <button type="button" id="clear_advice_scribble" class="btn btn-md btn-danger">Clear</button>
                  <button type="button" id="save_advice_scribble" class="btn btn-md btn-primary">Save</button>
                </div>
              </div>
            </div>
      </div>
      <div class="col-md-6" v-if="opdData.signaturePad2_src!=''">
          <div class="col-md-12">
              <label for="history">Past history Preview:  <i class="fa fa-download fa-lg red" @click="download(opdData.signaturePad2_src,'Advice')" aria-hidden="true"></i></label>
            </div>
            <div>
              <img :src="opdData.signaturePad2_src" title="Advice">
            </div>  
        </div>
    </div>
    <prescriptionData :department="department"> </prescriptionData>
    <div class="row form-group">
      <div class="col-md-6">
        <div class="col-md-12">
          <label for="referral">Referral:</label>
        </div>
        <div class="col-md-12">
          <select class="form-control ls-select2" name="referral" id="referral" v-model="opdData.referral" >
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
      <div class="col-md-6" v-if="opdData.referral == 'cross'">
        <div class="col-md-12">
          <label for="internal">Cross Reference:</label>
        </div>
        <div class="col-md-12">
          <select class="form-control ls-select2" name="cross" id="cross"  multiple="">
            <option value="internal">Internal</option>
            <option value="external">External</option>
          </select>
        </div>
      </div>
    </div>
    <div >
      <div class=" form-group" id="radio_div1" v-show="opdData.referral == 'radiology'">
        <div class="">
            <div class="row form-group">
               <div class="col-md-6"> 
                <div class="col-md-12">
                  <label>Select Radiology:</label>
                  <br>
                  <select class="form-control ls-select2" id="radiology_type_opd" name="radiology_type_opd">
                    <option v-for="type in investigationData.radiologyType" :value="type.value">{{type.text}}</option>
                  </select>
                  
                </div>
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-6">

                <div class="col-md-12">
                  <label>Body Parts:</label>
                  <br>
                  <select class="form-control ls-select2" id="radiology_subtype_opd" name="radiology_subtype_opd" v-model="resultData.subType">
                    <option v-for="obj in investigationData.radiologySubType" :value="obj.text">{{obj.text}}</option>
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12" v-if="resultData.subtype_text_enable">
                  <label> Other Parts</label>
                  <input type="text" name="subType_text_opd" id="subType_text_opd" class="form-control"  v-model="resultData.bodyPart">
                </div>
                <div class="col-md-12" v-if="resultData.subType === 'Spine'">
                  <label> Spine option:</label>
                  <select class="form-control ls-select2" id="radiology_spine_opd" name="radiology_spine_opd"  v-model="resultData.spine_option_value">
                    <option :value="obj.text" v-for="obj in investigationData.Spine_option" >{{obj.text}}</option>
                  </select>
                </div>
              </div>
                
            </div>
            <div class="row form-group">
              <div class="col-md-6">
                 <div class="col-md-12">
                    <label>Select Qualifires:</label>
                    <br>  
                      <select class="form-control ls-select2" id="radiology_qualifier_opd" name="radiology_qualifier_opd" v-if="resultData.type == 'MRI'" v-model="resultData.qualifier">
                        <option v-for="obj in investigationData.radiologyQualifier" :value="obj.text">{{obj.text}}</option>
                      </select>
                      <input type="text" name="qualifier_opd" id="qualifier_opd" class="form-control" v-model="resultData.qualifier" v-else>
                </div>
                <div class="col-md-12" v-if="resultData.type == 'MRI'">
                    <label>Select Special request:</label>
                    <br>
                      <select class="form-control ls-select2" id="radiology_special_request_opd" name="radiology_special_request_opd" v-model="resultData.special_request">
                        <option v-for="obj in investigationData.radiologySpecialRequest" :value="obj.text">{{obj.text}}</option>
                      </select>
              </div>
              <div class="col-md-12" v-else>
                <label>Select Special request:</label>
                <br>
                  <input type="text" name="special_request_opd" id="special_request_opd" class="form-control" v-model="resultData.special_request">
              </div>
              </div>
              <div class="col-md-6">
                <div class="col-md-12" v-if="resultData.qualifier_text_enable">
                  <label> Other Parts</label>
                  <input type="text" name="qualifier_text_opd" id="qualifier_text_opd" class="form-control" v-model="resultData.qualifier">
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
    
      <div class="row form-group">
        <div class="col-md-6" v-show="cross_internal=='true'">
          <div class="col-md-12">
            <label for="internal">Internal Reference:</label>
          </div>
          <div class="col-md-12">
            <select class="form-control ls-select2" name="internal" id="internal" multiple="">
              <option :value="doc.name" v-for="doc in doctorOption">{{doc.name}}</option>
            </select>
          </div>
        </div>
        <div class="col-md-6" v-show="cross_external=='true'" multiple="">
          <div class="col-md-12">
            <label for="external">External Reference:</label>
          </div>
          <div class="col-md-12">
            <input type="text" name="external" id="external" class="form-control" v-model="opdData.cross_type_ext">
            </div>
          </div>
        <!--    <div class="col-md-6"  v-show="(cross_internal == 'true')">
           <div class="col-md-12">
            <button type="button" class="btn btn-primary btn-submit text-right" @click="savePatientDataWithNewReferal">Save</button>
            <a class="btn btn-primary btn-submit text-right" href="/dashboard" >Exit</a>
          </div>
        </div> -->
        </div>
      
        <!-- for laboratory -->
        <div class="row form-group" v-show="opdData.referral == 'laboratory' ">
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
        <div class="row form-group" v-show="opdData.referral == 'physiotherapy' ">
          <div class="col-md-6">
          <div class="col-md-12">
            <label class="control-label" for="label_1">Details </label>
          </div>
          <div class="col-md-12">
            <textarea class="form-control" name="physio_details" id="physio_details" v-model="opdData.physio_details"></textarea>
          </div>
        </div>
      </div>
      <!-- for physiotherapy -->
       
         <div class="row form-group">
          <div class="col-md-12">
               <button type="button" class="btn btn-primary btn-lg " v-if="opdData.referral!='physiotherapy'" @click="saveReport()">Add</button>
          </div>
       </div> 
      <!-- for cross table -->  
      <div class="col-md-12" v-if="opdData.reffreal_cross_array.length>0">
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
                    <tr v-for="(cross_arr, index) in opdData.reffreal_cross_array">
                        <td>{{cross_arr.id}}</td>
                        <td>{{cross_arr.type}}</td>
                        <td>{{cross_arr.subtype}}</td>
                        <td>{{cross_arr.value}}</td>
                        <td><i class="fa fa-remove" @click="removeCrossRef(cross_arr.id)"></i></td>
                    </tr>
                  </tbody>
              </table>
            </div>
          </card>
      </div>
      <!-- for cross table -->
      <!-- for radiology table -->  
      <div class="col-md-12" v-if="opdData.reffreal_radiology_array.length>0">
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
                  <tr v-for="(radio_arr, index) in opdData.reffreal_radiology_array">
                      <td>{{radio_arr.id}}</td>
                      <td>{{radio_arr.type}}</td>
                      <td>{{radio_arr.bodyPart}}</td>
                      <td>{{radio_arr.qualifier}}</td>
                      <td>{{radio_arr.special_request}}</td>
                      <td>{{radio_arr.textData}}</td>
                      <td><i class="fa fa-remove" @click="removeRadioRef(radio_arr.id)"></i></td>
                  </tr>
                  
                  </tbody>
              </table>
            </div>
          </card>
          </div>
      <!-- for radiology table -->
       <!-- for laboratory table -->  
      <div class="col-md-12" v-if="opdData.reffreal_laboratory_array.length>0">
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
                    <tr v-for="(lab_arr, index) in opdData.reffreal_laboratory_array">
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
      <div class="row" v-if="curStep == 2"> 
          <laboratory :labData="opdData.laboratoryALLData" ></laboratory>
        </div>
      <div class="row form-group"  v-if="curStep == 3">
        <div class="col-md-12" v-if="department == 'Neurology' || department == 'Neurosurgery'">
          <neuro-examination :doctor="doctor"></neuro-examination>
        </div>
        <div class="col-md-12" v-if="department == 'Vascular'">
          <vascular-examination :doctor="doctor"></vascular-examination>
        </div>
      </div>
      <div class="row form-group">
        <div class="col-md-6">
<!--           <button type="button" class="btn btn-primary btn-submit text-right " @click="prev()" v-if="curStep!=1">Previous</button>
 -->          <button type="button" class="btn btn-primary btn-submit text-right " @click="next()" v-if="curStep==1">Next</button>
         <!--  <button type="button" class="btn btn-primary btn-submit text-right " v-if="curStep==3" @click="saveInformation()">Submit</button> -->
        </div>
      </div>
    </form>
  </div>
</template>

<script >
    var resData1=[];

  import User from '../../../api/users.js';
  import createPatientDetail from './createPatientDetail.vue';
  import vascularExamination from './vascularExamination.vue';
  import neuroExamination from './neuroExamination.vue';
  import SignaturePad from 'signature_pad';
  import laboratory from './laboratory.vue';
  import patientSearch from './patientSearchData.vue';
  import prescriptionData from './prescriptionData.vue';
  import stepProgressBar from './stepProgressBar.vue';

  import _ from 'lodash';
    import card from "./card.vue"
      var  medicine ;
      var  timeList ;
      var patient_list = [];
      var prescription_index  = 0;
      var b=0;
    export default {
        data() {
            return {
              'footer' : 'footer',
              'currentYear': new Date().getFullYear(),
              'type': 'opdForms',
              'doctor':this.$store.state.Users.userDetails.first_name + " "+ this.$store.state.Users.userDetails.last_name ,
              'doctor_id':this.$store.state.Users.userDetails.id,
              'department':this.$store.state.Users.userDetails.department,
              'user_type':this.$store.state.Users.userDetails.user_type,
              'finalResultData':{},
              'patient_select_enable':true,
              'isPatientSearch':true,
              'prescriptionunique' : 0,
              'cross_internal':'false',
              'cross_external':'false',
              'cross_array':{},
              'cross':{},
              'internal_array':{},
              'laboratory_array':{},
              'ref_cross_array':[],
              'ref_lab_array':[],
              'ref_radio_array':[],
              'investigationData':{
                  'radiologyType':[
                    {text:'',value:''},
                    {text:'X-Rays',value:'X-Rays'},
                    {text:'CT',value:'CT'},
                    {text:'MRI',value:'MRI'},
                    {text:'Other',value:'other'}
                  ],
                  'radiologySubType':[
                      {text:'',value:''},
                  ],
                  'radiologyQualifier':[
                      {text:'',value:''},
                      {text:'Stroke protocol',value:'stroke_protocol'},
                      {text:'Epilepsy protocol',value:  'epilepsy_protocol'},
                      {text:'Headache protocol',value:'headache_protocol'},
                      {text:'Tumor protocol',value:'tumor_protocol'}
                  ],
                  'radiologyQualifierReal':[
                      {text:'',value:''},
                      {text:'Stroke protocol',value:'stroke_protocol'},
                      {text:'Epilepsy protocol',value:  'epilepsy_protocol'},
                      {text:'Headache protocol',value:'headache_protocol'},
                      {text:'Tumor protocol',value:'tumor_protocol'}
                  ],
                  'X-Rays':'',
                  // 'xray_type_options': [
                  //     {text:'Fixed',value:'fixed','selected':true},
                  //     {text:'Portable',value:'portable','selected':false}
                  // ],
                  'X-Rays_options':[
                      {text:'',value:''},
                      {text:'HIP',value:'hip'},
                      {text:'Knee',value:'knee'},
                      {text:'Shoulder',value:'shoulder'},
                      {text:'Pelvis',value:'pelvis'},
                      {text:'Other',value:'other'},
                  ],
                  'CT':'',     
                  'CT_options':[
                      {text:'',value:''},
                      {text:'Brain (Plain)', value:'brain_plain'},
                      {text:'Brain (Plain & Contrast)', value:'brain_plain_contrast'},
                      {text:'Neck', value:'neck'},
                      {text:'Chest', value:'chest'},
                      {text:'Upper Abdomen', value:'upper_abdomen'},
                      {text:'Pelvis', value:'pelvis'},
                      {text:'Whole Abdomen', value:'whole_abdomen'},
                      {text:'CT Angiography', value:'ct_angiography'},
                      {text:'Guided Procedure:Biopsy', value:'guided_procedure'},
                     ],
                  'brain_options':[
                      {text:'',value:''},
                      {text:'Stroke protocol',value:'stroke_protocol'},
                      {text:'Epilepsy protocol',value:  'epilepsy_protocol'},
                      {text:'Headache protocol',value:'headache_protocol'},
                      {text:'Tumor protocol',value:'tumor_protocol'},
                      {text:'Brain (Routine)',value:'Brain (Routine)'},
                      {text:'Brain with Head &Neck MR Angiography(MRA)',value:'Brain with Head &Neck MR Angiography(MRA)'},
                      {text:'Brain with IntracranialMRA/MR Venography',value:'Brain with IntracranialMRA/MR Venography'},
                      {text:'Brain MR Spectroscopy alone',value:'Brain MR Spectroscopy alone'},
                      {text:'Brain Tumour Protoco',value:'Brain Tumour Protoco'},
                      {text:'Other',value:'Other'},
                  ],
                  'MRI':'',
                  'MRI_options':[
                       {text:'', value:''},
                       {text:'Brain', value:'brain'},
                       {text:'Spine', value:'spine'},
                       {text:'Joint', value:'joint'},
                       {text:'Cranial Nerne', value:'Cranial Nerne'},
                       {text:'Other', value:'other'}
                     ],
                  'Spine_option': [
                      {text:'',value:''},
                      {text:'Cervical', value:'Cervical'},
                      {text:'Dorsal', value:'Dorsal'},
                      {text:'Lumbar', value:'Lumbar'},
                      {text:'Whole spine screening', value:'Whole spine screening'},
                  ],
                  'others':'',
                  'others_options':[
                      {text:'',value:''},
                      {text:'other-Option 1'},
                      {text:'other-Option 2'},
                      {text:'other-Option 3'},
                      {text:'other-Option 4'},
                      {text:'other-Option 5'},
                      {text:'other-Option 6'},
                      {text:'other-Option 7'},
                      {text:'other-Option 8'}
                  ],
                  'radiologySpecialRequest':[
                      {text:'',value:''},
                      {text:'Neck Angio',value:'neck_angio'},
                      {text:'Brain Angio',value:'brain_angio'},
                      {text:'Spectroscopy',value:'spectroscopy'},
                      {text:'Diffusion',value:'diffusion'},
                      {text:'Flexion',value:'flexion'},
                      {text:'Extension',value:'extension'},
                  ]

              },
              
              'curStep':1,
              'totalStep':3,  
              'resultData': {
                    'id':'',
                    'uploadType':'image',
                    'bodyPart':'',
                    'qualifierPart':'',
                    'type': '',
                    // 'x_ray_type':'fixed',
                    'spine_option_value':'',
                    'subType': '',
                    'qualifier':'',
                    'imgData': '',
                    'textData': '',
                    'subtype_text_enable':false,
                    'qualifier_text_enable':false,
                    'special_request':'',
                    'removed':false

                },
              'doctorOption': [
                  {'name':'Rakesh Shah' },
                  {'name':'Anand Vaishnav'},
                  {'name':'Suvorit Bhowmick'},
                  {'name':'Mihir Acharya'},
                  {'name':'Monish Malhotra'},
                  {'name':'Suresh Nayak'},
                  {'name':'Rakesh Jasani'},
                  {'name':'Kaushik K Trivedi'},
                  {'name':'Ketan Kapashi'},
                  {'name':'Vijay Thakore'},
                  {'name':'Sumit Kapadia'},
                  {'name':'Rajesh Kantharia'},
                  {'name':'Hemant Mathur'},
              ],
              'opdData': {
                'reffreal_cross_array':[],
                'reffreal_laboratory_array':[],
                'reffreal_radiology_array':[],
                'pain_value':0,
                'patientlist':'',
                'patient_option':[],
                'opd_id':'',
                'opd_option':[],
                'case_type': '',
                'uhid_no': '',
                'name':'',
                'age':'',
                'gender':'',
                'weight':'',
                'height': '',
                'history':'',
                'historyType': 'scribble',
                'past_history':'',
                'pastHistoryType': 'scribble',
                'prescription':'',
                'prescription_quantity':'',
                'prescription_unit':'TAB.',
                'prescription_time':[],
                'advice':'',
                'adviceType': 'scribble',
                'referral':'',
                'laboratory':'',
                'signaturePad':{},
                'signaturePad_src':'',
                'signaturePad1_src':'',
                'signaturePad2_src':'',
                'prescriptiData' : '',
                'weight':'',
                'height': '',
                'bmi':'',
                'vitals':'',
                'pulse':'',
                'bp_systolic':'',
                'bp_diastolic':'',
                'temp':'',
                'laboratoryALLData':[],
                'laboratory_report_opd_data':{},
                'select_type':'',
                'select_value':'',
                'last_vist' : '',
                'physio_details':'',
                'provisional_diagnosis':''
              }
            }
        }, 
        components: {
         prescriptionData,
         createPatientDetail,
         vascularExamination,
         neuroExamination,
         laboratory,
         card,
         patientSearch,
         stepProgressBar,
       },
        computed: {
          bmi_mod() {
            if(this.opdData.weight!='' && this.opdData.height!=''){
              var height_met = this.opdData.height / 100;
              var bmiVal = (this.opdData.weight )/(height_met * height_met);
              return bmiVal.toFixed(1);
            } else {
              return 0;
            }
          },

       },
       created: function() {
             this.$root.$on('SetUhidNo', this.updateUhidNo);
             this.$root.$on('prev', this.prev);
             this.$root.$on('next', this.next);
             this.$root.$on('patientData',this.setPatientData);
             this.$root.$on('patientEmpty',this.patientEmpty);
        },
        
        mounted(){
         var vm =this;
          if(vm.$store.state.Users.userDetails.user_type != '1'){
              vm.$root.$emit('logout','You are not authorise to access this page'); 
          }
          $('.ls-select2').select2({
            placeholder: "Select",
            tags:false 
          });

         let opd_list_new=[];
           if(this.$store.state.Patient.patientId != ''){
              vm.opdData.patientlist= this.$store.state.Patient.patientId;
              $('#patient').val(vm.opdData.patientlist).trigger('change:select2');

          }
          vm.$store.dispatch('resetOpdForm');
         
          setTimeout(function(){
            vm.doctor = vm.$store.state.Users.userDetails.first_name + " "+ vm.$store.state.Users.userDetails.last_name;  
            vm.doctor_id = vm.$store.state.Users.userDetails.id;  
          },1000);
          /*for laboratory data*/
            let labpratory_all_data=[];
            User.generateAllLaboratoryListByChild().then(
              (response) => {
                let lab_data = response.data.data;
                vm.opdData.laboratoryALLData = lab_data;
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
              vm.opdData.laboratory_report_opd_data=selections;
              //vm.setLabData();
            });

          
          $(document).on("select2:select",'.ls-select2', function (e) { 
            if(this.id == 'referral'){
               vm.setRadioReferral();
              vm.opdData.referral=$(this).val();
              //vm.finalResultData = '';
              if($(this).val() == 'cross') {
                setTimeout(function(){
                  $('#cross').select2({
                    placeholder: "Select",
                    tags:false 
                  }); 
                },20)  
              }
            }
            else if(this.id == 'radiology'){
              vm.opdData.radiology=$(this).val();
            }
            else if(this.id == 'laboratory'){
              vm.opdData.laboratory=$(this).val();
            }
            else if(this.id == 'cross'){
              var cross_array=$(this).val();
              vm.cross=cross_array;
              if(cross_array.includes("internal"))
              {
                  vm.cross_internal='true';
              }
              if(cross_array.includes("external"))
              {
                  vm.cross_external='true';
              }
              

            }
            else if(this.id == 'internal'){
              var val_cross_array=$(this).val();
              vm.internal_array=val_cross_array;
            }
            else if(this.id == 'laboratory_report_opd'){
              var val_lab_array=$(this).val();
              vm.laboratory_array=val_lab_array;
            }
            else if(this.id == 'case_type'){
              vm.opdData.case_type = $(this).val(); 
            }
            else if(this.id == 'blood_report_opd'){
              vm.opdData.blood_report_opd = $(this).val(); 
            }
            else if(this.id == 'urine_opd'){
              vm.opdData.urine_report_opd = $(this).val(); 
            }
            else if(this.id == 'csf_opd'){
              vm.opdData.csf_report_opd = $(this).val(); 
            }
            else if(this.id == 'body_fluid_analysis_opd'){
              vm.opdData.body_fluid_analysis_report_opd = $(this).val(); 
            }

             else if(this.id == 'xray_type_opd'){
              vm.resultData.x_ray_type = $(this).val(); 
            }
                       
            if(this.id == 'radiology_type_opd') {

                vm.resultData.type = $(this).val();
                let type_opd_val=$(this).val();

                if(type_opd_val=='MRI')
                {
                  setTimeout(function(){
                          $('#radiology_qualifier_opd').select2({
                            placeholder: "Select",
                            tags:false 
                          }); 
                          $('#radiology_special_request_opd').select2({
                            placeholder: "Select",
                            tags:false 
                          });
                          
                    },1000);
                }
                else
                {
                    $('#radiology_qualifier_opd').select2("destroy");
                    $('#radiology_special_request_opd').select2("destroy");
                }
                vm.radioSubType();
                
            } 
            if(this.id == 'radiology_subtype_opd') {
                    
              let q_data=vm.investigationData.radiologyQualifierReal;
              let radiologySubType_val=$("#radiology_subtype_opd").select2().val();
              vm.resultData.bodyPart = radiologySubType_val;
              vm.resultData.subType=radiologySubType_val;
                //vm.investigationData.radiologySubType =  radiologySubType_val;

                if(radiologySubType_val == 'Other' || radiologySubType_val =='Joint'){
                    vm.resultData.subtype_text_enable = true;
                    //vm.resultData.bodyPart = radiologySubType_val;
                } else {
                  
                  vm.resultData.subtype_text_enable = false;
                  //vm.resultData.bodyPart = '';
                  
                }
                $("#radiology_qualifier_opd").val('').trigger('change.select2');
                vm.resultData.qualifier = '';
                vm.resultData.qualifier_text_enable = false;
                vm.resultData.qualifierPart = '';
                
                if(radiologySubType_val=='Spine')
                {
                    setTimeout(function(){
                            $('#radiology_spine_opd').select2({
                              placeholder: "Select",
                              tags:false 
                            }); 
                            

                    },500);

                   
                }
                else if(radiologySubType_val=='Brain')
                {
                  
                  vm.investigationData.radiologyQualifier="";
                  vm.investigationData.radiologyQualifier=vm.investigationData.brain_options;
                }
                else
                { 

                    vm.investigationData.radiologyQualifier="";
                    vm.investigationData.radiologyQualifier=q_data;
                    vm.resultData.qualifier_text_enable = false;
                    vm.resultData.qualifierPart = '';
                }
            }
            if(this.id == 'radiology_qualifier_opd') {

                vm.resultData.qualifier = $("#radiology_qualifier_opd").select2().val();
                let qualy_val=$("#radiology_qualifier_opd").select2().val();
                //console.log(qualy_val);
                if(qualy_val=='Other')
                {
                    vm.resultData.qualifier_text_enable = true;
                    vm.resultData.qualifierPart = '';
                }
                else
                {
                    vm.resultData.qualifier_text_enable = false;
                    vm.resultData.qualifierPart = $("#radiology_qualifier_opd").select2().val();
                }

            }
            if(this.id == 'radiology_spine_opd')
            {
             
              vm.resultData.spine_option_value=$("#radiology_spine_opd").select2().val();
            }
            if(this.id == 'radiology_special_request_opd') {
              
              vm.resultData.special_request = $("#radiology_special_request_opd").select2().val();
            }
             if($(this).val() == 'old') {
             } 
             else if($(this).val() == 'new') {
                setTimeout(function(){
                $('#createPatientDetail').modal('show');  
             },500)
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
         
          setTimeout(function(){
                  $('#patient').select2({
                    placeholder: "Select",
                    tags:false 
                  });
                },500);

          $('#patient').on("select2:select", function (e) {
                //console.log('call');
                vm.opdData.patientlist=$(this).val();
                let patientId = $(this).val();
                vm.opdData.patientlist=patientId;
                vm.$store.dispatch('SetPatientId',patientId);             
                vm.get_vitals();
               
          });
          $(document).on('hidden.bs.modal','#createPatientDetail', function () {
            $('#case_type').val('old').trigger('change.select2');
            vm.opdData.case_type = 'old';
          });



          setTimeout(function(){
            vm.examinationChangeImage();
          },500);
         
          // vm.getResults();
          vm.getResults();
          vm.newPatient(); 

        },
        methods: {
          // savePatientDataWithNewReferal(){
          //   User.movePatientForNewReferal().then(
          //      (response) => {

          //      },
          //      (error) => {

          //     }
          //   );
          // },
          newPatient()
          {
              var vm =this;
              
              setInterval(function() {

                 vm.getResults();
                // $('#patient').select2('destroy');
                 $('#patient').select2({
                    placeholder: "Select",
                    tags:false 
                  });

              }, 8000);
            
            },
          getResults(patient_list_new) {
            var vm =this;
            var patient_list_new=[];
            let section = 'OPD';
             User.getAllPatientName(vm.user_type,vm.doctor_id).then(
                   (response) => {
                    vm.opdData.patient_option=[];
                      let patien_data=response.data.data;
                      $.each(patien_data, function(key, value) {
                      let name = value.first_name +' '+value.last_name;
                      let pid  = value.id ;
                      let uhid_no  = value.uhid_no ;
                      patient_list_new.push({
                          name:name,
                          id:pid,
                          uhid_no:uhid_no
                        });
                      });

                      vm.opdData.patient_option=_.cloneDeep(patient_list_new);
                        
                     },
                      (error) => {
                  },
                   );
             
            
          },
          patient_select_change(val)
          {
            let vm =this;
           vm.opdData.patientlist="";
            vm.patientEmpty();
              if(val==true)
              {
                vm.patient_select_enable=false;
                $('#patient').val('').trigger('change.select2');
                $('#patient').select2('destroy');
              }
              else
              {
                
                vm.isPatientSearch =false;
                setTimeout(function(){
                  vm.isPatientSearch  =true;
                },500);
                vm.patient_select_enable=true;
                 setTimeout(function(){
                  $('#patient').select2({
                    placeholder: "Select",
                    tags:false 
                  });
                },500);
              
              }

          },
          patientEmpty()
          {
              let vm =this;
              vm.opdData.last_vist="";
              vm.opdData.patientlist="";
              vm.opdData.uhid_no="";
              vm.opdData.weight="";
              vm.opdData.height="";
              vm.opdData.bmi="";
              vm.opdData.vitals="";
              vm.opdData.pulse="";
              vm.opdData.bp_systolic="";
              vm.opdData.bp_diastolic="";
              vm.opdData.temp="";
              vm.opdData.pain_value=0;
              vm.opdData.select_value="";
              
          },
          pain_value(pain){
            this.opdData.pain_value = pain;
          },
          setPatientData(patientData) {
            let vm=this;
            vm.patientEmpty();
            if(patientData.code==200)
            {
              let pDetails=patientData.searchdata;
              //for opd list
                this.opdData.uhid_no=pDetails.uhid_no;
                this.opdData.patientlist=pDetails.id;
                vm.get_vitals();
            }
            else if(patientData.code==300)
            {
              toastr.error('Record not found', 'Error', {timeOut: 5000});
              this.initPatientData();
            }
            else
            {
              toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
              this.initPatientData();
            }
          },
          get_vitals()
          {
             let vm=this;
              //for uhid
                User.generatePatientDetailsByID(vm.opdData.patientlist).then(
                    (response) => {
                      let patient_data=response.data.data;
                      vm.opdData.uhid_no =patient_data.uhid_no;
                    },
                    (error) => {
                    },
                );
                //for opd list
                User.getOPDDetailsByPatientId(vm.opdData.patientlist).then(
                    (response) => {
                      let opdID ;
                      opdID = response.data.data.id;
                      User.getLastOPDIdByPatientId(vm.opdData.patientlist).then(
                          (response) => {
                            let lastVist;
                            lastVist = response.data.data.appointment_datetime;
                              vm.opdData.opd_id=opdID;
                              if(lastVist)
                              {
                                  vm.opdData.last_vist=lastVist;
                              }
                              else
                              {
                                   vm.opdData.last_vist="N/A";
                              }
                              
                            },
                            (error) => {
                            },
                      );
                     
                      
                      },
                      (error) => {
                      },
                );

                

              User.getVitalsInfoByPatientId(vm.opdData.patientlist).then(
              (response) => {
                let vitals_data=response.data.data;
                  if(vitals_data.code==200)
                  {
                      let patient_checkup_details=vitals_data.data;
                      vm.opdData.height =patient_checkup_details.height;
                      vm.opdData.weight =patient_checkup_details.weight;
                      vm.opdData.bmi =patient_checkup_details.bmi;
                      vm.opdData.vitals =patient_checkup_details.vitals;
                      vm.opdData.pulse =patient_checkup_details.pulse;
                      if(patient_checkup_details.bp!="")
                      {
                        let bp =patient_checkup_details.bp.split("/");
                        vm.opdData.bp_systolic =bp[0];
                        vm.opdData.bp_diastolic =bp[1];
                       }
                      vm.opdData.temp =patient_checkup_details.temp;
                      vm.opdData.pain_value=patient_checkup_details.pain;
                      
                  }
                  else if(vitals_data.code==300)
                  {
                   
                  }
                  else
                  {
                     
                  }
                },
                (error) => {
                },
            );
          },
          saveReport() {
                
                // var resData1=[];
                let vm =this;
                if(vm.opdData.referral=='cross')
                {
                    vm.saveCrossReport();
                }
                if(vm.opdData.referral=='laboratory')
                {
                    vm.saveLabReport();
                }
                if(vm.opdData.referral=='radiology')
                {
                    vm.saveRadiologyReport();
                }
                return false;
                 
          },
           saveRadiologyReport()
          {
              let vm =this;
              if(vm.resultData.type == '' || vm.resultData.bodyPart == '' ){
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
              vm.opdData.reffreal_radiology_array = _.cloneDeep(vm.ref_radio_array);
              $('#referral').val('').trigger('change.select2');
              vm.setRadioReferral();
              return false;
          },
           setRadioReferral()
          {
               let vm =this;
              
              $('#radiology_qualifier_opd').select2("destroy");
              $('#radiology_special_request_opd').select2("destroy");
              $('#radiology_type_opd').val('').trigger('change.select2');
              $('#radiology_subtype_opd').val('').trigger('change.select2');
              $('#radiology_spine_opd').select2("destroy");
              vm.resultData = {
                   'id':'',
                    'uploadType':'image',
                    'bodyPart':'',
                    'type': '',
                    'spine_option_value':'',
                    'subType': '',
                    'qualifier':'',
                    'imgData': '',
                    'textData': '',
                    'subtype_text_enable':false,
                    'special_request':'',
                    'removed':false,
                };
                $('#radio_div1 .ls-select2').val(null).trigger('change');
                vm.opdData.referral="";
          },
          removeRadioRef(rid)
          {
              let vm =this;
              _.remove(vm.ref_radio_array, function(o) {
                  return o.id==rid;
                });
              vm.opdData.reffreal_radiology_array= _.cloneDeep(vm.ref_radio_array);
          },
          saveLabReport()
          {
              let vm =this;
              if(vm.laboratory_array.length>0)
              {

                 _.forEach(vm.laboratory_array, function(value, key) {
                    let matches=_.some(vm.ref_lab_array,['lab_id',value]);
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
              vm.opdData.reffreal_laboratory_array= _.cloneDeep(vm.ref_lab_array);
              vm.setLabReferral();
              return false;
          },
          setLabReferral()
          {
               let vm =this;
              $('#referral').val('').trigger('change.select2');
              $('#laboratory_report_opd').val('').trigger('change.select2');
              vm.opdData.referral="";
              vm.laboratory_array=[];
          },
          removeLabRef(lid)
          {
              let vm =this;
              _.remove(vm.ref_lab_array, function(o) {
                  return o.id==lid;
                });
              vm.opdData.reffreal_laboratory_array= _.cloneDeep(vm.ref_lab_array);
          },
          saveCrossReport()
          {
                let vm =this;
                let matches2=_.some(vm.ref_cross_array,['value',vm.opdData.cross_type_ext]);
                if(matches2)
                {
                    vm.setCrossReferral();
                    toastr.error('This record already exist', 'Error', {timeOut: 5000});
                    return false;
                }
                if(vm.internal_array.length>0)
                {

                   _.forEach(vm.internal_array, function(value, key) {
                      let matches=_.some(vm.ref_cross_array,['value',value]);
                      if(matches)
                      {
                          vm.setCrossReferral();
                          toastr.error('This record already exist', 'Error', {timeOut: 5000});
                          return false;
                      }
                      else
                      {
                        vm.ref_cross_array.push({'id':vm.ref_cross_array.length+1,'type':vm.opdData.referral,'subtype':'Internal','value':value});
                      }
                    });
                }
                if(vm.opdData.cross_type_ext)
                {
                    vm.ref_cross_array.push({'id':vm.ref_cross_array.length+1,'type':vm.opdData.referral,'subtype':'External','value':vm.opdData.cross_type_ext});
                }
                vm.opdData.reffreal_cross_array=vm.ref_cross_array;
                vm.setCrossReferral();
                return false;

          },
          setCrossReferral()
          {
               let vm =this;
              $('#referral').val('').trigger('change.select2');
              $('#cross').val('').trigger('change.select2');
              $('#internal').val('').trigger('change.select2');
              vm.opdData.referral="";
              vm.opdData.cross_type_ext="";
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
              vm.opdData.reffreal_cross_array= _.cloneDeep(vm.ref_cross_array);
          },
        
          updateUhidNo(uhid) {
            let vm = this;
            vm.opdData.uhid_no = uhid;
          },
          prev(){
            let vm =this;
            vm.$root.$emit('submitNeuroData');
            // setTimeout(function(){
              if(vm.curStep> 0){
                vm.curStep = vm.curStep-1;
              }  
            // },3000)
            
            vm.opdData =  _.cloneDeep(vm.$store.state.Patient.opdData);
            vm.resultData = _.cloneDeep(vm.$store.state.Patient.opd_resultData);

            vm.initLastData();
          },
          next() {
            let vm =this;
                this.$validator.validateAll().then(
                (response) => {
                
                  if (!this.errors.any()) {
                      vm.curStep = vm.curStep+1;
                      vm.$store.dispatch('setOpdData',vm.opdData);
                      vm.$store.dispatch('setResData',vm.finalResultData);
                  }
               },
               (error) => {
                }
              )
            
          },
          initLastData(){
            let vm = this;
            
            if(vm.patient_select_enable==true)
            {
                $('#patient').val(vm.opdData.patientlist).trigger('change:select2');
            }
            
            let p_list = _.cloneDeep(vm.opdData.patient_option);
            let pres = _.cloneDeep(vm.opdData.prescription);
            let labs = _.cloneDeep(vm.opdData.laboratoryALLData);
            setTimeout(function(){
              $('#prescription').val(p_list).trigger('change');
              //$('#patient').val(pres).trigger('change');
              $('.ls-select2').select2({
                placeholder: "Select",
                tags:false 
              });
               $('#laboratory_report_opd').select2({
                  placeholder: 'Select',
                  data: _.cloneDeep(labs)
                });
              if(vm.curStep == 1){
                vm.examinationChangeImage();
              } 
            },1500)
          }, 
          removeReport(did) {
                let vm =this;
                // _.pullAt(resData, 0);
                _.find(vm.finalResultData, function(res) {
                    if(res.id == did) {
                         res.removed = true;
                    }
                });
          },
          setHistoryType(res,type){
            var vm =this;
            if(res == 'present'){
              vm.opdData.historyType = type;
            } else if(res == 'past') {
              vm.opdData.pastHistoryType = type;
            } else {
              vm.opdData.adviceType = type;

            }
          },
          radioSubType(){
            let vm =this;
            let resType = vm.resultData.type;
            let x_rayData = '';
            
            if(vm.resultData.type != ''){
              x_rayData = vm.investigationData[resType+'_options'];
              $('#radiology_subtype_opd').select2({
                placeholder: "Select",
              });

            } 
            vm.investigationData.radiologySubType = '';
            setTimeout(function(){
              vm.investigationData.radiologySubType = x_rayData;
            },200);

          },
          resizeCanvas(canvas) {
              var ratio =  Math.max(window.devicePixelRatio || 1, 1);
              canvas.width = canvas.offsetWidth * ratio;
              canvas.height = canvas.offsetHeight * ratio;
               canvas.getContext("2d").scale(ratio, ratio);
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
          saveInformation() {

              this.$validator.validateAll().then(
              (response) => {
                if (!this.errors.any()) {
                   $("body .js-loader").removeClass('d-none');
                   var vm=this;
                    this.$store.dispatch('SetDoctorId',vm.doctor_id);
                   let res= vm.$store.dispatch('saveOpdData');
                   if(res=='success')
                   {
                   }
                  }
                },
                (error) => {
                }
                );
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
            decodeBase64Image(dataString) {
              var matches = dataString.match(/^data:([A-Za-z-+\/]+);base64,(.+)$/),
                response = {};

              if (matches.length !== 3) {
                return new Error('Invalid input string');
              }

              response.type = matches[1];
              response.data = new Buffer(matches[2], 'base64');

              return response;
            },
          examinationChangeImage() {
            var vm =this;
            // savePNGButton.addEventListener("click", function (event) {
            var wrapper = document.getElementById("signature-pad");
            var wrapper1 = document.getElementById("signature-pad1");
            var canvas = document.getElementById("history_scribble");
            var canvas1 = document.getElementById("past_history_scribble");
            var canvas2 = document.getElementById("advice_scribble");
            var clear_history_scribble = document.getElementById("clear_history_scribble");
            var clear_past_history_scribble = document.getElementById("clear_past_history_scribble");
            var clear_advice_scribble = document.getElementById("clear_advice_scribble");
            var save_history_scribble = document.getElementById("save_history_scribble");
            var save_past_history_scribble = document.getElementById("save_past_history_scribble");
            var save_advice_scribble = document.getElementById("save_advice_scribble");


            vm.opdData.signaturePad = new SignaturePad(canvas, {
              backgroundColor: 'rgb(255, 255, 255)',
            });
            vm.opdData.signaturePad1 = new SignaturePad(canvas1, {
              backgroundColor: 'rgb(255, 255, 255)',
            });
            vm.opdData.signaturePad2 = new SignaturePad(canvas2, {
              backgroundColor: 'rgb(255, 255, 255)',
            });
            window.onresize = vm.resizeCanvas;
            vm.resizeCanvas(canvas);
            vm.resizeCanvas(canvas1);
            clear_history_scribble.addEventListener("click", function (event) {
              vm.opdData.signaturePad.clear();
              vm.opdData.signaturePad_src='';
            });
            clear_past_history_scribble.addEventListener("click", function (event) {
              vm.opdData.signaturePad1.clear();
              vm.opdData.signaturePad1_src='';

            });
            clear_advice_scribble.addEventListener("click", function (event) {
              vm.opdData.signaturePad2.clear();
              vm.opdData.signaturePad2_src='';

            });
            save_history_scribble.addEventListener("click", function (event) {
              vm.opdData.signaturePad_src = vm.opdData.signaturePad.toDataURL();
              
              
            });
            save_past_history_scribble.addEventListener("click", function (event) {
              vm.opdData.signaturePad1_src = vm.opdData.signaturePad1.toDataURL();
            });
            save_advice_scribble.addEventListener("click", function (event) {
              vm.opdData.signaturePad2_src = vm.opdData.signaturePad2.toDataURL();
            });
            
              
          },
        }
                      
           
    }
        
</script>
