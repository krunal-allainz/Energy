 <template>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-aside sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar -->
        <section class="sidebar">
            <div id="menu" role="navigation">
                <div class="nav_profile">
                    <!-- <profile></profile> -->
                </div>
                <div v-if="userRole == 6">
                   <vmenu>
                        <vmenu-item link="/nomination-form" icon="ti-layout">
                            &nbsp;Nomination request form
                        </vmenu-item>
                        <vmenu-item link="/nomination-list" icon="ti-layout">
                            &nbsp;Nomination list
                        </vmenu-item>
                    </vmenu> 
                </div>
            <vmenu>
                <!--     <vsub-menu title="Emergeny Patient" icon="ti-layout">
                        <vmenu-item link="/er_observation" icon="ti-desktop">
                             ER Observation
                        </vmenu-item>
                    </vsub-menu> 
                    <vsub-menu title="Pre-Admission Forms" icon="ti-layout">
                        <vmenu-item link="/information_form" icon="ti-desktop">
                            Information form
                        </vmenu-item>
                    </vsub-menu>
                    <vsub-menu title="Within 24 Hours" icon="ti-layout">
                        <vmenu-item link="/counsellingForm" icon="ti-desktop">
                            Counselling form
                        </vmenu-item>
                         <vmenu-item link="/completeNursingAssessment" icon="ti-desktop">
                            Complete nursing assessment
                        </vmenu-item>
                        <vmenu-item link="/NutritionalAssessmentForm" icon="ti-desktop">
                            Nutritional assessment form
                        </vmenu-item>
                        <vmenu-item link="/plan_of_care" icon="ti-desktop">
                            Plan of care
                        </vmenu-item>
                        <vmenu-item link="/history_form" icon="ti-desktop">
                            History form
                        </vmenu-item>
                    </vsub-menu>
                    <vsub-menu title="Operation/Surgery" icon="ti-layout">
                        <vmenu-item link="/LabSheet" icon="ti-desktop">
                            Lab sheet
                        </vmenu-item>
                         <vmenu-item link="/codeBlueEvaluationForm" icon="ti-desktop">
                            Code blue evaluation form
                        </vmenu-item>
                        <vmenu-item link="/OperativeDetailSheet" icon="ti-desktop">
                            Operative detail sheet
                        </vmenu-item>
                        <vmenu-item link="/surgicalSafetyChecklist" icon="ti-desktop"> 
                            Surgical safety Checklist
                        </vmenu-item>
                        <vmenu-item link="/pre_anaesthesia_checkup_form" icon="ti-desktop">
                            Pre-Anaesthesia Form
                        </vmenu-item>
                        <vmenu-item link="/briefOperativeNote" icon="ti-desktop">
                            Brief Operative Notes
                        </vmenu-item>
                    </vsub-menu>
                    <vsub-menu title="Daily Ward / General Forms" icon="ti-layout">
                        <vmenu-item link="/bloodSugarMonitoringChart" icon="ti-desktop">
                            Blood-Sugar Monitoring Chart
                        </vmenu-item>
                         <vmenu-item link="doctorsDailyNotes" icon="ti-desktop">
                            Doctor's Daily Notes
                        </vmenu-item>
                        <vmenu-item link="/OperativeDetailSheet" icon="ti-desktop">
                            Operative detail sheet
                        </vmenu-item>
                        <vmenu-item link="/surgicalSafetyChecklist" icon="ti-desktop"> 
                            Surgical safety Checklist
                        </vmenu-item>
                        <vmenu-item link="/pre_anaesthesia_checkup_form" icon="ti-desktop">
                            Pre-Anaesthesia Form
                        </vmenu-item>
                        <vmenu-item link="/briefOperativeNote" icon="ti-desktop">
                            Brief Operative Notes
                        </vmenu-item>
                    </vsub-menu>
                 -->    
                    <!-- <vmenu-item link="/patients_receipt_form" icon="ti-layout">
                        &nbsp; Patients Receipt Form
                    </vmenu-item> -->
                   <!--  <vmenu-item link="/provisional_diagnosis" icon="ti-layout">
                        &nbsp; Provisional Diagnosis Form
                    </vmenu-item> -->

                </vmenu>
                <!-- / .navigation -->
            </div>
            <!-- menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
</template>
<script>
import {
    vmenu,
    vmenuItem,
    vsubMenu
} from './menu';
// import profile from "../left-profile/user_profile.vue"
export default {
    name: "left-side",
    components: {
        vmenu,
        vsubMenu,
        vmenuItem,
        // profile
    },
    data() {
        return {
            'test':'test',
            'userRole': this.$store.state.Users.userDetails.user_type,

        }
    }
}
</script>




<!--
<vsub-menu title="Forms" icon="ti-check-box">
    <vmenu>
    <vsub-menu title="Features" icon="ti-receipt">
        <vmenu-item link="/form-elements" icon="ti-cup">
            Form Elements
        </vmenu-item>
        <vmenu-item link="/realtime_form" icon="ti-write">
            Realtime Form
        </vmenu-item>
        <vmenu-item link="/form-validations" icon="ti-alert">
            Form Validations
        </vmenu-item>
        <vmenu-item link="/form_layouts" icon="ti-layout-width-default">
            Form Layouts
        </vmenu-item>
        <vmenu-item link="/complex_forms" icon="ti-layout-cta-left">
            Complex Forms
        </vmenu-item>
        <vmenu-item link="/radio_check" icon="ti-check-box">
            Radio and Checkbox
        </vmenu-item>
    </vsub-menu>
    <vsub-menu title="Components" icon="ti-clipboard">
        <vmenu-item link="/form_editors" icon="ti-pencil">
            Form Editors
        </vmenu-item>
        <vmenu-item link="/form_wizards" icon="ti-settings">
            Form Wizards
        </vmenu-item>
        <vmenu-item link="/dropdowns" icon="ti-widget-alt">
            Drop Downs
        </vmenu-item>
        <vmenu-item link="/vue_multiselect" icon="ti-widget-alt">
            Vue Multiselect
        </vmenu-item>
        <vmenu-item link="/vue_slider" icon="ti-bell">
            Vue Slider
        </vmenu-item>
        <vmenu-item link="/date_pickers" icon="ti-calendar">
            Date pickers
        </vmenu-item>
        <vmenu-item link="/advanced_date_pickers" icon="ti-notepad">
            Advanced Date pickers
        </vmenu-item>
    </vsub-menu>
</vmenu>
</vsub-menu> -->

