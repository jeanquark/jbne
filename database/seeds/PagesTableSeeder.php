<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->delete();

        $pages = array(
            ['id' => 1, 'name' => 'Présentation', 'slug' => 'presentation', 'content' => 'contenu', 'is_published' => false, 'created_at' => new DateTime, 'updated_at' => new DateTime],
        );

        DB::table('pages')->insert($pages);
    }
}
