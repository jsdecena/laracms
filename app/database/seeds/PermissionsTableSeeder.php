<?php

class PermissionsTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('permissions')->delete();

        Permissions::create(array(
            'permission'           => 'Create',
        ));

        Permissions::create(array(
            'permission'           => 'View',
        ));

        Permissions::create(array(
            'permission'           => 'Edit',
        ));

        Permissions::create(array(
            'permission'           => 'Delete',
        ));

        Permissions::create(array(
            'permission'           => 'None',
        ));


    }
}