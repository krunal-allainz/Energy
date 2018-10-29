<template>

	<section class="content">
        <div class="">
            <div class="row">
                <div class="col-md-6 text-left">
                     <h3>Date : {{selectedDate}}</h3>
                </div>
                <div class="col-md-6 text-right">
                    <button class="btn btn-info" @click="getPrevoiusDate()"><i class="fa fa-arrow-left fa-lg"></i></button>
                    <button class="btn btn-info" :disabled="selectedDate==disabledDate" @click="getNextDate()"><i class="fa fa-arrow-right fa-lg"></i></button>
                </div>
            </div>
        </div>
        <br/>
		
	</section>
</template>
	
<script >
    import User from '../../../api/users.js';
    import moment from 'moment';

export default {
    name: "",
    data() {
        return {
            'selectedDate' : moment().format('DD-MM-YYYY'),
            'disabledDate':  moment().add(1,'days').format('DD-MM-YYYY'),
        }
    },
    mounted: function() {
        let vm=this;
        vm.$root.$emit('changeDashbordDate',vm.selectedDate);
    },
    components: {
           
    },
    methods: {
        getPrevoiusDate(){
            let vm=this;
            let prevoiusDay = moment(vm.selectedDate,'DD-MM-YYYY').add(-1,'days').format('DD-MM-YYYY');
            vm.selectedDate =  prevoiusDay;
            vm.$root.$emit('changeDashbordDate',vm.selectedDate);
        },
        getNextDate(){
            let vm=this;
            let nextDay = moment(vm.selectedDate,'DD-MM-YYYY').add(1,'days').format('DD-MM-YYYY');
            vm.selectedDate =  nextDay;
            vm.$root.$emit('changeDashbordDate',vm.selectedDate);
        },
    },
    
}

</script>