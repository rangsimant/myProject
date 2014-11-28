<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAnnotationActivityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('annotation_activity', function(Blueprint $table)
		{
			$table->foreign('code', 'code')->references('code')->on('annotationlist')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('annotation_activity', function(Blueprint $table)
		{
			$table->dropForeign('code');
		});
	}

}
