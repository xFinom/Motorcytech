<?php

namespace Database\Seeders;

use App\Models\Reviews;
use App\Models\User;
use App\Enums\ReviewStatus;
use Illuminate\Database\Seeder;

class ReviewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegúrate de que exista al menos un usuario
        $user = User::first() ?? User::factory()->create();

        // Generar 10 reseñas con estado Pendiente
        for ($i = 1; $i <= 10; $i++) {
            Reviews::create([
                'client_id' => $user->id,
                'comment'   => "Este es el comentario de prueba número {$i}.",
                'rating'    => fake()->randomFloat(1, 1, 5), // rating entre 1.0 y 5.0
                'status'    => ReviewStatus::Pendiente->value,
            ]);
        }
    }
}

