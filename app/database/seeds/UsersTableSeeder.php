<?php

class UsersTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
            'firstname'     => 'John',
            'lastname'      => 'Doe',
            'email'         => 'admin@admin.com',
            'password'      => Hash::make('Testing123'),
            'status'        => 1,
            'id_role'       => 1,
            'password_reset'=> Hash::make('123Testing'),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ));
    }
}