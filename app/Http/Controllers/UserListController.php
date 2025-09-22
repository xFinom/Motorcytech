<?php

namespace App\Http\Controllers;

use App\Enums\UserRole;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Inertia\Inertia;

class UserListController extends Controller
{
    public function index()
    {
        // Traer solo usuarios con rol "cliente" y paginarlos de 10 en 10
        $users = User::select('id', 'name', 'email', 'rfc', 'role', 'address', 'phone')
            ->where('role', UserRole::Cliente)
            ->paginate(10);

        return Inertia::render('Dashboard/Users/Userslist', [
            'users' => $users,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());

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
