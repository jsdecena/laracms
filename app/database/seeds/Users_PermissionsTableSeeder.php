<?php

class Users_PermissionsTableSeeder extends DatabaseSeeder {
    
    public function run()
    {
        DB::table('users_permissions')->delete();

        Users_Permissions::create(array(
            'id_user'       => 1, 
            'id_permission' => 1   
        ));

        Users_Permissions::create(array(
            'id_user'       => 1, 
            'id_permission' => 2   
        ));

        Users_Permissions::create(array(
            'id_user'       => 1, 
            'id_permission' => 3   
        ));

        Users_Permissions::create(array(
            'id_user'       => 1, 
            'id_permission' => 4   
        ));
    }
}