<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->truncate();


        DB::table('users')->insert([
            [
            	'first_name'=>'Admin',
	            'password'=>Hash::make(trim('password')),
	            'department'=>'',
	            'user_type'=>1,
	            'mobile_no'=>'1234567890',
	            'address'=>'Vadodara',
	            'user_image'=>NULL,
	            'token'=>'',
	            'is_verified'=>'1',
	            'timezone'=>NULL,
	            'last_login_time'=>NULL,
	            'is_active'=>'1',
	            'last_active_time'=>NULL,
	            'is_mobile_user'=>1,
	            'deleted_at'=>NULL,
	            'last_name'=>'admin',
	            'email'=>'admin1@gmail.com',
	            'status'=>'Active',
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	],
        	[
            	'first_name'=>'Buyer1',
	            'password'=>Hash::make(trim('password')),
	            'department'=>'',
	            'user_type'=>2,
	            'mobile_no'=>'1234567890',
	            'address'=>'Vadodara',
	            'user_image'=>NULL,
	            'token'=>'',
	            'is_verified'=>'1',
	            'timezone'=>NULL,
	            'last_login_time'=>NULL,
	            'is_active'=>'1',
	            'last_active_time'=>NULL,
	            'is_mobile_user'=>1,
	            'deleted_at'=>NULL,
	            'last_name'=>'buyer1',
	            'email'=>'buyer1@gmail.com',
	            'status'=>'Active',
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	],
        	[
            	'first_name'=>'Buyer2',
	            'password'=>Hash::make(trim('password')),
	            'department'=>'',
	            'user_type'=>2,
	            'mobile_no'=>'1234567890',
	            'address'=>'Vadodara',
	            'user_image'=>NULL,
	            'token'=>'',
	            'is_verified'=>'1',
	            'timezone'=>NULL,
	            'last_login_time'=>NULL,
	            'is_active'=>'1',
	            'last_active_time'=>NULL,
	            'is_mobile_user'=>1,
	            'deleted_at'=>NULL,
	            'last_name'=>'buyer2',
	            'email'=>'buyer2@gmail.com',
	            'status'=>'Active',
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	],
        	[
            	'first_name'=>'Buyer3',
	            'password'=>Hash::make(trim('password')),
	            'department'=>'',
	            'dagree'=>'',
	            'regno'=>'',
	            'user_type'=>2,
	            'mobile_no'=>'1234567890',
	            'address'=>'Vadodara',
	            'user_image'=>NULL,
	            'token'=>'',
	            'is_verified'=>'1',
	            'timezone'=>NULL,
	            'last_login_time'=>NULL,
	            'is_active'=>'1',
	            'last_active_time'=>NULL,
	            'is_mobile_user'=>1,
	            'deleted_at'=>NULL,
	            'last_name'=>'buyer3',
	            'email'=>'buyer3@gmail.com',
	            'status'=>'Active',
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	],
        	[
            	'first_name'=>'Seller1',
	            'password'=>Hash::make(trim('password')),
	            'department'=>'',
	            'dagree'=>'',
	            'regno'=>'',
	            'user_type'=>3,
	            'mobile_no'=>'1234567890',
	            'address'=>'Vadodara',
	            'user_image'=>NULL,
	            'token'=>'',
	            'is_verified'=>'1',
	            'timezone'=>NULL,
	            'last_login_time'=>NULL,
	            'is_active'=>'1',
	            'last_active_time'=>NULL,
	            'is_mobile_user'=>1,
	            'deleted_at'=>NULL,
	            'last_name'=>'seller1',
	            'email'=>'seller1@gmail.com',
	            'status'=>'Active',
	            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
	          	'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        	],
        	
        ]);
    }
}
