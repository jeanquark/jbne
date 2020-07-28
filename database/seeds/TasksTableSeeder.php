<?php

use Illuminate\Database\Seeder;

//use Faker\Factory as Faker;
use Carbon\Carbon;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tasks')->delete();

        $tasks = array(
            ['id' => 1, 'status_id' => 1, 'name' => 'Site web', 'description' => 'Construire le site web', 'progress' => 50, 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        $task_member = array(
            ['id' => 1, 'task_id' => 1, 'member_id' => 1]
        );

        DB::table('task_member')->insert($task_member);

        DB::table('tasks')->insert($tasks);
    }
}
