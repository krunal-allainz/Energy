<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');
         $this->call(UserTypeTableSeeder::class);
         $this->call(UserTableSeeder::class);
         DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
