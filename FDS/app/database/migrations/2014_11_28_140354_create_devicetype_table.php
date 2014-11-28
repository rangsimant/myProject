<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDevicetypeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('devicetype', function(Blueprint $table)
		{
			$table->integer('idDeviceType')->unsigned()->primary();
			$table->string('name', 45)->nullable();
			$table->integer('numberOfChannels')->nullable();
			$table->string('channelInfo', 45)->nullable();
			$table->string('description', 256)->nullable();
			$table->string('manufacturer', 45)->nullable();
			$table->string('type', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('devicetype');
	}

}
