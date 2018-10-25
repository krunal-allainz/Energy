<?php

use Illuminate\Database\Seeder;

class SpineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('spine')->truncate();

        DB::table('spine')->insert([
            [
            	'radiology_id'=>3,
            	'bodyparts_id'=>2,
	            'name'=>'Cervical'
	        ],

        ]);
         DB::table('spine')->insert([
            [
            	'radiology_id'=>3,
            	'bodyparts_id'=>2,
	            'name'=>'Dorsal'
	        ],

        ]);
         DB::table('spine')->insert([
            [
            	'radiology_id'=>3,
            	'bodyparts_id'=>2,
	            'name'=>'Lumbar'
	        ],

        ]);
         DB::table('spine')->insert([
            [
            	'radiology_id'=>3,
            	'bodyparts_id'=>2,
	            'name'=>'Whole spine screening'
	        ],

        ]);
        
    }
}
