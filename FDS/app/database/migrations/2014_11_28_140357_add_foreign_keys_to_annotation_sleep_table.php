<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAnnotationSleepTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('annotation_sleep', function(Blueprint $table)
		{
			$table->foreign('code', 'Annotation_Sleep_code_FK')->references('code')->on('annotationlist')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('annotation_sleep', function(Blueprint $table)
		{
			$table->dropForeign('code');
		});
	}

}
