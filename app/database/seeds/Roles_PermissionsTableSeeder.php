<?php

class Roles_PermissionsTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('roles_permissions')->delete();

        Roles_Permissions::create(array(
            'id_role'       => 1,
            'id_permission' => 1
        ));
        Roles_Permissions::create(array(
            'id_role'       => 1,
            'id_permission' => 2
        ));
        Roles_Permissions::create(array(
            'id_role'       => 1,
            'id_permission' => 3
        ));
        Roles_Permissions::create(array(
            'id_role'       => 1,
            'id_permission' => 4
        ));
        Roles_Permissions::create(array(
            'id_role'       => 2,
            'id_permission' => 1
        ));

        Roles_Permissions::create(array(
            'id_role'       => 2,
            'id_permission' => 2
        ));
    }
}