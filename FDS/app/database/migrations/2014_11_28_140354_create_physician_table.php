<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhysicianTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('physician', function(Blueprint $table)
		{
			$table->integer('idPhysician')->unsigned()->primary();
			$table->string('department', 45)->nullable();
			$table->string('position', 45)->nullable();
			$table->integer('User')->unsigned()->nullable()->index('Physician_User_FK_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('physician');
	}

}
