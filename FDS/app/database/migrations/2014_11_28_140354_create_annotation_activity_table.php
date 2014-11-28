<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnnotationActivityTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('annotation_activity', function(Blueprint $table)
		{
			$table->string('idAnnotation-Activity', 16)->primary();
			$table->string('code', 45)->nullable()->index('annotation_activity_Code_idx');
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
		Schema::drop('annotation_activity');
	}

}
