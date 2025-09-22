<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class WorkerlistController extends Controller
{
public function index()
{
    // Traer solo usuarios con rol "trabajador" y paginarlos de 10 en 10
    $workers = User::select('id', 'name', 'email','role', 'address', 'phone')
        ->where('role', UserRole::Trabajador)
        ->paginate(10);

    return Inertia::render('Dashboard/Workers/Workerslist', [
        'workers' => $workers
    ]);
}

        public function update(Request $request, User $worker)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$worker->id,
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $worker->update($validated);

        return redirect()->route('workerslist')->with('success', 'Trabajador actualizado correctamente.');
    }

    public function destroy(User $worker)
    {
        $worker->delete();
        return redirect()->route('workerslist')->with('success', 'Trabajador eliminado correctamente.');
    }
}
