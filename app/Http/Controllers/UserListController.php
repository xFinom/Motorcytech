<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Enums\UserRole;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    public function index()
    {
        // Traer solo usuarios con rol "cliente" y paginarlos de 10 en 10
        $users = User::select('id','name', 'email', 'rfc', 'role', 'address', 'phone')
            ->where('role', UserRole::Cliente)
            ->paginate(10);

        return Inertia::render('Dashboard/Users/Userslist', [
            'users' => $users
        ]);
    }

    public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'rfc' => 'nullable|string|max:13',
        'role' => 'nullable|string',
        'address' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:20',
    ]);

    $user->update($validated);

    return redirect()->route('userslist')->with('success', 'Usuario actualizado correctamente.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete(); // elimina el usuario
        return redirect()->route('userslist')->with('success', 'Usuario eliminado correctamente.');
    }
}