
<div>
	<div class='col-md-6 '>
		<span class='report_title'>Diagnosis:-</span>
	</div>
	
	@if($data['ReportPageData']['opdData']['diagnosis'] != '')
		<div >
			<div class='col-md-12'>
			   <span class="report_details">{{$data['ReportPageData']['opdData']['diagnosis']}}</span>
			</div> 
		</div>
	@else
		<span class="report_details">No record found.</span> 
	@endif
</div>
 