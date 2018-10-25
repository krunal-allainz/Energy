<div>
	<div class='col-md-6'>
		<span class='report_title'>Examination:-</span>
	</div>
	@if($data['ReportPageData']['examinationData']!='')
		<div class='col-md-12'>
			<span class='report_details'>{{$data['ReportPageData']['examinationData']}}</span>
		</div>
	@else
		<div class='col-md-12'>
			<span class='report_details'>No Record found.</span>
		</div>
	@endif
</div>
