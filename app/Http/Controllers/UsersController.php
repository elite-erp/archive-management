<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    
    public function index()
    {
        //
        $users = User::orderBy('id','DESC')->paginate(10);
        if ($users->count() > 0) {
            return response()->json([
                    'status' => 200,
                    '$users' => $users
                ],200);
        }
        else {
            return response()->json([
                    'status' => 404,
                    'message' => 'No Records Found'
                ],404);
        }

    }

    
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:191|email',
            'password' => 'required',
            'photo' => 'required' ,
            'isAdmin' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422 ,
                'error' => $validator->messages()
            ],422) ;
        }else{
            $user = User::create([
                'email' => $request->email ,
                'password' => $request->password,
                'photo' => $request->photo,
                'isAdmin' => $request->isAdmin,
            ]);
            if ($user) {
                return response()->json([
                    'status' => 200 ,
                    'message' => 'User Created Successfully'
                ],200);
            } else{
                return response()->json([
                    'status' => 500 ,
                    'message' => 'Something Went Wrong'
                ],500);
            }
            
            
        }
    }

    
    public function show(User $user)
    {
        if ($user) {
            return response()->json([
                'status' => 200,
                'user' => $user
            ],200);
        }else{
            return response()->json([
                        'status' => 404,
                        'message' => 'No such User Found'
                    ],404);
        }
    }

    

   
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|max:191|email',
            'password' => 'required',
            'photo' => 'required' ,
            'isAdmin' => 'nullable'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422 ,
                'error' => $validator->messages()
            ],422) ;
        }else{
            
            if ($user) {
                $user->update([
                    'email' => $request->email ,
                    'password' => $request->password,
                    'photo' => $request->photo,
                    'isAdmin' => $request->isAdmin,
                ]);
                
                return response()->json([
                    'status' => 200 ,
                    'message' => 'User Updated Successfully'
                ],200);
            } else{
                return response()->json([
                    'status' => 500 ,
                    'message' => 'Something Went Wrong'
                ],500);
            }
            
            
        }
    }

   
    public function destroy(User $user)
    {
        $user->delete();
        return [
            'status' => 'OK' ,
            'message' => 'User Deleted Successfully'
        ];
    }
}
