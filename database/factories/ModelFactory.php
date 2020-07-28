<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Lawyer::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'lastname' => $faker->lastName,
        'firstname' => $faker->firstName,
        'email' => $faker->safeEmail,
        'username' => $faker->unique()->userName,
        'password' => $password ?: $password = bcrypt('secret'),
        'phone_mobile' => $faker->e164PhoneNumber,
        // 'street' => $faker->streetAddress,
        // 'city' => $faker->city,
        // 'phone_office' => $faker->e164PhoneNumber,
        // 'fax_office' => $faker->e164PhoneNumber,
        'lawyer_office_id' => $faker->numberBetween($min = 1, $max = 10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\LawyerOffice::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->company,
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'phone_office' => $faker->e164PhoneNumber,
        'fax_office' => $faker->e164PhoneNumber,
    ];
});

for ($i = 1; $i <= 12; $i++) {
    $factory->define(App\Permanence::class, function (Faker\Generator $faker) {
        $i = $i+1;
        return [
            // 'week1' => $faker->randomElement(0,1),
            'lawyer_id' => $i,
            'year' => 2018,
            'quarter' => 2,
            'month' => 4,
            'week1' => $faker->boolean($chanceOfGettingTrue = 50),
            'week1_nb' => 14,
            'week2' => $faker->boolean($chanceOfGettingTrue = 50),
            'week2_nb' => 15,
            'week3' => $faker->boolean($chanceOfGettingTrue = 50),
            'week3_nb' => 16,
            'week4' => $faker->boolean($chanceOfGettingTrue = 50),
            'week4_nb' => 17,
            'week5' => $faker->boolean($chanceOfGettingTrue = 50),
            'week5_nb' => 18,
        ];
    });
};