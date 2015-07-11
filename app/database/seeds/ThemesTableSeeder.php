<?php

class ThemesTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('themes')->delete();

        Themes::create(array(
            'theme'             => 'clean',
            'description'       => 'Clean-Blog Theme by StartBootstrap',
            'status'            => 1,
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ));
    }
}