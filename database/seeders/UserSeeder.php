<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  // Import the User model
use Illuminate\Support\Facades\Hash; // Import the Hash facade

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin1@gmail.com',
                'password' => 'admin2',
                'role' => 'admin',
            ],
            [
                'name' => 'Center',
                'email' => 'center@gmail.com',
                'password' => 'admin3',
                'role' => 'center',
            ]
        ];

        foreach ($users as $user) {
           $user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make($user['password']),  // Hash the password
            ]); 
            $user->assignRole($user['role']);
        }

    }
}
