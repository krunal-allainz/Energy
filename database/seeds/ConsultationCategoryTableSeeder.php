<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ConsultationCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	 DB::table('consultation_category')->truncate();

        DB::table('consultation_category')->insert([
      	[
            'charges_type_id'=>1,
            'name'=>'Super Specialists',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
  		],
  		[
            'charges_type_id'=>1,
            'name'=>'Specialists',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
  		],

        ]);
    }
}
