<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRouterTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('router', function(Blueprint $table)
		{
			$table->increments('idRouter');
			$table->integer('Device')->unsigned()->index('fk_router_device_status_router1');
			$table->integer('Map')->unsigned()->index('Router_Map_FK_idx');
			$table->float('x', 10, 0)->nullable()->default(0);
			$table->float('y', 10, 0)->nullable()->default(0);
			$table->date('dateAssigned')->nullable();
			$table->string('planedDuration', 45)->nullable();
			$table->string('actualDuration', 45)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('router');
	}

}
