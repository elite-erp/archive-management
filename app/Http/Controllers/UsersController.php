<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::latest()->paginate(10);

        return Inertia::render('users/index', compact('users'));
    }


    public function store()
    {
        $data = request()->validate([
            'name' => 'required|max:191|min:3',
            'password' => 'required|min:8',
            'role' => 'required|in:موظف,مدير'
        ]);

        if (request()->hasFile('photo')) {
            $data['photo'] = '/' . request()->file('photo')->store('uploads/users');
        } else {
            $data['photo'] = "/imgs/user.png";
        }

        if (request()->has('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        User::create($data);

        return to_route('users.index');
    }


    public function show(User $user)
    {
        $documents = $user->documents()->paginate();

        return Inertia::render('users/show', compact('user', 'documents'));
    }

    public function uploadPhoto($id)
    {
        $user = User::find($id);
        $photo = '';
        if (request()->hasFile('photo')) {
            $photo = '/' . request()->file('photo')->store('uploads/users');
        }

        $user->update([
            'photo' => $photo
        ]);

        return to_route('users.show', $user->id);
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name' => 'max:191|min:3',
            'password' => 'min:8',
            'role' => 'in:موظف,مدير'
        ]);

        if (request()->has('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->fill($data);
        $user->save();

        return to_route('users.show', $user->id);
    }


    public function destroy(User $user)
    {
        $user->delete();
        return [
            'status' => 'OK',
            'message' => 'User Deleted Successfully'
        ];
    }
}
