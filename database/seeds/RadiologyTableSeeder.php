 <?php

use Illuminate\Database\Seeder;

class RadiologyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('radiology')->truncate();
        DB::table('radiology')->insert([
	        [
	        	'name'=>'X-Rays'
	        ]
        ]);
        DB::table('radiology')->insert([
	        [
	        	'name'=>'CT'
	        ]
        ]);
        DB::table('radiology')->insert([
	        [
	        	'name'=>'MRI'
	        ]
        ]);
        DB::table('radiology')->insert([
	        [
	        	'name'=>'Ultra Sound'
	        ]
        ]);
        DB::table('radiology')->insert([
	        [
	        	'name'=>'Doppler'
	        ]
        ]);
        DB::table('radiology')->insert([
	        [
	        	'name'=>'Echo Cardiography'
	        ]
        ]);
        DB::table('radiology')->insert([
	        [
	        	'name'=>'PET-CT'
	        ]
        ]);
        DB::table('radiology')->insert([
	        [
	        	'name'=>'Bone Densitometry (DXA)'
	        ]
        ]);
        DB::table('radiology')->insert([
	        [
	        	'name'=>'Other'
	        ]
        ]);
        

    }
}
