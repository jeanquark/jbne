<?php

use Illuminate\Database\Seeder;

//use Faker\Factory as Faker;
use Carbon\Carbon;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('members')->delete();

        $members = array(
            ['id' => 1, 'firstname' => 'John', 'lastname' => 'Doe', 'email' => 'john.doe@example.com', 'password' => bcrypt('secret'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
            ['id' => 2, 'firstname' => 'Jane', 'lastname' => 'Doe', 'email' => 'jane.doe@example.com', 'password' => bcrypt('secret'), 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        DB::table('members')->insert($members);
    }
}
