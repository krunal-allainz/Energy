@if(isset($data['ReportPageData']['CrossReferalData']))
	<div class=''>
		<div class='col-md-12'>
			<span class="report_title">Cross Referrals:-</span>
	    </div>
		<div class="">
        	<div class="col-md-12">
        	  <div class="">
                    @if(count($data['ReportPageData']['CrossReferalData'])>0)
                        <table class="table table-striped table-bordered report_table" id="radio_list">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['ReportPageData']['CrossReferalData'] as $index=>$res)
                                    <tr class="">
                                        <td>{{++$index}}</td>
                                        <td>{{$res['cross_type']}}</td>
                                        <td>{{$res['cross_value']}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                     @else
                        <span class="report_details">No record found.</span>
                    @endif
                </div>
        	</div>
        </div>
    </div>
@endif
