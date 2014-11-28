<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePatientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('patient', function(Blueprint $table)
		{
			$table->increments('idPatient');
			$table->string('patient_id', 32)->unique('patient_id_UNIQUE');
			$table->float('height', 10, 0)->unsigned()->nullable();
			$table->float('weight', 10, 0)->unsigned()->nullable();
			$table->boolean('bloodgroup')->nullable();
			$table->boolean('drugallergy')->nullable();
			$table->string('drugallergy_desc')->nullable();
			$table->integer('User')->unsigned()->index('fk_patient_user1');
			$table->string('occupation', 64)->nullable();
			$table->string('employer', 45)->nullable()->index('fk_patient_employer1');
			$table->integer('ContactPerson')->unsigned()->nullable()->index('ContactPerson_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('patient');
	}

}
