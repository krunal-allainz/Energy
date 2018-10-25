<template>
	<table width="500">
    <tbody>
        	 <tr v-if="(patientinfo != null)">
               <td >  <b>Name: </b> <span class="text-uppercase">{{patientinfo.first_name}}    {{patientinfo.middle_name}}  {{patientinfo.last_name}} </span></td>
            </tr>
            	 <tr v-if="(patientinfo != null)">
                   <td v-if="(patientinfo.gender != null)">
                       <b>Gender : </b>
                       <span class="text-uppercase" v-if="(patientinfo.gender == 'F')">Female</span>
                       <span class="text-uppercase" v-if="(patientinfo.gender == 'M')">Male</span>
                   </td>
                   <td v-if="(patientinfo.uhid_no != null)">
                     <b>UHID No :</b> 
                     <span class="text-uppercase">{{patientinfo.uhid_no}}</span>
                   </td>
                 </tr>	
                 <tr>
                 	<td>
                 	 <b>Address :</b> 
                     <span class="text-uppercase" v-if="(patientinfo.address != null)">{{patientinfo.address}}</span>
                     <span class="text-uppercase" v-if="(patientinfo.address == null)">N/A</span>
                    </td>
                 	<td>
                 	<b>Age :</b> 
                     <span class="text-uppercase" v-if="(patientinfo.age > 1000)">
							<span class="text-uppercase" v-if="(((currentYear) - (patientinfo.age)) > 0)">{{(currentYear) - (patientinfo.age)}}</span>	
							<span class="text-uppercase" v-if="(((currentYear) - (patientinfo.age)) == 0)"> 1</span>
						</span>
						<span v-if="(patientinfo.age  < 1000)">{{patientinfo.age}}</span>
                 	</td>
                 </tr>
                 <tr>
                 	<td>
                 	 <b>Mob No : </b> 
                     <span class="text-uppercase" v-if="(patientinfo.mob_no != null)">{{patientinfo.mob_no}}</span>
                     <span class="text-uppercase" v-if="(patientinfo.mob_no == null)">N/A</span>
                     </td>
                 	<td>
                 	 <b>Phone No:</b> 
                     <span class="text-uppercase" v-if="(patientinfo.ph_no != null)">{{patientinfo.ph_no}}</span>
                     <span class="text-uppercase" v-if="(patientinfo.ph_no == null)">N/A</span>
                     </td>
                 </tr>
             </tbody>
            </table>
</template>
<script>
	export default {
		props: ['patientinfo'],
		data() {
			return{
				'currentYear': (new Date()).getFullYear(),
			}
		}
	}
</script>
