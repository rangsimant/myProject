<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRecordDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('record_data', function(Blueprint $table)
		{
			$table->integer('idRecord-Data')->primary();
			$table->integer('Record')->unsigned()->nullable()->index('Record_idx');
			$table->string('filename', 45)->nullable();
			$table->integer('numberofChannels')->nullable();
			$table->integer('numberofSamples')->nullable();
			$table->integer('samplingFrequency')->nullable();
			$table->dateTime('startDate')->nullable();
			$table->dateTime('endDate')->nullable();
			$table->string('dataformat', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('record_data');
	}

}
