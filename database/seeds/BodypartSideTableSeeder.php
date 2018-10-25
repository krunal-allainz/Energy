<?php

use Illuminate\Database\Seeder;

class BodypartSideTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('bodypart_side')->truncate();


        DB::table('bodypart_side')->insert([
            [
            	'name'=>'Right',
            ],

        ]);
        DB::table('bodypart_side')->insert([
            [
            	'name'=>'Left',
            ],

        ]);
        DB::table('bodypart_side')->insert([
            [
            	'name'=>'Bilateral',
            ],

        ]);
        DB::table('bodypart_side')->insert([
            [
            	'name'=>'AP Lateral Oblique',
            ],

        ]);
        DB::table('bodypart_side')->insert([
            [
            	'name'=>'Others',
            ],

        ]);
        
    }
}
