<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToRecordDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('record_data', function(Blueprint $table)
		{
			$table->foreign('Record', 'Record_Data_Record_FK')->references('idRecord')->on('record')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('record_data', function(Blueprint $table)
		{
			$table->dropForeign('Record');
		});
	}

}
