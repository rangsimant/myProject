<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAnnotationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('annotation', function(Blueprint $table)
		{
			$table->foreign('activity', 'activity')->references('code')->on('annotationlist')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('Map', 'Map')->references('idMap')->on('map')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('alert', 'alert')->references('code')->on('annotationlist')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('sleep', 'sleep')->references('code')->on('annotationlist')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('annotation', function(Blueprint $table)
		{
			$table->dropForeign('activity');
			$table->dropForeign('Map');
			$table->dropForeign('alert');
			$table->dropForeign('sleep');
		});
	}

}
