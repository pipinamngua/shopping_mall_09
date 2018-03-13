<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(\App\Model\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => str_replace(' ', '', strtolower($faker->name)) . '@gmail.com',
        'password' => bcrypt('123456'),
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'verify_token' => str_random(10),
        'status' => config('status.active'),
        'role_id' => config('role.customer'),
        'remember_token' => str_random(10),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
