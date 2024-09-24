<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_role = Role::create(['name' => 'admin']);
        $center_role = Role::create(['name' => 'center']);

        $permission_read = Permission::create(['name' => 'read  articles']);
        $permission_edit = Permission::create(['name' => 'edit articles']);
        $permission_write = Permission::create(['name' => 'write articles']);
        $permission_delete = Permission::create(['name' => 'delete articles']);
       
        $admin_role->givePermissionTo(Permission::pluck('id'));
    
    }

}
