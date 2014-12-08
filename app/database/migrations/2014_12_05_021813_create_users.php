<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsers extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the users table
		Schema::create('users', function($table) {
			$table->increments('id');
			$table->string('name');
			$table->string('username', 32);
			$table->string('password', 64);
			$table->enum('role', array('admin', 'accounting', 'reader'));
			$table->string('remember_token', 100)->nullable();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Drop the users table
		Schema::drop('users');
	}

}
