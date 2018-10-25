<div class="container">
	<hr style="border-top: dashed  1px;" />
	<div class="report_left_pad report_table_patient">
		<table class="report_table_patient">
			<tr>
				<td><label><b>PULSE -</b></label>
					@if($data['patientCheckupDetail']['pulse'] != '')
						{{$data['patientCheckupDetail']['pulse']}}
					@else
					N/A
					@endif
					
				</td>
				<td><label><b>TEMP -</b></label>
					@if($data['patientCheckupDetail']['temp'] != '')
					{{$data['patientCheckupDetail']['temp']}}
					@else
					N/A
					@endif
				
						</td>
				<td><label><b>BP -</b></label>
					@if($data['patientCheckupDetail']['bp'] != '/')
						{{$data['patientCheckupDetail']['bp']}}
					@else
					N/A
					@endif
					
						</td>
				<td><label><b>RESP/SPO2 -</b></label>
					@if($data['patientCheckupDetail']['vitals'] != '')
					{{$data['patientCheckupDetail']['vitals']}}
					@else
					N/A
					@endif
					
						</td>
			</tr>
			<tr>
				<td><label><b>HEIGHT -</b></label>
					@if($data['patientCheckupDetail']['height'] != '')
						{{$data['patientCheckupDetail']['height']}}
					@else
					N/A
					@endif
					
							</td>
				<td><label><b>WEIGHT -</b></label>
					@if($data['patientCheckupDetail']['weight'] != '')
						{{$data['patientCheckupDetail']['weight']}}
					@else
					N/A
					@endif
					
							</td>
				<td><label><b>BMI -</b></label>
					@if($data['patientCheckupDetail']['bmi'] != '')
					{{$data['patientCheckupDetail']['bmi']}}
					@else
					N/A
					@endif
					
						</td>
			</tr>
			<tr>
				<td class="col-md-3 text-left"><label><b>PAIN ASSESSMENT</b></label></td>
				<td class="col-md-9 text-left">
					<div <?php 
					echo ($data['patientCheckupDetail']['pain'] == 0)?'style="float:left;  width:15% !important;
		    padding:0px !important;line-height : 22px;border :2px solid red;
		 box-shadow :rgba(0, 0, 0, 0.2) 0px 1px 3px 0px;border-radius :2px;
		  color:#5f5f5f;display :inline-block;"':''; 
					?>  style="float:left;width:15% !important;
		    padding:0px !important;">
						<img src="/assets/img/pain/P1.png" class="test" height="50" width="50" >
					</div>
					
					<div <?php 
					echo ($data['patientCheckupDetail']['pain'] == 2)?'style="float:left;  width:15% !important;
		    padding:0px !important;line-height : 22px;border :2px solid red;
		 box-shadow :rgba(0, 0, 0, 0.2) 0px 1px 3px 0px;border-radius :2px;
		  color:#5f5f5f;display :inline-block;"':'class="report-painassesment"'; 
					?> style="float:left;width:15% !important;
		    padding:0px !important;">
						<img src="/assets/img/pain/P2.png" class="test" height="50" width="50">
					</div>
					
					<div <?php 
					echo ($data['patientCheckupDetail']['pain'] == 4)?'style="float:left;  width:15% !important;
		    padding:0px !important;line-height : 22px;border :2px solid red;
		 box-shadow :rgba(0, 0, 0, 0.2) 0px 1px 3px 0px;border-radius :2px;
		  color:#5f5f5f;display :inline-block;"':'class="report-painassesment"'; 
					?> style="float:left;width:15% !important;
		    padding:0px !important;">
						<img src="/assets/img/pain/P3.png" class="test" height="50" width="50">
					</div>
					
					<div <?php 
					echo ($data['patientCheckupDetail']['pain'] == 6)?'style="float:left;  width:15% !important;
		    padding:0px !important;line-height : 22px;border :2px solid red;
		 box-shadow :rgba(0, 0, 0, 0.2) 0px 1px 3px 0px;border-radius :2px;
		  color:#5f5f5f;display :inline-block;"':'class="report-painassesment"'; 
					?> style="float:left;width:15% !important;
		    padding:0px !important;">
						<img src="/assets/img/pain/P4.png" class="test" height="50" width="50">
					</div>
					
					<div <?php 
					echo ($data['patientCheckupDetail']['pain'] == 8)?'style="float:left;  width:15% !important;
		    padding:0px !important;line-height : 22px;border :2px solid red;
		 box-shadow :rgba(0, 0, 0, 0.2) 0px 1px 3px 0px;border-radius :2px;
		  color:#5f5f5f;display :inline-block;"':'class="report-painassesment"'; 
					?> style="float:left;width:15% !important;
		    padding:0px !important;">
						<img src="/assets/img/pain/P5.png" class="test" height="50" width="50">
					</div>
					
					<div <?php 
					echo ($data['patientCheckupDetail']['pain'] == 10)?'style="float:left;  width:15% !important;
		    padding:0px !important;line-height : 22px;border :2px solid red;
		 box-shadow :rgba(0, 0, 0, 0.2) 0px 1px 3px 0px;border-radius :2px;
		  color:#5f5f5f;display :inline-block;"':'class="report-painassesment"'; 
					?> style="float:left;width:15% !important;
		    padding:0px !important;">
						<img src="/assets/img/pain/P6.png" class="test" height="50" width="50">
					</div>
				</td>
			</tr>
		</table>
	</div>
	<hr style="border-top: dashed  1px;" />	
</div>