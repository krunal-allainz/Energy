<template>
	<div>	
	
	<div v-show="(printType == 'lab')">
		
		<div class='col-md-12'>
			<span class="report_title">Lab Report:-</span>
		</div>
		
		 <div class="form-group" >
			<div class="col-md-12">
				<div class="" v-if="orgLabReffData.length>0">
					<table class="table table-striped table-bordered report_table" id="laboratory_table_list">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
							</tr>
						</thead>
						<tbody>
							<tr :id="res.id" v-for="(res,index) in orgLabReffData">
								<td>{{++index}}</td> 
								<td>{{res.name}}</td>		
							</tr>
						</tbody>
					</table>
				</div>
				<div v-else>
	                <span class="report_details">No record found.</span>
			    </div>
			</div>
		</div>
	</div>
	
	<div v-for="reportName in checkedreportList" v-show="(reportName == 'Laboratory' && refferance=='0')">
		
		<div class='col-md-12'>
			<span class="report_title">Lab Report:-</span>
		</div>
		
		 <div class="form-group" >
			<div class="col-md-12">
				<div class="" v-if="orgLabReffData.length>0">
					<table class="table table-striped table-bordered report_table" id="laboratory_table_list">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
							</tr>
						</thead>
						<tbody>
							<tr :id="res.id" v-for="(res,index) in orgLabReffData">
								<td>{{++index}}</td> 
								<td>{{res.name}}</td>		
							</tr>
						</tbody>
					</table>
				</div>
				<div v-else>
    				<span class="report_details">No record found.</span>
				</div> 
			</div>
		</div>
	</div>
	
	<div v-for="reportName in checkedreportList" v-show="(reportName == 'Investigation Lab' && printType == 'opd_case' && refferance=='1')">
		
		<div class='col-md-12'>
			<span class="report_title">Investigation Lab Report:-</span>
		</div>
		
		<div class="form-group"  >
			<div class="col-md-12">
				<div class="" v-if="orgLabReportData.length>0">
					
					<table class="table table-striped table-bordered report_table" id="laboratory_table_list">
					<thead>
					<tr>
						<th>#</th>
						<th>Name</th>
						<th>Date</th>
						<th>Result</th>
					</tr>
			   		 </thead>
					<tbody>
						<tr :id="res.id" v-for="(res,index) in orgLabReportData">
							<td>{{++index}}</td> 
							<td>{{res.name }}</td>
							<td>{{res.date }}</td>
							<td>{{res.result }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div v-else>
    			<span class="report_details">No record found.</span>
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