<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhysicianPatientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('physician_patient', function(Blueprint $table)
		{
			$table->integer('idPhysician-Patient')->unsigned()->primary();
			$table->integer('Patient')->unsigned()->index('Patient_idx');
			$table->integer('Physician')->unsigned()->nullable()->index('Physician_idx');
			$table->date('startDate')->nullable();
			$table->date('endDate')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('physician_patient');
	}

}
