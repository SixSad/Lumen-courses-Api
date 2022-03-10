<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'admin',
            'password' => Hash::make('admin'),
            'phone' => "+".random_int(1,99).random_int(0,999).random_int(0,999).random_int(0,99).random_int(0,99),
            'first_name' => 'admin',
            'last_name' => 'admin',
            'is_admin' => 'true'
        ]);
    }
}
