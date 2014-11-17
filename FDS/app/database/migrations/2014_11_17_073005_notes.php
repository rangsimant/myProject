<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Notes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// 
		Schema::create('notes', function($table)
		{
			$table->increments('id')->unsigned();
			$table->integer('user_id')->unsigned()->index();
			$table->integer('author_id')->unsigned()->index();
			$table->text('notes');
			$table->timestamps();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::drop('notes');
	}

}
