<template>
	<div>
		<div>
			 
		 	<div class='col-md-12'>
		 		<span class="report_title">Cross Referrals:-</span>
		 	</div>
    		<div class="col-md-12">
    			<div class="" v-if="CrossReferalData.length>0">
            		<table class="table table-striped table-bordered report_table" id="radio_list">
	                    <thead>
		                    <tr>
		                        <th>#</th>
		                        <th>Type</th>
		                        <th>Name</th>
				            </tr>
						</thead>
						<tbody >
							<tr  v-for="(res,index) in CrossReferalData">
			                    <td>{{++index}}</td>
			                    <td>{{res.cross_type}}</td>
			                    <td>{{res.cross_value}}</td>
			                    
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
		props:['CrossReferalData','printType','checkedreportList']
	}
</script>
