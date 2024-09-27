<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;  // Import the User model
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $user = User::create([
        'name' => 'Super Admin',
        'email' => 'superadmin@example.com',
        'password' => Hash::make('password')
      ]);
  
      $role = Role::where('name', 'Super Admin')->first();
      $user->assignRole([$role->id]);
    }
}
