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
					'tel' => '0123456789',
					'address' => 'Unknow'

					),
				array(
					'user_id' => '2',
					'first_name' => 'Normal User',
					'last_name' => 'Normal',
					'tel' => '0987654321',
					'address' => 'Unknow'

					)
			);
		DB::table('users_profile')->insert( $users_profile );
	}

}