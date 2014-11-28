<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatabaseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('database', function(Blueprint $table)
		{
			$table->increments('idDatabase');
			$table->string('name', 45)->nullable();
			$table->integer('Patient')->unsigned()->nullable()->index('database_Patient_idx');
			$table->integer('Record')->unsigned()->nullable()->index('database_Record_idx');
			$table->integer('AnnotationList')->index('database_AnnotationList_idx');
			$table->string('description', 256)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('database');
	}

}
