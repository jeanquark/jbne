<?php

use Illuminate\Database\Seeder;

//use Faker\Factory as Faker;
use Carbon\Carbon;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->delete();

        $permissions = array(
            ['id' => 1, 'name' => 'Create new user', 'slug' => 'create-user', 'description' => 'Créer un nouvel utilisateur', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'name' => 'Edit user', 'slug' => 'edit-user', 'description' => 'Editer un utilisateur', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'name' => 'Delete user', 'slug' => 'delete-user', 'description' => 'Supprimer un utilisateur', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 4, 'name' => 'Create new role', 'slug' => 'create-role', 'description' => 'Créer un nouvel rôle', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 5, 'name' => 'Edit role', 'slug' => 'edit-role', 'description' => 'Editer un rôle', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 6, 'name' => 'Delete role', 'slug' => 'delete-role', 'description' => 'Supprimer un rôle', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 7, 'name' => 'Create new permission', 'slug' => 'create-permission', 'description' => 'Créer une nouvelle permission', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 8, 'name' => 'Edit permission', 'slug' => 'edit-permission', 'description' => 'Editer une permission', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 9, 'name' => 'Delete permission', 'slug' => 'delete-permission', 'description' => 'Supprimer une permission', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 10, 'name' => 'Create new page', 'slug' => 'create-page', 'description' => 'Créer une page', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 11, 'name' => 'Edit page', 'slug' => 'edit-page', 'description' => 'Editer une page', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 12, 'name' => 'Delete page', 'slug' => 'delete-page', 'description' => 'Supprimer une page', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        $permission_roles = array(
            // role_id =>1 User
            // role_id =>2 Editor
            // role_id =>3 Admin
            ['permission_id' => 1, 'role_id' => 3],
            ['permission_id' => 2, 'role_id' => 3],
            ['permission_id' => 3, 'role_id' => 3],
            ['permission_id' => 4, 'role_id' => 3],
            ['permission_id' => 5, 'role_id' => 3],
            ['permission_id' => 6, 'role_id' => 3],
            ['permission_id' => 7, 'role_id' => 3],
            ['permission_id' => 8, 'role_id' => 3],
            ['permission_id' => 9, 'role_id' => 3],
            ['permission_id' => 10, 'role_id' => 3],
            ['permission_id' => 11, 'role_id' => 3],
            ['permission_id' => 12, 'role_id' => 3],

            // editor
            ['permission_id' => 10, 'role_id' => 2],
            ['permission_id' => 11, 'role_id' => 2],
            ['permission_id' => 12, 'role_id' => 2],
        );
 
        //// Uncomment the below to run the seeder
        DB::table('permissions')->insert($permissions);

        DB::table('permission_role')->insert($permission_roles);
    }
}