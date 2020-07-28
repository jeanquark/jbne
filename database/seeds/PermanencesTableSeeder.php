<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;
use Faker\Factory as Faker;

class PermanencesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('permanences')->delete();
        $year = 2020;
        for ($i = 1; $i <= 60; $i++) { // for each lawyer
            $permanences = array(
                ['lawyer_id' => $i, 'year' => $year, 'quarter' => 1, 'month' => 1, 'week1_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week1_nb' => 1, 'week2_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week2_nb' => 2, 'week3_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week3_nb' => 3, 'week4_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week4_nb' => 4, 'week5_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week5_nb' => 5, 'created_at' => new DateTime, 'updated_at' => new DateTime],

                ['lawyer_id' => $i, 'year' => $year, 'quarter' => 1, 'month' => 2, 'week1_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week1_nb' => 6, 'week2_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week2_nb' => 7, 'week3_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week3_nb' => 8, 'week4_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week4_nb' => 9, 'week5_dispo' => null, 'week5_nb' => null, 'created_at' => new DateTime, 'updated_at' => new DateTime],

                ['lawyer_id' => $i, 'year' => $year, 'quarter' => 1, 'month' => 3, 'week1_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week1_nb' => 10, 'week2_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week2_nb' => 11, 'week3_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week3_nb' => 12, 'week4_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week4_nb' => 13, 'week5_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week5_nb' => 14, 'created_at' => new DateTime, 'updated_at' => new DateTime],

                ['lawyer_id' => $i, 'year' => $year, 'quarter' => 2, 'month' => 4, 'week1_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week1_nb' => 15, 'week2_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week2_nb' => 16, 'week3_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week3_nb' => 17, 'week4_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week4_nb' => 18, 'week5_dispo' => null, 'week5_nb' => null, 'created_at' => new DateTime, 'updated_at' => new DateTime],
                ['lawyer_id' => $i, 'year' => $year, 'quarter' => 2, 'month' => 5, 'week1_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week1_nb' => 19, 'week2_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week2_nb' => 20, 'week3_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week3_nb' => 21, 'week4_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week4_nb' => 22, 'week5_dispo' => null, 'week5_nb' => null, 'created_at' => new DateTime, 'updated_at' => new DateTime],
                ['lawyer_id' => $i, 'year' => $year, 'quarter' => 2, 'month' => 6, 'week1_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week1_nb' => 23, 'week2_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week2_nb' => 24, 'week3_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week3_nb' => 25, 'week4_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week4_nb' => 26, 'week5_dispo' => null, 'week5_nb' => null, 'created_at' => new DateTime, 'updated_at' => new DateTime],
                ['lawyer_id' => $i, 'year' => $year, 'quarter' => 3, 'month' => 7, 'week1_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week1_nb' => 27, 'week2_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week2_nb' => 28, 'week3_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week3_nb' => 29, 'week4_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week4_nb' => 30, 'week5_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week5_nb' => 31, 'created_at' => new DateTime, 'updated_at' => new DateTime],
                ['lawyer_id' => $i, 'year' => $year, 'quarter' => 3, 'month' => 8, 'week1_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week1_nb' => 32, 'week2_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week2_nb' => 33, 'week3_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week3_nb' => 34, 'week4_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week4_nb' => 35, 'week5_dispo' => null, 'week5_nb' => null, 'created_at' => new DateTime, 'updated_at' => new DateTime],
                ['lawyer_id' => $i, 'year' => $year, 'quarter' => 3, 'month' => 9, 'week1_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week1_nb' => 36, 'week2_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week2_nb' => 37, 'week3_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week3_nb' => 38, 'week4_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week4_nb' => 39, 'week5_dispo' => null, 'week5_nb' => null, 'created_at' => new DateTime, 'updated_at' => new DateTime],
                ['lawyer_id' => $i, 'year' => $year, 'quarter' => 4, 'month' => 10, 'week1_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week1_nb' => 40, 'week2_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week2_nb' => 41, 'week3_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week3_nb' => 42, 'week4_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week4_nb' => 43, 'week5_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week5_nb' => 44, 'created_at' => new DateTime, 'updated_at' => new DateTime],
                ['lawyer_id' => $i, 'year' => $year, 'quarter' => 4, 'month' => 11, 'week1_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week1_nb' => 45, 'week2_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week2_nb' => 46, 'week3_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week3_nb' => 47, 'week4_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week4_nb' => 48, 'week5_dispo' => null, 'week5_nb' => null, 'created_at' => new DateTime, 'updated_at' => new DateTime],
                ['lawyer_id' => $i, 'year' => $year, 'quarter' => 4, 'month' => 12, 'week1_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week1_nb' => 49, 'week2_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week2_nb' => 50, 'week3_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week3_nb' => 51, 'week4_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week4_nb' => 52, 'week5_dispo' => $faker->boolean($chanceOfGettingTrue = 50), 'week5_nb' => 53, 'created_at' => new DateTime, 'updated_at' => new DateTime],
            );
            DB::table('permanences')->insert($permanences);
        }
    }
}
