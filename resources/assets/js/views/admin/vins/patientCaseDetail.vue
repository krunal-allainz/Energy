<template>
	<div v-if="(patientCaseDetail != '')">
		<table class="report_table table table-striped table-bordered">
			<thead>
			<tr>
				
				<th width="70px;">Case Type</th>
				<th  width="150px;">Last Vist</th>
				<th   width="150px;">Reference Dr</th>
				<th   width="150px;">Consultant Dr</th>
					
			</tr>
			</thead>
			<tbody>
				<tr v-for="patientCase in patientCaseDetail" >
					
					<td>
						<span v-if="(patientCase.case_type == 'new_case')">new</span>
						<span v-if="(patientCase.case_type == 'cross_reference')">Cross Reference</span>
						<span v-if="(patientCase.case_type == 'follow_ups')">Follow Up</span>
						<span v-if="(patientCase.case_type == 'reports')">Reports</span>
					</td>
					<td>
						<span>{{patientCase.appointment_datetime}}</span>
					</td>
					<td>
						<span>{{patientCase.references}}</span>
					</td>
					<td>
						<span>{{patientCase.first_name}} {{patientCase.last_name}}</span>
					</td>

					</tr>
					
			</tbody>
		</table>
	</div>
</template>
<script>
	import User from '../../../api/users.js';
	import patientOPDDetailInfo from './patientOPDDetailInfo.vue';
	export default {
		props: ['patientCaseDetail','patientOPDDetail'],
		data(){
			return {
				'opdDetailById': '',
			}
		},
		 components : {
            patientOPDDetailInfo,
          },
         methods :{
			getOpdDetail(opdId){
				let vm = this;
				User.getPatientOpdDetailByOpdId(opdId).then(
					  (response) => {
					  	vm.opdDetailById = response.data.data;
					  },
					  (error) => {
                       },
				);

			}
		},
	}
	
</script>
