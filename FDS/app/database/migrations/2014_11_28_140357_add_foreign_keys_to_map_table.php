<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMapTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('map', function(Blueprint $table)
		{
			$table->foreign('idMap', 'Location')->references('idLocation')->on('location')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('map', function(Blueprint $table)
		{
			$table->dropForeign('idMap');
		});
	}

}
