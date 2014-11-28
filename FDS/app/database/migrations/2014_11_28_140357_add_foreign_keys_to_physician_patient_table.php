<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPhysicianPatientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('physician_patient', function(Blueprint $table)
		{
			$table->foreign('Patient', 'Physician_Patient_Patient_FK')->references('idPatient')->on('patient')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('Physician', 'Physician_Patient_Physician_FK')->references('idPhysician')->on('physician')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('physician_patient', function(Blueprint $table)
		{
			$table->dropForeign('Patient');
			$table->dropForeign('Physician');
		});
	}

}
