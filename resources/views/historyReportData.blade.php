@if(isset($data['ReportPageData']['historyData']) )
	@if($data['ReportPageData']['historyData']['type'] == 'text' )	
		<div>
			<div class='col-md-6'>
				<span class="report_title">History:-</span>
			</div>
			<div>
			@if ($data['ReportPageData']['historyData']['type'] == 'text')
				@if($data['ReportPageData']['historyData']['value']!='')
					<div class='col-md-12'>
						<span class='report_details'>{{$data['ReportPageData']['historyData']['value']}}</span>
					</div>
				@else
					<div class='col-md-12'>
						<span class='report_details'>No record found.</span>
					</div>
				@endif
			@endif
			</div>
		</div>
		
		@endif
		@if($data['ReportPageData']['historyData']['type'] != 'text')
		<div>
			<div class='col-md-6'>
				<span class="report_title">History:-</span>
			</div>
			@if($data['ReportPageData']['historyData']['value']!='')
				<div class='col-md-12'>
				    <img class="report_image" src="{{$data['ReportPageData']['historyData']['value']}}" title="History">
				</div>
			@else
				<div class='col-md-12'>
					<span class='report_details'>No record found.</span>
				</div>
			@endif 
			
		</div>
		@endif 
@endif