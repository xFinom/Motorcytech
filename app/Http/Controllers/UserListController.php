<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Enums\UserRole;

class UserListController extends Controller
{
    public function index()
    {
        // Traer solo usuarios con rol "cliente" y paginarlos de 10 en 10
        $users = User::select('name', 'email', 'rfc', 'role', 'address', 'phone')
            ->where('role', UserRole::Cliente)
            ->paginate(10);

        return Inertia::render('Dashboard/Users/Userslist', [
            'users' => $users
        ]);
    }
}