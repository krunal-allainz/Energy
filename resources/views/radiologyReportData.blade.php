@if(isset($data['ReportPageData']['radiologyReferalReportData']))
  	
	<div class='col-md-12'>
		<span class="report_title">Radiology Report:-</span>
	</div>
	<div class="">
    	<div class="col-md-12">
             @if(count($data['ReportPageData']['radiologyReferalReportData'])>0)
                <table class="table table-striped table-bordered report_table" id="radio_list">
                  <thead>
                        <tr>
                            <!--  <th>#</th> -->
                             <th>Type</th>
                             <th>Body parts</th>
                             <th>Qualifier</th>
                             <th>Special request</th>
                             <th>Details</th>
                        </tr>
                    </thead>
                     <tbody>
                        @foreach($data['ReportPageData']['radiologyReferalReportData'] as $index=>$res)
                            <tr class="">
                                <!-- <td>{{++$index}}</td> -->
                                <td>{{$res['type']}}</td>
                                <td>{{$res['bodyparts']}}</td>
                                <td>{{$res['qualifiers']}}</td>
                                <td>{{$res['special_request']}}</td>
                                <td>{{str_limit($res['details'],50)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <span class="report_details">No record found.</span> 
            @endif
            
    	</div>
    </div>
  	
@endif