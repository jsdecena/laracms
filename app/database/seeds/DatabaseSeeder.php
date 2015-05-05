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

class PostsTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('posts')->delete();

        Posts::create(array(
            'post_type'     => 'page',
            'title'         => 'Blog',
            'slug'          => 'blog',
            'content'       => 'Lorem ipsum dolor sit amet.',
            'img_src'       => null,
            'post_cat'      => 1,
            'status'        => 0,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ));

        Posts::create(array(
            'post_type'     => 'post',
            'title'         => 'Lorem ipsum dolor sit amet',
            'slug'          => 'lorem-ipsum-dolor-sit-amet',
            'content'       => '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
            'img_src'       => null,
            'post_cat'      => 1,
            'status'        => 1,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ));        
    }
}

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
            'settings_value'    => 'xFinity CMS'
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

class CarouselsTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('carousels')->delete();

        Carousels::create(array(
            'title'          => 'Slide1',
            'description'    => 'Slide 1 description',
            'img_src'        => '',
            'link'           => '',
            'status'         => 0
        ));
    }
}

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

class ThemesTableSeeder extends DatabaseSeeder {

    public function run()
    {
        DB::table('themes')->delete();

        Themes::create(array(
            'theme'             => 'marketing',
            'description'       => 'Marketing Theme',
            'status'            => 1,
            'created_at'        => date('Y-m-d H:i:s'),
            'updated_at'        => date('Y-m-d H:i:s')
        ));
    }
}