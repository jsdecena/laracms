<?php

class SettingsTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('settings')->delete();

        Settings::create(array(
            'settings_name'     => 'POST_IN_PAGE',
            'settings_value'    => 'blog'
        ));

        Settings::create(array(
            'settings_name'     => 'WEBSITE_NAME',
            'settings_value'    => 'Wedding Digest'
        ));

        Settings::create(array(
            'settings_name'     => 'POSTS_PER_PAGE',
            'settings_value'    => '10'
        ));

        Settings::create(array(
            'settings_name'     => 'ORDER_BY',
            'settings_value'    => 'created_at'
        ));

        Settings::create(array(
            'settings_name'     => 'ARRANGE_BY',
            'settings_value'    => 'DESC'
        ));                                
    }
}