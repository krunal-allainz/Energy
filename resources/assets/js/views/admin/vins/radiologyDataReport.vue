<template>
	<div>
		<div v-if="(radiologyReferalReportData)" >
			 
		 	<div class='col-md-12'>
		 		<span class="report_title">Radiology Report:-</span>
		 	</div>
        		<div class="col-md-12">
        			<div class="" v-if="radiologyReferalReportData.length>0">
                		<table class="table table-striped table-bordered report_table" id="radio_list" >
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Type</th>
                            <th>Body parts</th>
			                <th>Qualifier</th>
			                <th>Special request</th>
			                <th>Details</th>
			            </tr>
						</thead>

						<tbody>
							<tr v-for="(res,index) in radiologyReferalReportData" >
			                    <td>{{++index}}</td>
			                    <td>{{res.type}}</td>
			                    <td>{{res.bodyparts}}</td>
			                    <td>{{res.qualifiers}}</td>
			                    <td>{{res.special_request}}</td>
			                    <td>{{res.details | strLimit}}</td>
			                   
			                </tr>
	                    </tbody>
						</table>
					</div>
					<div v-else>
    					<span class="report_details">No record found.</span>
					</div> 
				</div>
			
		</div>	
		<div v-for="reportName in checkedreportList" v-show="(reportName == 'Investigation Radiology' && printType == 'opd_case')" v-if="(radiologyReportData)">
			
		 	<div class='col-md-12'>
		 		<span class="report_title">Investigation Radiology Report:-</span>
		 	</div>
        		<div class="col-md-12">
        			<div class="" v-if="radiologyReportData.length>0">
                		<table class="table table-striped table-bordered report_table" id="radio_list">
	                        <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Type</th>
	                            <th>Body parts</th>
				                <th>Qualifier</th>
				                <th>Special request</th>
				                <th>Details</th>
				            </tr>
							</thead>
							<tbody>
								<tr  v-for="(res,index) in radiologyReportData">
				                    <td>{{++index}}</td>
				                    <td>{{res.type}}</td>
				                    <td>{{res.bodyparts}}</td>
				                    <td>{{res.qualifiers}}</td>
				                    <td>{{res.special_request}}</td>
				                    <td>{{res.details | strLimit}}</td>
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
</template>
<script>
	export default {
		props:['radiologyReferalReportData','radiologyReportData','printType','checkedreportList'],
		filters: {
          strLimit: function (value) {
            if(value.length > 50){
                var str50 = value.substr(0,50);
                return str50+'...'; 
            } else {
                return value; 

            }
          }
        },
	}
</script>