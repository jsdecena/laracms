<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function($table) {
			$table->increments('id_post', 10);
			$table->string('post_type', 255);
			$table->string('title', 255);
			$table->string('slug', 255);
			$table->text('content');
			$table->string('img_src', 255)->nullable();
			$table->integer('status')->default(1);
			$table->timestamps();
		});

		DB::statement('ALTER TABLE posts ADD FULLTEXT search(title, content)');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('posts', function($table)
		{	
			$table->dropIndex('search');
			$table->drop();
		});
	}

}
