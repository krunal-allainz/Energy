@if(isset($data['ReportPageData']['past_history']) )
	@if($data['ReportPageData']['past_history']['type'] == 'text' )	
		<div>
			<div class='col-md-6'>
				<span class='report_title'>Past Hisotory:-</span>
			</div>
			<div class=''>
				@if ($data['ReportPageData']['past_history']['type'] == 'text')
					@if($data['ReportPageData']['past_history']['value']!='')
						<div class='col-md-12'>
							<span class='report_details'>{{$data['ReportPageData']['past_history']['value']}}</span>
						</div>
					@else
						<div class='col-md-12'>
							<span class='report_details'>No record found.</span>
						</div>
					@endif
				@endif
				
			</div>
		</div>
		<br/>
		@endif
		@if($data['ReportPageData']['past_history']['type'] != 'text')
		<div>
			<div class='col-md-6 text-left'>
				<span class='report_title'>Past Hisotory:-</span>
			</div>
			@if($data['ReportPageData']['past_history']['value']!='')
				<div class='col-md-12'>
				    <img src="{{$data['ReportPageData']['past_history']['value']}}" title="Past Hisotory">
				</div> 
			@else
				<div class='col-md-12'>
					<span class='report_details'>No record found.</span>
				</div>
			@endif
			
		</div>
		@endif 
@endif