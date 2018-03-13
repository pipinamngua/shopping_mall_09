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

$factory->define(\App\Model\ProductColor::class, function (Faker $faker) {
    return [
        'product_id' => rand(1, 3),
        'color_id' => rand(1, 5),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
