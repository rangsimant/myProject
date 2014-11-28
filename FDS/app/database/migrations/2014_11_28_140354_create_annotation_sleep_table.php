<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnnotationSleepTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('annotation_sleep', function(Blueprint $table)
		{
			$table->string('idAnnotation-Activity', 16)->primary();
			$table->string('code', 45)->nullable()->index('annotation_sleepcode_idx');
			$table->dateTime('time')->nullable();
			$table->text('duration')->nullable();
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
		Schema::drop('annotation_sleep');
	}

}
