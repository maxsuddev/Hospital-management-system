<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ro'llarni va permissionlarni yaratish
        $adminPermission = [
            'edit-category',
             'create-category',
             'delete-category',
              'create-service',
             'delete-service',
            'edit-service',
            'create-doctor',
            'delete-doctor',
            'edit-doctor',
        ];

        foreach ($adminPermission as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Ro'l yaratish
        $adminRole = Role::create(['name' => 'admin']);

        // Ro'lga permissionlarni berish
        $adminRole->syncPermissions($adminPermission);

        // Foydalanuvchini yaratish
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ]);

        // Foydalanuvchiga ro'l berish
        $user->assignRole($adminRole);
    }
}
