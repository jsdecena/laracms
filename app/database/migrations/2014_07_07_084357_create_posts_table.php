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
			$table->increments('id_post');
			$table->string('post_type', 128);
			$table->string('title', 128);
			$table->string('slug', 128);
			$table->text('content');
			$table->string('img_src', 256)->nullable();
			$table->string('post_cat', 11);
			$table->string('status', 1);
			$table->timestamps();
			$table->engine = 'MyISAM';
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
