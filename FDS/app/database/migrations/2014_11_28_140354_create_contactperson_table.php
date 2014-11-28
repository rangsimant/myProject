<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactpersonTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contactperson', function(Blueprint $table)
		{
			$table->increments('idContactPerson');
			$table->string('name', 45)->nullable();
			$table->string('surname', 45)->nullable();
			$table->string('phone', 45)->nullable();
			$table->string('e-mail', 45)->nullable();
			$table->string('mobile', 45)->nullable();
			$table->string('address', 45)->nullable();
			$table->integer('User')->unsigned()->nullable()->index('ContactPerson_User_FK_idx');
			$table->string('relationship', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contactperson');
	}

}
