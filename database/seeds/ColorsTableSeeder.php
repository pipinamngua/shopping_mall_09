<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create record for colors
        DB::table('colors')->insert([
            [
                'color_name' => 'Black',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'color_name' => 'White',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'color_name' => 'Red',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'color_name' => 'Yellow',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'color_name' => 'Green',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ]);
    }
}
