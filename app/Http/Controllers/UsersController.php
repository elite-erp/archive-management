<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UsersController extends Controller
{

    public function index()
    {
        $search = request('search', '');
        $users = User::query()->when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%");
        })->select(['name', 'photo', 'role', 'id'])->latest()->paginate(10)->withQueryString();
        return Inertia::render('users/index', compact('users', 'search'));
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

        return to_route('users.index')->with('message', 'تم الحفظ بنجاح');
    }


    public function show(User $user)
    {
        $search = request('search', '');
        $documents = fetchDocuments($search, $user->id, 'created_by');
        return Inertia::render('users/show', compact('user', 'documents', 'search'));
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

        return to_route('users.show', $user->id)->with('message', 'تم التحديث بنجاح');
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
