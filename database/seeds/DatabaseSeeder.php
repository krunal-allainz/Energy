<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');
         $this->call(UsersTableSeeder::class);
         $this->call(appointmentBookSeeder::class);
         $this->call(codeBlueEvaluationFormSeeder::class);
         $this->call(doctorsDailyNotesSeeder::class);
         $this->call(formsSeeder::class);
         $this->call(ipdDetailsSeeder::class);
         $this->call(nutritionalScreeningSeeder::class);
         $this->call(opdDetailsSeeder::class);
         $this->call(patientDetailsSeeder::class);
         $this->call(rolesSeeder::class);
         $this->call(roleUserSeeder::class);
         $this->call(DiagnosisCategoryTableSeeder::class);
         $this->call(ProvisionalDiagnosistableSeeder::class);
         $this->call(PrescriptionDrugsTableSeeder::class);
         $this->call(ConsultationCategoryTableSeeder::class);
         $this->call(ConsultationCategoryDetailsTableSeeder::class);
         $this->call(ChargesTypeTableSeeder::class);
         $this->call(EmergencyDetailsTableSeeder::class);
         $this->call(LaboratoryTableSeeder::class);
         $this->call(UserTypesTableSeeder::class);
         $this->call(RadiologyTableSeeder::class);
         $this->call(BodypartsTableSeeder::class);
         $this->call(QualifiersTableSeeder::class);
         $this->call(SpecialRequestTableSeeder::class);
         $this->call(SpineTableSeeder::class);
         $this->call(BodypartSideTableSeeder::class);
         DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
