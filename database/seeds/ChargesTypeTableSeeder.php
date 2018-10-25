<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ChargesTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        
        DB::table('charges_type')->truncate();

        DB::table('charges_type')->insert([
      	[
            'name'=>'Consultation Charges',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
  		],
  		[
            'name'=>'Emergency Charges',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
  		],

        ]);
    }
}
