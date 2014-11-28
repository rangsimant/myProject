<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersProfile extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Creates users_profile table
		Schema::create('users_profile', function($table)
		{
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned()->index();
			$table->string('first_name');
			$table->string('last_name');
			$table->string('tel');
			$table->string('address');
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('users_profile');
	}

}
