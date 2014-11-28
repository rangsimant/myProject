<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDevicePatientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('device_patient', function(Blueprint $table)
		{
			$table->integer('idDevice-Patient')->unsigned()->primary();
			$table->integer('Patient')->unsigned()->index('Device_Patient_Patient_FK_idx');
			$table->integer('Device')->unsigned()->index('Device_idx');
			$table->string('placement', 45)->nullable();
			$table->dateTime('actualDateAssigned')->nullable();
			$table->string('actualDuration', 45)->nullable();
			$table->string('planDuration', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('device_patient');
	}

}
