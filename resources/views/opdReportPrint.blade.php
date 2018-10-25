<div>
  @include('reportHeader')
  <!-- <div id="header">
    <div class="" style="width:100%;height:150px;top:0px;left:0;position:fixed;"> 
       <div class="row">
        <div class="col-md-12" style="padding:25px;">
            <img src="{{$url.'/assets/img/nabh_vins_logo.png'}}" id="logo-desk" alt="NABH Logo" class="hidden-sm-down" height="auto" width="30%">
        </div>
      </div>
    </div>
  </div> -->
    <!-- <hr style="border-top: dashed  1px;" /> -->
   
    <div class="middlePart">
      @include('patientDetailReport')
      @include('patientCheckupReport')
        @if(in_array('Advice + follow ups',$data['checkedreportList'] ))
          <div class="report_space report_left_pad">
              @include('adviceReportData')
              @include('followupReportData')
          </div>
        @endif
        @if(in_array('Radiology',$data['checkedreportList'] ))
          <div class="report_space report_left_pad">
            @include('radiologyReportData')
          </div>
        @endif  

        @if(in_array('Laboratory',$data['checkedreportList'] ))
          <div class="report_space report_left_pad">
            @include('labReportData')
          </div>
        @endif

        @if(in_array('Prescription',$data['checkedreportList'] ))
          @if(isset($data['priscriptionData']))
              <div class="report_space report_left_pad">
                @include('prescriptionReportData')
              </div>
          @endif
        @endif

        @if(in_array('History',$data['checkedreportList'] ))
          <div class="report_space report_left_pad">
            @include('historyReportData')
          </div>
        @endif

        @if(in_array('Past History',$data['checkedreportList'] ))
          <div class="report_space report_left_pad">
            @include('pastHistoryReportdata')
          </div>
        @endif
        
        @if(in_array('Investigation Lab',$data['checkedreportList'] ))
          <div class="report_space report_left_pad">
            @include('labPatientReportData')
          </div>
        @endif

        @if(in_array('Investigation Radiology',$data['checkedreportList'] ))
          <div class="report_space report_left_pad">
            @include('radiologyPatientReportData')
          </div>
        @endif
        
        @if(in_array('Examination',$data['checkedreportList'] ))
          <div class="report_space report_left_pad">
            @include('examinationReportData')
          </div>
        @endif

         @if(in_array('Diagnosis',$data['checkedreportList'] ))
          <div class="report_space report_left_pad">
            @include('diagnosisReportData')
          </div>
        @endif
        
        @if(in_array('Referrals',$data['checkedreportList'] ))
          <div class="report_space report_left_pad">
            @include('crossReportData')
          </div>
        @endif
    </div>
   @include('reportSignature')
  @include('reportFooter')
  </div>
 