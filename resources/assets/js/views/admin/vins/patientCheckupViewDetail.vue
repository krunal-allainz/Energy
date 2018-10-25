<template>
	<div class="report_style">
	<hr style="border-top: dashed  1px;" />
		<div class="row">
			<div class="col-md-3 text-left">
					<label><b>PULSE -</b></label>
					<span v-if="(patientCheckupDetail.pulse != '')">	{{patientCheckupDetail.pulse}}</span>
					<span v-if="(patientCheckupDetail.pulse == null)">N/A</span>
			</div>
			<div class="col-md-3 text-left">
			<label><b>TEMP -</b></label>
			<span v-if="(patientCheckupDetail.temp != '')">	{{patientCheckupDetail.temp}}</span>
			<span v-if="(patientCheckupDetail.temp == null)">	N/A</span>
			</div>
			<div class="col-md-3 text-left">
			<label><b>BP -</b></label>
			<span v-if="(patientCheckupDetail.bp != '/')">{{patientCheckupDetail.bp}}</span>
			<span v-if="(patientCheckupDetail.bp == '/')">N/A</span>
			</div>
			<div class="col-md-3 text-left">
			<label><b>RESP/SPO2 -</b></label>
			<span v-if="(patientCheckupDetail.vitals != '')">	{{patientCheckupDetail.vitals}}</span>
			<span v-if="(patientCheckupDetail.vitals == null)">	N/A</span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3 text-left">
					<label><b>HEIGHT -</b></label>
					<span v-if="(patientCheckupDetail.height != '')">{{patientCheckupDetail.height}}</span>
					<span v-if="(patientCheckupDetail.height == null)">N/A</span>
			</div>
			<div class="col-md-3 text-left">
					<label><b>WEIGHT -</b></label>
					<span v-if="(patientCheckupDetail.weight != '')">{{patientCheckupDetail.weight}}</span>
					<span v-if="(patientCheckupDetail.weight == null)">N/A</span>
			</div>
			<div class="col-md-3 text-left">
					<label><b>BMI -</b></label>
					<span v-if="(patientCheckupDetail.bmi != '')">{{patientCheckupDetail.bmi}}</span>
					<span v-if="(patientCheckupDetail.bmi == null)">N/A</span>
			</div>

		</div>
		<div class="row">
			<div class="col-md-3 text-left">
				<label>PAIN ASSESSMENT</label>
			</div>
			<div class="col-md-9 text-left">
				<div  class="report-painassesment" v-bind:class="[patientCheckupDetail.pain==0 ? 'report-painassesment-selected': '', 'pain_img'  ]">
					<img src="/assets/img/pain/P1.png" class="test" height="50" width="50">
				</div>
				<div class="report-painassesment" v-bind:class="[patientCheckupDetail.pain==2 ? 'report-painassesment-selected': '', 'pain_img'  ]">
					<img src="/assets/img/pain/P2.png" class="test" height="50" width="50">
				</div>
				<div class="report-painassesment" v-bind:class="[patientCheckupDetail.pain==4 ? 'report-painassesment-selected': '', 'pain_img'  ]">
					<img src="/assets/img/pain/P3.png" class="test" height="50" width="50">
				</div>
				<div class="report-painassesment" v-bind:class="[patientCheckupDetail.pain==6 ? 'report-painassesment-selected': '', 'pain_img'  ]">
					<img src="/assets/img/pain/P4.png" class="test" height="50" width="50">
				</div>
				<div class="report-painassesment" v-bind:class="[patientCheckupDetail.pain==8 ? 'report-painassesment-selected': '', 'pain_img'  ]">
					<img src="/assets/img/pain/P5.png" class="test" height="50" width="50">
				</div>
				<div class="report-painassesment" v-bind:class="[patientCheckupDetail.pain==10 ? 'report-painassesment-selected': '', 'pain_img'  ]">
					<img src="/assets/img/pain/P6.png" class="test" height="50" width="50">
				</div>
			</div>
		</div>
		<hr style="border-top: dashed  1px;" />
	</div>
</template>
<script>
     export default {
        props: ['patientCheckupDetail'],
    }

</script>