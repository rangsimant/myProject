<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDatabaseTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('database', function(Blueprint $table)
		{
			$table->foreign('Patient', 'Patient')->references('idPatient')->on('patient')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('Record', 'Record')->references('idRecord')->on('record')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('AnnotationList', 'AnnotationList ')->references('idAnnotationList')->on('annotationlist')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('database', function(Blueprint $table)
		{
			$table->dropForeign('Patient');
			$table->dropForeign('Record');
			$table->dropForeign('AnnotationList');
		});
	}

}
