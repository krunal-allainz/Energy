@if(isset($data['ReportPageData']['opdData']['follow_up']) && $data['ReportPageData']['opdData']['follow_up'] != '')
<div>
	<div class='col-md-6 '>
		<span class='report_title'>Follow Up:-</span>
	</div>
	<div >
		<div class='col-md-12'>
		   <span class="report_details">{{$data['ReportPageData']['opdData']['follow_up']}}</span>
		</div> 
	</div>
</div>
@endif 