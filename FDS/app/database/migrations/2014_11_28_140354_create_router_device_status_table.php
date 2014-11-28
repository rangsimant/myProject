<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRouterDeviceStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('router_device_status', function(Blueprint $table)
		{
			$table->integer('idRouter-Device-Status')->primary();
			$table->integer('Router')->unsigned()->nullable()->index('Router_Device_Status_Router_FK_idx');
			$table->integer('Device')->unsigned()->nullable()->index('Router_Device_Status_Device_FK_idx');
			$table->dateTime('update_time')->nullable();
			$table->integer('packet_rate')->nullable();
			$table->float('avg_packet_rate', 10, 0)->nullable();
			$table->string('status', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('router_device_status');
	}

}
