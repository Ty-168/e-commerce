<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $manager = Role::firstOrCreate(['name' => 'manager']);
        $staff = Role::firstOrCreate(['name' => 'staff']);

        // Fetch all permissions
        $allPermissions = Permission::all();

        $managerPermissions = Permission::whereIn('name', [
            'products.create',
            'products.update',
            'category.create',
            'category.update',
        ])->get();

        // Assign permissions to roles
        $admin->permissions()->sync($allPermissions->pluck('id'));
        $manager->permissions()->sync($managerPermissions->pluck('id'));
    }
}
