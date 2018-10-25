<template>
	<div>	
	
	<div v-show="(printType == 'lab')" v-if="(labReferalData)">
		
		<div class='col-md-12'>
			<span class="report_title">Lab Report:-</span>
		</div>
		
		 <div class="form-group" >
			<div class="col-md-12">
				<div class="">
					<table class="table table-striped table-bordered report_table" id="laboratory_table_list">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
							</tr>
						</thead>
						<tbody v-if="labReferalData.length>0">
							<tr :id="res.id" v-for="(res,index) in labReferalData">
								<td>{{++index}}</td> 
								<td>{{res.name}}</td>		
							</tr>
						</tbody>
						<tbody v-else>
	                    	<tr>
				               <td colspan="2">No data found.</td>
				            </tr>
			            </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	

	<div v-if="(labReportData)" v-show="(printType == 'investigationLab')">
		
		<div class='col-md-12'>
			<span class="report_title">Investigation Lab Report:-</span>
		</div>
		
		<div class="form-group"  >
			<div class="col-md-12">
				<div class="">
					
					<table class="table table-striped table-bordered report_table" id="laboratory_table_list">
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Date</th>
						<th>Result</th>
					</tr>
			   		 </thead>
					<tbody v-if="labReportData.length>0">
						<tr :id="res.id" v-for="(res,index) in labReportData">
							<td>{{++index}}</td> 
							<td>{{res.name }}</td>
							<td>{{res.date }}</td>
							<td>{{res.result }}</td>
						</tr>
					</tbody>
					<tbody v-else>
                    	<tr>
			               <td colspan="4">No data found.</td>
			            </tr>
		            </tbody>
				</table>
			</div>
		</div>
	</div>
</div>
</div>
</template>
<script>
	export default {
        props:['labReferalData','labReportData','printType','checkedreportList','refferance'],
		data() {
			return{
				'orgLabReffData' : {},
				'orgLabReportData':{}
		      }
		},
		mounted(){
       		let vm =this;
       		vm.getAllValues();
        },
		components: {
         
        },
        methods: {
			GetSelectComponent(componentName) {
		       this.$router.push({name: componentName})
		   	},
		   	getAllValues()
		   	{
		   		let vm =this;

		   		if(!(jQuery.isEmptyObject(vm.labReferalData)))
		   		{
		   			vm.orgLabReffData=vm.labReferalData;
		   		}
		   		if(!(jQuery.isEmptyObject(vm.labReportData)))
		   		{
		   			vm.orgLabReportData=vm.labReportData;
		   		}
		   	}
        }
	}
</script>