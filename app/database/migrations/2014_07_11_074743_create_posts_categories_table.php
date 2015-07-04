<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsCategoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts_categories', function($table){
			$table->increments('id_post_category');
			$table->integer('id_post')->unsigned();
			$table->foreign('id_post')->references('id_post')->on('posts');
			$table->integer('id_category')->unsigned();
			$table->foreign('id_category')->references('id_category')->on('categories');
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
		Schema::drop('posts_categories');
	}

}
