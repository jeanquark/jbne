<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TeamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('team')->delete();

        $team_member = array(
            ['id' => 1, 'title' => 'Me', 'firstname' => 'Jane', 'lastname' => 'Doe', 'status' => 'Membre fondateur', 'image_path' => 'images/team/jane-doe-min.jpg', 'email' => '', 'website' => '', 'linkedIn' => '', 'is_published' => true, 'order_of_appearance' => 3, 'created_at' => new DateTime, 'updated_at' => new DateTime]
        );

        DB::table('team')->insert($team_member);
    }
}
