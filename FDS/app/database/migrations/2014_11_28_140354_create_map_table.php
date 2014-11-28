<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMapTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('map', function(Blueprint $table)
		{
			$table->increments('idMap');
			$table->string('name', 45)->nullable()->unique('name_UNIQUE');
			$table->string('filename', 45)->nullable();
			$table->string('description', 256)->nullable();
			$table->dateTime('createdDate')->nullable();
			$table->string('createdBy', 45)->nullable();
			$table->integer('Location')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('map');
	}

}
