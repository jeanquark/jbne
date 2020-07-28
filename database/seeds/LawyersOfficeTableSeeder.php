<?php

use Illuminate\Database\Seeder;

//use Faker\Factory as Faker;
use Carbon\Carbon;

class LawyersOfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lawyers_office')->delete();

        factory(App\LawyerOffice::class, 10)->create();
    }
}
