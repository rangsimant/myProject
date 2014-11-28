<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDeviceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('device', function(Blueprint $table)
		{
			$table->foreign('DeviceType', 'DeviceType')->references('idDeviceType')->on('devicetype')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('device', function(Blueprint $table)
		{
			$table->dropForeign('DeviceType');
		});
	}

}
