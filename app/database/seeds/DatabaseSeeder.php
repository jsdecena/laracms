<?php

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('UsersTableSeeder');
        $this->call('PostsTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('SettingsTableSeeder');
        $this->call('CarouselsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('Roles_PermissionsTableSeeder');
        $this->call('Users_PermissionsTableSeeder');
        $this->call('ThemesTableSeeder');
    }
}