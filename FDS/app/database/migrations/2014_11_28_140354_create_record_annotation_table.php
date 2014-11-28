<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecordAnnotationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('record_annotation', function(Blueprint $table)
		{
			$table->integer('idRecord-Annotation')->unsigned()->primary();
			$table->integer('Record')->unsigned()->nullable()->index('Record_Annotation_Record_FK_idx');
			$table->string('Annotation', 16)->nullable()->index('Annotation_idx');
			$table->string('annotator', 45)->nullable();
			$table->string('filename', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('record_annotation');
	}

}
