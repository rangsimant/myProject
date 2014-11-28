<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPatientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('patient', function(Blueprint $table)
		{
			$table->foreign('User', 'Patient_User_FK')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('ContactPerson', 'ContactPerson')->references('User')->on('contactperson')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('patient', function(Blueprint $table)
		{
			$table->dropForeign('User');
			$table->dropForeign('ContactPerson');
		});
	}

}
