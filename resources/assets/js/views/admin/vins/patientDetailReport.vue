<template>
	<div class="report_left_pad">
		<hr style="border-top: dashed  1px;" />
		<div class="report_table_patient">
			<div class="row">
				<div class='col-md-6 text-left'>
					 	<label ><b>Patient's Name:</b></label>
						<span class="text-uppercase"><b>{{patientDetail.first_name}}
						{{patientDetail.middle_name}}
					    {{patientDetail.last_name}}</b></span>
				</div>
				<div class='col-md-6 text-center'>
					 	<label><b>UHID :</b></label>
						<span class="text-uppercase"><b>{{patientDetail.uhid_no}}</b></span>
				</div>
			</div>
			<div class="row">
					<div class="col-md-6 text-left">
					 	<label><b>Address :</b></label>
						<span class="text-uppercase">{{patientDetail.address}}</span>
					</div>
					<div class="col-md-6 text-center">
					 	<label><b>Date :</b></label>
						<span class="text-uppercase"><b>{{todayDate}}</b></span>
					</div>
			</div>
			<div class="row">
					<div class="col-md-4">
					 	<label><b>Mob No:</b></label>
						<span class="text-uppercase"><b>{{patientDetail.mob_no}}</b></span>
					</div>
					<div class="col-md-4">
						<label><b>Phone No:</b></label>
							<span class="text-uppercase">{{patientDetail.ph_no}}</span>
					</div>
					<div class="col-md-4">
					 	<label><b>Age/Sex:</b></label>
						<span v-if="(patientDetail.age > 1000)">
							<span class="text-uppercase" v-if="(((currentYear) - (patientDetail.age)) > 0)">{{(currentYear) - (patientDetail.age)}}</span>	
							<span class="text-uppercase" v-else> 1</span>
						</span>
						<span v-if="(patientDetail.age  < 1000)" class="text-uppercase">{{patientDetail.age}}</span>
						<span v-if="(patientDetail.gender == 'F')" class="text-uppercase"><b>/ Female</b></span>
						<span v-if="(patientDetail.gender == 'M')" class="text-uppercase"><b>/ Male</b></span>
					</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-left">
				 	<label><b>Consulting Dr.:</b></label>
					<span class="text-uppercase">	{{consult_dr}}</span>
				</div>
				<div class="col-md-6 text-center">
				 	<label><b>Ref By Dr.:</b></label>
					<span class="text-uppercase">	{{refer_dr}} </span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-left">
				 	<label><b>Speciality:</b></label>
					<span class="text-uppercase">	{{department}}</span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 text-left">
				 	<label><b>Dr. Reg. No:</b></label>
					<span class="text-uppercase">	{{reg_no}}</span>
				</div>
			</div>

			</div>
	</div>
</template>
<script>
     export default {
        props: ['patientDetail','consult_dr','department','reg_no','refer_dr','todayDate'],
        data() {
			return{
				'currentYear': (new Date()).getFullYear(),
			}
		}

    }

</script>