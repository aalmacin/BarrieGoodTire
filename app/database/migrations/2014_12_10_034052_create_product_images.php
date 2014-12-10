<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductImages extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('product_images', function($table)
		{
			$table->increments('id');
			$table->string('original');
			$table->string('path');
			$table->string('thumb');

			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')
			->references('id')
			->on('products')
			->onDelete('cascade');

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
		Schema::drop('product_images');
	}

}
