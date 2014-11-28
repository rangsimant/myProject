<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnnotationlistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('annotationlist', function(Blueprint $table)
		{
			$table->integer('idAnnotationList');
			$table->string('name', 45)->nullable();
			$table->string('code', 45)->unique('code_UNIQUE');
			$table->string('setname', 45)->nullable();
			$table->primary(['idAnnotationList','code']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('annotationlist');
	}

}
