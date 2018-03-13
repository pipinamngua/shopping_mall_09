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

$factory->define(\App\Model\Product::class, function (Faker $faker) {
    return [
        'product_name' => 'Product' . ' ' . uniqid(),
        'image_path' => $faker->imageUrl($width = 640, $height = 480),
        'rate_point' => 0,
        'popular_level' => 0,
        'original_price' => 100,
        'status' => config('status.in_stock'),
        'user_id' => config('role.admin'),
        'category_id' => rand(1, 2),
        'created_at' => new DateTime,
        'updated_at' => new DateTime,
    ];
});
