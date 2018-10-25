<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ConsultationCategoryDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	//
    	 DB::table('consultation_category_details')->truncate();
    	 /*category_type =1,2,3 suggest that first,followup,emergency respectively*/
        DB::table('consultation_category_details')->insert([
      	[
      		'consultation_category_id'=>1,
            'consultation_type'=>'1',
            'consultation_name'=>'First',
            'charges'=>800,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
  		],
  		[
      		'consultation_category_id'=>1,
            'consultation_type'=>'2',
            'consultation_name'=>'Follow up',
            'charges'=>400,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
  		],
  		[
      		'consultation_category_id'=>1,
            'consultation_type'=>'3',
            'consultation_name'=>'Emergency',
            'charges'=>2000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
  		],
  		[
      		'consultation_category_id'=>2,
            'consultation_type'=>'1',
            'consultation_name'=>'First',
            'charges'=>500,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
  		],
  		[
      		'consultation_category_id'=>2,
            'consultation_type'=>'2',
            'consultation_name'=>'Follow up',
            'charges'=>250,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
  		],
  		[
      		'consultation_category_id'=>2,
            'consultation_type'=>'3',
            'consultation_name'=>'Emergency',
            'charges'=>1000,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
  		]
  		
      	
        ]);
    }
}
