<?php

use Illuminate\Database\Seeder;

//use Faker\Factory as Faker;
use Carbon\Carbon;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->delete();

        $roles = array(
            ['id' => 1, 'name' => 'User', 'slug' => 'user', 'description' => 'Utilisateur du site (privilèges minimums)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'name' => 'Editor', 'slug' => 'editor', 'description' => 'Editeur du site (privilèges limités)', 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 3, 'name' => 'Admin', 'slug' => 'admin', 'description' => 'Administrateur du site (tous les privilèges)', 'created_at' => new DateTime, 'updated_at' => new DateTime]
        );

        $role_member = array(
            ['member_id' => 1, 'role_id' => 3],
            ['member_id' => 2, 'role_id' => 3]
        );
 
        //// Uncomment the below to run the seeder
        DB::table('roles')->insert($roles);

        DB::table('role_member')->insert($role_member);
    }
}