<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create record for admin
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'phone' => '',
                'address' => '',
                'verify_token' => '',
                'status' => config('status.active'),
                'role_id' => config('role.admin'),
                'remember_token' => '',
                'created_at' => new DateTime,
                'updated_at' => new DateTime,
            ],
        ]);

        // Create records for customers
        factory(\App\User::class, 3)->create();
    }
}
