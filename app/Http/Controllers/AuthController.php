<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        try {
            $request->validate([
                'name' => 'min:4|required',
                'password' => 'min:6|required'
            ]);

            $credentials = request(['name', 'password']);
            if (!Auth::attempt($credentials)) {
                return to_route('/login', [
                    'status_code' => 401,
                    'message' => 'Unauthorized'
                ]);
            }

            return to_route('cpanel');

        } catch (Exception $error) {
            dump($error);
            return response()->json([
                'status_code' => 403,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }
    public function login()
    {
        return Inertia::render('login');
    }

    public function profile()
    {
        return Inertia::render('profile', [
            'user' => User::first()
        ]);
    }
}
