<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Admin
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345'), // You can change the password
            'role' => 'admin', // if you have a role column
        ]);

        // Create Regular User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('12345'), // You can change the password
            'role' => 'user', // if you have a role column
        ]);
        User::create([
            'name' => 'Office User',
            'email' => 'office@gmail.com',
            'password' => Hash::make('12345'), // You can change the password
            'role' => 'office', // if you have a role column
        ]);
    }
}
