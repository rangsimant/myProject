<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDevicePatientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('device_patient', function(Blueprint $table)
		{
			$table->foreign('Patient', 'Device_Patient_Patient_FK')->references('idPatient')->on('patient')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('Device', 'Device_Patient_Device_FK')->references('idDevice')->on('device')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('device_patient', function(Blueprint $table)
		{
			$table->dropForeign('Patient');
			$table->dropForeign('Device');
		});
	}

}
