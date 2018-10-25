<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class EmergencyDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	DB::table('emergency_details')->truncate();
    	 /*category_type =1,2,3 suggest that first,followup,emergency respectively*/
        DB::table('emergency_details')->insert([
	      	[
	      		'charges_type_id'=>2,
	            'emergency_type'=>'1',
	            'emergency_name'=>'Day Visit (8 am to 8 pm)',
	            'charges'=>4000,
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	  		],
	  		[
	      		'charges_type_id'=>2,
	            'emergency_type'=>'2',
	            'emergency_name'=>'Night Visit (8 pm to 8 am)',
	            'charges'=>6000,
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	  		]
	  		
  		]);
    }
}
