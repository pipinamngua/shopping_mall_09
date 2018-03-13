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

$factory->define(\App\Model\Images::class, function (Faker $faker) {
    return [
        'image_path' => $faker->imageUrl($width = 640, $height = 480),
        'product_color_id' => rand(1, 3),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
