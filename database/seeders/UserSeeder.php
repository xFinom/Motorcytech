<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Crear un usuario por cada rol
        foreach (UserRole::cases() as $role) {
            User::factory()->create([
                'name' => $role->value.' User',
                'email' => strtolower($role->value).'@example.com',
                'role' => $role->value,
            ]);
        }

        // Crear al menos 15 clientes
        User::factory(15)->create([
            'role' => UserRole::Cliente->value,
        ]);

        User::factory(15)->create([
            'role' => UserRole::Trabajador->value,
        ]);

        // Crear algunos usuarios aleatorios (opcional)
        User::factory(10)->create();
    }
}
