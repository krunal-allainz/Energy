<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProvisionalDiagnosistableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('provisional_diagnosis')->truncate();

         DB::table('provisional_diagnosis')->insert([
          ['name' => 'I.C.S.O.L. (Inftra Cranial Space Occupying Lesion)
',
          'category_id' => '2',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Abscess
',
          'category_id' => '3',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Cyst
',
          'category_id' => '2',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Contusion - Hemorrhagic
',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Contusion - Non-Hemorrhagic
',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Diffuse Axonal Injury
',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Diffuse Cerebral Injury
',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'S.A.H. (Sub Arachnoid Hemorrhage)
',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Acute Subdural Hematoma
',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Chronic Subdural Hematoma

',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

             ['name' => 'Sub-acute Subdural Hematoma


',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Depressed Fracture


',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Compund depressed Fracture



',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'C.S.F. Leak




',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


           ['name' => 'C.S.F. Rhinorrhea
',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'C.S.F. Otorrhera

',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


           ['name' => 'C.L.W.

',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Cerebral Concussion


',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Meningitis


',
          'category_id' => '3',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Fracture - Compression
',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


        ['name' => 'Fracture - Dislocation / Subluxation
',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

         ['name' => 'Myelopathy - Compressive
',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

         ['name' => 'Myelopathy - Mon-compressive
',
          'category_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Radiculopathy
',
          'category_id' => '8',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'IDEM (Intra Dural Extra Medullary) SOL
',
          'category_id' => '2',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'IMSOL (Intra Medullary SOL)

',
          'category_id' => '2',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


           ['name' => 'SOL

',
          'category_id' => '2',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'PIVD - Bulging


',
          'category_id' => '1,4',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


           ['name' => 'PIVD - Protruding


',
          'category_id' => '1,4',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'PIVD - Extruded


',
          'category_id' => '1,4',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


          ['name' => 'PIVD - Sequestered
',
          'category_id' => '1,4',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Canal Stenosis

',
          'category_id' => '4',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


           ['name' => 'Lateral Recess Stenosis

',
          'category_id' => '4',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Facetal Arthropathy
',
          'category_id' => '4',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Spondylolisthesis with Lysis


',
          'category_id' => '4,5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Spondylolisthesis - Degenerative



',
          'category_id' => '4,5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


            ['name' => 'Spondylolysis



',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Plexopathy
',
          'category_id' => '3,8',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


           ['name' => 'Neuropathy
',
          'category_id' => '3,8',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Spondylodiscitis

',
          'category_id' => '3',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


            ['name' => 'Osteomyelitis

',
          'category_id' => '3',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Carpal Tunnel Syndrome


',
          'category_id' => '8',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


          ['name' => 'Thoracic Outlet Syndrome
',
          'category_id' => '8',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Hydrocyphalus - Obstructive

',
          'category_id' => '5,2',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Hydrocyphalus - Communicating
',
          'category_id' => '5,3,8',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


            ['name' => 'Craniosynostosis


',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Encephalocele



',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Meningocele
',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


             ['name' => 'Myelocele

',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


             ['name' => 'Chiari Malformation

',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Syringomyelia
',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


           ['name' => 'Tethered Cord Syndrome
',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Spina Bifida Occulta

',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


           ['name' => 'Spina Bifida Occulta

',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Diastematomyelia
',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


           ['name' => 'Diastematomyelia with Septum
',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Kyphoscoliosis
',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Scoliosis - Degenerative
',
          'category_id' => '4',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Scoliosis - Congenital

',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


          ['name' => 'Scoliosis - Congenital - need to change
',
          'category_id' => '6',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Arteio-Venous Malformation

',
          'category_id' => '6',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],


            ['name' => 'Arterio-Vrnous Fistula

',
          'category_id' => '6',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Venous Malformation
',
          'category_id' => '6',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Cavernous Angioma
',
          'category_id' => '6',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

            ['name' => 'Celiosis
',
          'category_id' => '8',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Porencephaly

',
          'category_id' => '5',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),]

          ]);
    }
}
