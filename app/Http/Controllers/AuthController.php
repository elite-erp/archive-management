<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'password' => 'required|min:6'
        ]);

        $credentials = request(['name', 'password']);
        if (!Auth::attempt($credentials)) {
            return to_route('/login', [
                'status_code' => 401,
                'message' => 'Unauthorized'
            ]);
        }

        return to_route('cpanel');
    }
    public function login()
    {
        return Inertia::render('login');
    }

    public function profile()
    {
        return Inertia::render('profile', [
            'user' => auth()->user(),
            'documents' => auth()->user()->documents()->latest()->paginate(10)
        ]);
    }
    public function logout()
    {
        auth()->logout();
        return to_route('login');
    }
}
