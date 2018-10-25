<div class="container">
	<hr style="border-top: dashed  1px;" />
	<div class="report_left_pad">
		<table class="report_table_patient">
			<tbody>
				<tr>
					<td class="text-left"><label><b>Patient's Name:</b></label><span class="text-uppercase"><b>{{$data['patientDetail']['first_name']}}
									{{$data['patientDetail']['middle_name']}}
								    {{$data['patientDetail']['last_name']}}</b></span></td>
								    <td></td>
					<td class="text-right"><label><b>UHID :</b></label><span class="text-uppercase"><b>{{$data['patientDetail']['uhid_no']}}</b></span></td>
				</tr>
				<tr>
					<td><label><b>Address :</b></label><span class="text-uppercase">{{$data['patientDetail']['address']}}</span></td>
					<td></td>
					<td class="text-right"><label><b>Date :</b></label><span class="text-uppercase"><b>{{$data['todayDate']}}</b></span></td>
				</tr>
				<tr>
					<td class="text-left"><label><b>Mob No:</b></label><span class="text-uppercase"><b>{{$data['patientDetail']['mob_no']}}</b></span></td>
					<td class="text-center"><label><b>Phone No:</b></label><span class="text-uppercase"><b>{{$data['patientDetail']['ph_no']}}</b></span></td>
					<td class="text-right"><label><b>Age/Sex:</b></label>
						<span class="text-uppercase">
							@if($data['patientDetail']['age'] > 1000)
								@if(((now()->year) - ($data['patientDetail']['age'])) > 0)
										{{ (now()->year) - ($data['patientDetail']['age'])}}
								@else
									1
								@endif
							@endif
							@if($data['patientDetail']['age'] < 1000)
									{{$data['patientDetail']['age']}}
							@endif
							</span>
							@if($data['patientDetail']['gender'] == 'F')
							<span class="text-uppercase">/ Female</span>
							@else
							<span class="text-uppercase">/ Male</span>
							@endif</td>
				</tr>
				<tr>
					<td><label><b>Consulting Dr.:</b></label>
						<span class="text-uppercase"><b>{{$data['doctoreName']}}</b></span>
					</td>
					<td></td>
					<td class="text-right">	<label><b>Ref By Dr.:</b></label>
					<span class="text-uppercase"><b>{{ $data['reference']}}</b></span></td>
				</tr>
				<tr>
					<td>	<label><b>Speciality:</b></label>
							<span class="text-uppercase"><b>{{$data['department']}}</b></span></td>
							<td></td>
					<td></td>
				</tr>
				<tr>
					<td> 	<label><b>Dr. Reg. No:</b></label>
							<span class="text-uppercase"><b>{{$data['regNo']}}</b></span></td>
							<td></td>
							<td></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>


