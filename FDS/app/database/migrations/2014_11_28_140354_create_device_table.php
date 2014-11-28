<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDeviceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('device', function(Blueprint $table)
		{
			$table->integer('idDevice')->unsigned()->primary();
			$table->integer('DeviceType')->unsigned()->nullable()->index('DeviceType_idx');
			$table->date('purchasedDate')->nullable();
			$table->date('dateLastServiced')->nullable();
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
		Schema::drop('device');
	}

}
