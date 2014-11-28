<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('username', 64)->unique('username_UNIQUE');
			$table->string('password', 256);
			$table->string('email', 256)->nullable();
			$table->string('confirmation_code', 256)->nullable();
			$table->string('remember_token', 256)->nullable();
			$table->boolean('confirmed')->nullable();
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
		Schema::drop('users');
	}

}
