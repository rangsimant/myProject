<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRouterDeviceStatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('router_device_status', function(Blueprint $table)
		{
			$table->foreign('Router', 'Router_Device_Status_Router_FK')->references('idRouter')->on('router')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('Device', 'Router_Device_Status_Device_FK')->references('idDevice')->on('device')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('router_device_status', function(Blueprint $table)
		{
			$table->dropForeign('Router');
			$table->dropForeign('Device');
		});
	}

}
