<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create record for sizes
        DB::table('sizes')->insert([
            [
                'size_name' => 'S',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'size_name' => 'M',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'size_name' => 'L',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
            [
                'size_name' => 'XL',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ]);
    }
}
