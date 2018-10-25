<?php

use Illuminate\Database\Seeder;

class SpecialRequestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('special_request')->truncate();

        DB::table('special_request')->insert([
            [
            	'radiology_id'=>3,
	            'name'=>'Neck Angio'
	        ],

        ]);
         DB::table('special_request')->insert([
            [
            	'radiology_id'=>3,
	            'name'=>'Brain Angio'
	        ],

        ]);
         DB::table('special_request')->insert([
            [
            	'radiology_id'=>3,
	            'name'=>'Spectroscopy'
	        ],

        ]);
         DB::table('special_request')->insert([
            [
            	'radiology_id'=>3,
	            'name'=>'Diffusion'
	        ],

        ]);
         DB::table('special_request')->insert([
            [
            	'radiology_id'=>3,
	            'name'=>'Flexion'
	        ],

        ]);
         DB::table('special_request')->insert([
            [
            	'radiology_id'=>3,
	            'name'=>'Extension'
	        ],

        ]);
        
    }
}
