<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // 🔹 Crear permisos
        $permisos = [
            'acceso administrador',
            'acceso usuario',
        ];

        foreach ($permisos as $perm) {
            Permission::firstOrCreate(['name' => $perm, 'guard_name' => 'web']);
        }

        // 🔹 Crear roles
        $admin = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        $user  = Role::firstOrCreate(['name' => 'Usuario', 'guard_name' => 'web']);

        // 🔹 Asignar permisos
        $admin->syncPermissions(['acceso administrador']);
        $user->syncPermissions(['acceso usuario']);

        // 🔹 Crear usuario administrador automáticamente
        $adminUser = User::firstOrCreate(
            ['email' => 'admin123@gmail.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('Admin123'), 
            ]
        );

        // 🔹 Asignar rol si aún no lo tiene
        if (!$adminUser->hasRole('Administrador')) {
            $adminUser->assignRole('Administrador');
        }

        $this->command->info('Roles, permisos y usuario administrador creados correctamente.');
        $this->command->info('Usuario: admin123@gmail.com | Contraseña: Admin123');
    }
}
