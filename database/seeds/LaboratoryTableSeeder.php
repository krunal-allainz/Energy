<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LaboratoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('laboratory')->truncate();

        DB::table('laboratory')->insert([
	        [ 
	        	'name' => 'CBC',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'CBC ESR',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'CRP',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum Electrolytes',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum Creatinine',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'LFT',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'SGOT',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'SGPT',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'GGT',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Alkaline Phosphatase',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'HIV',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'HBeAg',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'HCV',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'RBS',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'FBS',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'PP2 BS',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Pre operative OT package',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Pre Cath Package',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'PT',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'a PTT',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'INR',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Clotting Time / Bleeding Time',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'RA Factor',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Uric Acid',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Anti CCP autobodies',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'ANA',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'ANA Profile',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Anti DNA',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Thyriod Profile',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum Free T3',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum Free T4',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum TSH',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum Cortisol (Evening)',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum Cortisol (Morning andEvening)',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum Cortisol (Morning)',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum ACTH',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum IGF-1',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum Prolactin',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum Testosterone',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum Ketones',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Serum Ammonia',
	        	'type' => '1',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Routine',
	        	'type' => '2',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Microscopy',
	        	'type' => '2',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Routine',
	        	'type' => '3',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Microscopy',
	        	'type' => '3',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Other',
	        	'type' => '3',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	],
	      	[ 
	        	'name' => 'Culture / Sensitivity',
	        	'type' => '1,2,3,4',
	          	'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
	      	]
	      	
	      	


	    ]);
    }
}
