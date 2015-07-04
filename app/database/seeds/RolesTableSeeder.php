<?php

class RolesTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('roles')->delete();

        Roles::create(array(
            'role'           => 'Admin',
            'description'    => 'This role allows you to have full access.',
            'status'         => 1
        ));

        Roles::create(array( 
            'role'           => 'Subscriber',
            'description'    => 'This role create post/pages/categories',
            'status'         => 1
        )); 
    }
}