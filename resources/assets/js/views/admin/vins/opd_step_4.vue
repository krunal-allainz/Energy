<template>
    <div class="container">
     <div class="row form-group">
            <div class="col-md-6">
              <div class="col-md-6">  
                <label for="diagnosis">Diagnosis:</label>
              </div>
              <div class="col-md-12">
                <textarea class="form-control" name="diagnosis" id="diagnosis" v-model="diagnosis" v-validate="'required'"></textarea>
                <i v-show="errors.has('diagnosis')" class="fa fa-warning"></i>
                  <span class="help is-danger" v-show="errors.has('diagnosis')">
                      Please fill diagnosis.
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
                <div class="col-md-12" v-show="step4Data.adviceType == 'text'">
                    <textarea class="form-control" type="text" name="advice" id="advice" v-model="step4Data.advice"></textarea>         
                </div>
                <div class="col-md-12" v-show="step4Data.adviceType == 'scribble'">
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
            <div class="col-md-6" v-if="step4Data.signaturePad2_src!='' && step4Data.adviceType != 'text' && step4Data.signaturePad2_src!== null">
              <div class="col-md-12">
                  <label for="history">Advice Preview:  <i class="fa fa-download fa-lg red" @click="download(step4Data.signaturePad2_src,'Advice')" aria-hidden="true"></i></label>
                </div>
                <div>
                  <img :src="step4Data.signaturePad2_src" title="Advice">
                </div>  
            </div>
        </div>
         <prescriptionData :department="department"> </prescriptionData>
         <refferals  ></refferals>
          <div class="row form-group">
    
      <div class="col-md-12">
          <div class="col-md-12">
            <label>Follow Up : </label>
          </div>
          <div class="col-md-12">
            <textarea class="form-control" type="text" name="follow_up" id="follow_up" v-model="step4Data.follow_up"  v-validate="'required'" /></textarea>
              <i v-show="errors.has('follow_up')" class="fa fa-warning"></i>
                  <span class="help is-danger" v-show="errors.has('follow_up')">
                      Please fill follow up.
                  </span>
          </div>
        </div>
          </div>
          <div class="row form-group">
            <div class="col-md-6">
              <div class="col-md-6">
                <label for="diagnosis" class="control-label">Doctor's name   </label>
              </div>
              <div class="col-md-6">
                <input class="form-control" type="text" id="doctor_name" name="doctor_name" value="" v-model="doctor" readonly="" />
               
              </div>
            </div>
            <div class="col-md-6">
              <div class="col-md-6">
                <label for="diagnosis" class="control-label">Date</label>
              </div>
              <div class="col-md-6">
                <input class="form-control" type="text" id="cur_datetime" name="cur_datetime" value="" v-model="currentDatetime" readonly="" />
                
              </div>
            </div>
          </div>
         <div class="row form-group">
              <button type="button" class="btn btn-primary btn-submit text-right " @click="prev()" >Previous</button>
              <span v-if="pageName=='EDIT'">
                  <button class="btn btn-primary btn-submit text-right ml-10" type="button" @click="EditOPDForm()">Edit Data</button>
                  <EditOPDConfirmModal :editConfirmMsg="editConfirmMsg"></EditOPDConfirmModal>
              </span>
              <span v-else>
                <button class="btn btn-primary btn-submit text-right ml-10" type="button" @click="saveOPDForm()">Save Data</button>
              </span>
              
        </div>
        
      <OPDConfirmModal :deleteConfirmMsg="deleteConfirmMsg"></OPDConfirmModal>
       <div id="receiptAddModel" class="modal hide" role="dialog">
        <div class="modal-dialog modal-lg">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Patient Receipt Form</h4>
            </div>
            <div class="modal-body">
                <patientReceiptForm :patientOPDDetails="patient_opd_details" v-if="modal_enabled=='true'"></patientReceiptForm>
            </div>
            <div class="modal-footer">
              <button type="button" class="closem btn btn-default" @click="confirm_popup()">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div id="receiptPrintModal" class="modal hide">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header"> </div>
            <div class="modal-body"><div id="printContent"></div> </div>
            <div class="modal-footer">
              <button  type="button" class="btn btn-primary"  @click="ClickHereToPrint()">Print</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
            </div>  
          </div>  
        </div>  
      </div>
    </div>
