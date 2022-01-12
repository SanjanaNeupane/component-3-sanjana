<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            'email' => 'sanjana@gmail.com',
            'password' => Hash::make('password'),
            'img' => '/img/girl2.png',
            'role' => 2
        ]);
        DB::table('users')->insert([
            'name' => 'neupane',
            'email' => 'neupane@gmail.com',
            'password' => Hash::make('password'),
            'img' => '/img/boy3.png',
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'img' => '/img/boy3.png',
            'password' => Hash::make('password')
        ]);
        DB::table('users')->insert([
            'name' => 'Jack Dell',
            'email' => 'jack345@gmail.com',
            'password' => Hash::make('password'),
            'img' => '/img/girl1.png',
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'Sara Roi',
            'email' => 'sara@gmail.com',
            'password' => Hash::make('password'),
            'img' => '/img/prabin.PNG',
            'role' => 1
        ]);
        DB::table('users')->insert([
            'name' => 'Roji Rose',
            'email' => 'roji@gmail.com',
            'password' => Hash::make('password'),
            'img' => '/img/boyy2.png'
        ]);


        \App\Models\Product::factory(10)->create();



        


    }
}
