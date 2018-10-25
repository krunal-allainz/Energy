<div style="">	

  	@if(isset($data['ReportPageData']['prescriptionReportData']))
	  	
		<div class='col-md-12'>
			<span class='report_title'>Prescription:-</span>
		</div>
		<div class="table-responsive">
			<table class="table report_table text-uppercase" id="prescription_list">
			<thead></thead>
			<tbody>
				@if(count($data['ReportPageData']['prescriptionReportData'])>0)
					@foreach($data['ReportPageData']['prescriptionReportData'] as $key=>$res)
						@if($res['remove']==='false')
						<tr>
							<td>
								<span style="font-size:13px;">
								{{++$key}} ] {{$res['name']}} :ORAL
								
								@if($res['type']=='Q-Hrs')
									@for($i=1;$i<=$res['total_qhrs'];$i++)
										@if($i!=1 && $res['clock_quantity_'.$i]!=0)
											 ______ 
										@endif
										@if($res['clock_quantity_'.$i]!=0)
											{{$res['clock_quantity_'.$i]}}
										@endif
									@endfor
								@else
									@if($res['clock_quantity_1']!='0')
									{{$res['clock_quantity_1']}}
									@endif
				                    @if($res['clock_quantity_2']!='0') 
				                        @if($res['clock_quantity_1']!='0') ______ 
				                    	@endif
										{{$res['clock_quantity_2']}}
				                     @endif
									@if($res['clock_quantity_3']!='0') 
				                    	@if($res['clock_quantity_1']!='0' || $res['clock_quantity_2']!='0') ______
				                    	@endif
				                          {{$res['clock_quantity_3']}}
				                    @endif
				                    @if($res['clock_quantity_4']!='0')
				                    	@if($res['clock_quantity_1']!='0' || $res['clock_quantity_2']!='0' || $res['clock_quantity_3']!='0')  ______ 
				                    	@endif
				                    	{{$res['clock_quantity_4']}}
				                    @endif
								@endif
								
								@if($res['type']=='Q-Hrs')
									[
										@for($i=1;$i<=$res['total_qhrs'];$i++)
											@if($i!=1 && $res['clock_time_'.$i]!=0)
												 ______ 
											@endif
											@if($res['clock_time_'.$i]!="")
												{{$res['clock_time_'.$i]}}
											@endif
										@endfor
									]
								@else
									@if($res['clock_quantity_1']!='0' || $res['clock_quantity_2']!='0' || $res['clock_quantity_3']!='0' || $res['clock_quantity_4']!='0')
										[ 
						                    @if($res['clock_quantity_1']!='0') 
						                        {{$res['clock_time_1']}}
						                    @endif
						                    @if($res['clock_quantity_2']!='0')
						                    	@if($res['clock_quantity_1']!='0') ______
						                    	@endif
						                        {{$res['clock_time_2']}}
						                    @endif
						                    @if($res['clock_quantity_3']!='0')
						                        @if($res['clock_quantity_1']!='0' || $res['clock_quantity_2']!='0') ______
						                        @endif {{$res['clock_time_3']}}
						                    @endif
						                    	@if($res['clock_quantity_4']!='0')
						                           @if($res['clock_quantity_1']!='0' || $res['clock_quantity_2']!='0' || $res['clock_quantity_3']!='0') ______ 
						                        @endif
						                    	   {{$res['clock_time_4']}}
						                    @endif
						                 ]
						            @endif

								@endif
								
			                      
								@if(($res['clock_suggest']!='--' && $res['clock_suggest']!='') )
									[{{$res['clock_suggest']}}]
								@endif
								@if($res['qhrs']!='') <span>		[{{$res['qhrs']}}]
								</span>
								@endif
			                                &#9747;
								@if($res['total_prescription_days']!='')
			                        {{$res['total_prescription_days']}}
			                         <span> DAYS </span>
			                    @else
			                        <span> TO BE CONTINUE </span>
			                    @endif
			                </span>
							</td>
			            </tr>
			       		@endif
					@endforeach
				@else
					<tr>
    					<td>No record found.</td>
					</tr>
				@endif
			</tbody>
			</table>
			</div>
			@php /*
			<div class="table-responsive">
	            <table class="table table-striped table-bordered">
	                <thead>
	                    <tr>
	                        <th>Index</th>
	                        <th>Prescription Name</th>
	                        <th>How Many Days</th>
	                        <th>Total Quantity</th>
	                        <th>QHRS</th>
	                        <th>Total Days</th>
	                        <th>Suggetion</th>
	                    </tr>
	                </thead>
	                <tbody>
						@foreach($data['ReportPageData']['prescriptionReportData'] as $key2=>$res2)
		                	@if($res2['remove']==='false')
			                 <tr class="text-center">
			                        <td>{{++$key2}} </td>
			                        <td>{{$res2['name']}}</td>
			                        <td>{{$res2['type']}}</td>
			                        <td>{{$res2['total_quantity']*$res2['total_prescription_days']}}</td>
			                        <td>{{$res2['qhrs']}}</td>
			                        <td>{{$res2['total_prescription_days']}}</td>
			                         <td>{{$res2['clock_suggest']}}</td>
			                  </tr>
			                @endif
		            	@endforeach
	                </tbody>
	            </table>
		</div> */
		@endphp
		
	@endif
</div>
