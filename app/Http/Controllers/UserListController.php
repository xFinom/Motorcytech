<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;

class UserListController extends Controller
{
    public function index()
    {
        // Traer 10 usuarios por página
        $users = User::select('name', 'email', 'rfc', 'role', 'address', 'phone')->paginate(10);

        return Inertia::render('Dashboard/Users/Userslist', [
            'users' => $users
        ]);
    }
}