<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRouterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('router', function(Blueprint $table)
		{
			$table->foreign('Device', 'Router_Device_FK')->references('idDevice')->on('device')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('Map', 'Router_Map_FK')->references('idMap')->on('map')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('router', function(Blueprint $table)
		{
			$table->dropForeign('Device');
			$table->dropForeign('Map');
		});
	}

}
