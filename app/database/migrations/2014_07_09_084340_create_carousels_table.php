<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarouselsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('carousels', function($table) {
			$table->increments('id_carousel');
			$table->string('title', 128);
			$table->text('description')->nullable();
			$table->string('img_src', 128)->nullable();
			$table->string('link', 128);
			$table->string('status', 1);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('carousels');
	}

}
