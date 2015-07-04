<?php

class CategoriesTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('categories')->delete();

        Categories::create(array(
            'category'       => 'Uncategorized',
            'description'    => 'uncategorized',
            'status'         => 0
        ));
    }
}