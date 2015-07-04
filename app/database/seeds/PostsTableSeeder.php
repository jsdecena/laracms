<?php

class PostsTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('posts')->delete();

        Posts::create(array(
            'post_type'     => 'page',
            'title'         => 'Blog',
            'slug'          => 'blog',
            'content'       => 'Lorem ipsum dolor sit amet.',
            'img_src'       => null,
            'status'        => 0,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ));

        Posts::create(array(
            'post_type'     => 'post',
            'title'         => 'Lorem ipsum dolor sit amet',
            'slug'          => 'lorem-ipsum-dolor-sit-amet',
            'content'       => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
            'img_src'       => null,
            'status'        => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ));        
    }
}