<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTypesTableSeeder extends Seeder
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
          ['id' => 1,
          'name' => 'Doctor',
          'status'=>1,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      	  ],

      	  ['id' => 2,
          'name' => 'Nurse',
          'status'=>1,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      	  ],

      	  ['id' => 3,
          'name' => 'Receptionist',
          'status'=>1,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
      	  ],
          ['id' => 4,
          'name' => 'Admin',
          'status'=>1,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ],
          ['id' => 5,
          'name' => 'Others',
          'status'=>1,
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
          ],

        ]);
         
    }
}
