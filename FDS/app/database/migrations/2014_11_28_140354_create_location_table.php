<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('location', function(Blueprint $table)
		{
			$table->integer('idLocation')->unsigned()->primary();
			$table->string('name', 45)->nullable();
			$table->string('floor', 45)->nullable();
			$table->string('room', 45)->nullable();
			$table->string('description', 256)->nullable();
			$table->string('address', 256)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('location');
	}

}
