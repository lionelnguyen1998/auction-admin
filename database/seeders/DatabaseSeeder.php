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
            'name' => 'Nguyen Thi Tra',
            'email' => 'tra@gmail.com',
            'password' => Hash::make('123456'),
            'address' => 'Nghi Loc Nghe An',
            'phone' => '03327418888',
            'role' => '1',
        ]);
    }
}