</template>
<script >
    import User from '../../../api/users.js';
    import myDatepicker from 'vue-datepicker';
    import refferals from './refferals.vue';
    import prescriptionData from './prescriptionData.vue';
    import OPDConfirmModal from '../../../components/OPDConfirmModal.vue';
    import EditOPDConfirmModal from '../../../components/EditOPDConfirmModal.vue';
    import SelectPatientModal from '../../../components/SelectPatientModal.vue';
    import SignaturePad from 'signature_pad';
    import patientReceiptForm from './patientsReceiptAddForm.vue';
    import _ from 'lodash';
    export default {
        name:'',
        computed:{

        },
        components: {
           prescriptionData,
           OPDConfirmModal,
           SelectPatientModal,
           patientReceiptForm,
           refferals,
           EditOPDConfirmModal
        },
        created: function() {
          this.$root.$on('printReceipt', this.printReceipt);
          this.$root.$on('confirmed', this.confirm_opd);
          this.$root.$on('setReferralId', this.setReferralId);
          this.$root.$on('crossReferSave', this.crossReferSave);
          this.$root.$on('edit_confirmed', this.editConfirmed);

        },
       props:['doctor','validatorErrorArray'],
        data() {
            return {
                'pageName':'ADD',
                'footer' : 'footer',
                'currentDatetime': moment().format('DD-MM-YYYY hh:mm A'),
                'deleteConfirmMsg':'Are you sure you want to exit from receipt form?',
                'editConfirmMsg':'Patient History Already Exist. Do you want to Add and Save Data?',
                'modal_enabled':'false',
                'type': 'neuroExamination',
                'patient_id': this.$store.state.Patient.patientId,
                'ipd_id': this.$store.state.Patient.ipdId,
                'doctor_id':this.$store.state.Users.userDetails.id,
                'department':this.$store.state.Users.userDetails.department,
                'user_type':this.$store.state.Users.userDetails.user_type,
                'hasError':true,
                'refferalId':'',
                'crossRefer':false,
                'diagnosis' : '',
                'step4Data': {
                  'advice':'',
                  'adviceType': 'scribble',
                  'signaturePad':{},
                  'signaturePad2_src':'',
                  'provisional_diagnosis':this.$store.state.Patient.provisionalDiagnosis,
                  'follow_up':''
                }
            }
               
        },
        mounted() {
            let vm =this;
            $('.ls-select2').select2({
              placeholder: "Select",
            });
             vm.step4Data.provisional_diagnosis = _.cloneDeep(this.$store.state.Patient.provisionalDiagnosis);
            setTimeout(function(){
              vm.examinationChangeImage();
              vm.initData();
            },500);
            if(vm.$store.state.Patient.setPage=='EDIT')
            {
                vm.pageName='EDIT';
            }
        },
        filters:{
            
        },
        methods: {
          editConfirmed()
          {
              this.editOPDData();
          },
          EditOPDForm()
          {
               $('#edit_confirm_modal').modal('show');
          },
          setReferralId(refId){
            this.refferalId = refId;
          },
          crossReferSave(){
            let vm =this;
            vm.crossRefer = true;
            vm.$store.dispatch('saveStep4Data',_.cloneDeep(vm.step4Data));
            let department = this.$store.state.Users.userDetails.department;
            let doctor = this.$store.state.Users.userDetails.id;
            
            var oData = {
              'opdData':this.$store.state.Patient.opdData,
              'patientCase':this.$store.state.Patient.patientCase,
              'resultData':this.$store.state.Patient.opd_resultData,
              'doctor':doctor,
              'department':department,
              'radioData':this.$store.state.Patient.radioData,
              'laboratoryData':this.$store.state.Patient.laboratoryData,
              'vascExaminationData':this.$store.state.Patient.vascExaminationData,
              'neuroExaminationData':this.$store.state.Patient.neuroExaminationData,
              'prescriptionData':this.$store.state.Patient.prescriptionData,
              'step4Data':this.$store.state.Patient.step4Data,
              'reffData':this.$store.state.Patient.refferelReportData,
              'diagnosis':this.$store.state.Patient.diagnosis,
              'provisionalDiagnosis':this.$store.state.Patient.provisionalDiagnosis,
            };
            this.saveOpdData(oData);
          },
          initData() {
            let vm =this;
            var oldData = _.cloneDeep(vm.$store.state.Patient.step4Data);
             vm.diagnosis = _.cloneDeep(this.$store.state.Patient.diagnosis);
            if(!(jQuery.isEmptyObject(oldData))) 
            {
               vm.step4Data=oldData;
               vm.examinationChangeImage();
            }
          },
           prev() {
              let vm =this;
              vm.saveRefData();
              vm.$store.dispatch('saveStep4Data',vm.step4Data);
              vm.$store.dispatch('saveDiagnosis',vm.diagnosis);

              vm.$root.$emit('prev');
          },
          setHistoryType(res,type){
            var vm =this;
            vm.step4Data.adviceType = type;
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
             resizeCanvas(canvas) {
              var ratio =  Math.max(window.devicePixelRatio || 1, 1);
              canvas.width = canvas.offsetWidth * ratio;
              canvas.height = canvas.offsetHeight * ratio;
               canvas.getContext("2d").scale(ratio, ratio);
            },
             examinationChangeImage() {
              var vm =this;
              
              var canvas2 = document.getElementById("advice_scribble");
              var clear_advice_scribble = document.getElementById("clear_advice_scribble");
              var save_advice_scribble = document.getElementById("save_advice_scribble");
              vm.step4Data.signaturePad2 = new SignaturePad(canvas2, {
                backgroundColor: 'rgb(255, 255, 255)',
              });
              window.onresize = vm.resizeCanvas;
              vm.resizeCanvas(canvas2);
              clear_advice_scribble.addEventListener("click", function (event) {
                vm.step4Data.signaturePad2.clear();
                vm.step4Data.signaturePad2_src='';
              });
            ;
              save_advice_scribble.addEventListener("click", function (event) {
                vm.step4Data.signaturePad2_src = vm.step4Data.signaturePad2.toDataURL();
              });
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
          confirm_opd(){
               $('#confirm_modal').modal('hide');
               $('#receiptAddModel').modal('show'); 
          },
          confirm_popup()
          {
            //$('#receiptAddModel').on('hidden.bs.modal', function () {});
            $('#receiptAddModel').modal('hide'); 
            $('#confirm_modal').modal('show'); 
          },
          ClickHereToPrint() {  
            try { 
              var  printContent = ''; 
                printContent = document.getElementById('printContent').innerHTML; 
                  var windowUrl = ''; 
                  var uniqueName = new Date();  
                  var windowName = 'Print' + uniqueName.getTime();  
                  var printWindow = window.open(windowUrl, windowName, 'left=5000,top=5000,width=0,height=0');  
                  printWindow.document.write(printContent); 
  
                printWindow.document.close(); 
                printWindow.focus();  
                printWindow.print();  
  
                printWindow.close();  
            } 
            catch (e) { 
                self.print(); 
            } 
          },
          printReceipt(test_val)
          {
              let vm=this;
              $('#receiptAddModel').modal('hide');
              toastr.success('Receipt successfully added.', 'Success', {timeOut: 5000});
              vm.$router.push({'name':'opdreport'});
              /*if(test_val==1)
              {
                  $('#receiptPrintModal').modal('show');
                  $('#printContent').html('');
                  $('#printContent').html(all_data);  
                  $('#receiptPrintModal').on('hidden.bs.modal', function () {
                    vm.$router.push({'name':'opdreport'});
                  });
              }
              else
              {
                  vm.$router.push({'name':'opdreport'});
              }*/
          },
          saveRefData(){
            let vm =this;
            _.find(this.$children, function(comp) {
              if(comp.id == vm.refferalId) {
                let referenceData = _.cloneDeep(comp.reffData);
                vm.$store.dispatch('saveReferralReportData',referenceData);
                   return false;
              }
            });
          },
          editOPDData()
          {
              let vm = this;
                vm.saveRefData(); 
                
                if(vm.$store.state.Patient.setErrorData.error)
                {
                    vm.$store.dispatch('saveStep4Data',vm.step4Data);
                    vm.$store.dispatch('saveDiagnosis',vm.diagnosis);
                    vm.$root.$emit('setCurSteps',vm.$store.state.Patient.setErrorData.steps);
                    return false;
                }
                this.$validator.validateAll().then(
                (response) => {

                if (!this.errors.any()) {
                        vm.$store.dispatch('saveStep4Data',_.cloneDeep(vm.step4Data));
                         vm.$store.dispatch('saveDiagnosis',vm.diagnosis);
                          let department = this.$store.state.Users.userDetails.department;
                          let doctor = this.$store.state.Users.userDetails.id;
                          
                          var oData = {
                            'opdData':this.$store.state.Patient.opdData,
                            'patientCase':this.$store.state.Patient.patientCase,
                            'resultData':this.$store.state.Patient.opd_resultData,
                            'doctor':doctor,
                            'department':department,
                            'radioData':this.$store.state.Patient.radioData,
                            'laboratoryData':this.$store.state.Patient.laboratoryData,
                            'examinationData':this.$store.state.Patient.examinationData,
                            'neuroExaminationData':this.$store.state.Patient.neuroExaminationData,
                            'prescriptionData':this.$store.state.Patient.prescriptionData,
                            'step4Data':this.$store.state.Patient.step4Data,
                            'crossRefer': this.crossRefer,
                            'reffData':this.$store.state.Patient.refferelReportData,
                            'diagnosis':this.$store.state.Patient.diagnosis,  
                            'provisionalDiagnosis':this.$store.state.Patient.provisionalDiagnosis,
                          };
                          vm.editOpdData(oData);
                          //vm.$store.dispatch('SetPatientId', '');
                          //vm.$store.dispatch('SetOpdId', '');
                          vm.$store.dispatch('SetPage', 'ADD');
                        } else {
                          
                          toastr.error('Please enter all required fields.', 'Error', {timeOut: 5000});
                        }
                        },
                    (error) => {
                    }
                    )
          },
          editOpdData(oData)
          {
               let vm =this;
               $("body .js-loader").addClass('d-none');
                User.generateEditOpdCaseDetails(oData).then((response) => {
                    
                      if(response.data.code == 200) {
                        if(vm.crossRefer == true){
                            toastr.success('Record has been saved', 'Success', {timeOut: 300});
                        }
                        
                        let case_id = response.data.data.case_pr_id;
                        vm.$store.dispatch('SetCaseId',case_id);
                        vm.$store.dispatch('saveDiagnosis',vm.diagnosis);
                        vm.patient_opd_details=response.data.data;
                        $('#edit_confirm_modal').modal('hide');
                        toastr.success('OPD Successfully Edited.', 'Error', {timeOut: 300});
                        vm.$router.push({'name':'opdreport'});
                      } else if(response.data.code == 300) {
                            $('#edit_confirm_modal').modal('hide');
                            toastr.error('Record not added.', 'Error', {timeOut: 5000});
                           //vm.$router.push({'name':'opd_form_thankyou'});
                          } else{
                             $('#edit_confirm_modal').modal('hide');
                             toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
                          }
                          // vm.$router.push({'name':'opd_form_thankyou'}); 
                  },
                  (error) => {toastr.error('Something goes wrong', 'Error', {timeOut: 5000});}
                );    

          },
          saveOPDForm() {
            // $("body .js-loader").removeClass('d-none');

                let vm = this;
                this.saveRefData(); 
                vm.$store.dispatch('setOpdSubmit',true);
                
                if(vm.$store.state.Patient.setErrorData.error)
                {
                    vm.$store.dispatch('saveStep4Data',vm.step4Data);
                    vm.$store.dispatch('saveDiagnosis',vm.diagnosis);
                    vm.$root.$emit('setCurSteps',vm.$store.state.Patient.setErrorData.steps);
                    return false;
                }
                this.$validator.validateAll().then(
                (response) => {

                if (!this.errors.any()) {
                        vm.$store.dispatch('saveStep4Data',_.cloneDeep(vm.step4Data));
                         vm.$store.dispatch('saveDiagnosis',vm.diagnosis);
                          let department = this.$store.state.Users.userDetails.department;
                          let doctor = this.$store.state.Users.userDetails.id;
                          
                          var oData = {
                            'opdData':this.$store.state.Patient.opdData,
                            'patientCase':this.$store.state.Patient.patientCase,
                            'resultData':this.$store.state.Patient.opd_resultData,
                            'doctor':doctor,
                            'department':department,
                            'radioData':this.$store.state.Patient.radioData,
                            'laboratoryData':this.$store.state.Patient.laboratoryData,
                            'examinationData':this.$store.state.Patient.examinationData,
                            'neuroExaminationData':this.$store.state.Patient.neuroExaminationData,
                            'prescriptionData':this.$store.state.Patient.prescriptionData,
                            'step4Data':this.$store.state.Patient.step4Data,
                            'crossRefer': this.crossRefer,
                            'reffData':this.$store.state.Patient.refferelReportData,
                            'diagnosis':this.$store.state.Patient.diagnosis,  
                            'provisionalDiagnosis':this.$store.state.Patient.provisionalDiagnosis,
                          };
                          vm.saveOpdData(oData);
                        } else {
                          
                          toastr.error('Please enter all required fields.', 'Error', {timeOut: 5000});
                        }
                        },
                    (error) => {
                    }
                    )

               },
               saveOpdData(oData){
                let vm =this;
                $("body .js-loader").removeClass('d-none');
                User.generateAddOpdDetails(oData).then((response) => {
                    $("body .js-loader").addClass('d-none');
                      if(response.data.code == 200) {
                        if(vm.crossRefer == true){
                            toastr.success('Record has been saved', 'Success', {timeOut: 5000});
                        }
                        vm.modal_enabled='true';
                        let case_id = response.data.data.case_pr_id;
                        vm.$store.dispatch('SetCaseId',case_id);
                        vm.$store.dispatch('saveDiagnosis',vm.diagnosis);
                        vm.$store.dispatch('SetPage', 'ADD');
                        vm.patient_opd_details=response.data.data;
                        $('#receiptAddModel').modal('show');
                      } else if(response.data.code == 300) {
                            toastr.error('Record not added.', 'Error', {timeOut: 5000});
                           //vm.$router.push({'name':'opd_form_thankyou'});
                          } else{
                           toastr.error('Something goes wrong', 'Error', {timeOut: 5000});
                          }
                          // vm.$router.push({'name':'opd_form_thankyou'}); 
                  },
                  (error) => {toastr.error('Something goes wrong', 'Error', {timeOut: 5000});}
                );
               }
        }
           
    }
</script>
