<?php

use Illuminate\Database\Seeder;

class BodypartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bodyparts')->truncate();


        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>1,
            	'name'=>'HIP',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>1,
            	'name'=>'Knee',
            ],

        ]);
         DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>1,
            	'name'=>'Shoulder',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>1,
            	'name'=>'Pelvis',
            ],

        ]);
       	DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>1,
            	'name'=>'Chest PA',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>1,
            	'name'=>'Cervical Spine',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>1,
            	'name'=>'Dorsal Spine',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>1,
            	'name'=>'Lumbar Spine',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>1,
            	'name'=>'Other',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>2,
            	'name'=>'Brain (Plain)',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>2,
            	'name'=>'Brain (Plain & Contrast)',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>2,
            	'name'=>'Neck',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>2,
            	'name'=>'Chest',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>2,
            	'name'=>'Upper Abdomen',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>2,
            	'name'=>'Pelvis',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>2,
            	'name'=>'Whole Abdomen',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>2,
            	'name'=>'CT Angiography',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>2,
            	'name'=>'Guided Procedure:Biopsy',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>2,
            	'name'=>'Other',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>3,
            	'name'=>'Brain',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>3,
            	'name'=>'Spine',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>3,
            	'name'=>'Joint',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>3,
            	'name'=>'Cranial Nerne',
            ],

        ]);
        DB::table('bodyparts')->insert([
            [
            	'radiology_id'=>3,
            	'name'=>'Other',
            ],

        ]);
        

        
    }
}
