<?php

class CategoriesTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('categories')->delete();

        Categories::create(array(
            'name'       	 => 'Uncategorized',
            'slug'			 => 'uncategorized',
            'description'    => 'uncategorized',
            'status'         => 0
        ));
    }
}