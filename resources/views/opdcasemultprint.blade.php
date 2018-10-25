
  		@include('patientDetailReport')
 		@include('patientCheckupReport')
	  	@if(in_array( 'Advice + follow ups',$data['checkedreportList']))
			<div class="report_left_pad">
				@include('adviceReportData')
				@include('followupReportData')
			</div>

		@endif
	  	@if(in_array( 'Radiology',$data['checkedreportList']))
	  		<div class="report_left_pad">
	  			@include('radiologyReportData')
	  		</div>
	  	@endif	

	  	@if(in_array( 'Laboratory',$data['checkedreportList']))
	  		<div class="report_left_pad">
	  			@include('labReportData')
	  		</div>
	  	@endif
		
		@if(in_array('Prescription',$data['checkedreportList']))
			@if(isset($data['priscriptionData']))
		  		@if(!empty($data['priscriptionData']))
		  			<div class="report_left_pad">
						@include('prescriptionReportData')
					</div>
				@endif
			@endif
		@endif

		@if(in_array( 'History',$data['checkedreportList']))
			<div class="report_left_pad">
				@include('historyReportData')
			</div>
		@endif

		@if(in_array( 'Past History',$data['checkedreportList']))
			<div class="report_left_pad">
				@include('pastHistoryReportdata')
			</div>
		@endif
		
		@if(in_array('Investigation Lab',$data['checkedreportList'] ))
			<div class="report_left_pad">
				@include('labPatientReportData')
			</div>
		@endif

		@if(in_array('Investigation Radiology',$data['checkedreportList']))
			<div class="report_left_pad">
				@include('radiologyPatientReportData')
			</div>
		@endif
		
		@if(in_array( 'Examination',$data['checkedreportList']))
			<div class="report_left_pad">
				@include('examinationReportData')
			</div>
		@endif
		@if(in_array( 'Diagnosis',$data['checkedreportList']))
			<div class="report_left_pad">
				@include('diagnosisReportData')
			</div>
		@endif
		
		@if(in_array('Referrals',$data['checkedreportList'] ))
			<div class="report_left_pad">
				@include('crossReportData')
			</div>
		@endif