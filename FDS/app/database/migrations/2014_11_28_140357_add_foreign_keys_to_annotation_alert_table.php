<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAnnotationAlertTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('annotation_alert', function(Blueprint $table)
		{
			$table->foreign('code', 'Annotation_Alert_code_FK')->references('code')->on('annotationlist')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('annotation_alert', function(Blueprint $table)
		{
			$table->dropForeign('code');
		});
	}

}
