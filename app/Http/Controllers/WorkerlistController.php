<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Enums\UserRole;

class WorkerlistController extends Controller
{
    public function index()
    {
        // Traer solo usuarios con rol "cliente" y paginarlos de 10 en 10
        $workers = User::select('name', 'email','role', 'address', 'phone')
            ->where('role', UserRole::Trabajador)
            ->paginate(10);

        return Inertia::render('Dashboard/Workers/Workerslist', [
            'workers' => $workers
        ]);
    }
}
