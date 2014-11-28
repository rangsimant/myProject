<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRecordAnnotationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('record_annotation', function(Blueprint $table)
		{
			$table->foreign('Record', 'Record_Annotation_Record_FK')->references('idRecord')->on('record')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('Annotation', 'Annotation')->references('idAnnotation')->on('annotation')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('record_annotation', function(Blueprint $table)
		{
			$table->dropForeign('Record');
			$table->dropForeign('Annotation');
		});
	}

}
