<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = DB::table('roles')->where('name', 'admin')->first();

        DB::table('users')->insert([
            'role_id' => $adminRole->id,
            'name' => 'admin',
            'gender' => 'male',
            'dob' => '1990-01-01',
            'mobile' => '1234567890',
            'email' => 'admin@yopmail.com',
            'photo' => null,
            'password' => Hash::make('admin@123'),
            'is_approved' => 1,
            'approved_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
