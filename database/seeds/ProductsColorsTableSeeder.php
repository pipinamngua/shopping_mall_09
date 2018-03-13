<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create records for products
        // factory(\App\Model\ProductColor::class, 3)->create();
        DB::table('products_colors')->insert([
            [
                'product_id' => rand(1, 3),
                'color_id' => rand(1, 5),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'product_id' => rand(1, 3),
                'color_id' => rand(1, 5),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'product_id' => rand(1, 3),
                'color_id' => rand(1, 5),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ]);
    }
}
