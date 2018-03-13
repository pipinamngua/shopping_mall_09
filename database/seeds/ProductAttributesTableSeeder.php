<?php

use Illuminate\Database\Seeder;

class ProductAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create records for product attributes
        factory(\App\Model\ProductAttribute::class, 3)->create();
    }
}
