<?php

namespace Database\Seeders;

use App\Enums\ServiceOrderStatus;
use App\Enums\UserRole;
use App\Models\Motorcycle;
use App\Models\MotorcycleType;
use App\Models\Service;
use App\Models\ServiceOrders;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@mt.com'],
            [
                'name' => 'Motorcytech Admin',
                'password' => Hash::make('password'),
                'role' => UserRole::Admin,
            ]
        );

        $this->createWorkers();
        $this->createClients();

        $clients = User::where('role', UserRole::Cliente)->get();

        $this->createMotorcycles($clients);
        $this->createServiceOrders($clients);
    }

    private function createWorkers(): void
    {
        $trabajadores = [
            'Luis Hernández', 'Carlos García', 'Juan Pérez', 'Miguel López', 'José Martínez',
            'Pedro González', 'Jorge Rodríguez', 'Fernando Sánchez', 'Ricardo Ramírez', 'David Torres',
            'Andrés Flores', 'Mario Castro', 'Victor Morales', 'Sergio Ortiz', 'Alejandro Jiménez'
        ];

        foreach ($trabajadores as $name) {
            $email = $this->generateEmail($name);
            User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make('secret123'),
                    'role' => UserRole::Trabajador,
                    'rfc' => strtoupper(Str::random(12)),
                    'address' => 'Dirección ejemplo',
                    'phone' => '555123456',
                ]
            );
        }
    }

    private function createClients(): void
    {
        $clientes = [
            'Ana Gómez', 'María Díaz', 'Laura Fernández', 'Patricia Herrera', 'Carmen Romero',
            'Gabriela Vargas', 'Verónica Cruz', 'Leticia Ríos', 'Raquel Mendoza', 'Claudia Soto',
            'Adriana Navarro', 'Elizabeth Reyes', 'Daniela Ortega', 'Sofía Aguilar', 'Natalia Castillo',
            'Carolina Peña', 'Mónica Morales', 'Jessica Guerrero', 'Paulina Castillo', 'Lorena Salazar',
            'Sandra Molina', 'Cecilia Ramos', 'Gloria Pacheco', 'Vanessa Medina', 'Alejandra León',
            'Isabel Rivas', 'Karen Espinoza', 'Mariana Chávez', 'Fabiola Delgado', 'Beatriz Cordero',
            'Jessica Campos', 'Paty Sandoval', 'Erika Jiménez', 'Viviana Gallegos', 'Claudia Acosta',
            'Paulina Bravo', 'Karina Duarte', 'Monica Santiago', 'Gabriela Paredes', 'Carla Robles',
            'Verónica Cortés', 'Lorena Salinas', 'Daniela Vázquez', 'Adriana Peña', 'Mariana Soto',
            'Natalia Morales', 'Jessica Moreno', 'Karen Herrera', 'Vanessa Torres', 'Isabel Rojas'
        ];

        foreach ($clientes as $name) {
            $email = $this->generateEmail($name);
            User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'password' => Hash::make('secret123'),
                    'role' => UserRole::Cliente,
                    'rfc' => strtoupper(Str::random(12)),
                    'address' => 'Calle 12345',
                    'phone' => '5551234567',
                ]
            );
        }
    }

    private function createMotorcycles(Collection $clients): void
    {
        $types = MotorcycleType::all();

        foreach ($clients as $client) {
            Motorcycle::query()->create([
                'placa' => strtoupper(Str::random(6)),
                'serial_num' => strtoupper(Str::random(6)),
                'motor_num' => strtoupper(Str::random(6)),
                'year' => rand(2000, date('Y')),
                'type_id' => $types->random()->id,
                'id_cliente' => $client->id,
            ]);
        }
    }

    private function createServiceOrders(Collection $clients): void
    {
        $services = Service::all();

        foreach ($clients as $client) {
            $client->load('motorcycles');

            ServiceOrders::query()->create([
                'id' => Str::ulid()->toBase32(),
                'entry_date' => now()->subDays(rand(0, 30)),
                'delivery_date' => now()->addDays(rand(1, 30)),
                'motorcycle_id' => $client->motorcycles->first()->id,
                'status' => ServiceOrderStatus::randomCase(),
                'client_id' => $client->id,
                'service_id' => $services->random()->id,
                'note' => 'Nota',
            ]);
        }
    }

    private function generateEmail(string $name): string
    {
        $namePart = strtolower(str_replace(' ', '.', $name));
        return $namePart . '@example.com';
    }
}
