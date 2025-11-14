<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\http\Requests\WorkerStoreRequest;
use App\Http\Requests\WorkerUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WorkerlistController extends Controller
{
    public function index()
    {
        // Traer solo usuarios con rol "trabajador" y paginarlos de 10 en 10
        $workers = User::select('id', 'name', 'email', 'role', 'address', 'phone')
            ->where('role', UserRole::Trabajador)
            ->paginate(10);

        return Inertia::render('Dashboard/Workers/Workerslist', [
            'workers' => $workers,
        ]);
    }

    public function store(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'role' => UserRole::Trabajador->value, // siempre asignamos rol trabajador
            // password opcional o generado automáticamente
            'password' => bcrypt('defaultpassword123'),
        ]);

        return redirect()->route('dashboard.workers.index')
            ->with('success', 'Trabajador creado correctamente.');
    }

    public function update(WorkerUpdateRequest $request, User $worker)
    {
        $worker->update($request->validated());

        return redirect()->route('dashboard.workers.index')->with('success', 'Trabajador actualizado correctamente.');
    }

    public function destroy(User $worker)
    {
        $worker->delete();

        return redirect()->route('dashboard.workers.index')->with('success', 'Trabajador eliminado correctamente.');
    }
}
