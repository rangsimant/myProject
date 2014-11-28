<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersProfileTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users_profile', function(Blueprint $table)
		{
			$table->integer('idUser_Profile', true);
			$table->integer('user_id')->unsigned()->index('User_Profile_User_FK_idx');
			$table->string('citizen_id', 32)->default('0000000000000');
			$table->boolean('title');
			$table->string('custom_title', 64)->nullable();
			$table->string('first_name', 32);
			$table->string('middle_name', 32)->nullable();
			$table->string('last_name', 32);
			$table->boolean('gender')->nullable();
			$table->date('dateofbirth')->nullable();
			$table->boolean('maritalstatus')->nullable();
			$table->string('nationality', 32)->nullable();
			$table->string('race', 32)->nullable();
			$table->string('religion', 32)->nullable();
			$table->string('language_spoken', 32)->nullable();
			$table->string('father_name', 64)->nullable();
			$table->string('mother_name', 64)->nullable();
			$table->string('spouse_name', 64)->nullable();
			$table->string('address', 256)->nullable();
			$table->string('road', 64)->nullable();
			$table->string('distict', 64)->nullable();
			$table->string('provice', 64)->nullable();
			$table->string('postcode', 32)->nullable();
			$table->string('telephone', 32)->nullable();
			$table->string('mobilephone', 32)->nullable();
			$table->string('fax', 32)->nullable();
			$table->string('photo', 256)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users_profile');
	}

}
