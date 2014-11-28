<?php

class UsersProfileTableSeeder extends Seeder {

	public function run()
	{
		DB::table('users_profile')->delete();

		$users_profile = array(
				array(
					'user_id' => '1',
					'first_name' => 'Adminstrator',
					'last_name' => 'Admin',
					'mobilephone' => '0123456789',
					'address' => 'Unknow',
					'created_at' => '2014/10/20 12:12:12',
					'updated_at' => '2014/10/20 12:12:12'


					),
				array(
					'user_id' => '2',
					'first_name' => 'Normal User',
					'last_name' => 'Normal',
					'mobilephone' => '0987654321',
					'address' => 'Unknow',
					'created_at' => '2014/11/20 12:12:12',
					'updated_at' => '2014/11/20 12:12:12'

					)
			);
		DB::table('users_profile')->insert( $users_profile );
	}

}