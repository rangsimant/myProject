<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAnnotationLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('annotation_location', function(Blueprint $table)
		{
			$table->foreign('Map', 'Annotation_Location_Map_FK')->references('idMap')->on('map')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('annotation_location', function(Blueprint $table)
		{
			$table->dropForeign('Map');
		});
	}

}
