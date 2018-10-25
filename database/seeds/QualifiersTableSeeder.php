<?php

use Illuminate\Database\Seeder;

class QualifiersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('qualifiers')->truncate();
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>20,
	            'name'=>'Stroke Protocol'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>20,
	            'name'=>'Epilepsy Protocol'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>20,
	            'name'=>'Headache Protocol'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>20,
	            'name'=>'Tumor Protocol'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>20,
	            'name'=>'Brain (Routine)'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>20,
	            'name'=>'Brain with Head &Neck MR Angiography(MRA)'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>20,
	            'name'=>'Brain with IntracranialMRA/MR Venography'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>20,
	            'name'=>'Brain MR Spectroscopy alone'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>20,
	            'name'=>'Brain Tumour Protocol'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>20,
	            'name'=>'Other'
        	],

        ]);

       DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>22,
	            'name'=>'Stroke Protocol'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>22,
	            'name'=>'Epilepsy Protocol'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>22,
	            'name'=>'Headache Protocol'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>22,
	            'name'=>'Tumor Protocol'
        	],

        ]);
         DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>23,
	            'name'=>'Stroke Protocol'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>23,
	            'name'=>'Epilepsy Protocol'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>23,
	            'name'=>'Headache Protocol'
        	],

        ]);
        DB::table('qualifiers')->insert([
            [
            	'radiology_id'=>3,
	            'bodyparts_id'=>23,
	            'name'=>'Tumor Protocol'
        	],

        ]);

        DB::table('qualifiers')->insert([
            [
                'radiology_id'=>3,
                'bodyparts_id'=>24,
                'name'=>'Stroke Protocol'
            ],

        ]);
        DB::table('qualifiers')->insert([
            [
                'radiology_id'=>3,
                'bodyparts_id'=>24,
                'name'=>'Epilepsy Protocol'
            ],

        ]);
        DB::table('qualifiers')->insert([
            [
                'radiology_id'=>3,
                'bodyparts_id'=>24,
                'name'=>'Headache Protocol'
            ],

        ]);
        DB::table('qualifiers')->insert([
            [
                'radiology_id'=>3,
                'bodyparts_id'=>24,
                'name'=>'Tumor Protocol'
            ],

        ]);
        
    }
}
