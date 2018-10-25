@if(isset($data['ReportPageData']['adviceData']) )
	@if($data['ReportPageData']['adviceData']['type'] == 'text') 
		<div class="report_space">
			<div class='col-md-6'>
				<span class='report_title'>Advice:-</span>
			</div>
			<div >
				@if ($data['ReportPageData']['adviceData']['type'] == 'text' && $data['ReportPageData']['adviceData']['value']!='')
					<div class='col-md-12'>
						<span class="report_details">{{$data['ReportPageData']['adviceData']['value']}}</span>
					</div>
				@else
					<div class='col-md-12'>
						<span class="report_details">No record found.</span>
					</div>
				@endif
			</div>
		</div>
		@endif
		@if($data['ReportPageData']['adviceData']['type'] != 'text')
			<div  class="report_space">
				<div class='col-md-6'>
					<span class='report_title'>Advice:-</span>
				</div>

				@if($data['ReportPageData']['adviceData']['value']!='')
					<div class='col-md-12'>
					    <img class="report_image" src="{{$data['ReportPageData']['adviceData']['value']}}" title="Advice">
					</div> 
				@else
					<div class='col-md-12'>
						<span class="report_details">No record found.</span>
					</div>
				@endif
			</div>
		@endif
@endif