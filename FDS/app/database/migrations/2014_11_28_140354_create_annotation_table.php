<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnnotationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('annotation', function(Blueprint $table)
		{
			$table->string('idAnnotation', 16)->primary();
			$table->string('activity', 45)->nullable()->index('activity_idx');
			$table->integer('Map')->unsigned()->nullable()->index('Map_idx');
			$table->string('location', 45)->nullable();
			$table->dateTime('time');
			$table->text('duration')->nullable();
			$table->string('alert', 45)->nullable()->index('alert_idx');
			$table->integer('priority')->nullable();
			$table->string('image_snapshot', 45)->nullable();
			$table->string('sleep', 45)->nullable()->index('sleep_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('annotation');
	}

}
