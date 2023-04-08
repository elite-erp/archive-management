<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
           $data['photo'] = request()->file('photo')->store('uploads/users');
        } else {
            $data['photo'] = "imgs/user.png";
        }
        User::create($data);

        return to_route('users.index');
    }


    public function show(User $user)
    {
        $documents = $user->documents()->paginate();

        return Inertia::render('users/show', compact('user', 'documents'));
    }




    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:191|email',
            'password' => 'required',
            'photo' => 'required',
            'isAdmin' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'error' => $validator->messages()
            ], 422);
        } else {

            if ($user) {
                $user->update([
                    'email' => $request->email,
                    'password' => $request->password,
                    'photo' => $request->photo,
                    'isAdmin' => $request->isAdmin,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => 'User Updated Successfully'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Something Went Wrong'
                ], 500);
            }
        }
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
