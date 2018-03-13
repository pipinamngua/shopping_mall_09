<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create record for categories
        DB::table('categories')->insert([
            [
                'category_name' => 'Men',
                'user_id' => config('role.admin'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'category_name' => 'Women',
                'user_id' => config('role.admin'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ]);
    }
}
