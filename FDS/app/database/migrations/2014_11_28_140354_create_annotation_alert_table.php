<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnnotationAlertTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('annotation_alert', function(Blueprint $table)
		{
			$table->string('idAnnotation-Alert', 16)->primary();
			$table->string('code', 45)->nullable()->index('Code_idx');
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
		Schema::drop('annotation_alert');
	}

}
