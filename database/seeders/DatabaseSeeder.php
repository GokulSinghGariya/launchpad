<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'user_type'=>'admin',
            'is_verified'=>'1',
        ]);

        DB::table('users')->insert([
            'name' => 'teacher',
            'email' => 'teacher@gmail.com',
            'password' => Hash::make('password'),
            'user_type'=>'teacher',
            'is_verified'=>'1',
        ]);
        DB::table('users')->insert([
            'name' => 'student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('password'),
            'user_type'=>'student',
            'is_verified'=>'1',
        ]);
    }
}
