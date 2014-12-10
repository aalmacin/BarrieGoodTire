<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducts extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function($table) {
			$table->increments('id');
			$table->decimal('price');
			$table->decimal('original_price');
			$table->string('image')->nullable();
			$table->integer('quantity');

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('rims', function($table) {
			$table->increments('id');
			$table->string('material');
			$table->string('size');
			$table->string('bolt_pattern');

			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')
			->references('id')
			->on('products')
			->onDelete('cascade');

			$table->timestamps();
			$table->softDeletes();
		});

		Schema::create('tires', function($table) {
			$table->increments('id');
			$table->string('brand_name');
			$table->text('description');
			$table->string('size');
			$table->string('model');

			$table->integer('product_id')->unsigned();
			$table->foreign('product_id')
				->references('id')
				->on('products')
				->onDelete('cascade');

			$table->integer('rim_id')->unsigned()->nullable();
			$table->foreign('rim_id')
				->references('id')
				->on('rims')
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
		Schema::drop('tires');
		Schema::drop('rims');
		Schema::drop('products');
	}

}
