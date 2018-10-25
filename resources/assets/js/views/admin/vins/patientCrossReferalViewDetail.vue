<template>
	<div>
		<div>
			 
		 	<div class='col-md-12'>
		 		<span class="report_title">Cross Referrals:-</span>
		 	</div>
    		<div class="col-md-12">
    			<div class="">
            		<table class="table table-striped table-bordered report_table" id="radio_list">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Type</th>
                        <th>Name</th>
		            </tr>
					</thead>
					<tbody v-if="CrossReferalData.length>0">
					<tr  v-for="(res,index) in CrossReferalData">
	                    <td>{{++index}}</td>
	                    <td>{{res.cross_type}}</td>
	                    <td>{{res.cross_value}}</td>
	                    
	                </tr>
                </tbody>
                <tbody v-else>
                	<tr>
                		<td colspan="3">No data found.</td>
                	</tr>
                </tbody>
				</table>
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
