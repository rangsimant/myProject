<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnnotationLocationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('annotation_location', function(Blueprint $table)
		{
			$table->string('idAnnotation-Location', 16)->primary();
			$table->integer('Map')->unsigned()->index('Annotation_Location_Map_FK_idx');
			$table->string('location', 45)->nullable();
			$table->dateTime('time')->nullable();
			$table->text('duration')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('annotation_location');
	}

}
