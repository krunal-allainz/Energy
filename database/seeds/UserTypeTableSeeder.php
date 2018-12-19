<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;	

class UserTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('user_types')->truncate();

        DB::table('user_types')->insert([
			
			[
				'name' => 'Admin',
				'status' => 1,
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				'name' => 'Buyer',
				'status' => 1,
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			],
			[
				'name' => 'Seller',
				'status' => 1,
				'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          		'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
			]
		]);

    }
}
