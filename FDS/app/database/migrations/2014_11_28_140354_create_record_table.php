<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecordTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('record', function(Blueprint $table)
		{
			$table->integer('idRecord')->unsigned()->primary();
			$table->string('name', 45)->nullable();
			$table->integer('Device')->unsigned()->nullable()->index('record_Device_idx');
			$table->string('description', 256)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('record');
	}

}
