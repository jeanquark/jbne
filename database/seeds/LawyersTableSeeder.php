<?php

use Illuminate\Database\Seeder;

//use Faker\Factory as Faker;
use Carbon\Carbon;

class LawyersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lawyers')->delete();

        // factory(App\Lawyer::class, 20)->create();
        factory(App\Lawyer::class, 60)->create();
    }
}
