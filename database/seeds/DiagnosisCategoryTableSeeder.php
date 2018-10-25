<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DiagnosisCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         DB::table('diagnosis_category_list')->truncate();

         DB::table('diagnosis_category_list')->insert([
          ['name' => 'Etio-Pathology',
          'parent_id' => '0',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Trauma',
          'parent_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Tumors',
          'parent_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Infection',
          'parent_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Degenerative',
          'parent_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

           ['name' => 'Congenital',
          'parent_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Vascular',
          'parent_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Genetic',
          'parent_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

          ['name' => 'Others',
          'parent_id' => '1',
          'status' => '1',
          'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
          'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),],

        ]);
    }
}
